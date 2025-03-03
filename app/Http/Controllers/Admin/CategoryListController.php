<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Console\View\Components\Alert;

class CategoryListController extends Controller
{
    public function categoryList()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(5);
        return view ('admin/category/category_list', compact('categories'));
    }

    //create category
    public function categoryCreate(Request $request)
    {
        $this->validation($request);

        Category::create([
            'name' => $request->categoryName
        ]);

        // Alert::success('Success title', 'Create Category Successful!');

        return back();
 
    }

    //check validation
    public function validation($request)
    {
        $request->validate([
            'categoryName' => 'required|min:2|max:20|unique:categories,name'
        ], [
            'categoryName.required' => 'category name is required.'
        ]);

    }
}
