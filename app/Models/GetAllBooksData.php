<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class GetAllBooksData extends Model
{
    public function getAllBooksData()
    {
        return Cache::remember(
            'getAllBooksData',
            3600,
            fn() =>
            Book::all()
        );
    }
}
