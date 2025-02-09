<?php

namespace App\Http\Controllers\user;

use App\Models\Book;
use App\Models\Order;
use App\Models\UserBook;
use App\Models\BookOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
    public function add(Request $request)
    {
        // Create the order
        $validate = validator(request()->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]));
        if ($validate->fails()) {
            return back()->withErrors($validate);
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'note' => $request->note,
            'total_price' => $request->total_price,
            'status' => 'Pending'
        ]);


        // data insert to pivot table
        // Many books order from cart
        if (is_array($request->book_id)) {
            $book_ids = $request->book_id;
            $qty = $request->quantity;
            $cartBookIds = $request->cartBookIds;

            foreach ($book_ids as $index => $id) {

                BookOrder::create([
                    'order_id' => $order->id,
                    'book_id' => $id,
                    'qty' => $qty[$index],
                ]);
                $stock = Book::findOrFail($id);
                $stock->decrement('count', $qty[$index]);
                $deleteCart = UserBook::findOrFail($cartBookIds[$index]);
                $deleteCart->delete();
            }
        } else {
            // single book order
            BookOrder::create(attributes: [
                'book_id' => $request->book_id,
                'order_id' => $order->id,
                'qty' => $request->quantity
            ]);
            $stock = Book::findOrFail($request->book_id);

            $stock->decrement('count', $request->quantity);
        }


        return to_route('home')->with('success', 'Order Added Successfully');
    }
}
