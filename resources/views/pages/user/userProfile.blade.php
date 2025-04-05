@extends('layouts.front')

@section('content')
    <br>
    <br>
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
    <div class="container">
        <h2 class="text-center mb-4">User Profile</h2>
        <div class="row" style="display: flex;justify-content: center">
            <!-- User Profile Section -->
            <div class="col-md-10">
                <div class="card mx-auto shadow-sm shadow-lg bg-white rounded">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <img src="{{ $user->profile_image ?? asset('images/pro-image.png') }}"
                                 alt="Profile Image"
                                 class="rounded-circle"
                                 style="width: 120px; height: 120px; object-fit: cover;">
                        </div>
                        <h5 class="card-title">{{ $user->name }}</h5>
                        <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                        <p class="card-text"><strong>Registered on:</strong> {{ $user->created_at->format('d M Y') }}</p>

                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>
            </div>

            <div class="col-md-10">
                <div class="card shadow-sm shadow-lg bg-white rounded">
                    <div class="card-body text-center">
                        <h4 class="card-title text-primary">Your Tours</h4>

                        <!-- Flex Container for Tours -->
                        <div class="tour-sections d-flex flex-column flex-md-row gap-3">
                            <!-- Pending Tours Section -->
                            <div class="tour-section col-12 col-md-4">
                                <h5 class="text-center">Pending Tours</h5>
                                @if($tours->where('status', 'pending')->count() > 0)
                                    <div class="tour-list" style="max-height: 150px; overflow-y: auto;">
                                        <ul class="list-group list-group-flush">
                                            @foreach($tours->where('status', 'pending') as $tour)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <strong style="color: brown">{{ $tour->category->category_name }} Tour</strong>
                                                    <a href="{{ route('userTours', $tour->id) }}">view tour</a>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                @else
                                    <p class="text-muted">No pending tours.</p>
                                @endif
                            </div>

                            <!-- Confirmed Tours Section -->
                            <div class="tour-section col-12 col-md-4">
                                <h5 class="text-center">Finalized Tours</h5>
                                @if($tours->where('status', 'confirmed')->count() > 0)
                                    <div class="tour-list" style="max-height: 150px; overflow-y: auto;">
                                        <ul class="list-group list-group-flush">
                                            @foreach($tours->where('status', 'confirmed') as $tour)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <strong style="color: brown">{{ $tour->category->category_name }} Tour</strong>
                                                    <a href="{{ route('userTours', $tour->id) }}">view tour</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @else
                                    <p class="text-muted">No confirmed tours.</p>
                                @endif
                            </div>

                            <!-- Booked Tours Section -->
                            <div class="tour-section col-12 col-md-4">
                                <h5 class="text-center">Booked Tours</h5>
                                @if($tours->where('status', 'booked')->count() > 0)
                                    <div class="tour-list" style="max-height: 150px; overflow-y: auto;">
                                        <ul class="list-group list-group-flush">
                                            @foreach($bookings->where('status', 'booked') as $booking)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <strong style="color: brown">{{$booking->package->category->category_name}} Tour</strong>
                                                    <a href="{{ route('booked.tours', $booking->id) }}">view tour</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @else
                                    <p class="text-muted">No booked tours.</p>
                                @endif
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <div class="col-md-10">
                <div class="card mx-auto shadow-sm shadow-lg bg-white rounded">
                    <div class="card-body text-center">
                        <form action="{{route('user.comment')}}" method="post">
                            @csrf
                            <h5 class="text-center mb-4">Leave your Comment</h5>
                            <div class="form-group mb-3">

                                <textarea type="text" class="form-control" id="comment" name="comment" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">upload Comment</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <br>
    <br>
@endsection
