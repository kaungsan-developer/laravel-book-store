<?php

namespace App\Http\Controllers;

use App\Http\Controllers\owner\DashboardController;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware("auth");
    // }
    public function authenticated()
    {
        // split (owner/admin) and normal user home
        if (Auth::user()->position == 'owner') {
            return app(DashboardController::class)->index();
        } else {
            return app(HomeController::class)->index();
        }
    }
}
