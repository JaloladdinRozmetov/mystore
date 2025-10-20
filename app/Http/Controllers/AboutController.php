<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\SiteSetting;

class AboutController extends Controller
{
    public function index()
    {
        $about_us = SiteSetting::get('about');
        $services = Service::active()->with('media')->limit(6)->get();
        return view('new.about',compact('about_us','services'));

    }
}
