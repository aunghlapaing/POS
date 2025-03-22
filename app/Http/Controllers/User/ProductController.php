<?php

namespace App\Http\Controllers\User;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    #product detail page
    public function productDetailPage($id)
    {
        $productData = Product::select('products.id', 'products.name', 'products.price', 'products.image', 'products.stock', 'products.description', 'products.category_id', 'categories.name as category_name')
                                ->leftJoin('categories', 'products.category_id', 'categories.id')
                                ->where('products.id', $id)
                                ->first();
        
        $productList = Product::select('products.id', 'products.name', 'products.price', 'products.image', 'products.description', 'products.category_id', 'categories.name as category_name')
                                ->leftJoin('categories', 'products.category_id', 'categories.id')
                                ->get();

        return view('user.detail', compact('productData', 'productList'));
    }

    # product comment function
    public function productComment(Request $request)
    {
        # product id
        # user id
        # message

        $userId = Auth::user()->id;
        $data = $this->getData($request);
        
        Comment::create($data);

    }
    # get data function
    public function getData ($request)
    {
        return [
            'user_id' => Auth::user()->id,
            'product_id' => $request->productId,
            'message' => $request->comment
        ];
    }
}
