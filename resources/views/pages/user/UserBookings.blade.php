@extends('layouts.front')

@section('content')

    <style>
        .tour-details-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .right-panel {
            flex: 1;
            max-width: 550px;
            padding: 0 15px;
        }

        .tour-details-card {
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            padding: 20px;
        }

        .tour-header {
            background: linear-gradient(45deg, #007bff, #6a11cb);
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .tour-info {
            padding: 15px;
            line-height: 1.8;
        }

        .tour-info h5 {
            color: #333;
            font-weight: bold;
        }

        .tour-status-pending {
            background-color: #ffc107;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 14px;
        }

        .tour-status-confirmed {
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 14px;
        }

        .tour-status-booked {
            background-color: #d90309;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 14px;
        }

        .back-btn {
            margin-top: 20px;
        }

        .list-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .list-item {
            color: #494949;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .list-item i {
            color: #007bff;
            margin-right: 8px;
        }
    </style>
    <br>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container my-5">
        <div class="tour-details-container">
            <!-- Right Panel for Tour Information -->
            <div class="right-panel">
                <div class="tour-details-card">
                    <div class="tour-header">
                        <h2 style="color: white">Tour Description</h2>
                    </div>


                        <div class="tour-info">
                            <h5>Destination: {{ $tour->package->category->category_name }}</h5>
                            <h4 class="list-title">Date: {{ \Carbon\Carbon::parse($tour->created_at)->format('d M Y') }}</h4>
                            <h4 class="list-title">No. of days: {{ $tour->package->no_of_days }} days</h4>
                            <h4 class="list-title">No. of persons: {{ $tour->no_of_persons }} </h4>

                            <h4 class="list-title">Status:
                                @if($tour->package->status == 'pending')
                                    <span class="tour-status-pending">Pending</span>
                                @elseif($tour->status == 'confirmed')
                                    <span class="tour-status-confirmed">Confirmed</span>
                                @else
                                    <span class="tour-status-booked">Booked</span>
                                @endif
                            </h4>


                            <div>
                                <h4 class="list-title">Routes</h4>
                                <ul style="list-style: none; padding: 0;">
                                    @foreach($tour->package->routes as $route)
                                        <li class="list-item"><i class="bi bi-arrow-right-circle"></i>{{ $route->name }}</li>
                                    @endforeach
                                </ul>

                                <h4 class="list-title">Inclusions</h4>
                                <ul style="list-style: none; padding: 0;">
                                    @foreach($tour->package->inclusions as $inclusion)
                                        <li class="list-item"><i class="bi bi-check-circle"></i>{{ $inclusion->name }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <p><strong>Description:</strong> {{ $tour->package->requests }}</p>

                            <h4 class="list-title">Price: ${{ number_format($tour->total_amount, 2) }}</h4>

                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('profile') }}" class="btn btn-secondary back-btn">Back</a>


                        </div>

                </div>

            </div>

        </div>
    </div>



@endsection
