@extends('admin/layouts/master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4 col-5">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Update Category Page</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Drinks...">
                </div>

                <a href="{{ route('categoryList') }}">
                    <input type="submit" value="Cancel" class="btn btn-outline-danger" id="">
                </a>
                <input type="submit" value="Update" class="btn btn-outline-primary">
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
