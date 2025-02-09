<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'books' => Book::whereNull('discounted_price')->orderBy('id')->take(4)->get(),
            'newArrivals' => Book::whereNull('discounted_price')->orderBy('id', 'desc')->take(4)->get(),
            'specialOffers' => Book::whereNotNull('discounted_price')->take(4)->get(),
            'categories' => Category::take(4)->get(),

        ];
        // $data = Cache::remember('home_books_data', 3600, fn() => [
        //     'books' => Book::orderBy('id')->take(4)->get(),
        //     'newArrivals' => Book::orderBy('id', 'desc')->take(4)->get(),
        //     // 'specialOffers' => Book::whereNotNull('discount')->take(4)->get(),
        //     'specialOffers' => null,
        // ]);
        return view('user.home', $data);
    }
}
