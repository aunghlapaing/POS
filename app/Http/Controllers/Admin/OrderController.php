<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    # order list page
    public function orderListPage()
    {
        $orderList = Order::select('orders.created_at', 'orders.order_code', 'orders.status', 'users.first_name as user_name')
                            ->leftJoin('users', 'orders.user_id', 'users.id')
                            ->groupBy('order_code')
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('admin.order.list', compact('orderList'));
    }

    # order details page
    public function orderDetailPage()
    {
        
    }
}
