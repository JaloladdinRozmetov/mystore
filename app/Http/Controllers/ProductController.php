<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected $service;
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $products = $this->service->getByPaginate();

        return view('new.product.index',compact('products'));
    }
}
