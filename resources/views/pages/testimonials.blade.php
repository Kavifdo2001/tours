@extends('layouts.front')
@section('content')

    <style>
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
    </style>

    <br>
    <br>
    <br>

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
