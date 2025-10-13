@extends('new.layouts.app')

@section('title', 'Acuas — Brands')

@section('content')

    @error('name')
    <div class="text-danger">{{ $message }}</div>
    @enderror
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown"
                data-wow-delay="0.1s">{{__('messages.brands.our')}}</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{route('home',app()->getLocale())}}">{{__('messages.home')}}</a>
                </li>
                <li class="breadcrumb-item active text-primary">{{__('messages.brands.title')}}</li>
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
                        <input type="search" class="form-control p-3" placeholder="keywords"
                               aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text btn border p-3"><i
                                class="fa fa-search text-white"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->

    <!-- Brands Start -->
    <div class="container-fluid feature bg-light py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-uppercase text-primary">{{__('messages.brands.our')}}</h4>
                <h1 class="display-3 text-capitalize mb-3">A Trusted Name In Bottled Water Industry</h1>
            </div>
            <div class="row g-4">
                @foreach($brands as $brand)
                    <div class=" col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="feature-item p-4">
                            <div class="mb-3">
                                <img src="{{$brand->getFirstMediaUrl('images')}}" alt="{{$brand->name}}" class="img-fluid rounded-circle"
                                     style="width: 200px; height: 150px; object-fit: contain;">
                            </div>
                            <a href="#" class="h4 mb-3">{{$brand->name}}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Brands End -->
@endsection
