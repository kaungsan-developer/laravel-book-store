<?php

namespace App\Http\Controllers\owner;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class AllBooksController extends Controller
{
    public function index()
    {
        $data = Book::orderBy('updated_at', 'desc')->get();
        return view('owner.all_books', [
            "books" => $data,
        ]);
    }

    public function detail($id)
    {
        $categories = Category::select('id', 'name')->get();
        $data = Book::findOrFail($id);
        return view("owner.detail_book", [
            "book" => $data,
            "categories" => $categories,
        ]);
    }

    public function update($id)
    {
        // dd(request()->all());
        $validate = validator(request()->validate([
            "book_name" => "required",
            "aurthor" => "required",
            "price" => "required",
            "count" => "required",
            "category_id" => "required",
            "book_image" => "mimes:jpg,png,jpeg,gif,svg",
            "description" => "max:500",
        ]));
        if ($validate->fails()) {
            return back()->withErrors($validate);
        }

        $data = Book::findOrFail($id);
        // save new image and delete old image if exist
        if (request()->file('book_image')) {
            $book_image_name = uniqid() . request()->file('book_image')->getClientOriginalName();
            request()->file('book_image')->move(public_path() . '/books_img_folder/', $book_image_name);
            $old_image = $data->image;
            if ($old_image && file_exists(public_path('/books_img_folder/' . $old_image))) {
                unlink(public_path('/books_img_folder/' . $old_image));
            }
        } else {
            // save old image when not upload new image
            $book_image_name = $data->image;
        }

        // save data
        $data->image = $book_image_name;
        $data->name = request()->book_name;
        $data->aurthor = request()->aurthor;
        $data->price = request()->price;
        $data->count = request()->count;
        $data->category_id = request()->category_id;
        // $data->description = request()->description;
        $data->updated_at = Carbon::now();

        $data->save();

        return to_route('owner.all.books')->with('success', "Updated Successfully");
    }

    public function delete($id)
    {
        $data = Book::findOrFail($id);
        $data->delete();

        return to_route('owner.all.books')->with('info', "Deleted Successfully");
    }
}
