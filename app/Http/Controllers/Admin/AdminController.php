<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    # redirect to the admin home page
    public function adminHome (){
        return view('admin/dashboard/home');
    }
    
    # create new admin account page by super admin
    public function createNewAdminPage()
    {
        return view('/admin/profile/create_new_admin');
    }

    # create new admin account
    public function createNewAdmin(Request $request)
    {
        $this->checkValidation($request);
        $data = $this->getData ($request);

        User::create($data);
        return back();
    }

    # get data for create new admin account
    public function getData($request)
    {
        return [
            'first_name' => $request->first_name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'admin'
        ];
    }

    # check validation for create new admin
    public function checkValidation($request)
    {
        $request->validate([
            'first_name' => 'required|min:3|max:100',
            'email' => 'required',
            'password'=> 'required|min:6|max:12',
            'confirmPassword' => 'required|min:6|max:12|same:password'
        ],[]);
    }

    # admin list page
    public function adminListPage($action = 'default')
    {
        $userData = User::select(
                                'id',
                                'first_name',
                                'email',
                                'phone',
                                'address',
                                'role',
                                'created_at',
                                'provider'
                            )
                        ->when($action == 'superAdmin', function($query){
                            $query->where('role', '=' , 'superadmin');
                        })
                        ->when($action == 'admin', function($query){
                            $query->where('role', '=' , 'admin');
                        })
                        ->when($action == 'user', function($query){
                            $query->where('role', '=', 'user');
                        })
                        ->when(request('searchKey'), function($query){
                            $query->whereAny(['first_name', 'address', 'provider'], 'like', '%' .request('searchKey'). '%');
                        })
                        ->paginate(4);
        return view('admin/profile/admin_list', compact('userData'));
    }
    
}
