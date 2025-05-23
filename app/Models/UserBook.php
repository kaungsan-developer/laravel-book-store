<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// this model is for cart
class UserBook extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'book_id',
        'cart',
    ];
}
