<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;
use Lunar\Base\HasThumbnailImage;     // your interface
use Spatie\MediaLibrary\HasMedia as SpatieHasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class News extends Model implements HasThumbnailImage, SpatieHasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'author_id',
        'title_uz', 'excerpt_uz', 'description_uz',
        'title_ru', 'excerpt_ru', 'description_ru',
        'title_en', 'excerpt_en', 'description_en',

        'slug', 'status', 'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */
    public function scopePublished($q)
    {
        return $q->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /*
    |--------------------------------------------------------------------------
    | Locale helpers
    |--------------------------------------------------------------------------
    */
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

    // Convenient accessors for Blade: $news->title_cur / excerpt_cur / description_cur
    public function getTitleCurAttribute(): ?string       { return $this->t('title'); }
    public function getExcerptCurAttribute(): ?string     { return $this->t('excerpt'); }
    public function getDescriptionCurAttribute(): ?string { return $this->t('description'); }

    /*
    |--------------------------------------------------------------------------
    | Media (Spatie / Lunar)
    |--------------------------------------------------------------------------
    */
    public function images(): MorphMany
    {
        return $this->media()->where('collection_name', config('lunarphp.media.collection'));
    }

    public function getThumbnailImage(): string
    {
        return $this->getFirstMediaUrl('news_cover', 'thumb')
            ?: $this->getFirstMediaUrl('news_cover')
                ?: '';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('news_cover')->singleFile();
        $this->addMediaCollection('news_gallery');
    }

    public function registerMediaConversions(?\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300)
            ->sharpen(7)
            ->performOnCollections('news_cover', 'news_gallery')
            ->nonQueued(); // switch to queued if you have queues
    }

    /*
    |--------------------------------------------------------------------------
    | Slug generation
    |--------------------------------------------------------------------------
    */
    protected static function booted(): void
    {
        static::creating(function (News $news) {
            // If slug empty, generate from the best available title (current locale -> uz -> en)
            if (empty($news->slug)) {
                $title = $news->t('title') ?? 'news';
                $base  = Str::slug($title) ?: 'news';
                $slug  = $base;
                $i     = 2;

                while (self::where('slug', $slug)->exists()) {
                    $slug = "{$base}-{$i}";
                    $i++;
                }
                $news->slug = $slug;
            }
        });

        static::updating(function (News $news) {
            // If slug is missing (or admin cleared it), regenerate from title
            if (empty($news->slug)) {
                $title = $news->t('title') ?? 'news';
                $base  = Str::slug($title) ?: 'news';
                $slug  = $base;
                $i     = 2;

                while (self::where('slug', $slug)->where('id', '!=', $news->id)->exists()) {
                    $slug = "{$base}-{$i}";
                    $i++;
                }
                $news->slug = $slug;
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
