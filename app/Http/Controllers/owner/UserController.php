<?php

namespace App\Http\Controllers\owner;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('owner.users', [
            "users" => $users,
        ]);
    }

    public function detail($id)
    {
        $user = User::findOrFail($id);
        return view("owner.user_detail", [
            "user" => $user,
        ]);
    }
}
