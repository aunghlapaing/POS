<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    # redirect to the user home page
    public function userHome ()
    {
        $productData = Product::select('products.id', 'products.name', 'products.price', 'products.image', 'products.description', 'products.category_id', 'categories.name as category_name')
                                ->leftJoin('categories', 'products.category_id', 'categories.id')
                                ->when( request('categoryId'), function($query){
                                    $query->where('products.category_id', request('categoryId'));
                                })
                                ->orderBy('products.created_at', 'desc')
                                ->get();

                                # dd($productData->toArray());

        $categoryData = Category::select('id', 'name')->get();
        return view('user.dashboard.home_page', compact('productData', 'categoryData'));
    }

    public function testAuth()
    {
        return view('user.testAuth');
    }
}
