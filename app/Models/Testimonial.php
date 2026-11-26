<?php

namespace App\Models;

use App\Support\MediaStorage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'quote',
        'learner_name',
        'program_or_role',
        'photo_path',
        'is_published',
        'show_on_home',
        'display_order',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'show_on_home' => 'boolean',
            'display_order' => 'integer',
        ];
    }

    public function getPhotoUrlAttribute(): ?string
    {
        return app(MediaStorage::class)->resolvePublicUrl($this->photo_path);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)
            ->orderBy('display_order')
            ->orderByDesc('id');
    }

    public function scopeForHome(Builder $query): Builder
    {
        return $query->where('is_published', true)
            ->where('show_on_home', true)
            ->orderBy('display_order')
            ->orderByDesc('id');
    }
}
