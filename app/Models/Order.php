<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use Hasfactory;
    protected $fillable = [
        'user_id',
        'name',
        'qty',
        'total_price',
        'phone',
        'address',
        'note',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function books()
    {
        return $this->belongsToMany('App\Models\Book', 'book_orders');
    }
    public function payments()
    {
        return $this->hasMany('App\Models\Payemnt');
    }
}
