@extends('admin.layout.front',['main_page' => 'yes'])

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Guide Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Guides</li>
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
                            <h3 class="card-title">Guide Details</h3>
                            <a href="{{ route('admin.create_guide') }}" class="btn btn-primary float-right">Create New Guide</a>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Contact</th>
                                        <th>Profile Image</th>
                                        <th>Description</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($guides as $guide)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $guide->name }}</td>
                                        <td>{{ $guide->email }}</td>
                                        <td>{{ $guide->address }}</td>
                                        <td>{{ $guide->contact }}</td>
                                        <td>
                                            @if($guide->profileImage)
                                                <img src="{{ asset($guide->profileImage) }}" alt="Guide Profile Image" width="50" height="50">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>{{ $guide->description }}</td>
                                        <td>
                                            <a href="{{ route('admin.view_guide', $guide->id) }}" class="btn btn-info">View</a>
                                            <a href="{{ route('admin.edit_guide', $guide->id) }}" class="btn btn-primary">Edit</a>
                                            <form action="{{ route('guide.destroy', $guide->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this guide?');">
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
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Contact</th>
                                        <th>Profile Image</th>
                                        <th>Description</th>
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
