<?php

namespace App\Http\Controllers;

use App\Services\HomeService;
use App\Services\ProductService;

class HomeController extends Controller
{
    protected HomeService $home_service;
    protected ProductService $product_service;
    public function __construct(HomeService $home_service, ProductService $product_service)
    {
        $this->home_service = $home_service;
        $this->product_service = $product_service;
    }


    public function index()
    {
        $products = $this->product_service->getProductsIndex();

        return view('new.index',compact('products'));
    }
}
