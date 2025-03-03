<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //redirect to the admin home page
    public function adminHome (){
        return view('admin/dashboard/home');
    }
}
