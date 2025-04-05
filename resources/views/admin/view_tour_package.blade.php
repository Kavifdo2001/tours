@extends('admin.layout.front', ['main_page' => 'yes'])

@section('content')

    <style>
        .image-container img {
            width: 100%;
            height: auto;
            max-height: 300px;
            width: 300px;
            object-fit: cover;
        }
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>


    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Package ID: {{ $package->id }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.default_tour')}}">Package</a></li>
                            <li class="breadcrumb-item active">Package Details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Package Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>Main Category:</strong> {{ $package->category->category_name }}</p>
                                <p><strong>Sub Category:</strong> {{ $package->subcategory->category_name }}</p>
                                <p><strong>Departure:</strong> {{ $package->departure->name }}</p>
                                <p><strong>Air Ticket:</strong> {{ $package->airTicket->name }}</p>


                            </div>

                            <div class="col-md-4">

                                <p><strong>Route:</strong></p>
                                <ul>
                                    @foreach($package->routes as $route)
                                        <li>{{ $route->name }}</li>
                                    @endforeach
                                </ul>

                                <p><strong>Inclusion:</strong></p>
                                <ul>
                                    @foreach($package->inclusions as $inclusion)
                                        <li>{{ $inclusion->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-4">


                                <p><strong>Amount:</strong> {{ $package->currency }} {{ $package->amount }}</p>
                                <p><strong>Number of Days:</strong> {{ $package->no_of_days }}</p>
                                <p><strong>Guide:</strong> {{ $package->guide->name }}</p>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Images</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Main Image</h4>
                                <div class="image-container">
                                    @if($package->photos && $package->photos->main_image)
                                        <img src="{{ asset($package->photos->main_image) }}" alt="Main Image" class="img-fluid">
                                    @else
                                        <p>No main image available.</p>
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>Other Images</h4>
                                <div class="row">

                                    @if($package->photos && $package->photos->other_images)
                                        @foreach(explode(',', $package->photos->other_images) as $image)
                                            <div class="col-md-6 mb-3">
                                                <div class="image-container">
                                                    <img src="{{ asset($image) }}" alt="Other Image" class="img-fluid">
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p>No other images available.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Videos</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            @if($package->videos && $package->videos->count() > 0)
                                @foreach($package->videos as $video)
                                    <div class="col-md-6 mb-3">
                                        <div class="video-container">
                                            <video width="100%" height="auto" controls>
                                                <source src="{{ asset($video->video) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>No videos available.</p>
                            @endif
                        </div>
                    </div>
                </div> --}}

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Document</h3>
                    </div>
                    <div class="card-body">
                        @if($package->pdf_document)
                            <p>
                                <strong>Document:</strong>
                                <a href="{{ asset($package->pdf_document) }}" target="_blank">View PDF</a>
                                |
                                <a href="{{ asset($package->pdf_document) }}" download>Download PDF</a>
                            </p>
                        @else
                            <p>No document available.</p>
                        @endif

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
