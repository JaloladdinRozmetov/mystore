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
}
