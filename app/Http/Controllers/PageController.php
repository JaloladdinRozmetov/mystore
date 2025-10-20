<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Service;
use App\Models\SiteSetting;

class PageController extends Controller
{
    public function about()
    {
        $page = Page::where('key', 'about')->where('is_published', true)->firstOrFail();
        $services = Service::active()->with('media')->limit(6)->get();
        $about_us = SiteSetting::get('about');

        return view('new.about',compact('page','services','about_us'));
    }
}
