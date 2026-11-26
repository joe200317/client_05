<?php

namespace App\Models;

use App\Support\MediaStorage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class GalleryPhoto extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'display_order',
        'is_visible',
    ];

    protected $casts = [
        'display_order' => 'integer',
        'is_visible' => 'boolean',
    ];

    public function getImageUrlAttribute(): string
    {
        return app(MediaStorage::class)->resolvePublicUrl(
            $this->image_path,
            asset('images/mind-training-lotus-mark.png')
        ) ?? asset('images/mind-training-lotus-mark.png');
    }

    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('is_visible', true)
            ->orderBy('display_order')
            ->orderByDesc('id');
    }
}
