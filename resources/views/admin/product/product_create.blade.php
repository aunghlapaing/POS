@extends('admin/layouts/master')

@section('content')
    <div class="cointainer">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="">
                            <div class="">
                                <h6 class="m-0 font-weight-bold text-primary">Create Category Page</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="formMultipleFile" class="form-label">Multiple file input example</label>
                                    <input class="form-control" type="file" id="formFile" multiple>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6 mt-3">
                                    <label for="exampleFormControlInput1" class="form-label">Produdct Name</label>
                                    <input type="text" name="productName" class="form-control"
                                        placeholder="Enter product name..." value="{{ old('productName') }}">
                                </div>
                                <div class="col-6 mt-3">
                                    <label for="productCreate" class="form-label">Category List</label>
                                    <select name="productCategory" class="form-select" id="">
                                        <option selected value="">Choose Category</option>
                                        @foreach ($category as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6 mt-3">
                                    <label for="exampleFormControlInput1" class="form-label">Product Price</label>
                                    <input type="text" name="productPrice" class="form-control"
                                        placeholder="Enter product price..." value="{{ old('productPrice') }}">
                                </div>
                                <div class="col-6 mt-3">
                                    <label for="productCreate" class="form-label">Stock</label>
                                    <input type="number" class="form-control" name="stock" placeholder="Enter stock number...">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mt-3 ">
                                    <label for="productCreate" class="form-label" >Enter Description</label>
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                        <label for="floatingTextarea">Comments...</label>
                                    </div>
                                  </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <a href="#" class="btn btn-outline-primary">
                                        Product List
                                    </a>
                                    <input type="submit" name="btn_submit" class="btn btn-success" value="Create Product" id="">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
