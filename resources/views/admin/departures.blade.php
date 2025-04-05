@extends('admin.layout.front',['main_page' > 'yes'])

@section('content')
<body>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Departure Managment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                      <li class="breadcrumb-item active">Deparure</li>
                    </ol>
                  </div>
            </div>
        </div>
    </section>

    <!-- Display success message -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Display errors -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Departure Details</h3>
                        </div>

                        <form method="POST" action="{{ route('admin.post.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Main Category</label>
                                    <select class="form-control select2" name="mainctg_id" style="width: 100%;">
                                        <option value="">Select Main Category</option>
                                        @foreach($mainCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter name">
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Display table with departures -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Departure Table</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Main Category</th>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($departures as $departure)
                                    <tr>
                                        <td>{{ $departure->id }}</td>
                                        <td>{{ $departure->category->category_name }}</td>
                                        <td>{{ $departure->name }}</td>
                                        <td>
                                            {{-- <a href="{{ route('admin.departure.view', $departure->id) }}" class="btn btn-info btn-sm">View</a> --}}
                                            <a href="{{ route('admin.departure.edit', $departure->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('admin.departure.delete', $departure->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Main Category</th>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
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
$(document).ready(function() {
    $('.select2').select2();
});
</script>
@endsection
