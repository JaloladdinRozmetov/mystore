@extends('new.layouts.app')

@section('title', 'IDEALMETER — About')

@section('content')

    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">{{__('messages.about_us')}}</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{route('home',app()->getLocale())}}">{{__('messages.home')}}</a></li>
                <li class="breadcrumb-item active text-primary">{{__('messages.about_us')}}</li>
            </ol>
        </div>
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

    <!-- About Start -->
    <div class="container-fluid about py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="about-img rounded h-100">
                        <img src="{{$page->getFirstMediaUrl('pages_cover')}}" class="img-fluid rounded h-100 w-100" style="object-fit: cover;" alt="">
                        <div class="about-exp"><span>{{$about_us['experiance_'.app()->getLocale()]}}</span></div>
                    </div>
                </div>
                <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="about-item">
                        <h4 class="text-primary text-uppercase">{{__('messages.about_us')}}</h4>
                        <h1 class="display-3 mb-3">{{$page->getTitleAttribute()}}</h1>
                        <p class="mb-4">
                            {!!  $page->getContentAttribute() !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Service Start -->
    <div class="container-fluid service bg-light overflow-hidden py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-uppercase text-primary">{{__('messages.services.our')}}</h4>
                <h1 class="display-3 text-capitalize mb-3">{{__('messages.services.description')}}</h1>
            </div>
            <div class="row gx-0 gy-4 align-items-center">
                <div class="col-lg-6 col-xl-4 wow fadeInLeft" data-wow-delay="0.2s">
                    @foreach($services->slice(0,3) as $service)
                        <div class="service-item rounded p-4 mb-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <div class="service-content text-end">
                                            <a href="#" class="h4 d-inline-block mb-3">{{$service->getTitleAttribute()}}</a>
                                            <p class="mb-0">{{$service->getExcerptAttribute()}}</p>
                                        </div>
                                        <div class="ps-4">

                                            <img src="{{$service->getFirstMediaUrl('images')}}" alt="{{$service->title}}" class="img-fluid rounded-circle"
                                                 style="width: 200px; height: 150px; object-fit: contain;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="bg-transparent">
                        <!--                            <img src="img/water.png" class="img-fluid w-100" alt="">-->
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4 wow fadeInRight" data-wow-delay="0.2s">
                    @foreach($services->slice(3,3) as $service)
                        <div class="service-item rounded p-4 mb-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <div class="service-content text-end">
                                            <a href="#" class="h4 d-inline-block mb-3">{{$service->getTitleAttribute()}}</a>
                                            <p class="mb-0">{{$service->getExcerptAttribute()}}</p>
                                        </div>
                                        <div class="ps-4">
                                            <img src="{{$service->getFirstMediaUrl('service_cover','thumb')}}" alt="{{$service->title}}" class="img-fluid rounded-circle"
                                                 style="width: 200px; height: 150px; object-fit: contain;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


@endsection
