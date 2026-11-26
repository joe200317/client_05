<?php

namespace App\Console\Commands;

use App\Models\BlogPost;
use App\Models\GalleryPhoto;
use App\Models\Program;
use App\Models\Testimonial;
use App\Support\MediaStorage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Throwable;

class MigrateMediaToS3Command extends Command
{
    protected $signature = 'media:migrate-to-s3
                            {--dry-run : Preview actions without uploading or updating MySQL}
                            {--with-static : Also upload static files from public/images (not required for normal use)}';

    protected $description = 'Upload dynamic admin media from MySQL/local storage to S3 and sync full S3 URLs. Static public/images stay local unless --with-static is passed.';

    public function handle(MediaStorage $media): int
    {
        $dryRun = (bool) $this->option('dry-run');

        if (! filled(config('filesystems.disks.s3.bucket'))) {
            $this->error('S3 bucket is not configured. Set AWS_BUCKET or AWS_S3_BUCKET_NAME in .env.');

            return self::FAILURE;
        }

        $this->info($dryRun ? 'Dry run: no uploads or database updates will be made.' : 'Migrating media to S3…');
        $this->newLine();

        $dbUpdated = 0;
        $dbSkipped = 0;
        $dbFailed = 0;

        foreach ($this->databaseTargets() as $target) {
            $this->line("→ {$target['label']}");

            foreach ($target['query']()->cursor() as $model) {
                $column = $target['column'];
                $current = $model->{$column};

                if (! filled($current)) {
                    $dbSkipped++;

                    continue;
                }

                if (Str::startsWith((string) $current, ['http://', 'https://'])) {
                    $dbSkipped++;

                    continue;
                }

                $absolute = $this->resolveLocalAbsolutePath((string) $current);

                if ($absolute === null) {
                    $this->warn("  Missing local file for {$target['label']} #{$model->getKey()}: {$current}");
                    $dbFailed++;

                    continue;
                }

                $destination = $this->destinationKeyForDatabaseValue((string) $current, $target['folder']);

                try {
                    if ($dryRun) {
                        $this->line("  [dry-run] {$absolute} → s3://{$destination}");
                    } else {
                        $url = $media->storeLocalFile($absolute, $destination);
                        $model->forceFill([$column => $url])->save();
                        $this->line("  Updated {$target['label']} #{$model->getKey()}");
                    }

                    $dbUpdated++;
                } catch (Throwable $exception) {
                    $this->error("  Failed {$target['label']} #{$model->getKey()}: {$exception->getMessage()}");
                    $dbFailed++;
                }
            }
        }

        $staticUploaded = 0;
        $staticSkipped = 0;
        $staticFailed = 0;

        if ($this->option('with-static')) {
            $this->newLine();
            $this->line('→ Static assets in public/images');

            $imagesRoot = public_path('images');

            if (! File::isDirectory($imagesRoot)) {
                $this->warn('  public/images directory not found.');
            } else {
                foreach (File::allFiles($imagesRoot) as $file) {
                    if (! $this->isImageFile($file->getFilename())) {
                        $staticSkipped++;

                        continue;
                    }

                    $relative = 'images/'.str_replace('\\', '/', $file->getRelativePathname());

                    try {
                        if ($dryRun) {
                            $this->line("  [dry-run] {$file->getPathname()} → s3://{$relative}");
                        } else {
                            $media->storeLocalFile($file->getPathname(), $relative);
                            $this->line("  Uploaded {$relative}");
                        }

                        $staticUploaded++;
                    } catch (Throwable $exception) {
                        $this->error("  Failed {$relative}: {$exception->getMessage()}");
                        $staticFailed++;
                    }
                }
            }
        }

        $this->newLine();
        $this->info('Migration summary');
        $this->table(
            ['Scope', 'Processed', 'Skipped', 'Failed'],
            [
                ['Database media', $dbUpdated, $dbSkipped, $dbFailed],
                ['Static public/images', $staticUploaded, $staticSkipped, $staticFailed],
            ]
        );

        $this->comment('Local files were left intact as a backup.');

        return ($dbFailed + $staticFailed) > 0 ? self::FAILURE : self::SUCCESS;
    }

    /**
     * @return list<array{label: string, column: string, folder: string, query: callable}>
     */
    private function databaseTargets(): array
    {
        return [
            [
                'label' => 'programs.thumbnail_path',
                'column' => 'thumbnail_path',
                'folder' => 'programs',
                'query' => fn () => Program::query()->whereNotNull('thumbnail_path'),
            ],
            [
                'label' => 'blog_posts.cover_image_path',
                'column' => 'cover_image_path',
                'folder' => 'blogs',
                'query' => fn () => BlogPost::query()->whereNotNull('cover_image_path'),
            ],
            [
                'label' => 'gallery_photos.image_path',
                'column' => 'image_path',
                'folder' => 'gallery',
                'query' => fn () => GalleryPhoto::query()->whereNotNull('image_path'),
            ],
            [
                'label' => 'testimonials.photo_path',
                'column' => 'photo_path',
                'folder' => 'testimonials',
                'query' => fn () => Testimonial::query()->whereNotNull('photo_path'),
            ],
        ];
    }

    private function resolveLocalAbsolutePath(string $value): ?string
    {
        $clean = ltrim(str_replace('\\', '/', $value), '/');

        if (Str::startsWith($clean, 'storage/')) {
            $clean = Str::after($clean, 'storage/');
        }

        $candidates = [
            storage_path('app/public/'.$clean),
            public_path('storage/'.$clean),
            public_path($clean),
            base_path($clean),
        ];

        foreach ($candidates as $candidate) {
            if (is_file($candidate)) {
                return $candidate;
            }
        }

        return null;
    }

    private function destinationKeyForDatabaseValue(string $value, string $folder): string
    {
        $clean = ltrim(str_replace('\\', '/', $value), '/');

        if (Str::startsWith($clean, 'storage/')) {
            $clean = Str::after($clean, 'storage/');
        }

        if (Str::startsWith($clean, $folder.'/')) {
            return $clean;
        }

        return $folder.'/'.basename($clean);
    }

    private function isImageFile(string $filename): bool
    {
        return (bool) preg_match('/\.(jpe?g|png|gif|webp|svg|ico|avif|bmp|jpe)$/i', $filename);
    }
}
