<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Lunar\Models\Product;
use Lunar\Models\ProductType;
use phpDocumentor\Reflection\Types\Compound;

class ProductController extends Controller
{

    protected ProductService $service;

    /**
     * @param ProductService $service
     */
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object
     */
    public function index()
    {
        $products = $this->service->getByPaginate();

        return view('new.products-index',compact('products'));
    }

    /**
     * @param string $local
     * @param int $product_type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object
     */
    public function listByCategory(string $local,int $product_type)
    {
        $products = $this->service->getByCategory($product_type);

        return view('new.products-index',compact('products'));
    }

    /**
     * @param string $local
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object
     */
    public function show(string $local,int $id)
    {
        $product = $this->service->getProductById($id);

        return view('new.products-show',compact('product'));
    }
}
