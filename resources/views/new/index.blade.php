@extends('new.layouts.app')

@section('title', 'Acuas — Home')

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
                <h4 class="text-uppercase text-primary">Our Products</h4>
                <h1 class="display-3 text-capitalize mb-3">We Deliver Best Quality Bottle Packs.</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($products as $product)
                    <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="product-item">
                        <img src="{{ $product->media->first()?->getUrl('large') }}" class="img-fluid w-100 rounded-top"  alt="Image">
                        <div class="product-content bg-light text-center rounded-bottom p-4">
                            <p>2L 1 Bottle</p>
                            <a href="#" class="h4 d-inline-block mb-3">{{ $product->translateAttribute('name') }}</a>
                            <p class="fs-4 text-primary mb-3">{{ $product->prices->first()->price->formatted }}</p>
                            <a href="#" class="btn btn-secondary rounded-pill py-2 px-4">Read More</a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Products End -->

    <!-- feature Start -->
    <div class="container-fluid feature bg-light py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-uppercase text-primary">Our Feature</h4>
                <h1 class="display-3 text-capitalize mb-3">A Trusted Name In Bottled Water Industry</h1>
            </div>
            <div class="row g-4">
                <div class=" col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="feature-item p-4">
                        <div class="feature-icon mb-3"><i class="fas fa-hand-holding-water text-white fa-3x"></i></div>
                        <a href="#" class="h4 mb-3">Quality Check</a>
                        <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero repellat deleniti necessitatibus</p>
                        <a href="#" class="btn text-secondary">Read More <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="feature-item p-4">
                        <div class="feature-icon mb-3"><i class="fas fa-filter text-white fa-3x"></i></div>
                        <a href="#" class="h4 mb-3">5 Steps Filtration</a>
                        <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero repellat deleniti necessitatibus</p>
                        <a href="#" class="btn text-secondary">Read More <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                    <div class="feature-item p-4">
                        <div class="feature-icon mb-3"><i class="fas fa-recycle text-white fa-3x"></i></div>
                        <a href="#" class="h4 mb-3">Composition</a>
                        <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero repellat deleniti necessitatibus</p>
                        <a href="#" class="btn text-secondary">Read More <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                    <div class="feature-item p-4">
                        <div class="feature-icon mb-3"><i class="fas fa-microscope text-white fa-3x"></i></div>
                        <a href="#" class="h4 mb-3">Lab Control</a>
                        <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero repellat deleniti necessitatibus</p>
                        <a href="#" class="btn text-secondary">Read More <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- feature End -->

    <!-- About Start -->
    <div class="container-fluid about overflow-hidden py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="about-img rounded h-100">
                        <img src="{{ asset('acuas/img/about.jpg') }}" class="img-fluid rounded h-100 w-100" style="object-fit: cover;" alt="">
                        <div class="about-exp"><span>20 Years Experiance</span></div>
                    </div>
                </div>
                <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="about-item">
                        <h4 class="text-primary text-uppercase">About Us</h4>
                        <h1 class="display-3 mb-3">We Deliver The Quality Water.</h1>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                        <div class="bg-light rounded p-4 mb-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <div class="pe-4">
                                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;"><i class="fas fa-tint text-white fa-2x"></i></div>
                                        </div>
                                        <div class="">
                                            <a href="#" class="h4 d-inline-block mb-3">Satisfied Customer</a>
                                            <p class="mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quas provident maiores quisquam.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-light rounded p-4 mb-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <div class="pe-4">
                                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;"><i class="fas fa-faucet text-white fa-2x"></i></div>
                                        </div>
                                        <div class="">
                                            <a href="#" class="h4 d-inline-block mb-3">Standard Product</a>
                                            <p class="mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quas provident maiores quisquam.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="btn btn-secondary rounded-pill py-3 px-5">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Fact Counter -->
    <div class="container-fluid counter py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="counter-item">
                        <div class="counter-item-icon mx-auto">
                            <i class="fas fa-thumbs-up fa-3x text-white"></i>
                        </div>
                        <h4 class="text-white my-4">Happy Clients</h4>
                        <div class="counter-counting">
                            <span class="text-white fs-2 fw-bold" data-toggle="counter-up">456</span>
                            <span class="h1 fw-bold text-white">+</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="counter-item">
                        <div class="counter-item-icon mx-auto">
                            <i class="fas fa-truck fa-3x text-white"></i>
                        </div>
                        <h4 class="text-white my-4">Transport</h4>
                        <div class="counter-counting">
                            <span class="text-white fs-2 fw-bold" data-toggle="counter-up">513</span>
                            <span class="h1 fw-bold text-white">+</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                    <div class="counter-item">
                        <div class="counter-item-icon mx-auto">
                            <i class="fas fa-users fa-3x text-white"></i>
                        </div>
                        <h4 class="text-white my-4">Employees</h4>
                        <div class="counter-counting">
                            <span class="text-white fs-2 fw-bold" data-toggle="counter-up">53</span>
                            <span class="h1 fw-bold text-white">+</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                    <div class="counter-item">
                        <div class="counter-item-icon mx-auto">
                            <i class="fas fa-heart fa-3x text-white"></i>
                        </div>
                        <h4 class="text-white my-4">Years Experiance</h4>
                        <div class="counter-counting">
                            <span class="text-white fs-2 fw-bold" data-toggle="counter-up">17</span>
                            <span class="h1 fw-bold text-white">+</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fact Counter End -->

    <!-- Service Start -->
    <div class="container-fluid service bg-light overflow-hidden py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-uppercase text-primary">Our Service</h4>
                <h1 class="display-3 text-capitalize mb-3">Protect Your Family with Best Water</h1>
            </div>
            <div class="row gx-0 gy-4 align-items-center">
                <div class="col-lg-6 col-xl-4 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="service-item rounded p-4 mb-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex">
                                    <div class="service-content text-end">
                                        <a href="#" class="h4 d-inline-block mb-3">Residential Waters</a>
                                        <p class="mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quas provident maiores quisquam.</p>
                                    </div>
                                    <div class="ps-4">
                                        <div class="service-btn"><i class="fas fa-hand-holding-water text-white fa-2x"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="service-item rounded p-4 mb-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex">
                                    <div class="service-content text-end">
                                        <a href="#" class="h4 d-inline-block mb-3">Commercial Waters</a>
                                        <p class="mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quas provident maiores quisquam.</p>
                                    </div>
                                    <div class="ps-4">
                                        <div class="service-btn"><i class="fas fa-dumpster-fire text-white fa-2x"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="service-item rounded p-4 mb-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex">
                                    <div class="service-content text-end">
                                        <a href="#" class="h4 d-inline-block mb-3">Filtration Plants</a>
                                        <p class="mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quas provident maiores quisquam.</p>
                                    </div>
                                    <div class="ps-4">
                                        <div class="service-btn"><i class="fas fa-filter text-white fa-2x"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="bg-transparent">
                        <img src="{{ asset('acuas/img/water.png') }}" class="img-fluid w-100" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="service-item rounded p-4 mb-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex">
                                    <div class="pe-4">
                                        <div class="service-btn"><i class="fas fa-assistive-listening-systems text-white fa-2x"></i></div>
                                    </div>
                                    <div class="service-content">
                                        <a href="#" class="h4 d-inline-block mb-3">Water Softening</a>
                                        <p class="mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quas provident maiores quisquam.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="service-item rounded p-4 mb-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex">
                                    <div class="pe-4">
                                        <div class="service-btn"><i class="fas fa-recycle text-white fa-2x"></i></div>
                                    </div>
                                    <div class="service-content">
                                        <a href="#" class="h4 d-inline-block mb-3">Market Research</a>
                                        <p class="mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quas provident maiores quisquam.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="service-item rounded p-4 mb-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex">
                                    <div class="pe-4">
                                        <div class="service-btn"><i class="fas fa-project-diagram text-white fa-2x"></i></div>
                                    </div>
                                    <div class="service-content">
                                        <a href="#" class="h4 d-inline-block mb-3">Project Planning</a>
                                        <p class="mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quas provident maiores quisquam.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Blog Start -->
    <div class="container-fluid blog pb-5">
        <div class="container pb-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-uppercase text-primary">Our Blog</h4>
                <h1 class="display-3 text-capitalize mb-3">Latest Blog & News</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach ([1,2,3] as $i)
                    <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="{{ $i * 0.2 }}s">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="{{ asset("img/blog-$i.jpg") }}" class="img-fluid rounded-top w-100" alt="">
                                <div class="blog-date px-4 py-2"><i class="fa fa-calendar-alt me-1"></i> Jan 12 2025</div>
                            </div>
                            <div class="blog-content rounded-bottom p-4">
                                <a href="#" class="h4 d-inline-block mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde</a>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel, officiis?</p>
                                <a href="#" class="fw-bold text-secondary">Read More <i class="fa fa-angle-right"></i></a>
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
                @foreach ([1,2,3,4] as $i)
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="{{ $i * 0.2 }}s">
                        <div class="team-item p-4">
                            <div class="team-inner rounded">
                                <div class="team-img">
                                    <img src="{{ asset("img/team-$i.jpg") }}" class="img-fluid rounded-top w-100" alt="Image">
                                    <div class="team-share">
                                        <a class="btn btn-secondary btn-md-square rounded-pill text-white mx-1" href=""><i class="fas fa-share-alt"></i></a>
                                    </div>
                                    <div class="team-icon rounded-pill py-2 px-2">
                                        <a class="btn btn-secondary btn-sm-square rounded-pill mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                        <a class="btn btn-secondary btn-sm-square rounded-pill me-1" href=""><i class="fab fa-twitter"></i></a>
                                        <a class="btn btn-secondary btn-sm-square rounded-pill me-1" href=""><i class="fab fa-linkedin-in"></i></a>
                                        <a class="btn btn-secondary btn-sm-square rounded-pill me-1" href=""><i class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                                <div class="bg-light rounded-bottom text-center py-4">
                                    <h4 class="mb-3">Hard Branots</h4>
                                    <p class="mb-0">CEO & Founder</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Team End -->

    <!-- Testimonial Start -->
    <div class="container-fluid testimonial pb-5">
        <div class="container pb-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-uppercase text-primary">Testimonials</h4>
                <h1 class="display-3 text-capitalize mb-3">Our clients reviews.</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.3s">
                @foreach ([1,2,3,3] as $i)
                    <div class="testimonial-item text-center p-4">
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Incidunt pariatur officiis quis molestias, sit iure sunt voluptatibus accusantium laboriosam dolore.</p>
                        <div class="d-flex justify-content-center mb-4">
                            <img src="{{ asset("img/testimonial-$i.jpg") }}" class="img-fluid border border-4 border-primary" style="width: 100px; height: 100px; border-radius: 50px;" alt="">
                        </div>
                        <div class="d-block">
                            <h4 class="text-dark">Client Name</h4>
                            <p class="m-0 pb-3">Profession</p>
                            <div class="d-flex justify-content-center text-secondary">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

@endsection
