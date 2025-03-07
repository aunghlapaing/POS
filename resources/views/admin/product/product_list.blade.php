@extends('admin/layouts/master')

@section('content')
    <div class="container">
        <div class=" d-flex justify-content-between my-2">
            <div class="">
                <button class=" btn btn-secondary rounded shadow-sm"> <i class="fa-solid fa-database"></i>
                    Product Count ( {{ count($products) }} ) </button>
                <a href="{{ route('productList', 'default') }}" class=" btn btn-outline-primary  rounded shadow-sm">All Products</a>
                <a href="{{ route('productList', 'lowAmt')  }}" class=" btn btn-outline-danger  rounded shadow-sm">Low Amount Product List</a>
            </div>
            <div class="">
                <form action="{{ route('productList') }}" method="get">

                    <div class="input-group">
                        <input type="text" name="searchKey" value="{{ request('searchKey') }}" class=" form-control"
                            placeholder="Enter Search Key...">
                        <button type="submit" class=" btn bg-dark text-white"> <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-hover shadow-sm ">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Category</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($products) != 0)
                            @foreach ($products as $item)
                                <tr>
                                    <td> 
                                        <img src="{{ asset('productImage/' . $item->image) }}" style="width: 90px; height:80px;" alt="">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td> {{ $item->price }} mmk</td>
                                    <td class="col-2">
                                        
                                        
                                        <button type="button" class="btn btn-secondary position-relative">
                                            @if ($item->stock <= 3)
                                                {{ $item->stock }}
                                                <span
                                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                    Low amt stock
                                                </span>
                                            @else
                                                {{ $item->stock }}
                                            @endif
                                        </button>
                                        
                                    </td>
                                    <td>{{ $item->category_name }}</td>
                                    <td>
                                        <a href="{{ route('productDetail', $item->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('productEditPage', $item->id) }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="fa-solid fa-pen-to-square"></i> 
                                        </a>
                                        <button type="button" onclick="deleteProduct({{ $item->id }})" class="btn btn-sm btn-outline-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">
                                    <h5 class="text-muted text-center">There is no product</h5>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <span class="d-flex justify-content-md-start">{{ $products->links() }}</span>
            </div>
        </div>
    </div>
@endsection

@section('js-script')
    <script>
        function deleteProduct($id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                    setInterval(() => {
                        location.href = '/admin/product/delete/' + $id
                    }, 1000);
                }
            });

        }
    </script>
@endsection
