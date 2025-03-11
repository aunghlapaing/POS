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
            <div class="col">
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
                                    <td>{{ $item->address == "" ? 'sample' : $item->address; }}</td>
                                    <td>{{ $item->phone == "" ? 'sample' : $item->phone; }}</td>
                                    <td><span class="btn btn-sm bg-danger text-white rounded shadow-sm">{{ $item->role }}</span></td>
                                    <td>{{ $item->provider }}</td>
                                    <td>{{ $item->created_at}}</td>
                                    <td></td>
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
