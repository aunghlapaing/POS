@extends('admin/layouts/master')

@section('content')
<div class="containter">
    <div class="card col-md-8 shadow-md offset-md-2">
        <div class="card-header py-3">
            <div class="">
                <div class="">
                    <h6 class="m-0 font-weight-bold text-primary">Product Detail Page</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-primary" role="alert">
                        {{ $product->name }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-primary" role="alert">
                        {{ $product->category_name}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-primary" role="alert">
                        {{ $product->price }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-primary" role="alert">
                        {{ $product->stock }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-primary" role="alert">
                        <img src="{{ asset('productImage/' . $product->image) }}" style="width: 120px; height:120px;" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-primary" role="alert">
                        {{ $product->description }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-3">
                    <a href="{{ route("productList") }}" class="btn btn-outline-primary">
                        Product List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection