<?php

namespace App\Http\Controllers\owner;

use App\Models\Order;
use App\Models\BookOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class OrdersController extends Controller
{
    public function index()
    {
        $data = Order::all();

        return view("owner.orders", [
            "orders" => $data,
        ]);
    }

    public function detail($id)
    {
        $data = Order::findOrFail($id);


        return view('owner.order_detail', [
            "order" => $data,
        ]);
    }
    public function accept($id)
    {
        $data = Order::findOrFail($id);
        $data->status = "Accepted";
        $data->save();


        return back()->with('accept', "Order Accepted Successfully");
    }

    public function reject($id)
    {
        $data = Order::findOrFail($id);
        $data->status = "Rejected";
        $data->save();


        return back()->with('reject', "Order Rejected Successfully");
    }

    // orders from users

}
