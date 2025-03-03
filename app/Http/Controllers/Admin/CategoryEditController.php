<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryEditController extends Controller
{
    public function categoryEdit()
    {
        return view ('admin/category/category_edit');
    }
}
