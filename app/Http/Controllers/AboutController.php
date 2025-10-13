<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Compound;

class AboutController extends Controller
{
    public function index()
    {
        $about_us = SiteSetting::get('about');

        return view('new.about',compact('about_us'));

    }
}
