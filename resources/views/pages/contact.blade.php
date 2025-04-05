@extends('layouts.front')
@section('title', 'Contact Us - King Sri Lanka Tours')
@section('meta_description', 'Get in touch with King Sri Lanka Tours. Our team is ready to help you plan your next Sri Lankan adventure. Contact us for inquiries, booking tours, or any assistance.')
@section('meta_keywords', 'Contact King Sri Lanka Tours, Sri Lanka Tour Booking, Sri Lanka Travel Inquiries, Contact Travel Agency, Sri Lanka Tourism, Book Tours')
@section('meta_author', 'King Sri Lanka Tours')
@section('meta_og_title', 'Contact King Sri Lanka Tours')
@section('meta_og_description', 'Reach out to King Sri Lanka Tours for all your travel inquiries, tour bookings, and more. We’re here to help you plan your perfect Sri Lanka trip.')
@section('meta_og_image', asset('assets/images/contact-us.jpg'))
@section('meta_og_url', url()->current())

@section('content')

    {{--message--}}
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    {{--end--}}
    <!-- Contact Start -->
    <div class="container-fluid contact  py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Contact Us</h5>
                <h1 class="mb-0">Contact For Any Query</h1>
            </div>
            <div class="row g-5 align-items-center">
                <div class="col-lg-4">
                    <div class="bg-white rounded p-4">
                        <div class="text-center mb-4">
                            <i class="fa fa-map-marker-alt fa-3x text-primary"></i>
                            <h4 class="text-primary"><Address></Address></h4>
                            <p class="mb-0">No.558/9, Base line Road, <br>
                                Daluwakotuwa, Kochchikade
                            </p>
                        </div>
                        <div class="text-center mb-4">
                            <i class="fa fa-phone-alt fa-3x text-primary mb-3"></i>
                            <h4 class="text-primary">Mobile</h4>
                            <p class="mb-0">+94 775 192 780</p>
                            <p class="mb-0">+94 715 667 192</p>
                        </div>

                        <div class="text-center">
                            <i class="fa fa-envelope-open fa-3x text-primary mb-3"></i>
                            <h4 class="text-primary">Email</h4>
                            <p class="mb-0">kingstours@gmail.com</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <h3 class="mb-2">Send us a message</h3>
                    <p class="mb-4">Just feel free to message us.</p>

                    <form action="{{ route('user.mail')}}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control border-0" id="name" name="name" placeholder="Your Name" required>
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control border-0" id="email" name="email" placeholder="Your Email" required>
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="tel" class="form-control border-0" id="contact" name="contact" placeholder="phone no" required>
                                    <label for="subject">Contact</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control border-0" id="subject" name="subject" placeholder="Subject" required>
                                    <label for="subject">Subject</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control border-0" placeholder="Leave a message here" id="message" name="message" style="height: 160px" required></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-12">
                    <div class="rounded">
                        <iframe class="rounded w-100"
                                style="height: 450px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.0052048523517!2d79.83909457405083!3d7.24024341442148!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2e94cbc6a1d6b%3A0x2eade49fce3209e6!2sBlue%20Wave%20Beach%20Restaurant!5e0!3m2!1sen!2slk!4v1733924086696!5m2!1sen!2slk"
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

@endsection
