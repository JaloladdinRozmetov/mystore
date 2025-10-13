@extends('new.layouts.app')

@section('title', 'Acuas — News')

@section('content')

    @error('name')
    <div class="text-danger">{{ $message }}</div>
    @enderror

    <div class="container-fluid position-relative p-0">
        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">{{__('messages.our_news_blog')}}</h4>
                <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item"><a href="{{route('home',app()->getLocale())}}">{{__('messages.home')}}</a></li>
                    <li class="breadcrumb-item active text-primary">{{__('messages.news_blog')}}</li>
                </ol>
            </div>
        </div>
        <!-- Header End -->
    </div>

    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h4 class="modal-title mb-0" id="exampleModalLabel">Search by keyword</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text btn border p-3"><i class="fa fa-search text-white"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->

    <!-- News Detail start -->
    <div class="container-fluid about overflow-hidden py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="about-img rounded h-100" style="max-height: 70%">
                        <img src="{{$item->getFirstMediaUrl('news_cover','thumb')}}" class="img-fluid rounded h-100 w-100" style="object-fit: cover;" alt="">
                        <div class="about-exp"><span>{{$item->published_at}}</span></div>
                    </div>
                </div>
                <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="about-item">
                        <h1 class="display-3 mb-3">{{$item->getTitleCurAttribute()}}</h1>
                        <p class="mb-4">{{$item->getDescriptionCurAttribute()}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- News Detail end -->
@endsection
