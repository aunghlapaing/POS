@extends('admin/layouts/master')

@section('content')
    <div class="container">
        <div class=" d-flex justify-content-between my-2">
            <div class="">
                <a href="" class=" btn btn-sm btn-info ">System Users Count ({{ count($userData) }})</a>
                <a href="{{ route('adminListPage', 'default') }}" class=" btn btn-sm btn-secondary  ">All System Users</a> 
                <a href="{{ route('adminListPage', 'superAdmin') }}" class=" btn btn-sm btn-secondary  "> Super Admin List</a>
                <a href="{{ route('adminListPage', 'admin') }}" class=" btn btn-sm btn-secondary  "> Admin List</a>
                <a href="{{ route('adminListPage', 'user') }}" class=" btn btn-sm btn-secondary  "> User List</a>
            </div>
            <div class="">
                <form action="{{ route('adminListPage') }}" method="get">
                    <div class="input-group">
                        <input type="text" name="searchKey" value="{{ request('searchKey') }}" class=" form-control" placeholder="Enter Search Key...">
                        <button type="submit" class=" btn bg-dark text-white"> <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover shadow-sm ">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Platform</th>
                            <th>Created Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($userData) != 0)
                            @foreach ($userData as $item)
                                <tr>
                                    <td>{{ $item->id}}</td>
                                    <td>{{ $item->first_name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{!! $item->address == "" ? '<span class="text-danger">__</span>' : $item->address !!}</td>
                                    <td>{!! $item->phone == "" ? '<span class="text-danger">__</span>' : $item->phone !!}</td>
                                    <td><span class="btn btn-sm bg-danger text-white rounded shadow-sm">{{ $item->role }}</span></td>
                                    <td>{{ $item->provider }}</td>
                                    <td>{{ $item->created_at->format('j-F-Y')}}</td>
                                    <td>
                                        @if($item->role != 'superadmin')
                                            <button type="button" onclick="deleteProcess({{ $item->id }})" class="btn btn-outline-danger btn-sm">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr> 
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9">
                                    <h5 class="text-muted text-center">There is no record!</h5>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <span class=" d-flex justify-content-end">{{ $userData->links() }}</span>

            </div>
        </div>
    </div>
@endsection

@section('js-script')
<script>
    function deleteProcess($id)
    {
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
                        location.href = '/admin/account/admin/delete/' + $id
                    }, 1000);
                }
            });
    }
</script>

@endsection
