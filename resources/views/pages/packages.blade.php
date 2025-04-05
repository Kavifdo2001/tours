@extends('layouts.front')

@section('title', 'Tour Packages - King Sri Lanka Tours')
@section('meta_description', 'Explore our exciting tour packages in Sri Lanka with King Sri Lanka Tours. From cultural tours to wildlife safaris, we offer custom packages to suit every traveler’s needs.')
@section('meta_keywords', 'Sri Lanka Tour Packages, Sri Lanka Tours, Wildlife Safaris Sri Lanka, Cultural Tours Sri Lanka, Best Tour Packages, Explore Sri Lanka')
@section('meta_author', 'King Sri Lanka Tours')
@section('meta_og_title', 'Explore Our Tour Packages - King Sri Lanka Tours')
@section('meta_og_description', 'Discover the best Sri Lanka tour packages with King Sri Lanka Tours. Whether you’re interested in nature, adventure, or culture, we have the perfect tour for you.')
@section('meta_og_image', asset('assets/images/tour-packages.jpg'))
@section('meta_og_url', url()->current())

@section('content')

    <style>
        .pill-buttons:hover {
            background-color: pink !important;
        }
    </style>

    <link href="asset/front/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="asset/front/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <link href="{{ asset('asset/front/lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">


<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4">Travel Packages</h3>

    </div>
</div>
<!-- Header End -->


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




@endsection





