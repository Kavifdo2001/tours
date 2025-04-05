@extends('layouts.front')
@section('content')


    <style>
        /* Custom CSS */
        .tour-header {
            background-color: #f8f9fa;
            padding: 20px 0;
            text-align: center;
        }

        .tour-header h1 {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .tour-header p {
            color: #6c757d;
            font-size: 18px;
        }

        .tour-image {
            max-height: 500px;
            width: 100%;
            object-fit: cover;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 24px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 15px;
            color: #343a40;
        }

        .tour-details {
            margin-bottom: 40px;
        }

        .booking-btn {
            background-color: #004669;
            color: #fff;
            font-weight: bold;
            padding: 10px 20px;
            border: none;
            transition: background-color 0.3s ease;
        }

        .booking-btn:hover {
            background-color: #00263a;
        }

        .customize-btn{
            background-color: #dc7d00;
            color: #fff;
            font-weight: bold;
            padding: 10px 20px;
            border: none;
            transition: background-color 0.3s ease;
        }

        .customize-btn:hover {
            background-color: #ffac3f;
            color: white;
        }

        .styled-select select {
            width: 80px; /* Adjust width as needed */

            border: 2px solid #4d4c4c;
            border-radius: 8px;
            background-color: #f9f9f9;
            color: #333;
            font-weight: bold;
            appearance: none; /* Removes the default dropdown arrow in some browsers */
            -webkit-appearance: none;
            -moz-appearance: none;
            text-align: center;
        }

        .styled-select {
            position: relative;
            display: inline-block;
        }

        .styled-select::after {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none; /* Prevent clicking on the arrow */
            color: #333;
        }

    </style>
    <br>
    <br>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

<!-- Tour Header Section -->
<div class="tour-header">
    <h1>{{ $package->category->category_name}} Tour {{$package->no_of_days}} Days </h1>
    <div class=""><p class="" style="font-size: 16px;font-weight: bold;color: grey;letter-spacing: 2px">{{$package->subcategory->category_name}} </p></div>

</div>

<!-- Tour Image Section -->
<div class="container">
    <img  src="{{ asset($package->photos->main_image) }}" alt="Tour Image" class="tour-image img-fluid rounded">
</div>

<!-- Tour Details Section -->
<div class="container tour-details p-4">
    <div class="row">
        <div class="col-md-8">
            <!-- Description -->
            <h2 class="section-title">Tour Description</h2>
            <p>
                {{ $package->description }}
            </p>

            <!-- Itinerary -->
            <h2 class="section-title">Routes</h2>
            <ul style="list-style: none; padding: 0; margin: 0;">
                @foreach($package->routes as $route)
                    <li class="d-flex" style=" color: #494949;font-weight: bold;font-size: 14px;">
                        <i class="bi bi-arrow-right-circle me-2"></i>{{ $route->name }}
                    </li>

                @endforeach
            </ul>

            <h2 class="section-title">Inclusions</h2>
            <ul style="list-style: none; padding: 0; margin: 0;">
                @foreach($package->inclusions as $inclusion)
                    <li style=" color: #494949;font-weight: bold;font-size: 14px;">
                        <i class="bi bi-check-circle me-2"></i>{{ $inclusion->name }}
                    </li>
                @endforeach
            </ul>


        </div>
        <br>
        <div class="col-md-4">
            <!-- Pricing and Booking Section -->
            <br>
            <div class="card shadow-sm">
                <form action="{{ route('bookTours', $package->id) }}"  method="POST">
                    @csrf
                    <div class="card-body">

                    <h2 class="section">Pricing</h2>
                    <p><strong>Price:</strong> {{ $package->currency }} <span id="package-amount">{{ $package->amount }}</span></p>
                    <p><strong>No. of Days:</strong> {{$package->no_of_days}}</p>

                    <div class="d-flex align-items-center">
                        <p class="mb-0 me-2"><strong>Select No. of Persons:</strong></p>
                        <div class="styled-select">
                            <select name="no_of_persons" class="form-select" id="number-of-persons" onchange="calculateTotal()">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                    </div>

                        <input type="hidden" id="total-amount-input" name="total_amount" value="{{ $package->amount }}">
                    <br>
                    <p><strong>Total Price:</strong> {{ $package->currency }} <span id="total-price">{{ $package->amount }}</span></p>
                    @guest
                        <button type="submit" class="btn booking-btn btn-block" onclick="showLoginPopup()">Book Now</button>
                    @else
                        <button type="submit" class="btn booking-btn btn-block">Book Now</button>
                    @endguest

                </div>
                </form>
            </div>
            <br>
            @guest
                <a href="javascript:void(0)" class="btn customize-btn btn-block" onclick="showLoginPopup()">Customize Tour</a>
            @else
                <a href="{{ route('customizeTour', $package->id) }}" class="btn customize-btn btn-block">Customize Tour</a>
            @endguest
        </div>

    </div>
</div>

    <div class="modal fade" id="loginPopupModal" tabindex="-1" aria-labelledby="loginPopupLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginPopupLabel">Login Required</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    You need to log in to proceed. Please log in or register to continue.
                </div>
                <div class="modal-footer">
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha384-q/QDYob/o7E1o4+lKQ6D3d1B6RQEEhFV16GQ2pxiw3+br/gXf8rtEPCmdOfs8iH7" crossorigin="anonymous"></script>

    <script>
        function showLoginPopup() {
            let loginModal = new bootstrap.Modal(document.getElementById('loginPopupModal'));
            loginModal.show();
        }
    </script>

    <script>
        function calculateTotal() {
            const packageAmount = parseFloat(document.getElementById('package-amount').innerText);

            const numberOfPersons = document.getElementById('number-of-persons').value;

            const totalPrice = packageAmount * numberOfPersons;

            document.getElementById('total-price').innerText = totalPrice.toFixed(2);
        }
    </script>




@endsection
