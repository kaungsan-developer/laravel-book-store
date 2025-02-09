<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GetAllBooksData;

class GetAllBooksDataController extends Controller
{
    protected $getAllBooksData;
    public function __construct(GetAllBooksData $getAllBooksData)
    {
        $this->getAllBooksData = $getAllBooksData;
    }

    public function ownerSideAllBooksData()
    {
        $books =  $this->getAllBooksData->getAllBooksData();
        return view('owner.all_books', [
            'books' => $books,
        ]);
    }
    public function userSideAllBooksData()
    {
        $books = $this->getAllBooksData->getAllBooksData();
        return view('user.all_books', [
            'books' => $books,
        ]);
    }
}
