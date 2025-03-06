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
                        <form action="{{ route('productCreate') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <img class="img-profile mb-1 w-25" id="output" alt="">
                                    </div>
                                    <input class="form-control mt-2 @error('image') is-invalid @enderror" name="image" accept="image/*" type="file" id="formFile" onchange="loadFile(event)">
                                    @error('image')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6 mt-3">
                                    <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Enter product name..." value="{{ old('name') }}">
                                    @error('name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-6 mt-3">
                                    <label for="productCreate" class="form-label">Category List</label>
                                    <select name="categoryId" class="form-select @error('categoryId') is-invalid @enderror" id="">
                                        <option selected value="">Choose Category</option>
                                        @foreach ($category as $item)
                                            <option value="{{ $item->id }}" @if(old('categoryId') == $item->id) @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('categoryId')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6 mt-3">
                                    <label for="exampleFormControlInput1" class="form-label">Product Price</label>
                                    <input type="text" name="price" class="form-control @error('price') is-invalid @enderror"
                                        placeholder="Enter product price..." value="{{ old('price') }}">
                                    @error('price')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-6 mt-3">
                                    <label for="productCreate" class="form-label">Stock</label>
                                    <input type="number" class="form-control @error('stock') @enderror" name="stock" value="{{ old('stock') }}" placeholder="Enter stock number...">
                                    @error('stock')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mt-3 ">
                                    <label for="productCreate" class="form-label">Enter Description</label>
                                    <div class="form-floating">
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" style="height: 200px;" placeholder="Leave a comment here" id="floatingTextarea">{{ old('description') }}</textarea>
                                        <label for="floatingTextarea">Comments...</label>
                                        @error('description')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
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
