@extends('layouts.front')

@section('content')
    <style>

    </style>

    <br>
    <br>
    <div class="container-fluid py-5" style="margin-top: -90px">
        <div class="container py-5">
            <!-- Centered Register Title -->
            <div class="row justify-content-center mb-5">
                <div class="col-12 text-center">
                    {{--                    <h1 class="section-booking-title">Register</h1>--}}
                </div>
            </div>

            <div class="row g-5 align-items-center justify-content-center">
                <div class="col-lg-6">
                    <h5 class="section-booking-title pe-3" style="text-align: center">Create Your Account</h5>
                    <p class=" mb-4" style="color: #fbab22">Join us to explore the best deals and travel opportunities around the world. Sign up to create your account and start your adventure.</p>
                    <p class=" mb-4">Fill in your details below to complete your registration.</p>
                </div>

                <div class="col-lg-6">
                    <h1 class=" mb-3" style="color: #fbab22">Register Now</h1>
                    <br>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input id="name" type="text" class="form-control bg-white border-0 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    <label for="name">Your Name</label>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input id="email" type="email" class="form-control bg-white border-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    <label for="email">Your Email</label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input id="contact" type="tel" class="form-control bg-white border-0 @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required autocomplete="contact" autofocus>
                                    <label for="contact">Contact Number</label>
                                    @error('contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input id="password" type="password" class="form-control bg-white border-0 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    <label for="password">Password</label>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input id="password-confirm" type="password" class="form-control bg-white border-0" name="password_confirmation" required autocomplete="new-password">
                                    <label for="password-confirm">Confirm Password</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary text-white w-100 py-3" type="submit">Register</button>
                            </div>
                        </div>

                    </form>

                    <a href="{{ route('google.login') }}" class="google-btn">
                        <i class="fab fa-google" style="color: #c50d0d; background-color: #fdfdfd; border-radius: 50%; padding: 10px; font-size: 20px; width: 40px; height: 40px; align-items: center; justify-content: center;"></i> Sign Up with Google
                    </a>

                </div>
            </div>
        </div>
    </div>
@endsection
