@extends('layouts.front')

@section('title', 'Transport - King Sri Lanka Tours')
@section('meta_description', 'Explore our fleet of vehicles available for rent at King Sri Lanka Tours. Find the perfect vehicle for your travel needs.')
@section('meta_keywords', 'Transport, Vehicle Rentals, Sri Lanka Tours, Car Rentals, Vehicle Hire')
@section('meta_author', 'King Sri Lanka Tours')
@section('meta_og_title', 'Transport - King Sri Lanka Tours')
@section('meta_og_description', 'Discover our range of vehicles available for rent at King Sri Lanka Tours. Choose from a variety of models and prices.')
@section('meta_og_image', asset('assets/images/transport.jpg'))
@section('meta_og_url', url()->current())

@section('content')

    <style>
        .pill-buttons:hover {
            background-color: pink !important;
        }

        .vehicle-item {
            margin: 10px;
            box-shadow: 0 14px 18px rgba(0, 0, 0, 0.3);
            border-radius: 20px;
            overflow: hidden;
        }

        .vehicle-img img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .vehicle-details {
            padding: 15px;
            background: #fff;
        }

        .vehicle-details h4 {
            color: #fbab22;
            font-size: 20px;
            font-weight: bold;
        }

        .vehicle-details p {
            color: #494949;
            font-size: 16px;
            margin: 5px 0;
        }

        .vehicle-content {
            background: #f8f9fa;
            padding: 10px;
            text-align: center;
        }

        .vehicle-content h4 {
            color: #fbab22;
            font-size: 18px;
            margin: 0;
        }

        .vehicle-content .price {
            color: #0e285c;
            font-size: 16px;
            font-weight: bold;
        }

        .vehicle-actions {
            display: flex;
            justify-content: space-between;
            background: #fbab22;
            padding: 10px;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        .vehicle-actions a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        .vehicle-img {
            position: relative;
            padding-top: 56.25%; /* 16:9 Aspect Ratio */
            overflow: hidden;
          }
        .vehicle-img img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            }

            .vehicle-img img {
    transition: transform 0.3s ease;
}
.vehicle-img img:hover {
    transform: scale(1.1);
}
    </style>


    <!-- Transport Start -->
    <div class="container-fluid transport py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Transport</h5>
                <h1 class="mb-0">Explore Our Vehicles</h1>
            </div>
            <div class="row g-4">
                  @foreach($vehicles as $vehicle)
                      <div class="col-md-4 col-lg-4 mb-4">
                          <div class="vehicle-item">
                              <!-- Vehicle Image -->
                              <div class="vehicle-img" style="height: 300px; overflow: hidden;">
                                  <img src="{{ asset($vehicle->image) }}" class="img-fluid w-100 h-100" alt="{{ $vehicle->name }}" style="object-fit: cover;">
                              </div>
              
                              <!-- Vehicle Details -->
                              <div class="vehicle-details">
                                  <h4>{{ $vehicle->name }}</h4>
                                  <p style="font-weight:bold">Type: {{ $vehicle->model }}</p>
                                  <p>Price: ${{ $vehicle->price }}/day</p>
                              </div>
              
                              <!-- Vehicle Actions -->
                              <div class="vehicle-actions">
                                  <!-- Add buttons or links here if needed -->
                              </div>
                          </div>
                      </div>
                  @endforeach
              
            </div>
        </div>
    </div>
    <!-- Transport End -->

@endsection

