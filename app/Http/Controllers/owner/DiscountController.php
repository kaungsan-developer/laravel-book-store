<?php

namespace App\Http\Controllers\owner;

use App\Models\Book;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiscountController extends Controller
{


    public function index()
    {

        $book =  Book::select('id', 'name', 'aurthor', 'price')->whereNull('discounted_price')->get();
        $discounted_book = Book::select('id', 'name', 'aurthor', 'price', 'discounted_price', 'discount_start', 'discount_end')->whereNotNull('discounted_price')->get();
        return view('owner.discount', [
            'books' => $book,
            'discounted_books' => $discounted_book,

        ]);
    }



    public function addDiscount(Request $request)
    {
        // $this->authorize('create');
        $this->addDiscountValidation($request);

        $discount_amount = $this->calculate_percent_or_mmk($request);
        if ($discount_amount == null) {
            return back()->with('error', 'Discount Percent must be less than 100%');
        }

        $book_ids = $request->book_id;

        foreach ($book_ids as  $id) {
            $book = Book::findOrFail($id);

            if ($discount_amount < 1) {
                // do this when discount type is %
                $book->discounted_price = $book->price * $discount_amount;
            } else {
                // do this when discount type is MMK
                $discounted_price = $book->price - $discount_amount;
                if ($discounted_price > 0) {
                    $book->discounted_price = $discounted_price;
                } else {
                    return back()->with('error', 'Discount Amount is greater than original price');
                }
            }
            $book->discount_start = $request->start_date;
            $book->discount_end = $request->end_date;
            $book->save();
        }
        return back()->with('success', "Discount Added Successfully");
    }

    public function calculate_percent_or_mmk(Request $request)
    {
        // $this->authorize('create');
        $discount_amount = null;
        if ($request->discount_type == '%') {
            if ($request->discount_amount > 100) {
                return $discount_amount;
            }
            $discount_amount = (100 - $request->discount_amount) / 100;
            return $discount_amount;
        } else {
            $discount_amount = $request->discount_amount;
            return $discount_amount;
        }
    }

    public function removeDiscount(Request $request)
    {
        $this->removeDiscountValidation($request);

        $book_ids = $request->discounted_book_ids;
        foreach ($book_ids as $book_id) {
            $book = Book::where('id', $book_id)->update([
                'discounted_price' => null,
                'discount_start' => null,
                'discount_end' => null,
            ]);
        }
        return back()->with('success', 'Discount Removed Successfully');
    }



    // validation methods
    // validation methods


    public function addDiscountValidation(Request $request)
    {
        $validate = validator($request->validate([
            'book_id' => 'required',
            'discount_amount' => 'required',
            'discount_type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ], [
            'book_id.required' => 'You must select at least one book',
            'discount_amount.required' => 'Discount Amount is required',
            'discount_type.required' => 'Discount Type is required',
            'start_date.required' => 'Start Date is required',
            'end_date.required' => 'End Date is required',
        ]));
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }
    }

    public function removeDiscountValidation(Request $request)
    {
        $validate = validator($request->validate([
            'discounted_book_ids' => 'required',
        ], [
            'discounted_book_ids.required' => 'You must select at least one book to remove discount.',
        ]));
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }
    }
}
