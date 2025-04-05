@extends('layouts.front')
@section('title', 'About Us - King Sri Lanka Tours')
@section('meta_description', 'Learn more about King Sri Lanka Tours and our mission to provide unforgettable travel experiences across Sri Lanka. Explore our tours, services, and team.')
@section('meta_keywords', 'About King Sri Lanka Tours, Sri Lanka Travel Company, Sri Lanka Tour Operators, Travel Experiences, Sri Lanka Tourism, Explore Sri Lanka')
@section('meta_author', 'King Sri Lanka Tours')
@section('meta_og_title', 'About King Sri Lanka Tours')
@section('meta_og_description', 'Discover the story behind King Sri Lanka Tours and how we offer the best travel experiences in Sri Lanka. Explore our passion for culture, nature, and wildlife.')
@section('meta_og_image', asset('assets/images/about-us.jpg'))
@section('meta_og_url', url()->current())

@section('content')


    <!-- About Start -->
    <div class="container-fluid about py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5">
                    <div class="h-100" style="border: 50px solid; border-color: transparent #0A6847  transparent  #0A6847 ">
                        <img src="{{ asset('asset/front/img/profiles/roshan.jpg')}}" class="img-fluid w-100 h-100" alt="">


                    </div>
                </div>
                <div class="col-lg-7" style="background: linear-gradient(rgba(255, 255, 255, .8), rgba(255, 255, 255, .8)), url(asset/front/img/about-img-1.png);">
                    <h5 class="section-about-title pe-3">About Us</h5>
                    <h1 class="mb-4">Welcome to <span class="text-primary">King Sri Lanka Tours</span></h1>
                    <p class="mb-4" style="color: black"> I'm Roshan Panagoda owner and founder of <b>"King SriLanka Tours"</b>. Apart from this,
                        I have a restaurant and a villa in Negombo called <b>'Blue wave restaurant'</b> and <b>'Green light holiday
                            village'.</b> We have been operating from the Negombo area since 2002. So more than 13 years in the tourism industry.
                    </p>
                    <p class="mb-4" style="color: black">Our mission is to satisfy the needs of our customers, promote memorable holidays in
                        Sri Lanka, and provide service in a socially and environmentally responsible manner.

                        We provide fully insurance and fully air conditioned vehicles as well as tuk tuk service. Whether
                        you are a backpacker looking for an affordable experience, or family, group, honeymooners looking to
                        splurge on a vacation, King Sri Lanka Tours has it all!
                    </p>
                    <p class="mb-4" style="color: black">You will experience a friendly and trusted service with King Sri Lanka Tour.
                        <br>
                        Thank you!
                    </p>
                    <div class="row gy-2 gx-4 mb-4">

                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Handpicked Hotels</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>5 Star Accommodations</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Latest Model Vehicles</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>50+ Premium City Tours</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>24/7 Service</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Travel Guide Start -->
    <div class="container-fluid guide py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Travel Guide</h5>
                <h1 class="mb-0">Meet Our Guide</h1>
            </div>
            <div class="row g-4">

                @foreach($guides as $guide)
                    <div class="col-md-6 col-lg-3">
                        <div class="guide-item">
                            <div class="guide-img">
                                <div class="">
                                    <img src="{{ asset($guide->profileImage) }}" class="img-fluid w-100 rounded-top" alt="Image">
                                </div>

                            </div>
                            <div class="guide-title text-center rounded-bottom p-1">
                                <div class="guide-title-inner">
                                    <h4 class="mt-3">{{$guide->name}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Travel Guide End -->
@endsection
