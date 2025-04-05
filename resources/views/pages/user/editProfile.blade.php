@extends('layouts.front')

@section('content')

    <style>
        label {
            color: black;
        }
    </style>

    <br>
    <br>
    <br>


    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-6 col-lg-5  rounded shadow-sm shadow-lg  bg-white rounded">
            <h2 class="text-center mb-4">Edit Profile</h2>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                </div>
                <div class="form-group mb-4">
                    <label for="profile_image">Choose Profile Image</label>
                    <input type="file" class="form-control-file" id="profile_image" name="profile_image" accept="image/*">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </form>
            <hr>
            @if(session('success'))
                <div class="alert alert-danger">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <br>

            <h5 class="mb-4">Change Password</h5>
            <form action="{{ route('profile.changePassword') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="new_password">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
                <div class="form-group mb-3">
                    <label for="new_password_confirmation">Confirm New Password</label>
                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            </form>
            <br>
        </div>


    </div>
    <br>

@endsection
