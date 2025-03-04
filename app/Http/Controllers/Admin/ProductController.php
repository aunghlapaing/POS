<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    //create product
    public function productCreate()
    {
        $category = Category::select('id', 'name')->get( );
        
        return view ('admin/product/product_create', compact('category'));
    }
}
