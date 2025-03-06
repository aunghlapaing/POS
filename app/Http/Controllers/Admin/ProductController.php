<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Console\View\Components\Alert;

class ProductController extends Controller
{
    //product create route
    public function productCreatePage()
    {
        //fetch data from category
        $category = Category::select('id', 'name')->get();
        
        return view ('admin/product/product_create', compact('category'));
    }

    //product create function
    public function productCreate(Request $request)
    {
        $this->checkValidation($request, "create");
        // dd($request->toArray());
        $data = $this->getData($request);

        if($request->hasFile("image"))
        {
            $fileName = uniqid() . $request->file("image")->getClientOriginalName();
            $request->file("image")->move(public_path() . "/productImage/" , $fileName );
            $data["image"] = $fileName;
        }

        Product::create($data);

        // //sweet alert message
        // Alert::success('Success','Prodct create Successful');

        return to_route('productCreatePage');
    }

    //get method form data
    public function getData($request)
    {
        return [
            'name' => $request->name,
            'price' => $request->price,
            'category_id' =>$request->categoryId,
            'stock' => $request->stock,
            'description' => $request->description
        ];
    }

    //product list page
    public function productList($action = 'default')
    {
        // dd($action);
        $products = Product::select('products.id','products.name','products.image','products.price','products.stock','products.category_id', 'categories.name as category_name' )
                                ->leftJoin('categories', 'products.category_id', 'categories.id')
                                ->when($action == 'lowAmt', function($query){
                                    $query->where('products.stock' , '<=', 3);
                                })
                                ->orderBy('products.created_at', 'desc')
                                ->get();

        return view('admin/product/product_list', compact('products'));
    }

    //check validation
    public function checkValidation($request)
    {
        $rules = [
            'image'=> 'required|file',
            'name'=> 'required|unique:products,name|min:3|max:50',
            'categoryId'=> 'required',
            'price'=> 'required|numeric|min:2',
            'stock'=> 'required|numeric|max:3',
            'description'=> 'required|min:5|max:1000'
        ];

        $message = [
            'image.required' =>'Image file is required',
            'name.required' =>'Product name is required',
            'categoryId.required' =>'Category name is required',
            'price.required' =>'Price is required',
            'stock.required' =>'Stock quantity is required',
            'description.required' =>'Description is required'
        ];

        $request->validate($rules, $message);

    }
}
