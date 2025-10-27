<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\OurTeam;
use App\Models\Page;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Services\BrandService;
use App\Services\ProductService;

class HomeController extends Controller
{
    protected ProductService $product_service;
    protected BrandService $brand_service;
    public function __construct(BrandService $brand_service, ProductService $product_service)
    {
        $this->product_service = $product_service;
        $this->brand_service = $brand_service;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object
     */
    public function index()
    {
        $products = $this->product_service->getProductsIndex();
        $brands = $this->brand_service->all();
        $page = Page::where('key', 'about')->where('is_published', true)->firstOrFail();
        $about_us = SiteSetting::get('about');
        $services = Service::active()->with('media')->limit(6)->get();
        $latest_news = News::published()->with('media')->limit(3)->latest()->get();
        $our_team = OurTeam::query()->with('media')->limit(4)->latest()->get();

        return view('new.index',compact('products','brands','page','about_us','services','latest_news','our_team'));
    }
}
