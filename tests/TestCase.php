<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Storage;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config([
            'filesystems.disks.s3.key' => 'testing-key',
            'filesystems.disks.s3.secret' => 'testing-secret',
            'filesystems.disks.s3.region' => 'us-east-1',
            'filesystems.disks.s3.bucket' => 'test-bucket',
            'filesystems.disks.s3.url' => null,
        ]);

        Storage::fake('s3');
    }
}
