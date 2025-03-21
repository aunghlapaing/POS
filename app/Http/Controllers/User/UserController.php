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
                                ->when(request('categoryId'), function($query){
                                    $query->where('products.category_id', request('categoryId'));
                                })
                                ->when( request('searchKey'), function($query){
                                    $query->where('products.name', 'like', '%'. request('searchKey') .'%');
                                })
                                # min -> true && max -> true
                                ->when(request('minPrice') != null && request('maxPrice') != null, function($query){
                                    $query->whereBetweenBetween('products.price', [request('minPrice'), request('maxPrice')]);
                                })
                                # min -> true && max -> false
                                ->when(request('minPrice') != null && request('maxPrice') == null, function($query){
                                    $query->where('products.price','>=', request('minPrice'));
                                })
                                # min -> false && max -> true
                                ->when(request('minPrice') == null && request('maxPrice') != null, function($query){
                                    $query->where('products.price','<=', request('maxPrice'));
                                })
                                ->when(request('sortingType'), function($query){
                                    $sortingRules = explode(',', request('sortingType'));
                                    $query->orderBy('products.' .$sortingRules[0], $sortingRules[1]);
                                })
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
