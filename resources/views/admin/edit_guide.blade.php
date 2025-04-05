@extends('admin.layout.front',['main_page' => 'yes'])

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Guide Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.guide') }}">Guides</a></li>
                        <li class="breadcrumb-item active">Edit Guide Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Guide Information</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.update_guide', $guide->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $guide->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" value="{{ $guide->email }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ $guide->address }}">
                                </div>
                                <div class="form-group">
                                    <label for="contact">Contact</label>
                                    <input type="text" class="form-control" id="contact" name="contact" value="{{ $guide->contact }}">
                                </div>
                                <div class="form-group">
                                    <label for="category" class="col-form-label">{{ __('Category') }}</label>
                                    <select id="category" class="form-control @error('category') is-invalid @enderror" name="category" required>
                                        <option value="">Select a category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $guide->category == $category->category_name ? 'selected' : '' }}>
                                                {{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3">{{ $guide->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="profileImage">Profile Image</label>
                                    <input type="file" class="form-control-file" id="profileImage" name="profileImage">
                                    @if($guide->profileImage)
                                        <img src="{{ asset($guide->profileImage) }}" alt="Current Profile Image" width="100" height="100" class="mt-2">
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">Update Guide</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
