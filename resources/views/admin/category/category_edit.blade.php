@extends('admin/layouts/master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4 col-md-5">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Update Category Page</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('categoryUpdate', $category->id) }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                        <input type="text" name="categoryName" class="form-control @error('categoryName') is-invalid @enderror"
                            id="exampleFormControlInput1" value="{{ old('categoryName', $category->name) }}" placeholder="Drinks...">
                        @error('categoryName')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <a href="{{ route('categoryList') }}" class="btn btn-outline-danger" id="">
                        Cancel
                    </a>
                    <input type="submit" value="Update" class="btn btn-outline-primary"></input>
                
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
