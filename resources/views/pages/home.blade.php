@extends('layouts.front')

@section('title', 'King Sri Lanka Tours - Explore the Beauty of Sri Lanka')
@section('meta_description', 'King Sri Lanka Tours offers unforgettable travel experiences in Sri Lanka. Explore beaches, cultural landmarks, and wildlife with our expert guides.')
@section('meta_keywords', 'Sri Lanka Tours, Sri Lanka Travel, Beaches, Wildlife, Cultural Heritage, Sri Lanka Safaris')
@section('meta_author', 'King Sri Lanka Tours')
@section('meta_og_title', 'Welcome to King Sri Lanka Tours')
@section('meta_og_description', 'Experience the beauty of Sri Lanka with King Sri Lanka Tours. Explore stunning beaches, cultural landmarks, and wildlife adventures.')
@section('meta_og_image', asset('assets/images/king-sri-lanka-tours.jpg'))
@section('meta_og_url', url()->current())

@section('content')

    <style>
        .packages-img {
            position: relative;
            width: 100%;
            height: 250px;
            overflow: hidden; /* Ensures that any part of the image outside the container is hidden */
        }

        .packages-img img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ensures the image covers the entire container while maintaining aspect ratio */
            object-position: center; /* Centers the image within the container */
        }

        .packages-item {
            max-width: 100%; /* Ensures the div doesn't exceed the container's width */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .route-list {
            list-style: none; /* Removes the default bullet points */
            padding: 0;
            margin: 0;
            gap: 3px; /* Space between list items */
        }

        .route-item {
            background-color: #f0f0f0; /* Light background color for each item */
            border: 1px solid #ddd; /* Border for separation */
            border-radius: 8px; /* Rounded corners */
            padding: 2px 5px; /* Padding inside each item */
            color: #333; /* Text color */
            font-weight: bold; /* Bold text for emphasis */
            transition: background-color 0.3s; /* Transition effect for hover */
        }

         .testimonial-item {
             background-color: #9172e7; /* Example background color */
             border: 1px solid #e0e0e0;
             border-radius: 10px;
             padding: 20px;
             margin: 10px;
             max-width: 350px; /* Adjust size as needed */
             box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
             width: 100%; /* Make sure it fits within its container */
         }

        .testimonial-comment {
            background-color: #495057; /* Example comment background color */
        }

        .testimonial-text {
            font-size: 16px;
            color: #f8f9fa; /* Light text color for readability */
            min-height: 80px; /* Ensure consistent height */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .testimonial-img {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: -10px; /* Position image over the comment */
        }

        .testimonial-img img {
            width: 80px;
            height: 80px;
            object-fit: cover; /* Ensures image is cropped properly */
            border: 3px solid #fff; /* Add border to make the image stand out */
            border-radius: 50%; /* Make the image round */
        }

        .testimonial-name {
            margin-top: 5px;
            font-size: 18px;
            font-weight: bold;
            color: #ffffff; /* Light color for the name */
        }

        /* Responsive styles for smaller screens */

        @media (max-width: 767px) {
            .testimonial-item {
                width: 100%; /* Allow full-width items on small screens */
                margin: 15px auto; /* Center the items */
                padding: 15px; /* Reduce padding for smaller screens */
                max-height: 100%;
            }

            .testimonial-text {
                font-size: 14px; /* Adjust text size for better readability */
                min-height: 60px; /* Adjust height to prevent text overflow */
            }

            .testimonial-img img {
                width: 100%; /* Smaller image size for mobile */
                height: 60px;
            }

            .testimonial-name {
                font-size: 16px; /* Smaller name size for mobile */
            }

            /* Hide all testimonials except the first one on mobile */
            .testimonial-item:nth-child(n + 2) {
                display: none;
            }
        }


        /* Extra small screen adjustments */
        @media (max-width: 480px) {
            .testimonial-text {
                font-size: 13px; /* Even smaller text size for very small screens */
            }

            .testimonial-item {
                padding: 10px; /* Less padding on very small devices */
            }
        }


        .btn:focus {
            outline: none;
            box-shadow: none;
        }
    </style>


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
                    <img src="{{ asset('asset/front/img/sri-lanka-tour.jpg')}}" class="img-fluid" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Explore The World</h4>
                            <h1 class="display-2 text-capitalize text-white mb-4">Full of hospitality!</h1>
                            <p class="mb-5 fs-5">We are experts in Tourism industry and have experience for more than 13 years!
                            </p>

                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('asset/front/img/Sigiriya-Rock-2.jpg')}}" class="img-fluid" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Discover Your Next Adventure In Sri Lanka</h4>
                            <h1 class="display-2 text-capitalize text-white mb-4">Find Your Perfect Tour KING SRI LANKA TOURS</h1>

                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('asset/front/img/srilanka1.jpg')}}" class="img-fluid" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">The Pearl of the Indian Ocean</h4>
                            <h1 class="display-2 text-capitalize text-white mb-4">A Land of History, Culture, and Natural Beauty</h1>

                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                <span class="carousel-control-prev-icon btn bg-primary" aria-hidden="false"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                <span class="carousel-control-next-icon btn bg-primary" aria-hidden="false"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->


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


    <!-- Packages Start -->
    <div class="container-fluid packages py-3" >
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Destinations</h5>
                <h1 class="mb-0">Popular Tours</h1>
            </div>


            <div class="packages-carousel container">
                <div class="row justify-content-center">
                    <!-- Package Item 1 -->

                    @foreach($countries as $country)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 d-flex">
                        <div class="packages-item" style="margin: 10px; width: 100%; border-radius: 15px; overflow: hidden; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);"> <!-- Added border radius and box shadow -->
                            <div class="packages-img">
                                <img src="{{ $country->image }}" class=" w-100 rounded-top" alt="Image" style="height: 250px; object-fit: cover;"> <!-- Increased height -->
                            </div>
                            <div class="packages-content bg-primary d-flex justify-content-center align-items-center" style="height: 40px;"> <!-- Increased height -->
                                <h5 class="text-white mb-0">{{$country->category_name}}</h5> <!-- Removed margin-bottom for better centering -->
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>


        </div>
    </div>
    <!-- Packages End -->

    <!-- Destination Start -->
    <div class="container-fluid destination py-3">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">

                <h5 class="section-title px-3">Awesome Packages</h5>
                <h1 class="mb-0">Tour Packages</h1>
            </div>
            <div class="tab-class text-center">
                <ul class="nav nav-pills d-inline-flex justify-content-center mb-5">
                    <li class="nav-item">
                        <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill active" data-bs-toggle="pill" href="#all-packages">
                            <span class="text-dark" style="width: 150px;">Sri Lanka</span>
                        </a>
                    </li>


                </ul>
                <div class="tab-content">
                    <div id="all-packages" class="tab-pane fade show p-0 active">
                        <div class="row packages-carousel">


                            @foreach($packages as $package)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="packages-item" style="margin: 10px; box-shadow: 0 14px 18px rgba(0, 0, 0, 0.3); border: 10px;border-bottom-left-radius: 20px; border-bottom-right-radius: 20px">

                                    <img src="{{$package->photos->main_image}}" class="img-fluid rounded-top" style="width: 100%; height: 200px; object-fit: cover;"  alt="Image">

                                    <div class="packages-info border" style="width: 100%; bottom: 0; left: 0; z-index: 5; text-align: left;padding-left: 10px;padding-top: 10px; ">
                                        <div class="" ><h5 style="color: #fbab22">{{$package->no_of_days}} Days </h5></div>
                                        <div class=""><p class="" style="font-size: 16px;font-weight: bold;color: grey;letter-spacing: 2px">{{$package->subcategory->category_name}} </p></div>

                                    </div>

                                    <div class="packages-info border " style="width: 100%; bottom: 0; left: 0; z-index: 5;text-align: left;">
                                        <div class="" style="padding-left:10px; padding-top: 10px;"><p style="font-size: 18px;font-weight: bold;color: #fbab22;letter-spacing: 1px;margin:0">Routes:</p></div>
                                        <div class="route-list-container" style="padding-left: 10px;">
                                            <ul class="route-list d-flex flex-wrap align-items-center">

                                                @foreach($package->routes as $route)
                                                    <li class="d-flex" style=" color: #494949;font-weight: bold;font-size: 14px;">
                                                        <i class="bi bi-arrow-right-circle me-2"></i>{{ $route->name }}
                                                    </li>

                                                @endforeach

                                            </ul>
                                        </div>

                                    </div>

                                    <div class="packages-info border" style="width: 100%; bottom: 0; left: 0; z-index: 5; text-align: left;">
                                        <div style="padding-left: 10px; padding-top: 10px;">
                                            <p style="font-size: 18px; font-weight: bold; color: #fbab22; letter-spacing: 1px; margin: 0;">Inclusions:</p>
                                        </div>
                                        <div>
                                            <ol class="d-flex justify-content-between align-items-center flex-wrap w-100" style="list-style: none; padding: 0; margin: 0;">


                                                @foreach($package->inclusions as $inclusion)
                                                    <li style="flex: 1; text-align: center; color: #0e285c;">
                                                        <i class="bi bi-check-circle me-2"></i>{{ $inclusion->name }}
                                                    </li>
                                                @endforeach
                                            </ol>
                                        </div>
                                    </div>


                                    <div class="packages-info border" style="width: 100%; bottom: 0; left: 0; z-index: 5; text-align: center;">

                                        <div class="content align-items-center">
                                            <div class="align-items-center">
                                                <img src="{{$package->photos->other_images}}" alt="" width="310" height="70">
                                            </div>

                                        </div>



                                    </div>


                                    <div class="packages-content bg-light" style="border-bottom-left-radius: 20px;border-bottom-right-radius: 20px">
                                        <div class="p-1 pb-0">
                                            <h4 class="mb-0" style="color: #fbab22">{{ $package->category->category_name }}</h4>
                                            <div class="mb-2">
                                                <div class="fw-bold" style="color: white"> {{ $package->currency }} {{ $package->amount }}</div>
                                            </div>
{{--                                            <p class="mb-2">Description here </p>--}}
                                        </div>
                                        <div class="row bg-primary rounded-bottom mx-0">
                                            <div class="col-6 text-start px-0">
                                                <a href="{{ route('tourDetails', $package->id) }}" class="btn border-0 text-white px-4" style="outline: none; box-shadow: none;">Book Now</a>
                                            </div>
                                            <div class="col-6 text-center px-0">
                                                <a href="{{ route('tourDetails', $package->id) }}" class="btn border-0 text-white px-4" style="outline: none; box-shadow: none;">View</a>
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
        </div>
    </div>
    <!-- Destination End -->



    <!-- Gallery Start -->
    <div class="container-fluid gallery py-5 my-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Our Gallery</h5>
            <h1 class="mb-4">Tourism & Traveling Gallery.</h1>

        </div>
        <div class="tab-class text-center">
            <ul class="nav nav-pills d-inline-flex justify-content-center mb-5">
                <li class="nav-item">
                    <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill active" data-bs-toggle="pill" href="#GalleryTab-1">
                        <span class="text-dark" style="width: 150px;">All</span>
                    </a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="d-flex py-2 mx-3 border border-primary bg-light rounded-pill" data-bs-toggle="pill" href="#GalleryTab-2">--}}
{{--                        <span class="text-dark" style="width: 150px;">Sri Lanka</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill" data-bs-toggle="pill" href="#GalleryTab-3">--}}
{{--                        <span class="text-dark" style="width: 150px;">Maldives</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill" data-bs-toggle="pill" href="#GalleryTab-4">--}}
{{--                        <span class="text-dark" style="width: 150px;">Makkah</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

            </ul>

            <div class="tab-content">

                <div id="GalleryTab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-2">
                        @foreach($gallery as $image)
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                                <div class="gallery-item h-100">
                                    <img src="{{$image->images}}" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-plus-icon">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div id="GalleryTab-2" class="tab-pane fade show p-0">
                    <div class="row g-2">
                        @foreach($sriLankan as $image)
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                                <div class="gallery-item h-100">
                                    <img src="{{$image->images}}" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-plus-icon">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div id="GalleryTab-3" class="tab-pane fade show p-0">
                    <div class="row g-2">
                        @foreach($maldives as $image)
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                                <div class="gallery-item h-100">
                                    <img src="{{$image->images}}" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-plus-icon">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div id="GalleryTab-4" class="tab-pane fade show p-0">
                    <div class="row g-2">
                        @foreach($makkah as $image)
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                                <div class="gallery-item h-100">
                                    <img src="{{$image->images}}" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-plus-icon">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Gallery End -->


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



    <!-- Testimonial Start -->
    <div class="container-fluid testimonial py-1">
        <div class="container py-2">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Testimonial</h5>
                <h1 class="mb-0">Our Clients Say!!!</h1>
            </div>
            <div class="testimonial-carousel owl-carousel">
                @foreach($com as $comment)
                    <div class="testimonial-item text-center rounded pb-2"  style="background-color: #fbab22 !important">
                        <div class="testimonial-comment bg-light rounded p-2" style="background-color:#347928 !important">
                            <p class="testimonial-text text-center mb-4" style="color:white;">{{$comment->comment}}</p>
                        </div>
                        <div class="testimonial-img mt-2">
                            <img src="{{ $comment->user->profile_image }}" class="rounded-circle" alt="Image">
                        </div>
                        <div class="testimonial-name mt-1">
                            <h5 class="mb-0">{{ $comment->user->name }}</h5>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


@endsection

