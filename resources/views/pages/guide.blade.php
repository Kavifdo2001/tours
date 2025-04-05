@extends('layouts.front')
@section('content')


<!-- Travel Guide Start -->
<div class="container-fluid guide py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Travel Guide</h5>
            <h1 class="mb-0">Meet Our Guide</h1>
        </div>
        <div class="row g-4">

            @foreach($guides as $guide)
                <div class="col-md-6 col-lg-3">
                    <div class="guide-item">
                        <div class="guide-img">
                            <div class="">
                                <img src="{{ asset($guide->profileImage) }}" class="img-fluid w-100 rounded-top" alt="Image">
                            </div>

                        </div>
                        <div class="guide-title text-center rounded-bottom p-1">
                            <div class="guide-title-inner">
                                <h4 class="mt-3">{{$guide->name}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
             @endforeach

        </div>
    </div>
</div>
<!-- Travel Guide End -->

@endsection
