<?php

namespace App\Http\Controllers\owner;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;
use RealRashid\SweetAlert\Facades\Alert;

class NewBookController extends Controller
{
    public function index()
    {
        $categories = Category::select('id', 'name')->get();
        return view("owner.new_book", [
            "categories" => $categories,
        ]);
    }

    public function add()
    {


        $validate = validator(request()->validate([
            "book_image" => "required|mimes:jpg,png,jpeg,gif,svg",
            "book_name" => "required",
            "aurthor" => "required",
            "category_id" => "required",
            "price" => "required|numeric",
            "count" => "required|numeric",
            "description" => "max:500",
        ], [
            "book_image.required" => "Must Be Upload Image",
            "book_name.required" => "Must Be Fill Name",
            "aurthor.required" => "Must Be Fill Author Name",
            "category_id.required" => "Must Be Fill Category",
            "price.required" => "Must Be Fill Price",
            "count.required" => "Must Be Fill Quantity",
            'price.numeric' => 'Must Be Number',
            'count.numeric' => 'Must Be Number',
            "description.max" => "Must Be Less Than 500 Characters",
        ]));
        if ($validate->fails()) {

            return back()->withErrors($validate);
        }
        $img_name = uniqid() . request()->file('book_image')->getClientOriginalName();
        request()->file('book_image')->move(public_path() . '/books_img_folder/', $img_name);

        $data = new Book;
        $data->image = $img_name;
        $data->name = request()->book_name;
        $data->aurthor = request()->aurthor;
        $data->category_id = request()->category_id;
        $data->price = request()->price;
        $data->count = request()->count;
        // $data->description = request()->description;

        $data->save();
        Cache::forget('home_books_data');
        Cache::forget('GetAllBooksData');
        // Alert::success('Success', "A new book added successfully");

        return back()->with('success', "A new book added successfully");
    }
}
