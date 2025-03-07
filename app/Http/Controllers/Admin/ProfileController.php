<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Console\View\Components\Alert;

class ProfileController extends Controller
{
    //chanag Password page 
    public function changePasswordPage()
    {
        return view('admin/profile/change_password');
    }

    //change new password
    public function changePassword (Request $request)
    {

        //user registered password and oldPassword should be same
        //all required
        //min and max
        //newPassword and oldPassword shoule be same

        $oldPassword = $request->oldPassword;
        $userRegisteredPassword = Auth::user()->password;

       if( Hash::check($oldPassword, $userRegisteredPassword))
        {
            $this->checkValidation($request, 'changePassword');
            // dd($request->toArray());

            $data = $this->getData($request);
            User::where('id', Auth::user()->id)->update($data);
        }
        else 
        {
            $this->checkValidation($request, 'changePassword');
        } 
        return back();
    }

    //get data method
    public function getData ($request)
    {
        return [
            'password' => Hash::make($request->confirmPassword)
        ];
    }

    //check validation
    private function checkValidation($request, $action)
    {
        $rules = [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6|max:12',
            'confirmPassword' => 'required|min:6|max:12|same:newPassword'
        ];
        $message = [];

        $request->validate($rules, $message);
    }
}
