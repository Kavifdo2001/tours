@extends('admin.layout.front',['main_page' => 'yes'])

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Guide Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.guide')}}">Guides</a></li>
                        <li class="breadcrumb-item active">Guide Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Guide Profile</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>Guide Information</h4>
                                    @if($guide->profileImage)
                                        <img src="{{ asset($guide->profileImage) }}" alt="Guide Profile Image" width="200" height="200">
                                    @else
                                        No Image
                                    @endif
                                </div>
                                <div class="col-md-8">

                                    <p><strong>Name:</strong> {{ $guide->name }}</p>
                                    <p><strong>Email:</strong> {{ $guide->email }}</p>
                                    <p><strong>Address:</strong> {{ $guide->address }}</p>
                                    <p><strong>Contact:</strong> {{ $guide->contact }}</p>
                                    <p><strong>Category:</strong>  {{ $guide->category }}</p>
                                    <p><strong>Description:</strong> {{ $guide->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Change Password</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.change_password', $guide->id) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="current_password">Current Password:</label>
                                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                                </div>
                                <div class="form-group">
                                    <label for="new_password">New Password:</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password:</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
