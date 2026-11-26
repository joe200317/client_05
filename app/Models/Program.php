<?php

namespace App\Models;

use App\Support\MediaStorage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Program extends Model
{
    public const CATEGORY_OPTIONS = [
        'Mind Trainer',
        'Mind Coaching',
        'Mental Wellness & Alternative Healing',
        'Corporate & Soft Skills Training',
        'Others',
    ];

    public const TYPE_OPTIONS = [
        'Seminar',
        'Webinar',
        '1-on-1 Seminar',
        'Mind Trainer',
        'Personal and Professional Development Skills',
        'Others',
    ];

    protected $fillable = [
        'category',
        'type',
        'title',
        'slug',
        'description',
        'thumbnail_path',
        'schedule_or_format',
        'price',
        'button_label',
        'button_link',
        'display_order',
        'is_visible',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'display_order' => 'integer',
            'is_visible' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Program $program) {
            if (empty($program->slug)) {
                $program->slug = static::generateUniqueSlug($program->title);
            }
        });
    }

    public static function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'program';
        $slug = $base;
        $counter = 2;

        while (
            static::where('slug', $slug)
                ->when($ignoreId, fn (Builder $q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$base}-{$counter}";
            $counter++;
        }

        return $slug;
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        return app(MediaStorage::class)->resolvePublicUrl($this->thumbnail_path);
    }

    public function getExcerptAttribute(): string
    {
        return Str::limit(strip_tags((string) $this->description), 140);
    }

    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('is_visible', true)
            ->orderBy('display_order')
            ->orderByDesc('id');
    }
}
