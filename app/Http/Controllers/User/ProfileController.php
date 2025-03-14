<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    # edit profile page
    public function editPage($id)
    {
        $userData = User::where('id', $id)->first();
        # dd($userData->toArray());
        return view('user/profile/edit_profile', compact('userData'));
    }

    # update profile function
    public function updateProfile($id, Request $request)
    {
        $this->checkProfileValidation($request);
        $data = $this->getProfileData($request);
        # dd($data);
        if($request->hasFile('profile'))
        {
            if(file_exists(public_path('user/profile' . $request->profile)))
            {
                unlink(public_path('user/profile' . $request->profile));
            }

            $newProfile = uniqid() . $request->file("profile")->getClientOriginalName();
            $request->file("profile")->move(public_path() . "/user/profile/" , $newProfile);
            $data['profile'] = $newProfile;
        }

        User::where('id', $id)->update($data);
        
        #sweet alert
        Alert::success('Successful!', 'Profile updated');
        return to_route('userHome');

    }

    #get profile data
    public function getProfileData($request)
    {
        return [
            'first_name' => $request->first_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'profile' => $request->profile
        ];
    }


    # check profile validation
    public function checkProfileValidation($request)
    {
        $rules = [
            'first_name' => 'required',
            'email' => 'required|unique:users,email,' . Auth::user()->id,
            'phone' => 'required',
            'address' => 'required'
        ];

        $message = [
            
        ];

        $request -> validate($rules, $message);
    }
}
