<?php

namespace App\Http\Controllers\user;

use App\Models\User;
use App\Models\UserBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{


    public function index($id)
    {

        $user_profile = User::findOrFail($id);
        if (Gate::denies('profile', $user_profile)) {
            abort(401);
        }
        return view('user.profile', [
            'user' => $user_profile,
        ]);
    }
}
