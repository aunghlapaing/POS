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
        $products = Product::select(
                                    'products.id',
                                    'products.name',
                                    'products.image',
                                    'products.price',
                                    'products.stock',
                                    'products.category_id', 
                                    'categories.name as category_name' )
                                ->leftJoin('categories', 'products.category_id', 'categories.id')
                                ->when($action == 'lowAmt', function($query){
                                    $query->where('products.stock' , '<=', 3);
                                })
                                ->when(request('searchKey'), function ($query){
                                    $query->whereAny(['products.name','categories.name' ], 'like', '%'. request('searchKey') .'%');
                                })
                                ->orderBy('products.created_at', 'desc')
                                ->paginate(5);

        return view('admin/product/product_list', compact('products'));
    }

    //product delete
    public function productDelete ($id)
    {
        // dd ($id);
        Product::where('id', $id)->delete();
        return back();
    }

    //product edit page 
    public function productEditPage($id)
    {
        $category = Category::get();
        $product = Product::where('id', $id)->first();

        return view('admin/product/product_edit',compact('category', 'product'));
    }

    //update product
    public function productUpdate($id, Request $request)
    {

        $this->checkValidation ($request, 'update');
        $data = $this->getData($request);

        if($request->hasFile('image'))
        {
            $oldImage = $request->oldImage;
            if(file_exists(public_path('productImage/' . $oldImage)))
            {
                unlink(public_path('productImage/' . $oldImage));
            }

            $newFile = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path(). "/productImage/", $newFile);
            $data['image'] = $newFile;
        }
        Product::where("id", $id)->update($data);
        return to_route('productList');

        // return back();
    }

    //check validation
    public function checkValidation($request, $action)
    {
        $rules = [
            'name'=> 'required|min:3|max:50|unique:products,name,' .$request->id ,
            'categoryId'=> 'required',
            'price'=> 'required|numeric|min:2',
            'stock'=> 'required|numeric|max:999',
            'description'=> 'required|min:5|max:1000'
        ];

        $rules['image'] = $action == 'create' ? 'required|file|mimes:png,jpg,jpeg,webp,svg,gif' : 'file|mimes:png,jpg,jpeg,webp,svg,gif';

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
