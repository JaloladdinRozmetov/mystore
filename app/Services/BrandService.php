<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Lunar\Models\Brand;

class BrandService
{
    /**
     * Get all brands with pagination.
     *
     * @param  int  $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 24): LengthAwarePaginator
    {
        return Brand::query()
            ->with('media')                // Lunar uses Spatie MediaLibrary
            ->orderBy('name')              // 'name' is translatable; respects current locale
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Get all brands without pagination (be careful for large datasets).
     */
    public function all()
    {
        return Brand::query()
            ->with('media')
            ->orderBy('name')
            ->get();
    }
}
