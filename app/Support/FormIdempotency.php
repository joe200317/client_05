<?php

namespace App\Support;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;

class FormIdempotency
{
    public static function fingerprint(Request $request, ?string $scope = null): string
    {
        $actor = $request->user()?->getAuthIdentifier();

        if ($actor === null || $actor === '') {
            // Avoid session-id volatility between rapid requests; bind guests to IP + UA.
            $actor = hash('sha256', implode('|', [
                $request->ip() ?: '0.0.0.0',
                substr((string) $request->userAgent(), 0, 160),
            ]));
        }

        $payload = $request->except([
            '_token',
            '_method',
            'password',
            'password_confirmation',
            'current_password',
        ]);

        foreach ($request->allFiles() as $key => $file) {
            $payload[$key] = self::fileSignature($file);
        }

        array_walk_recursive($payload, static function (mixed &$value): void {
            if (is_string($value)) {
                $value = trim($value);
            }
        });

        self::recursiveKeySort($payload);

        return hash('sha256', implode('|', [
            $scope ?? $request->route()?->getName() ?? $request->path(),
            (string) $actor,
            $request->method(),
            json_encode($payload, JSON_THROW_ON_ERROR),
        ]));
    }

    public static function claim(Request $request, ?string $scope = null, int $ttlSeconds = 8): bool
    {
        $key = 'form-idempotency:'.self::fingerprint($request, $scope);

        return Cache::add($key, 1, now()->addSeconds($ttlSeconds));
    }

    public static function release(Request $request, ?string $scope = null): void
    {
        Cache::forget('form-idempotency:'.self::fingerprint($request, $scope));
    }

    /**
     * @param  UploadedFile|array<int, UploadedFile>|null  $file
     */
    private static function fileSignature(mixed $file): mixed
    {
        if (is_array($file)) {
            return array_map(fn (mixed $item) => self::fileSignature($item), $file);
        }

        if (! $file instanceof UploadedFile) {
            return null;
        }

        return [
            'name' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
            'mime' => $file->getMimeType(),
        ];
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    private static function recursiveKeySort(array &$payload): void
    {
        ksort($payload);

        foreach ($payload as &$value) {
            if (is_array($value)) {
                self::recursiveKeySort($value);
            }
        }
    }
}
