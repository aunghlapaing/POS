<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Rating;
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
        
        $ratingCount = number_format(Rating::where('product_id', $id)->avg('count')) ;

        $userRating = number_format(Rating::where('product_id', $id)->where('user_id', Auth::user()->id)->avg('count'));

        # $count = 0;
        # foreach($ratingCount as $item)
        # {
            # $count += $item->count;
        # }

        # $avgRating = $count/count($ratingCount);
        # dd($ratingCount);

        return view('user.detail', compact('productData', 'productList', 'commentData', 'ratingCount', 'userRating'));
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

    # rating function
    public function rating(Request $request)
    {
        # create or update query
        Rating::updateOrCreate([
            'user_id' => Auth::user()->id,
            'product_id' => $request->productId
        ],[
            'product_id' => $request->productId,
            'user_id' => Auth::user()->id,
            'count' => $request->productRating
        ]);

        # Alert::success('Successful', 'Product Rating given');

        return back();
    }

    #cart page
    public function cartPage()
    {
        $cartData = Cart::select('carts.id as cart_id', 'carts.qty', 'products.id as product_id', 'products.name', 'products.price', 'products.image')
                    ->leftJoin('products', 'carts.product_id', 'products.id')
                    ->where('carts.user_id', Auth::user()->id)
                    ->get();

        $totalPrice = 0;

        foreach($cartData as $item)
        {
            $totalPrice += $item->price * $item->qty;
        }

        # dd($cartData->toArray());
        return view('user.cart', compact('cartData', 'totalPrice'));
    }

    # add to cart function
    public function  addToCart(Request $request)
    {
        # dd($request->toArray());

        Cart::create([
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'qty' => $request->qty 
        ]);

        return back();
    }

    # cart delete function
    public function cardDelete(Request $request)
    {
        $cartId = $request['cartId'];

        Cart::where('id', $cartId)->delete();

        return response()->json([
            'status' => 'success' , 
            'message' => 'Cart delete process success!'
        ],200);
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
