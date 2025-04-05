@extends('admin.layout.front',['main_page' => 'yes'])
@section('content')

<style>
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
        padding: 5px;
    }
    .card {
        width: 100%;
        max-width: 350px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .card-header {
        background-color: #949596;
        border-bottom: 1px solid #dee2e6;
        padding: 8px;
        font-size: 0.85rem;
        font-weight: bold;
        text-align: center;
    }
    .card-body {
        padding: 6px;
    }
    .form-group {
        margin-bottom: 0.4rem;
    }
    .col-form-label {
        font-weight: bold;
        font-size: 0.85rem;
    }
    .form-control {
        padding: 2px;
        font-size: 0.85rem;
    }
    .btn-primary {
        display: block;
        width: 100%;
        padding: 6px;
        font-size: 0.85rem;
    }
</style>
<body>
    <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Vehicle</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.transport')}}">vehicle</a></li>
              <li class="breadcrumb-item active">New Guide</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

<div class="container">
    <div class="card">
        <div class="card-header">Add Vehicle</div>

        @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

        <div class="card-body">
            <form method="POST" action="{{route('admin.store_transport')}}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name" class="col-form-label">{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="model" class="col-form-label">{{ __('Model') }}</label>
                  <input id="model" type="text" class="form-control @error('model') is-invalid @enderror" name="model" value="{{ old('model') }}" required autocomplete="model" autofocus>
                  @error('model')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>

              <div class="form-group">
                  <label for="price" class="col-form-label">{{ __('Price') }}</label>
                  <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>
                  @error('price')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
                <div class="form-group">
                    <label for="image" class="col-form-label">{{ __('Vehicle Image') }}</label>
                    <input id="image" type="file" class="form-control-file @error('image') is-invalid @enderror" name="image" required>
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
    </div>
</body>
@endsection
