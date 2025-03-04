<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryEditController extends Controller
{
    public function categoryEdit($id)
    {
        $category = Category::where('id', $id)->first();
        return view ('admin/category/category_edit', compact('category'));
    }
}
