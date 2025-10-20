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
        return Product::query()->with('images','variants','prices')->paginate(12);
    }

    /**
     * @return Collection
     */
    public function getProductsIndex(): Collection
    {
        return Product::query()->with('variants','images','prices')->limit(3)->latest()->inRandomOrder()->get();
    }

    /**
     * @param int $product_type
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getProductsByType(int $product_type)
    {
        $products = Product::query()
            ->with('variants','images','prices','brand')
            ->status('published')
            ->where('product_type_id', $product_type)
            ->paginate(12);

        return $products;
    }

    public function getProductById(int $id)
    {
        return Product::query()
            ->with('variants','images','prices','brand','productType')
            ->findOrFail($id);
    }

}
