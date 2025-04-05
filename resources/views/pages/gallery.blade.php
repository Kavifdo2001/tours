@extends('layouts.front')
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
                    <img src="{{ asset('asset/front/img/sri-lanka-tour.jpg')}}" class="img-fluid" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Explore The World</h4>
                            <h1 class="display-2 text-capitalize text-white mb-4">Let's The World Together!</h1>

                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('asset/front/img/Sigiriya-Rock-2.jpg')}}" class="img-fluid" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Explore The World</h4>
                            <h1 class="display-2 text-capitalize text-white mb-4">Find Your Perfect Tour At Travel</h1>


                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('asset/front/img/R.jpg')}}" class="img-fluid" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Explore The World</h4>
                            <h1 class="display-2 text-capitalize text-white mb-4">You Like To Go?</h1>


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


    <!-- Gallery Start -->
    <div class="container-fluid gallery py-5 my-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Our Gallery</h5>
            <h1 class="mb-4">Tourism & Traveling Gallery.</h1>

        </div>
        <div class="tab-class text-center">
            <ul class="nav nav-pills d-inline-flex justify-content-center mb-5">
                <li class="nav-item">
                    <a class="d-flex mx-3 py-2 border border-primary bg-dark rounded-pill active" data-bs-toggle="pill" href="#GalleryTab-1">
                        <span class="text-dark" style="width: 150px;">Gallery</span>
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

@endsection
