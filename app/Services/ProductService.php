<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{

    protected $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getByPaginate()
    {
        $result = $this->productRepository->getProductPaginate();
        return $result;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getProductsIndex():Collection
    {
        return $this->productRepository->getProductsIndex();
    }

    /**
     * @param int $product_type
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getByCategory(int $product_type)
    {
        return $this->productRepository->getProductsByType($product_type);
    }

    public function getProductById(int $id)
    {
        return $this->productRepository->getProductById($id);
    }
}
