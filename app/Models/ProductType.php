<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Lunar\Models\ProductType as LunarProductType;
class ProductType extends LunarProductType
{
    protected $fillable = [
        'name', 'name_ru', 'name_uz',
    ];

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
}
