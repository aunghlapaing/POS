@extends('admin/layouts/master')

@section('content')
<div class="container-fluid">

    <div class="row">
        <!-- DataTales Example -->
        <div class="card shadow mb-4 col-md-4">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Add Category Page</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('categoryCreate') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                        <input type="text" name="categoryName" class="form-control @error('categoryName') is-invalid  @enderror" id="exampleFormControlInput1"
                            placeholder="Enter Category Name..." value="{{ old('categoryName') }}">
                        @error('categoryName')
                           <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
    
                    <input type="submit" value="Create" class="btn btn-primary">
                </form>
                
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4 col-md-6 ml-3">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Created At</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->created_at->format('j-F-Y')}}</td>
                                <td>
                                    <a href="{{ route('categoryEdit') }}">
                                        <button type="button" class="btn btn-outline-primary"><i class="fa-regular fa-pen-to-square"></i></button>
                                    </a>
                                    
                                    <button type="button" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></butt>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
