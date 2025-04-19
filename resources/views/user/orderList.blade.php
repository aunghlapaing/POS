@extends('user.layouts.master')

@section('content')

<div class="container " style="margin-top: 150px">
    <div class="row">
        <table class="table table-hover shadow-sm ">
            <thead class="bg-primary text-white">
                <tr>
                    <th>Date</th>
                    <th>Order Code</th>
                    <th>Order Status</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($orderList as $item)
                    <tr>
                        <td>{{ $item->created_at->format('j-F-Y') }}</td>
                        <td>{{ $item->order_code }}</td>
                        <td>
                            @if( $item->status == 0 )
                                <i class="fa-solid fa-hourglass-half btn btn-sm btn-warning me-2"></i>
                                <span class="text-warning">Pending</span>
                            @elseif( $item->status == 1 )
                                <i class="fa-solid fa-check btn btn-sm btn-success me-2"></i>
                                <span class="text-primary">Completed</span>
                            @elseif( $item->status == 2 )
                                <i class="fa-solid fa-xmark btn btn-sm btn-danger me-2"></i>
                                <span class="text-danger">Incompleted</span>
                            @endif
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
    
@endsection