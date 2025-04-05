@extends('admin.layout.front', ['main_page' > 'yes'])
@section('content')

    <body>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Tour Packages </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Package</li>
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
                        <form method="POST" action="{{ route('admin.default_tour.store') }}" enctype="multipart/form-data">
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Create Toure Package</h3>
                                    </div>



                                    @csrf
                                    <input type="hidden" name="u_id" value="{{ Auth::id() }}">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Main Category</label>
                                                    <select class="form-control select2" style="width: 100%;"
                                                        id="main_category" name="category_id">
                                                        <option value="">Select Main Category</option>
                                                        @foreach ($mainCategories as $category)
                                                            <option value="{{ $category->id }}">
                                                                {{ $category->category_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Sub Category:</label>
                                                    <select class="form-control select2" style="width: 100%;"
                                                        id="sub_category" name="subctg_id">
                                                        <option value="">Select Sub Category</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Departure:</label>
                                                    <select class="form-control select2" style="width: 100%;" id="departure"
                                                        name="departure_id">
                                                        <option value="">Select Departure</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Route:</label>
                                                    {{-- <select class="form-control select2" style="width: 100%;" id="route" name="route_id">
                                                        <option value="">Select Routes</option>
                                                    </select> --}}
                                                    <div id="route" name="route_ids[]">
                                                        <!-- Checkboxes will be appended here by AJAX -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Inclusion:</label>
                                                    {{-- <select class="form-control select2" style="width: 100%;" id="inclusion" name="inclusion_id">
                                                        <option value="">Select Inclusions</option>
                                                    </select> --}}
                                                    <div id="inclusion" name="inclusion_ids[]">
                                                        <!-- Checkboxes will be appended here by AJAX -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Airtiket:</label>
                                                    <select class="form-control select2" style="width: 100%;" id="airticket"
                                                        name="air_ticket_id">
                                                        <option value="">Select Airticket</option>
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
                                                            <select class="form-control" id="currency" name="currency"
                                                                style="border-top-right-radius: 0; border-bottom-right-radius: 0;">
                                                                <option value="USD">$</option>
                                                                <option value="LKR">Rs</option>
                                                            </select>
                                                        </div>
                                                        <input type="number" class="form-control" id="amount"
                                                            name="amount" placeholder="Enter amount" step="0.01">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>No of Days:</label>
                                                    <input type="number" class="form-control" id="days" name="days"
                                                        placeholder="Enter number of days">
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                {{-- <div class="form-group">
                                                    <label>Guide Name:</label>
                                                    <select class="form-control select2" style="width: 100%;" id="guide_id" name="guide_id">
                                                        <option value="">Select Guide</option>
                                                        @foreach ($guides as $guide)
                                                            <option value="{{ $guide->id }}">{{ $guide->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div> --}}
                                                <div class="form-group">
                                                    <label>Guide Name:</label>
                                                    <select class="form-control select2" style="width: 100%;" id="guide_id"
                                                        name="guide_id">
                                                        <option value="">Select Guide</option>
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
                                                            <input type="file" class="custom-file-input"
                                                                id="mainImage" name="mainImage" accept="image/*">
                                                            <label class="custom-file-label" for="mainImage">Choose main
                                                                image</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Other Images:</label><br>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                id="otherImages" name="otherImages[]" multiple
                                                                accept="image/*">
                                                            <label class="custom-file-label" for="otherImages">Choose
                                                                other images</label>
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
                                                            <input type="file" class="custom-file-input"
                                                                id="document" name="document"
                                                                accept=".pdf, .docx, .doc">
                                                            <label class="custom-file-label" for="document">Choose
                                                                document</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Description:</label><br>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <textarea class="form-control" id="description" name="description"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>







            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Package Table</h3>
                                </div>
                                <div class="card-body">

                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>

                                                <th>ID</th>
                                                <th>Main Category Name</th>
                                                <th>Sub Category Name</th>
                                                <th>Amount</th>
                                                <th>No of Days</th>
                                                <th>Guide Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($tourPackages as $package)
                                                <tr>
                                                    <td>{{ $package->id }}</td>
                                                    <td>{{ $package->category ? $package->category->category_name : '' }}
                                                    </td>
                                                    <td>{{ $package->subCategory ? $package->subCategory->category_name : '' }}
                                                    </td>
                                                    <td>{{ $package->amount }}</td>
                                                    <td>{{ $package->no_of_days }}</td>
                                                    <td>{{ $package->guide ? $package->guide->name : '' }}</td>

                                                    <td class="action-icons">
                                                        <a href="{{ route('admin.default_tour.view', $package->id) }}"
                                                            class="btn btn-primary">
                                                            <i class="far fa-eye"></i> <span>View</span>
                                                        </a>
                                                        <a href="{{ route('admin.default_tour.edit', $package->id) }}"
                                                            class="btn btn-warning">
                                                            <i class="fas fa-edit"></i> <span>Edit</span>
                                                        </a>
                                                        <form
                                                            action="{{ route('admin.default_tour.delete', $package->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"
                                                                onclick="return confirm('Are you sure you want to delete this package?')">
                                                                <i class="fas fa-trash"></i> <span>Delete</span>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Main Category Name</th>
                                                <th>Sub Category Name</th>
                                                <th>Amount</th>
                                                <th>No of Days</th>
                                                <th>Guide Name</th>
                                                <th>Action</th>

                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
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
                amountInput.placeholder = Enter amount in $ {
                    currencySymbol
                };
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
                if (categoryId) {
                    $.ajax({
                        url: '{{ route('admin.get_subcategories') }}',
                        type: 'GET',
                        data: {
                            category_id: categoryId
                        },
                        success: function(data) {
                            $('#sub_category').empty();
                            $('#sub_category').append(
                                '<option value="">Select Sub Category</option>');
                            $.each(data, function(key, value) {
                                $('#sub_category').append('<option value="' + value.id +
                                    '">' + value.category_name + '</option>');
                            });
                        }
                    });

                    $.ajax({
                        url: '{{ route('admin.get_departures') }}',
                        type: 'GET',
                        data: {
                            category_id: categoryId
                        },
                        success: function(data) {
                            $('#departure').empty();
                            $('#departure').append(
                            '<option value="">Select Departure</option>');
                            $.each(data, function(key, value) {
                                $('#departure').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        }
                    });


                    // Fetch Routes
                    $.ajax({
                        url: '{{ route('admin.get_routes') }}',
                        type: 'GET',
                        data: {
                            category_id: categoryId
                        },
                        success: function(data) {
                            $('#route').empty();
                            $.each(data, function(key, value) {
                                $('#route').append(
                                    '<div class="form-check">' +
                                    '<input class="form-check-input" type="checkbox" name="route_ids[]" value="' +
                                    value.id + '" id="route_' + value.id + '">' +
                                    '<label class="form-check-label" for="route_' +
                                    value.id + '">' + value.name + '</label>' +
                                    '</div>'
                                );
                            });
                        }
                    });

                    // Fetch Inclusions
                    $.ajax({
                        url: '{{ route('admin.get_inclusions') }}',
                        type: 'GET',
                        data: {
                            category_id: categoryId
                        },
                        success: function(data) {
                            $('#inclusion').empty();
                            $.each(data, function(key, value) {
                                $('#inclusion').append(
                                    '<div class="form-check">' +
                                    '<input class="form-check-input" type="checkbox" name="inclusion_ids[]" value="' +
                                    value.id + '" id="inclusion_' + value.id +
                                    '">' +
                                    '<label class="form-check-label" for="inclusion_' +
                                    value.id + '">' + value.name + '</label>' +
                                    '</div>'
                                );
                            });
                        }
                    });


                    $.ajax({
                        url: '{{ route('admin.get_airtickets') }}',
                        type: 'GET',
                        data: {
                            category_id: categoryId
                        },
                        success: function(data) {
                            $('#airticket').empty();
                            $('#airticket').append(
                            '<option value="">Select Airticket</option>');
                            $.each(data, function(key, value) {
                                $('#airticket').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        }
                    });

                    $.ajax({
                        url: '{{ route('admin.getGuides') }}',
                        type: 'GET',
                        data: {
                            category_id: categoryId
                        },
                        success: function(data) {
                            $('#guide_id').empty();
                            $('#guide_id').append('<option value="">Select Guide</option>');
                            $.each(data, function(key, value) {
                                $('#guide_id').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        }
                    });

                } else {
                    $('#sub_category').empty();
                    $('#departure').empty();
                    $('#route').empty();
                    $('#inclusion').empty();
                    $('#airticket').empty();
                    $('#guide_id').empty();
                }
            });
        });
    </script>

@endsection
