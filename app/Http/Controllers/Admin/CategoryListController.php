<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $data = $this->getData($request);

        Category::create($data);

        // Alert::success('Success title', 'Create Category Successful!');

        return back();
 
    }

    //get method form data
    public function getData($data)
    {
        return [
            'name' => $data->categoryName
        ];
    }

    //delete category
    public function categoryDelete($id){
        Category::where('id',$id)->delete();
        return back();
    }

    //edit category
    public function categoryEdit($id)
    {
        $category = Category::where('id', $id)->first();
        return view ('admin/category/category_edit', compact('category'));
    }

    //update category
    public function categoryUpdate($id, Request $request)
    {
        $request['id'] = $id;
        $this->validation($request);

        Category::where('id', $id)->update([
            'name' => $request->categoryName
        ]);

        return to_route('categoryList');

    }

    //check validation
    public function validation($request)
    {
        $request->validate([
            'categoryName' => 'required|min:2|max:20|unique:categories,name,' .$request->id
        ], [
            'categoryName.required' => 'category name is required.',
            'categoryName.unique' => 'category name is already taken.'
        ]);

    }
}
