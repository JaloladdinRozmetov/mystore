@extends('new.layouts.app')

@section('title', 'IDEALMETER — Home')

@section('content')

    <!-- Carousel Start -->
    <div class="carousel-header">
        <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
                <li data-bs-target="#carouselId" data-bs-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img src="{{ asset('acuas/img/carousel-1.jpg') }}" class="img-fluid w-100" alt="Image">
                    <div class="carousel-caption-1">
                        <div class="carousel-caption-1-content" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase fw-bold mb-4 fadeInLeft animated" data-animation="fadeInLeft" data-delay="1s" style="animation-delay: 1s;">Importance life</h4>
                            <h1 class="display-2 text-capitalize text-white mb-4 fadeInLeft animated" data-animation="fadeInLeft" data-delay="1.3s" style="animation-delay: 1.3s;">Always Want Safe Water For Healthy Life</h1>
                            <p class="mb-5 fs-5 text-white fadeInLeft animated" data-animation="fadeInLeft" data-delay="1.5s" style="animation-delay: 1.5s;">Lorem Ipsum is simply dummy text of the printing and typesetting industry...</p>
                            <div class="carousel-caption-1-content-btn fadeInLeft animated" data-animation="fadeInLeft" data-delay="1.7s" style="animation-delay: 1.7s;">
                                <a class="btn btn-primary rounded-pill flex-shrink-0 py-3 px-5 me-2" href="#">Order Now</a>
                                <a class="btn btn-secondary rounded-pill flex-shrink-0 py-3 px-5 ms-2" href="#">Free Estimate</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('acuas/img/carousel-2.jpg') }}" class="img-fluid w-100" alt="Image">
                    <div class="carousel-caption-2">
                        <div class="carousel-caption-2-content" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase fw-bold mb-4 fadeInRight animated" data-animation="fadeInRight" data-delay="1s" style="animation-delay: 1s;">Importance life</h4>
                            <h1 class="display-2 text-capitalize text-white mb-4 fadeInRight animated" data-animation="fadeInRight" data-delay="1.3s" style="animation-delay: 1.3s;">Always Want Safe Water For Healthy Life</h1>
                            <p class="mb-5 fs-5 text-white fadeInRight animated" data-animation="fadeInRight" data-delay="1.5s" style="animation-delay: 1.5s;">Lorem Ipsum is simply dummy text of the printing and typesetting industry...</p>
                            <div class="carousel-caption-2-content-btn fadeInRight animated" data-animation="fadeInRight" data-delay="1.7s" style="animation-delay: 1.7s;">
                                <a class="btn btn-primary rounded-pill flex-shrink-0 py-3 px-5 me-2" href="#">Order Now</a>
                                <a class="btn btn-secondary rounded-pill flex-shrink-0 py-3 px-5 ms-2" href="#">Free Estimate</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                <span class="carousel-control-prev-icon btn btn-primary fadeInLeft animated" aria-hidden="true" data-animation="fadeInLeft" data-delay="1.1s" style="animation-delay: 1.3s;"> <i class="fa fa-angle-left fa-3x"></i></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                <span class="carousel-control-next-icon btn btn-primary fadeInRight animated" aria-hidden="true" data-animation="fadeInLeft" data-delay="1.1s" style="animation-delay: 1.3s;"><i class="fa fa-angle-right fa-3x"></i></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Products Start -->
    <div class="container-fluid product py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h1 class="text-uppercase text-primary">{{__('messages.products.title')}}</h1>
                <h5 class="display-4 mb-3">{{__('messages.products.subtitle')}}</h5>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($products as $product)
                    <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="product-item">
                            <img src="{{ $product->getFirstMediaUrl('images','large') }}" class="img-fluid w-100 rounded-top"  alt="Image">
                            <div class="product-content bg-light text-center rounded-bottom p-4">
                                <p>{{$product->brand->name ?? ''}}</p>
                                <a href="{{route('product.show',['locale' => app()->getLocale(),'id' => $product->id])}}" class="h4 d-inline-block mb-3">{{ $product->translateAttribute('name') }}</a>
                                <p class="fs-4 text-primary mb-3">{{ $product->prices->first()->price->formatted }}</p>
                                <a href="{{route('product.show',['locale' => app()->getLocale(),'id' => $product->id])}}" class="btn btn-secondary rounded-pill py-2 px-4">{{__('messages.products.view_details')}}</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Products End -->

    <!-- Brands Start -->
    <div class="container-fluid feature bg-light py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h1 class="text-uppercase text-primary">{{__('messages.brands.our')}}</h1>
                <h5 class="display-3 mb-3">{{__('messages.brands.subtitle')}}</h5>
            </div>
            <div class="row g-4">
                @foreach($brands as $brand)
                    <div class=" col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="feature-item p-4">
                            <div class="mb-3">
                                <img src="{{$brand->getFirstMediaUrl('brand_cover','thumb')}}" alt="{{$brand->name}}" class="img-fluid rounded-circle"
                                     style="width: 200px; height: 150px; object-fit: contain;">
                            </div>
                            <a href="#" class="h4 mb-3">{{$brand->nameForLocale()}}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Brands End -->

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
                            {!! $page->getContentAttribute()!!}
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

                                            <img src="{{$service->getFirstMediaUrl('service_cover','thumb')}}" alt="{{$service->title}}" class="img-fluid rounded-circle"
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


    <!-- Blog Start -->
    <div class="container-fluid blog pb-5">
        <div class="container pb-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-uppercase text-primary">{{__('messages.news')}}</h4>
                <h1 class="display-3 text-capitalize mb-3">{{__('messages.news_blog')}}</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach ($latest_news as $n)
                    <div class="col-lg-6 col-xl-4 wow fadeInUp"  data-wow-delay="{{ 1 * 0.2 }}s">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="{{$n->getFirstMediaUrl('news_cover','thumb')}}" class="img-fluid rounded-top w-100" alt="">
                                <div class="blog-date px-4 py-2"><i class="fa fa-calendar-alt me-1"></i>{{ $n->published_at?->format('d.m.Y') }}</div>
                            </div>
                            <div class="blog-content rounded-bottom p-4">
                                <a href="#" class="h4 d-inline-block mb-3">{{$n->getTitleCurAttribute()}}</a>
                                <p>{{ Str::limit($n->getExcerptCurAttribute(), 140) }}</p>
                                <a href="{{route('news.show',[ 'id' =>$n->id,'locale' => app()->getLocale()])}}" class="fw-bold text-secondary">{{__('messages.read_more')}} <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Blog End -->

    <!-- Team Start -->
    <div class="container-fluid team pb-5">
        <div class="container pb-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-uppercase text-primary">Our Team</h4>
                <h1 class="display-3 text-capitalize mb-3">What is Really seo & How Can I Use It?</h1>
            </div>
            <div class="row g-4">
                @foreach ($our_team as $i)
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="{{ $loop->iteration * 0.2 }}s">
                        <div class="team-item p-4">
                            <div class="team-inner rounded">
                                <div class="team-img">
                                    <img src="{{ $i->getFirstMediaUrl('team_cover','thumb') }}"
                                         class="img-fluid rounded-top w-100"
                                         alt="{{ $i->name }}">

                                    <div class="team-share">
                                        <a class="btn btn-secondary btn-md-square rounded-pill text-white mx-1" href="#">
                                            <i class="fas fa-share-alt"></i>
                                        </a>
                                    </div>

                                    {{-- Dynamic social links --}}
                                    @if(!empty($i->social_links))
                                        <div class="team-icon rounded-pill py-2 px-2">
                                            @foreach ($i->social_links as $link)
                                                @php
                                                    $platform = strtolower($link['platform']);
                                                    $url = $link['url'];
                                                    $icon = match($platform) {
                                                        'facebook' => 'fab fa-facebook-f',
                                                        'twitter' => 'fab fa-twitter',
                                                        'linkedin' => 'fab fa-linkedin-in',
                                                        'instagram' => 'fab fa-instagram',
                                                        'youtube' => 'fab fa-youtube',
                                                        default => 'fas fa-link',
                                                    };
                                                @endphp
                                                <a class="btn btn-secondary btn-sm-square rounded-pill mx-1"
                                                   href="{{ $url }}" target="_blank" title="{{ ucfirst($platform) }}">
                                                    <i class="{{ $icon }}"></i>
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <div class="bg-light rounded-bottom text-center py-4">
                                    <h4 class="mb-3">{{ $i->name }}</h4>
                                    <p class="mb-0">{{ $i->job_title }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Team End -->

@endsection
