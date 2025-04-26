<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'aurthor',
        'image',
        'category_id',
        'price',
        'count',
        'discounted_price',
        'discount_start',
        'discount_end',
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'book_orders');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class)->orderBy('created_at', 'desc');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
