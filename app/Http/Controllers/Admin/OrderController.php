<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PaymentHistories;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    # order list page
    public function orderListPage()
    {
        $orderList = Order::select(
                            'orders.created_at', 
                            'orders.order_code', 
                            'orders.status', 
                            'orders.count',
                            'products.stock',
                            'users.first_name as user_name'
                            )
                            ->leftJoin('users', 'orders.user_id', 'users.id')
                            ->leftJoin('products' , 'orders.product_id', 'products.id')
                            ->groupBy('order_code')
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('admin.order.list', compact('orderList'));
    }

    # order details page
    public function orderDetailPage($orderCode)
    {
        $orderDetail = Order::select(
                            'orders.id as order_id',
                            'orders.user_id as user_id',
                            'orders.count as order_count',
                            'orders.order_code as order_code', 
                            'orders.created_at as order_date',
                            'orders.total_price as order_total_price',
                            'products.id as product_id',
                            'products.image as product_image',
                            'products.name as product_name',
                            'products.stock as product_stock',
                            'products.price as product_price',
                            'users.first_name as user_name',
                            'users.phone as user_phone',
                            'users.address as user_address'
                            )
                            ->leftJoin('products', 'orders.product_id', 'products.id')
                            ->leftJoin('users','orders.user_id', 'users.id')
                            ->where('orders.order_code', $orderCode)
                            ->get();

        $paymentHistory = PaymentHistories::select(
                                            'payment_histories.phone', 
                                            'payment_histories.address', 
                                            'payments.type as payment_method', 
                                            'payment_histories.total_amt',
                                            'payment_histories.created_at as payment_date',
                                            'payment_histories.payslip_image as slip'
                                            )
                                            ->leftJoin('payments', 'payment_histories.payment_method' ,'payments.id')
                                            ->where('order_code', $orderCode)
                                            ->first();

        $status = true;

        foreach($orderDetail as $item)
        {
            if($item->order_count <= $item->product_stock)
            {
                $status = true;
            }
            else
            {
                $status = false;
                break;
            }
        }


        return view('admin.order.detail', compact('orderDetail', 'paymentHistory', 'status'));
    }

    # order reject function
    public function orderReject(Request $request)
    {
        logger($request);
        Order::where('order_code', $request->orderCode)
            ->update([
                'status' => 2 
            ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Order rejected successful!'
        ]);
        
    }

    # order confirm function
    public function orderConfirm(Request $request)
    {
        logger($request->all());

        Order::where('order_code', $request[0]['order_code'])
            ->update([
                'status' => 1
            ]);
        
        foreach($request->all() as $item)
        {
            Product::where('id',$item['product_id'])->decrement('stock',$item['order_count']);
        }

        return response()->json([
            'status' => 'success' ,
            'message' => 'Order confirmed successful!'
        ],200);
    }

    # order status change
    public function statusChange(Request $request)
    {
        logger($request->toArray());
        Order::where('order_code', $request->order_code)
            ->update([
                'status' => $request->status
            ]);

        return response()->json([
            'status' => 'success' ,
            'message' => 'Order status update successful!'
        ], 200);
    }
}
