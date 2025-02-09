<?php

namespace App\Http\Controllers\user;

use App\Models\Cart;
use App\Models\User;
use App\Models\UserBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CartController extends Controller
{


    public function show($id)
    {

        $cart = User::findOrFail($id);
        if (Gate::denies('user-cart', $cart)) {
            abort(401);
        }
        return view('user.cart', [
            'user' => $cart,
        ]);
    }

    public function add()
    {
        UserBook::create([
            'book_id' => request()->book_id,
            'user_id' => Auth::id(),
            'cart' => 1,
        ]);

        return back();
    }

    public function delete($id)
    {
        $data = UserBook::findOrFail($id);
        $data->delete();
        return back();
    }
}
