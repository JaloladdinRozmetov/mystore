<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value'];
    protected $casts = ['value' => 'array'];

    public static function get(string $key, $default = null) {
        return Cache::remember("site_setting:$key", 3600, fn () =>
            optional(static::query()->where('key', $key)->first())->value ?? $default
        );
    }

    public static function set(string $key, $value): void {
        static::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget("site_setting:$key");
    }
}
