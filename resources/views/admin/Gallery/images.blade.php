@extends('admin.layout.front',['main_page' => 'yes'])

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Images</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Gallery | Images</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Images Form</h3>
            </div>

            <!-- Form to Upload Images -->
            <form class="form-horizontal" method="POST" action="{{ route('admin.photos.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <!-- Select Main Category -->
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label>Main Category</label>
                            <select class="form-control select2" style="width: 100%;" name="category_id" required>
                                <option value="">Select Main Category</option>
                                @foreach($mainCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Upload Images -->
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label>Category Images</label>
                            <input type="file" class="form-control" id="categoryImages" name="images[]" multiple required>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Save</button>
                    <button type="button" class="btn btn-default float-right" onclick="window.history.back()">Cancel</button>
                </div>
            </form>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Main Category Table</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Category Name</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($photos as $index => $photo)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $photo->category->category_name }}</td>
                                        <td>
                                            <img src="{{ asset($photo->images) }}" alt="Category Image" style="max-width: 100px; max-height: 100px;">
                                        </td>
                                        <td class="action-icons">
                                            <a href="{{ route('admin.photos.delete', $photo->id) }}" class="text-danger" onclick="return confirm('Are you sure you want to delete this image?')">
                                                <span class="btn btn-danger"><i class="fas fa-trash"></i> <span>Delete</span></span>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Category Name</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title">Your Gallery</h4>
                        </div>
                        <div class="card-body">
                            <!-- Category Filter Buttons -->
                            <div>
                                <div class="btn-group-responsive">
                                    <a class="btn btn-info active" href="javascript:void(0)" data-filter="all">All items</a>
                                    @foreach($mainCategories as $category)
                                        <a class="btn btn-info" href="javascript:void(0)" data-filter="{{ $category->id }}">{{ $category->category_name }}</a>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Gallery Images -->
                            <div>
                                <div class="filter-container p-0 row">
                                    @foreach($photos as $photo)
                                        <div class="filtr-item col-sm-2" data-category="{{ $photo->category_id }}">
                                            <a href="{{ asset($photo->images) }}" data-toggle="lightbox" data-title="Image">
                                                <img src="{{ asset($photo->images) }}" class="img-fluid mb-2" alt="Image" style="width: 100%; height: auto;">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Lightbox
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });

        // Filter functionality
        var $container = $('.filter-container');
        $('[data-filter]').on('click', function() {
            var filterValue = $(this).attr('data-filter');
            if (filterValue === 'all') {
                $container.children().show();
            } else {
                $container.children().hide();
                $container.children('[data-category="' + filterValue + '"]').show();
            }
        });

        // Shuffle functionality
        $('[data-shuffle]').on('click', function() {
            var items = $container.children();
            for (var i = items.length; i >= 0; i--) {
                $container.append(items[Math.random() * i | 0]);
            }
        });

        // Sort functionality
        $('[data-sortOrder]').on('change', function() {
            var order = $(this).val();
            var items = $container.children();
            if (order === 'index') {
                items.sort(function(a, b) {
                    return $(a).index() - $(b).index();
                });
            } else {
                items.sort(function(a, b) {
                    return $(a).data('sort') > $(b).data('sort') ? 1 : -1;
                });
            }
            $container.append(items);
        });

        $('[data-sortAsc]').on('click', function() {
            var items = $container.children();
            items.sort(function(a, b) {
                return $(a).data('sort') > $(b).data('sort') ? 1 : -1;
            });
            $container.append(items);
        });

        $('[data-sortDesc]').on('click', function() {
            var items = $container.children();
            items.sort(function(a, b) {
                return $(a).data('sort') < $(b).data('sort') ? 1 : -1;
            });
            $container.append(items);
        });
    });
</script>
{{-- <script>
$(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
            alwaysShowClose: true
        });
    });

    // Filterizr - Category Filter
    $('.filter-container').filterizr({gutterPixels: 3});

    $('.btn[data-filter]').on('click', function() {
        var filterValue = $(this).attr('data-filter');
        $('.btn[data-filter]').removeClass('active');
        $(this).addClass('active');

        // Show all items if "all" filter is selected
        if (filterValue == 'all') {
            $('.filtr-item').show();
        } else {
            $('.filtr-item').hide().filter(function() {
                return $(this).attr('data-category') == filterValue;
            }).show();
        }
    });
});
</script> --}}


@endsection
