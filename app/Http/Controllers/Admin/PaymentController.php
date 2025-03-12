<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    # Payment create Page
    public function paymentPage()
    {
        $paymentData = Payment::get();
        return view('admin/payment/payment_create', compact('paymentData'));
    }

    # Payment create function
    public function paymentCreate(Request $request)
    {
        $this->checkValidation($request, 'create');
        $data = $this->getPaymentData($request);

        Payment::create($data);

        # alert message
        Alert::success('Successful!', 'Payment Created!');

        return to_route('paymentPage');
    }

    # payment edit 
    public function paymentEditPage($id)
    {
        # dd($id);
        $paymentData = Payment::where('id', $id)->first();
        return view('admin/payment/payment_edit', compact('paymentData'));
    }

    # payment update function
    public function paymentUpdate($id, Request $request)
    {
        $this->checkValidation($request, 'update');
        $data = $this->getPaymentData($request);
        # dd($data);
        Payment::where('id', $id)->update($data);

        # alert message
        Alert::success('Successful!', 'Payment Updated');

        return to_route('paymentPage');
    }

    # payment delete
    public function paymentDelete($id)
    {
        Payment::where('id', $id)->delete();
        return back();
    }

    # get data method for payment create
    public function getPaymentData ($request)
    {
        return [
            'account_number' => $request->account_number,
            'account_name' => $request->account_name,
            'type' => $request->type
        ];
    }

    # checkValidation 
    public function checkValidation($request, $action)
    {
        $rules = ([
            'account_number' => 'required',
            'account_name' => 'required',
            'type' => 'required'
        ]);
        
        $message = ([

        ]);

        $request->validate($rules, $message);
        
    }
}
