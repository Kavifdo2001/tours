@extends('admin.layout.front',['main_page' > 'yes'])
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


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">


    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Booked Tours </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Booked Tours</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="">
                <div class="container my-5">
                    <div class="">
                        <!-- Right Panel for Tour Information -->
                        <div class="">
                            <div class="tour-details-card">
                                <div class="tour-header">
                                    <h2 style="color: white">Booked Tour Description</h2>
                                </div>
                                <div class="tour-info">
                                    <h5>Client Name: {{ $tour->user->name }}</h5>
                                    <h5>Client Contact: {{ $tour->user->contact }}</h5>
                                    <h5>Destination: {{ $tour->package->category->category_name }}</h5>
                                    <h4 class="list-title">Date: {{ \Carbon\Carbon::parse($tour->created_at)->format('d M Y') }}</h4>
                                    <h4 class="list-title">No. of days: {{ $tour->package->no_of_days }} days</h4>
                                    <h4 class="list-title">No. of Persons: {{ $tour->no_of_persons }}</h4>
                                    <h4 class="list-title">Price: ${{ number_format($tour->total_amount, 2) }}</h4>
                                    <h4 class="list-title">Status:
                                        @if($tour->status == 'booked')
                                            <span class="tour-status-booked">Booked</span>
                                        @else
                                            <span class="tour-status-pending">Pending</span>
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

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section>


    </div>

@endsection
