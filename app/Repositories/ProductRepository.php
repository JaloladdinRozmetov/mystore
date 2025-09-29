<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Lunar\Models\Product;

class ProductRepository
{

    /**
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getProductPaginate(): \Illuminate\Pagination\LengthAwarePaginator
    {
        return Product::query()->with('media','variants')->paginate(12);
    }

    /**
     * @return Collection
     */
    public function getProductsIndex(): Collection
    {
        return Product::query()->with('variants','images','prices')->limit(3)->latest()->inRandomOrder()->get();
    }

}
