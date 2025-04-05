@extends('layouts.front')

@section('content')
    <br>
    <br>
    <div class="container-fluid py-2" >
        <div class="container py-2">

            <div class="row justify-content-center mb-2">
                <div class="col-12 text-center">
                    <h1 class="section-booking-title" style="color: #fbab22">Login</h1>
                </div>
            </div>

            <div class="row g-5 align-items-center justify-content-center">
                <div class="col-lg-6">
                    <h1 class=" mb-4">Welcome Back!</h1>
                    <p class=" mb-4" style="color: #fbab22">Log in to your account to access the best deals and travel opportunities. We are excited to have you back!</p>
                    <p class=" mb-4">Enter your credentials below to continue your journey with us.</p>
                </div>

                <div class="col-lg-6">

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input id="email" type="email" class="form-control bg-white border-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <label for="email">Your Email</label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <input id="password" type="password" class="form-control bg-white border-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    <label for="password">Password</label>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary text-white w-100 py-3" type="submit">Login</button>
                            </div>



                            {{--                            <div class="col-12 text-center">--}}
                            {{--                                @if (Route::has('password.request'))--}}
                            {{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
                            {{--                                        Forgot Your Password?--}}
                            {{--                                    </a>--}}
                            {{--                                @endif--}}
                            {{--                            </div>--}}
                        </div>
                    </form>
                    <a href="{{ route('google.login') }}" class="google-btn">
                        <i class="fab fa-google" style="color: #c50d0d; background-color: #fdfdfd; border-radius: 50%; padding: 10px; font-size: 20px; width: 40px; height: 40px; align-items: center; justify-content: center;"></i> Login with Google
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
