<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'discount_amount',
        'discount_type',
        'start_date',
        'end_date',
        'status',
        'limit_use'
    ];
}
