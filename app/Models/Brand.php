<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Lunar\Base\HasThumbnailImage;
use Spatie\MediaLibrary\HasMedia as SpatieHasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Brand extends Model implements HasThumbnailImage,SpatieHasMedia
{

    use InteractsWithMedia;
    protected $fillable = [
        'name',
        'name_ru',
        'name_uz',
    ];
    protected $table = 'lunar_brands';


    public static function morphName(): string
    {
        return (new static)->getMorphClass();
    }
    /**
     * Get brand name based on given or current locale.
     */
    public function nameForLocale(?string $locale = null): ?string
    {
        $locale = $locale ?: app()->getLocale();

        return match ($locale) {
            'ru' => $this->name_ru ?: $this->name,
            'uz' => $this->name_uz ?: $this->name,
            default => $this->name,
        };
    }

    /**
     * Scope to search across multilingual name columns.
     */
    public function scopeSearchNames(Builder $query, ?string $term): Builder
    {
        if (!$term) {
            return $query;
        }

        $term = "%{$term}%";

        return $query->where(function (Builder $q) use ($term) {
            $q->where('name', 'like', $term)
                ->orWhere('name_ru', 'like', $term)
                ->orWhere('name_uz', 'like', $term);
        });
    }

    public function images(): MorphMany
    {
        return $this->media()->where('collection_name', config('lunarphp.media.collection'));
    }

    public function getThumbnailImage(): string
    {
        return $this->getFirstMediaUrl('brand_cover', 'thumb')
            ?: $this->getFirstMediaUrl('brand_cover')
                ?: '';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('brand_cover')->singleFile();
        $this->addMediaCollection('brand_gallery');
    }

    public function registerMediaConversions(?\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300)
            ->sharpen(7)
            ->performOnCollections('brand_cover', 'brand_gallery')
            ->nonQueued();
    }
}
