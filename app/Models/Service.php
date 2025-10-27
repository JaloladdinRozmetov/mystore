<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Lunar\Base\HasThumbnailImage;
use Spatie\MediaLibrary\HasMedia as SpatieHasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Service extends Model implements HasThumbnailImage, SpatieHasMedia
{
    use SoftDeletes,HasFactory,InteractsWithMedia;

    protected $fillable = [
        'slug',
        'is_active',
        'sort_order',
        'published_at',
        'title_uz','title_ru','title_en',
        'excerpt_uz','excerpt_ru','excerpt_en',
        'content_uz','content_ru','content_en',
        'icon',
    ];

    protected $casts = [
        'is_active'   => 'bool',
        'published_at'=> 'datetime',
    ];

    // Auto-generate slug if missing and title exists
    protected static function booted(): void
    {
        static::saving(function (Service $service) {
            if (blank($service->slug)) {
                // Prefer current locale title if present
                $title = $service->getLocalized('title') ?? $service->title_uz ?? $service->title_ru ?? $service->title_en ?? '';
                $service->slug = Str::slug(Str::limit($title, 60, ''));
            }
        });
    }

    /**
     * Helper to get a localized field by current app locale.
     * Usage: $service->getLocalized('title'); // returns title_uz|title_ru|title_en
     */
    public function getLocalized(string $base): ?string
    {
        $locale = app()->getLocale();
        $attr = "{$base}_{$locale}";
        return $this->getAttribute($attr);
    }

    /** Scopes */
    public function scopeActive(Builder $q): Builder
    {
        return $q->where('is_active', true);
    }

    public function scopePublished(Builder $q): Builder
    {
        return $q->where(function ($q) {
            $q->whereNull('published_at')
                ->orWhere('published_at', '<=', now());
        });
    }

    public function scopeOrdered(Builder $q): Builder
    {
        return $q->orderBy('sort_order')->orderByDesc('published_at');
    }

    /** Accessors for convenience in Blade */
    public function getTitleAttribute(): ?string   { return $this->getLocalized('title'); }
    public function getExcerptAttribute(): ?string { return $this->getLocalized('excerpt'); }
    public function getContentAttribute(): ?string { return $this->getLocalized('content'); }

    /**
     * Get a localized field: t('title'), t('excerpt'), t('description')
     * Defaults to current app locale; falls back to 'uz' then 'en'.
     */
    public function t(string $base, ?string $locale = null): ?string
    {
        $locale = $locale ?: app()->getLocale();
        $candidates = [
            "{$base}_{$locale}",
            "{$base}_uz",
            "{$base}_en",
        ];

        foreach ($candidates as $col) {
            if (!empty($this->{$col})) {
                return $this->{$col};
            }
        }

        return null;
    }

    public function images(): MorphMany
    {
        return $this->media()->where('collection_name', config('lunarphp.media.collection'));
    }

    public function getThumbnailImage(): string
    {
        return $this->getFirstMediaUrl('service_cover', 'thumb')
            ?: $this->getFirstMediaUrl('service_cover')
                ?: '';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('service_cover')->singleFile();
        $this->addMediaCollection('service_gallery');
    }

    public function registerMediaConversions(?\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300)
            ->sharpen(7)
            ->performOnCollections('service_cover', 'service_gallery')
            ->nonQueued();
    }

}
