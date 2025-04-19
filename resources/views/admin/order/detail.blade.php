@extends('admin.layouts.master')

@section('content')

<div class="container-fluid">


    <a href="{{ url('admin/order/list')  }}" class=" text-black m-3"> <i class="fa-solid fa-arrow-left-long"></i> Back</a>

    <!-- DataTales Example -->


    <div class="row">
        <div class="card col-5 shadow-sm m-4 col">
            <div class="card-header bg-primary">
                Customer Information
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-5">Name : </div>
                    <div class="col-7">{{ $orderDetail[0]->user_name }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-5">Phone : </div>
                    <div class="col-7">
                        {{ $orderDetail[0]->user_phone }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-5">Addr : </div>
                    <div class="col-7">
                        {{ $orderDetail[0]->user_address }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-5">Order Code : </div>
                    <div class="col-7" id="orderCode">{{ $orderDetail[0]->order_code }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-5">Order Date : </div>
                    <div class="col-7">{{ $orderDetail[0]->order_date }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-5">Total Price : </div>
                    <div class="col-7">
                        {{ $paymentHistory->total_amt }}mmk<br>
                        <small class=" text-danger ms-1">( Contain Delivery Charges )</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card col-5 shadow-sm m-4 col">
            <div class="card-header bg-primary">
                Payment History
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-5">Contact Phone :</div>
                    <div class="col-7">{{ $paymentHistory->phone }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-5">Payment Method :</div>
                    <div class="col-7">{{ $paymentHistory->payment_method }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-5">Purchase Date :</div>
                    <div class="col-7">{{ $paymentHistory->payment_date }}</div>
                </div>
                <div class="row mb-3">
                    <img style="width: 150px" src="{{ asset('payslipImage/'. $paymentHistory->slip) }}" class=" img-thumbnail">
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <div class="">
                    <h6 class="m-0 font-weight-bold text-primary">Order Board</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover shadow-sm " id="productTable">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="col-2">Image</th>
                            <th>Name</th>
                            <th>Order Count</th>
                            <th>Available Stock</th>
                            <th>Product Price (each)</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($orderDetail as $item)
                            <tr>
                                <input type="hidden" class="productId" value="">
                                <input type="hidden" class="productOrderCount" value="">

                                <td>
                                    <img src="{{ asset('productImage/'. $item->product_image) }}" class=" w-50 img-thumbnail">
                                </td>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->order_count }} @if( $item->order_count > $item->product_stock )  <small class="text-danger">( Out of Stock )</small> @endif</td>
                                <td>{{ $item->product_stock }}</td>
                                <td> {{ $item->product_price }} mmk</td>
                                <td>{{ $item->product_price * $item->order_count }} mmk</td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <div class="">
                <input type="button" id="btn-order-confirm" class="btn btn-success rounded shadow-sm"
                    value="Confirm">

                <input type="button" id="btn-order-reject" class="btn btn-danger rounded shadow-sm"
                    value="Reject">
            </div>
        </div>
    </div>

</div>

@endsection