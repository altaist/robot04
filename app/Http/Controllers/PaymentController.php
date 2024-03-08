<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends BaseController
{
    public function store(Request $request)
    {
        $rules = [
            'user_id' => 'required|exists:users',
            'payer_id' => 'exists:users|nullable',
            'operator_id' => 'exists:users|nullable',
            'amount' => 'required|numeric',
            'comments' => 'string|nullable'
        ];


        $payment = new Payment();
        $payment->user_id = $request->get('user_id');
        $payment->payer_id = $request->get('payer_id');
        $payment->amount = $request->get('amount');
        $payment->comments = $request->get('comments');
        $payment->save();
        //dd($payment);
        return response($payment);
    }
}
