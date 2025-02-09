<?php

namespace App\Http\Controllers\user;

use App\Models\Book;
use App\Models\Order;
use App\Models\Review;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function all_books()
    {
        $books = Book::latest()->paginate(18);
        return view('user.all_books', [
            'books' => $books,
        ]);
    }
    public function book_detail_page($id)
    {

        $rating = Review::select('rating')->where('book_id', $id)->where('user_id', Auth::user()->id)->first();
        $avg_rating = Review::where('book_id', $id)->avg('rating');
        $book = Book::findOrFail($id);
        return view('user.book_detail', [
            "book" => $book,
            "rating" => $rating,
            'avg_rating' => $avg_rating,

        ]);
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|numeric|min:1',
            'total_price' => 'required|numeric'
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'note' => $request->note,
            'total_price' => $request->total_price,
            'status' => 'Pending'
        ]);

        $order->books()->attach($request->book_id);

        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }

    public function bookSearchByCategory($id)
    {
        $books = Book::where('category_id', $id)->get();
        return view('user.all_books', [
            'books' => $books,
        ]);
    }

    public function bookSearchBySearchBar(Request $request)
    {
        // dd(request()->all());
        $books = Book::whereAny(['name', 'aurthor'], 'like', '%' . request('searchKey') . '%')->get();

        // dd($books);
        return view('user.all_books', [
            'books' => $books,
        ]);
    }
}
