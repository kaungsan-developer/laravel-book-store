<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment()
    {
        $payment_image_name = uniqid() . request()->file('payment_image')->getClientOriginalName();
        request()->file('payment_image')->move(public_path() . '/payment_imgs/', $payment_image_name);
        $data = new Payment;
        $data->order_id = request()->order_id;
        $data->image = $payment_image_name;
        $data->invoice = request()->invoice;

        $data->save();
        return back();
    }
}
