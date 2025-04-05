@extends('admin.layout.front',['main_page' => 'yes'])

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gallery | Videos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Gallery | Videos</li>
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

    <!-- Form to Upload Videos -->
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Videos Form</h3>
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('admin.Videos.store') }}" enctype="multipart/form-data">
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

                    <!-- Upload Videos -->
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label>Category Videos</label>
                            <input type="file" class="form-control" id="categoryVideos" name="videos[]" multiple accept="video/*" required>
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
                                        <th>Video</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($videos as $index => $video)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $video->category->category_name }}</td>
                                        <td>
                                            <video width="320" height="240" controls>
                                                <source src="{{ asset($video->videos) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </td>
                                        <td class="action-icons">
                                            <a href="{{ route('admin.Videos.delete', $video->id) }}" class="text-danger" onclick="return confirm('Are you sure you want to delete this video?')">
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
                                        <th>Video</th>
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
                            <div class="btn-group-responsive">
                                <a class="btn btn-info active" href="javascript:void(0)" data-filter="all">All items</a>
                                @foreach($mainCategories as $category)
                                    <a class="btn btn-info" href="javascript:void(0)" data-filter="{{ $category->id }}">{{ $category->category_name }}</a>
                                @endforeach
                            </div>

                            <!-- Gallery Videos -->
                            <div class="filter-container p-0 row">
                                @foreach($videos as $video)
                                    <div class="filtr-item col-sm-4" data-category="{{ $video->category_id }}">
                                        <video width="100%" controls>
                                            <source src="{{ asset($video->videos) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>
<script>
    function confirmDelete(event) {
        event.preventDefault();
        if (confirm('Are you sure you want to delete this video? This action cannot be undone.')) {
            window.location.href = event.target.closest('a').href;
        }
    }
    </script>

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
    });
</script>

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection
