<?php

namespace App\Http\Controllers\User;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

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

        $commentData = Comment::select('comments.id as comment_id', 'users.id as user_id', 'users.profile as user_profile', 'users.first_name as user_name', 'comments.message', 'comments.created_at')
                                ->where('comments.product_id', $id)
                                ->leftJoin('users', 'users.id', 'comments.user_id')
                                ->orderBy('comments.created_at', 'desc')
                                ->get();

        return view('user.detail', compact('productData', 'productList', 'commentData'));
    }

    # product comment function
    public function productComment(Request $request)
    {
        # product id
        # user id
        # message

        $this->checkValidation($request);
        $data = $this->getData($request);
        
        Comment::create($data);

        # sweet-alert is not working within this template
        # Alert::success('Successful!', 'Comment post successful.');

        return back();

    }

    # comment delete function
    public function commentDelete($id)
    {
        Comment::where('id',$id)->delete();
        return back();
    }

    # get data function
    public function getData ($request)
    {
        return [
            'user_id' => Auth::user()->id,
            'product_id' => $request->productId,
            'message' => $request->comment,
            'created_at' => Carbon::now()
        ];
    }

    # check validation
    public function checkValidation ($request)
    {
        $request->validate([
            'comment' => 'required|min:3|max:200'
        ],[]);
    }
}
