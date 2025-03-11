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
    #chanag Password page 
    public function changePasswordPage()
    {
        return view('admin/profile/change_password');
    }

    #change new password
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
            #dd($request->toArray());

            $data = $this->getData($request);
            User::where('id', Auth::user()->id)->update($data);
        }
        else 
        {
            $this->checkValidation($request);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('login');
    }

    #get data method
    public function getData ($request)
    {
        return [
            'password' => Hash::make($request->confirmPassword)
        ];
    }

    #check validation
    public function checkValidation($request)
    {
        $rules = [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6|max:12',
            'confirmPassword' => 'required|min:6|max:12|same:newPassword',
        ];
        $message = [];

        $request->validate($rules, $message);
    }

    #profile edit page
    public function editProfilePage()
    {
        $userData = User::where('id', Auth::user()->id)->first();
        return view('/admin/profile/edit_profile', compact('userData'));
    }

    #edit profile function
    public function editProfile($id, Request $request)
    {
        #dd($request->toArray());
        $this->checkValidationProfile($request);
        $data = $this->getUserData($request);
        #dd($data);

        if($request->hasFile('image'))
        {
            if(Auth::user()->profile != "")
            {
                $oldProfile = $request->oldProfile;
                if(file_exists(public_path('admin/profile/' . $oldProfile)))
                {
                    unlink(public_path('admin/profile/' . $oldProfile));
                }
            }

            $newProfile = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path() . "/admin/profile/" , $newProfile);
            $data['profile'] = $newProfile;
        }

        User::where('id', $id)->update($data);
        return to_route('adminHome');

    }

    #get data
    public function getUserData($request)
    {
        return [

            'first_name' => $request->first_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ];
    }

    #check validation for the profile update
    public function checkValidationProfile($request)
    {
        $request->validate([
            'first_name' => 'required|min:3|max:100',
            'email' => 'required|unique:users,email,' . Auth::user()->id,
            'phone' => 'required',
            'address' => 'max:100',
            'image' => 'file|mimes:jpg,png,webp,gift,svg,jpeg'
        ], []);
    }
}
