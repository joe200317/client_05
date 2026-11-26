<?php

use App\Support\MediaStorage;

if (! function_exists('s3_asset')) {
    /**
     * Build a public S3 URL for a static project asset path (e.g. images/logo.png).
     */
    function s3_asset(string $path): string
    {
        $path = ltrim(str_replace('\\', '/', $path), '/');

        return app(MediaStorage::class)->url($path);
    }
}
