@extends('new.layouts.app')

@section('title', 'Acuas — Home')

@section('content')

    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">{{__('messages.contact')}}</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{route('home',app()->getLocale())}}">{{__('messages.home')}}</a></li>
                <li class="breadcrumb-item active text-primary">{{__('messages.contact')}}</li>
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

<!-- Contact Start -->
<div class="container-fluid contact bg-light py-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-6 h-100 wow fadeInUp" data-wow-delay="0.2s">
                <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                    <h4 class="text-uppercase text-primary">Let’s Connect</h4>
                    <h1 class="display-3 text-capitalize mb-3">Send Your Message</h1>
                    <p class="mb-0">The contact form is currently inactive. Get a functional and working contact form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code and you're done. <a class="text-primary fw-bold" href="https://htmlcodex.com/contact-form">Download Now</a>.</p>
                </div>
                <form>
                    <div class="row g-4">
                        <div class="col-lg-12 col-xl-6">
                            <div class="form-floating">
                                <input type="text" class="form-control border-0" id="name" placeholder="Your Name">
                                <label for="name">Your Name</label>
                            </div>
                        </div>
                        <div class="col-lg-12 col-xl-6">
                            <div class="form-floating">
                                <input type="email" class="form-control border-0" id="email" placeholder="Your Email">
                                <label for="email">Your Email</label>
                            </div>
                        </div>
                        <div class="col-lg-12 col-xl-6">
                            <div class="form-floating">
                                <input type="phone" class="form-control border-0" id="phone" placeholder="Phone">
                                <label for="phone">Your Phone</label>
                            </div>
                        </div>
                        <div class="col-lg-12 col-xl-6">
                            <div class="form-floating">
                                <input type="text" class="form-control border-0" id="subject" placeholder="Subject">
                                <label for="subject">Subject</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control border-0" placeholder="Leave a message here" id="message" style="height: 175px"></textarea>
                                <label for="message">Message</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.4s">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="d-inline-flex rounded bg-white w-100 p-4">
                            <i class="fas fa-map-marker-alt fa-2x text-secondary me-4"></i>
                            <div>
                                <h4>Address</h4>
                                <p class="mb-0">123 North tower New York, USA</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-xl-6">
                        <div class="d-inline-flex rounded bg-white w-100 p-4">
                            <i class="fas fa-envelope fa-2x text-secondary me-4"></i>
                            <div>
                                <h4>Mail Us</h4>
                                <p class="mb-0">info@example.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-xl-6">
                        <div class="d-inline-flex rounded bg-white w-100 p-4">
                            <i class="fa fa-phone-alt fa-2x text-secondary me-4"></i>
                            <div>
                                <h4>Telephone</h4>
                                <p class="mb-0">(+012) 3456 7890 123</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="h-100 overflow-hidden">
                            <iframe class="w-100 rounded" style="height: 400px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387191.33750346623!2d-73.97968099999999!3d40.6974881!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1694259649153!5m2!1sen!2sbd"
                                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
@endsection
