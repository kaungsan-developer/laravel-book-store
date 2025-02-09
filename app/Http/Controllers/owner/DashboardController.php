<?php

namespace App\Http\Controllers\owner;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $orders = Order::where('status', 'Pending')->select('id', 'created_at', 'status', 'user_id')->get();
        return view('owner.dashboard', compact('orders'));
    }
}
