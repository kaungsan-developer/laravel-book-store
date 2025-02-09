<?php

namespace App\Http\Controllers\owner;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('owner.categories', [
            "categories" => $categories
        ]);
    }

    public function add(Request $request)
    {

        $validated = validator($request->all(), [
            'name' => 'required|string|max:255',
        ]);
        if ($validated->fails()) {
            return back()->withErrors($validated)->withInput();
        }
        Category::create([
            'name' => $request->name,
        ]);
        return back()->with('success', 'Category created successfully');
    }

    public function delete($id)
    {
        Category::find($id)->delete();
        Book::where('category_id', $id)->update(['category_id' => null]);
        return back()->with('success', 'Category deleted successfully');
    }
}
