@extends('admin.layout.front',['main_page' => 'yes'])

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Transport Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Transport</li>
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

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Transport Details</h3>
                            <a href="{{ route('admin.create_transport') }}" class="btn btn-primary float-right">Add Vehicle</a>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>model</th>
                                        <th>price</th>
                                        <th>image</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transport as $car)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $car->name }}</td>
                                        <td>{{ $car->model }}</td>
                                        <td>{{ $car->price }}</td>
                                    
                                        <td>
                                          <img src="{{ asset($car->image) }}" alt="Image" width="50" height="50">
                                        </td>
                              
                                        <td>
                                            <a href="{{ route('admin.edit_transport', $car->id) }}" class="btn btn-primary">View/Edit</a>
                                            <form action="{{ route('admin.destroy_transport', $car->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE') <!-- Spoof the DELETE method -->
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this vehicle?');">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                          <th>ID</th>
                                          <th>Name</th>
                                          <th>model</th>
                                          <th>price</th>
                                          <th>image</th>
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
</div>

@endsection
