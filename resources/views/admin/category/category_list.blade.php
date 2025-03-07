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
                    @if (Session::has('success'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ Session::get('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('categoryCreate') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                            <input type="text" name="categoryName"
                                class="form-control @error('categoryName') is-invalid  @enderror"
                                id="exampleFormControlInput1" placeholder="Enter Category Name..."
                                value="{{ old('categoryName') }}">
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
                                        <td>{{ $item->created_at->format('j-F-Y') }}</td>
                                        <td>
                                            <a href="{{ route('categoryEdit', $item->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>

                                            <button type="button" onclick="deleteCategory({{ $item->id }})"
                                                class="btn btn-sm btn-outline-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <span class="d-flex justify-content-md-start">{{ $categories->links() }}</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection


@section('js-script')

    <script>
        function deleteCategory($id) {
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
                        location.href = '/admin/category/delete/' + $id
                    }, 1000);
                }
            });

        }
    </script>


@endsection
