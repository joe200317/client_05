<?php

namespace Tests\Unit;

use App\Support\MediaStorage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MediaStorageTest extends TestCase
{
    public function test_it_stores_uploaded_files_on_s3_and_returns_full_url(): void
    {
        $media = app(MediaStorage::class);
        $file = UploadedFile::fake()->create('cover.jpg', 120, 'image/jpeg');

        $url = $media->storeUploadedFile($file, 'blogs');

        $this->assertStringStartsWith('https://test-bucket.s3.us-east-1.amazonaws.com/', $url);
        $this->assertStringContainsString('/blogs/', $url);

        $key = $media->objectKey($url);
        $this->assertNotNull($key);
        Storage::disk('s3')->assertExists($key);
    }

    public function test_it_parses_object_keys_from_full_s3_urls_and_relative_paths(): void
    {
        $media = app(MediaStorage::class);

        $this->assertSame(
            'programs/demo.jpg',
            $media->objectKey('https://test-bucket.s3.us-east-1.amazonaws.com/programs/demo.jpg')
        );

        $this->assertSame(
            'gallery/photo.webp',
            $media->objectKey('storage/gallery/photo.webp')
        );
    }

    public function test_it_deletes_s3_objects_from_stored_urls(): void
    {
        Storage::disk('s3')->put('programs/keep-me.jpg', 'binary', 'public');
        $media = app(MediaStorage::class);
        $url = $media->url('programs/keep-me.jpg');

        $media->delete($url);

        Storage::disk('s3')->assertMissing('programs/keep-me.jpg');
    }
}
