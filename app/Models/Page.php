<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Lunar\Base\HasThumbnailImage;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia as SpatieHasMedia;


class Page extends Model implements HasThumbnailImage,SpatieHasMedia
{

    use InteractsWithMedia;
    protected $fillable = [
        'key',
        'title_uz', 'title_en', 'title_ru',
        'content_uz', 'content_en', 'content_ru',
        'is_published',
    ];

    // Return title based on current locale
    public function getTitleAttribute(): ?string
    {
        $locale = app()->getLocale();

        return $this->{'title_' . $locale} ?? $this->title_en ?? null;
    }

    // Return content based on current locale
    public function getContentAttribute(): ?string
    {
        $locale = app()->getLocale();

        return $this->{'content_' . $locale} ?? $this->content_en ?? null;
    }

    public function images(): MorphMany
    {
        return $this->media()->where('collection_name', config('lunar.media.collection'));
    }

    public function getThumbnailImage(): string
    {
        return $this->getFirstMediaUrl('pages_cover', 'thumb')
            ?: $this->getFirstMediaUrl('pages_cover')
                ?: '';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('pages_cover')->singleFile();
        $this->addMediaCollection('pages_gallery');
    }

    public function registerMediaConversions(?\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300)
            ->sharpen(7)
            ->performOnCollections('pages_cover', 'pages_gallery')
            ->nonQueued();
    }
}
