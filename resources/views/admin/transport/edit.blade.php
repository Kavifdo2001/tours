@extends('admin.layout.front',['main_page' > 'yes'])
@section('content')



  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.transport')}}">Transport</a></li>
                <li class="breadcrumb-item active">Edit Vehicle</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->

    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Edit Vehicle</h3>
            </div>

            <form class="form-horizontal" method="POST" action="{{ route('admin.update_transport', $category->id) }}" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                <div class="card-body">
                    <div class="form-group row">
                        
                        <label for="categoryName" class="col-sm-2 col-form-label">Vehicle Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $category->name }}"  
                                placeholder="Enter Vehicle name" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="model" class="col-sm-2 col-form-label">Vehicle Model</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="model" name="model"
                                value="{{ $category->model }}"  
                                placeholder="Enter Vehicle model" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="model" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="price" name="price"
                                value="{{ $category->price }}"  
                                placeholder="Enter Vehicle Price" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="categoryImage" class="col-sm-2 col-form-label">Category Image</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                              <img src="{{ asset($category->image) }}" alt="Current Image" style="width: 400px; height: auto;">
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Update</button>
                    <button type="button" class="btn btn-default float-right" onclick="window.history.back()">Cancel</button>
                </div>
            </form>
        </div>
    </section>

    </div>

</body>
@endsection

