@extends('admin.layout.front',['main_page' > 'yes'])
@section('content')


    <style>
    </style>


    <body>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Toure Package </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.default_tour')}}">Package</a></li>
                            <li class="breadcrumb-item active">Edit Toure Package</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Toure Package</h3>
                            </div>


                            <form method="POST" action="{{ route('admin.default_tour.update', $package->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="u_id" value="{{ Auth::id() }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Main Category</label>
                                                <select class="form-control select2" style="width: 100%;" id="main_category" name="category_id" disabled>
                                                    <option value="">Select Main Category</option>
                                                    @foreach($mainCategories as $category)
                                                        <option value="{{ $category->id }}" {{ $package->category_id == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Sub Category:</label>
                                                <select class="form-control select2" style="width: 100%;" id="sub_category" name="subctg_id">
                                                    <option value="">Select Sub Category</option>
                                                    @foreach($subCategories as $subcategory)
                                                        <option value="{{ $subcategory->id }}" {{ $package->subcategory_id == $subcategory->id ? 'selected' : '' }}>{{ $subcategory->category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Departure:</label>
                                                <select class="form-control select2" style="width: 100%;" id="departure" name="departure_id">
                                                    <option value="">Select Departure</option>
                                                    @foreach($departures as $departure)
                                                        <option value="{{ $departure->id }}" {{ $package->departure_id == $departure->id ? 'selected' : '' }}>{{ $departure->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Route:</label>
                                                <div id="route" name="route_ids[]">
                                                    @foreach($routes as $route)
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="route_ids[]" value="{{ $route->id }}" {{ in_array($route->id, $package->routes->pluck('id')->toArray()) ? 'checked' : '' }} id="route_{{ $route->id }}">
                                                            <label class="form-check-label" for="route_{{ $route->id }}">{{ $route->name }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Inclusion:</label>
                                                <div id="inclusion" name="inclusion_ids[]">
                                                    @foreach($inclusions as $inclusion)
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="inclusion_ids[]" value="{{ $inclusion->id }}" {{ in_array($inclusion->id, $package->inclusions->pluck('id')->toArray()) ? 'checked' : '' }} id="inclusion_{{ $inclusion->id }}">
                                                            <label class="form-check-label" for="inclusion_{{ $inclusion->id }}">{{ $inclusion->name }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Airtiket:</label>
                                                <select class="form-control select2" style="width: 100%;" id="airticket" name="air_ticket_id">
                                                    <option value="">Select Airticket</option>
                                                    @foreach($airtickets as $airticket)
                                                        <option value="{{ $airticket->id }}" {{ $package->air_ticket_id == $airticket->id ? 'selected' : '' }}>{{ $airticket->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="amount">Amount:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <select class="form-control" id="currency" name="currency" style="border-top-right-radius: 0; border-bottom-right-radius: 0;">
                                                            <option value="USD" {{ $package->currency == 'USD' ? 'selected' : '' }}>$</option>
                                                            <option value="LKR" {{ $package->currency == 'LKR' ? 'selected' : '' }}>Rs</option>
                                                        </select>
                                                    </div>
                                                    <input type="number" class="form-control" id="amount" name="amount" value="{{ $package->amount }}" step="0.01">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>No of Days:</label>
                                                <input type="number" class="form-control" id="days" name="days" value="{{ $package->no_of_days }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Guide Name:</label>
                                                <select class="form-control select2" style="width: 100%;" id="guide_id" name="guide_id">
                                                    <option value="">Select Guide</option>
                                                    @foreach($guides as $guide)
                                                        <option value="{{ $guide->id }}" {{ $package->guide_id == $guide->id ? 'selected' : '' }}>{{ $guide->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Main Image:</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="mainImage" name="mainImage" accept="image/*">
                                                        <label class="custom-file-label" for="mainImage">Choose main image</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Other Images:</label><br>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="otherImages" name="otherImages[]" multiple accept="image/*">
                                                        <label class="custom-file-label" for="otherImages">Choose other images</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Document:</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="document" name="document" accept=".pdf, .docx, .doc">
                                                        <label class="custom-file-label" for="document">Choose document</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Description:</label><br>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <textarea class="form-control" id="description" name="description">{{ $package->description }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                                </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                        </form>
                    </div>
                </div>
        </section>

    </div>
    </body>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const currencySelect = document.getElementById('currency');
            const amountInput = document.getElementById('amount');

            function updatePlaceholder() {
                const currencySymbol = currencySelect.options[currencySelect.selectedIndex].text;
                amountInput.placeholder = 'Enter amount in ' + currencySymbol;
            }

            currencySelect.addEventListener('change', updatePlaceholder);
            updatePlaceholder();
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#main_category').change(function() {
                var categoryId = $(this).val();
                if(categoryId) {
                    $.ajax({
                        url: '{{ route("admin.get_subcategories") }}',
                        type: 'GET',
                        data: { category_id: categoryId },
                        success: function(data) {
                            $('#sub_category').empty();
                            $('#sub_category').append('<option value="">Select Sub Category</option>');
                            $.each(data, function(key, value) {
                                $('#sub_category').append('<option value="'+ value.id +'">'+ value.category_name +'</option>');
                            });
                        }
                    });

                    $.ajax({
                        url: '{{ route("admin.get_departures") }}',
                        type: 'GET',
                        data: { category_id: categoryId },
                        success: function(data) {
                            $('#departure').empty();
                            $('#departure').append('<option value="">Select Departure</option>');
                            $.each(data, function(key, value) {
                                $('#departure').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            });
                        }
                    });

                    // Fetch Routes
                    $.ajax({
                        url: '{{ route("admin.get_routes") }}',
                        type: 'GET',
                        data: { category_id: categoryId },
                        success: function(data) {
                            $('#route').empty();
                            $.each(data, function(key, value) {
                                $('#route').append(
                                    '<div class="form-check">' +
                                    '<input class="form-check-input" type="checkbox" name="route_ids[]" value="'+ value.id +'" id="route_' + value.id + '">' +
                                    '<label class="form-check-label" for="route_' + value.id + '">' + value.name + '</label>' +
                                    '</div>'
                                );
                            });
                        }
                    });

                    // Fetch Inclusions
                    $.ajax({
                        url: '{{ route("admin.get_inclusions") }}',
                        type: 'GET',
                        data: { category_id: categoryId },
                        success: function(data) {
                            $('#inclusion').empty();
                            $.each(data, function(key, value) {
                                $('#inclusion').append(
                                    '<div class="form-check">' +
                                    '<input class="form-check-input" type="checkbox" name="inclusion_ids[]" value="'+ value.id +'" id="inclusion_' + value.id + '">' +
                                    '<label class="form-check-label" for="inclusion_' + value.id + '">' + value.name + '</label>' +
                                    '</div>'
                                );
                            });
                        }
                    });

                    $.ajax({
                        url: '{{ route("admin.get_airtickets") }}',
                        type: 'GET',
                        data: { category_id: categoryId },
                        success: function(data) {
                            $('#airticket').empty();
                            $('#airticket').append('<option value="">Select Airticket</option>');
                            $.each(data, function(key, value) {
                                $('#airticket').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            });
                        }
                    });
                } else {
                    $('#sub_category').empty();
                    $('#departure').empty();
                    $('#route').empty();
                    $('#inclusion').empty();
                    $('#airticket').empty();
                }
            });
        });
    </script>

@endsection
