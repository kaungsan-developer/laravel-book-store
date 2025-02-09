<?php

namespace App\Http\Controllers\user;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function add()
    {
        $validate = validator(request()->validate([
            'book_id' => 'required',
            'rating' => 'required',
        ], [
            'rating' => 'Star Rating is required',
        ]));
        if ($validate->fails()) {
            return back()->withErrors($validate);
        }
        Review::updateOrCreate([
            'user_id' => Auth::user()->id,
            'book_id' => request()->book_id,
        ], [
            'review' => request()->review,
            'rating' => request()->rating,
        ]);

        return back();
    }

    public function delete($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return back();
    }
}
