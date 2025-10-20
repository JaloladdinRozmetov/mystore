@extends('new.layouts.app')

@section('title', 'IDEALMETER — News')

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

<!-- Blog Start -->
<div class="container-fluid blog py-5">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-uppercase text-primary">Our Blog</h4>
            <h1 class="display-3 text-capitalize mb-3">Latest Blog & News</h1>
        </div>
        <div class="row g-4 justify-content-center">

            @foreach($news as $n)
                <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
                <div class="blog-item">
                    <div class="blog-img">
                        <img src="{{$n->getFirstMediaUrl('news_cover','thumb')}}" class="img-fluid rounded-top w-100 h-64" style="object-fit: cover; height:250px;" alt="{{$n->getTitleCurAttribute()}}">
                        <div class="blog-date px-4 py-2"><i class="fa fa-calendar-alt me-1"></i> {{ $n->published_at?->format('d.m.Y') }}</div>
                    </div>
                    <div class="blog-content rounded-bottom p-4">
                        <a href="#" class="h4 d-inline-block mb-3">{{$n->getTitleCurAttribute()}}</a>
                        <p>{{ Str::limit($n->getExcerptCurAttribute(), 140) }}</p>
                        <a href="{{route('news.show',[ 'id' =>$n->id,'locale' => app()->getLocale()])}}" class="fw-bold text-secondary">{{__('messages.read_more')}} <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
                <div class="mt-4">
                    {{ $news->links() }}
                </div>
        </div>
    </div>
</div>
<!-- Blog End -->
@endsection
