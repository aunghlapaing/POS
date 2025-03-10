<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //redirect to the admin home page
    public function adminHome (){
        return view('admin/dashboard/home');
    }
    
    //create new admin account page by super admin
    public function createNewAdminAccountPage()
    {
        return view('/admin/profile/create_new_admin');
        // dd ("this is cfreate new admin account page");
    }

    //create new admin account function
    public function createNewAdminAccount(Request $request)
    {
        $this->checkValidation($request);
        // dd ($request->toArray());

        $data = $this->getData($request);
        if($request->hasFile("image"))
            {
                $fileName = uniqid() . $request->file("image")->getClientOriginalName();
                $request->file("image")->move(public_path() . "/admin/profile/" , $fileName );
                $data['profile'] = $fileName;
            }
        User::create($data);
        return back();
    }

    //get data method
    public function getData ($request)
    {
        return [
            'first_name' => $request->first_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => 'admin123',
            'role' => 'admin'

        ];
    }

    //check validation
    public function checkValidation($request)
    {
        $request->validate([
            'first_name' => 'required|min:3|max:10',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'image' => 'required'
        ], []);
    }
}
