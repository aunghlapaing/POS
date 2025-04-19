@extends('admin.layouts.master')

@section('content')

<div class="container">
    <div class=" d-flex justify-content-between my-2">
        <div class=""></div>
        <div class="">
            <form action="" method="get">

                <div class="input-group">
                    <input type="text" name="searchKey" value="" class=" form-control"
                        placeholder="Enter Search Key...">
                    <button type="submit" class=" btn bg-dark text-white"> <i
                            class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><i class="fa-solid fa-triangle-exclamation me-2"></i>Click the order code to see the order details.</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <table class="table table-hover shadow-sm ">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Date</th>
                        <th>Order Code</th>
                        <th>User Name</th>
                        <th>Oder Status</th>
                        <th></th>
                    </tr>
                </thead>
                @foreach($orderList as $data)
                    <tr>
                        <td>{{ $data->created_at->format('j-F-Y') }}</td>
                        <td><a href="{{ route('orderDetailPage') }}">{{ $data->order_code  }}</a></td>
                        <td>{{ $data->user_name }}</td>
                        <td>
                            <select name="status" id="status" class="form-control">
                                <option value="" @if( $data->status == 0 ) selected @endif >Pending</option>
                                <option value="" @if( $data->status == 1 ) selected @endif >Completed</option>
                                <option value="" @if( $data->status == 2 ) selected @endif >Incompleted</option>
                            </select>
                        </td>
                        <td>
                            @if( $data->status == 0 )
                                <i class="fa-solid fa-hourglass-half text-warning"></i>   
                            @elseif( $data->status == 1 )
                                <i class="fa-solid fa-check text-primary"></i>
                            @elseif( $data->status == 2 )
                                <i class="fa-solid fa-xmark text-danger"></i>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
            <span class="d-flex justify-content-md-start"> </span>
        </div>
    </div>
</div>

@endsection