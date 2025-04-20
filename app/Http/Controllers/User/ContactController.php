<?php

namespace App\Http\Controllers\User;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    # contact page
    public function contactPage()
    {
        return view('user.contact');
    }

    #contact function
    public function contact(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'title'=>'required',
            'message'=>'required'
        ]);

        $data = [
            'user_id' => $request->user_id,
            'title' => $request->title,
            'message' => $request->message
        ];

        Contact::create($data);

        return back();
    }
}
