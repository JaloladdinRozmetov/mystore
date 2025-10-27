<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Lunar\Base\HasThumbnailImage;
use Spatie\MediaLibrary\HasMedia as SpatieHasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class OurTeam extends Model implements HasThumbnailImage, SpatieHasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $fillable = [
        'name_uz',
        'name_ru',
        'name_en',
        'job_title_uz',
        'job_title_ru',
        'job_title_en',
        'social_links',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];

    public function getNameAttribute()
    {
        $locale = app()->getLocale();
        $column = "name_{$locale}";
        return $this->{$column} ?? $this->name_en; // fallback to English
    }

    /**
     * Automatically return the translated job title
     */
    public function getJobTitleAttribute()
    {
        $locale = app()->getLocale();
        $column = "job_title_{$locale}";
        return $this->{$column} ?? $this->job_title_en; // fallback to English
    }

    public function images(): MorphMany
    {
        return $this->media()->where('collection_name', config('lunarphp.media.collection'));
    }

    public function getThumbnailImage(): string
    {
        return $this->getFirstMediaUrl('team_cover', 'thumb')
            ?: $this->getFirstMediaUrl('team_cover')
                ?: '';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('team_cover')->singleFile();
        $this->addMediaCollection('team_gallery');
    }

    public function registerMediaConversions(?\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300)
            ->sharpen(7)
            ->performOnCollections('team_cover', 'team_gallery')
            ->nonQueued(); // switch to queued if you have queues
    }
}
