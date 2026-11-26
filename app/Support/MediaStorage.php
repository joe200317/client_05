<?php

namespace App\Support;

use Aws\S3\S3Client;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Filesystem\AwsS3V3Adapter;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;

class MediaStorage
{
    public function disk(): string
    {
        return 's3';
    }

    public function storeUploadedFile(UploadedFile $file, string $directory): string
    {
        $directory = trim($directory, '/');
        $extension = $file->getClientOriginalExtension() ?: $file->extension() ?: 'bin';
        $filename = Str::uuid()->toString().'.'.strtolower($extension);
        $path = $directory.'/'.$filename;

        $stream = fopen($file->getRealPath(), 'r');

        if ($stream === false) {
            throw new RuntimeException('Unable to read uploaded file stream.');
        }

        try {
            $this->putObject($path, $stream, $file->getMimeType() ?: 'application/octet-stream');
        } finally {
            if (is_resource($stream)) {
                fclose($stream);
            }
        }

        return $this->url($path);
    }

    public function storeLocalFile(string $absolutePath, string $destinationPath): string
    {
        $destinationPath = ltrim(str_replace('\\', '/', $destinationPath), '/');
        $stream = fopen($absolutePath, 'r');

        if ($stream === false) {
            throw new RuntimeException("Unable to read local file [{$absolutePath}].");
        }

        $mime = mime_content_type($absolutePath) ?: 'application/octet-stream';

        try {
            $this->putObject($destinationPath, $stream, $mime);
        } finally {
            if (is_resource($stream)) {
                fclose($stream);
            }
        }

        return $this->url($destinationPath);
    }

    /**
     * Upload without ACL headers. Required for buckets with Object Ownership = BucketOwnerEnforced.
     *
     * @param  resource|string  $body
     */
    public function putObject(string $path, mixed $body, ?string $contentType = null): void
    {
        $path = ltrim(str_replace('\\', '/', $path), '/');
        $disk = $this->filesystem();

        // Storage::fake() replaces the S3 adapter in tests — use plain put there.
        if (! $disk instanceof AwsS3V3Adapter) {
            $contents = is_resource($body) ? (stream_get_contents($body) ?: '') : $body;
            $disk->put($path, $contents);

            return;
        }

        $bucket = (string) config('filesystems.disks.s3.bucket');

        if ($bucket === '') {
            throw new RuntimeException('S3 bucket is not configured.');
        }

        $params = [
            'Bucket' => $bucket,
            'Key' => $path,
            'Body' => $body,
        ];

        if (filled($contentType)) {
            $params['ContentType'] = $contentType;
        }

        $disk->getClient()->putObject($params);
    }

    public function url(string $path): string
    {
        $path = ltrim(str_replace('\\', '/', $path), '/');

        $diskUrl = $this->filesystem()->url($path);

        if (Str::startsWith($diskUrl, ['http://', 'https://'])) {
            return $diskUrl;
        }

        $bucket = (string) config('filesystems.disks.s3.bucket');
        $region = (string) config('filesystems.disks.s3.region', 'us-east-1');
        $encoded = implode('/', array_map('rawurlencode', explode('/', $path)));

        return "https://{$bucket}.s3.{$region}.amazonaws.com/{$encoded}";
    }

    public function delete(?string $urlOrPath): void
    {
        $key = $this->objectKey($urlOrPath);

        if ($key === null) {
            return;
        }

        $this->filesystem()->delete($key);
    }

    public function objectKey(?string $urlOrPath): ?string
    {
        if (! filled($urlOrPath)) {
            return null;
        }

        $value = trim((string) $urlOrPath);

        if ($value === '') {
            return null;
        }

        if (! Str::startsWith($value, ['http://', 'https://'])) {
            $clean = ltrim(str_replace('\\', '/', $value), '/');

            if (Str::startsWith($clean, 'storage/')) {
                $clean = Str::after($clean, 'storage/');
            }

            return $clean !== '' ? $clean : null;
        }

        $path = parse_url($value, PHP_URL_PATH);

        if (! is_string($path) || $path === '' || $path === '/') {
            return null;
        }

        $key = ltrim(rawurldecode($path), '/');
        $bucket = (string) config('filesystems.disks.s3.bucket');

        if ($bucket !== '' && Str::startsWith($key, $bucket.'/')) {
            $key = Str::after($key, $bucket.'/');
        }

        return $key !== '' ? $key : null;
    }

    public function resolvePublicUrl(?string $urlOrPath, ?string $fallback = null): ?string
    {
        if (! filled($urlOrPath)) {
            return $fallback;
        }

        $value = trim((string) $urlOrPath);

        if (Str::startsWith($value, ['http://', 'https://'])) {
            return $value;
        }

        $key = $this->objectKey($value);

        if ($key === null) {
            return $fallback;
        }

        return $this->url($key);
    }

    public function filesystem(): Filesystem|AwsS3V3Adapter
    {
        return Storage::disk($this->disk());
    }

    /**
     * @return S3Client
     */
    public function client()
    {
        $disk = $this->filesystem();

        if (! method_exists($disk, 'getClient')) {
            throw new RuntimeException('S3 disk client is unavailable.');
        }

        return $disk->getClient();
    }
}
