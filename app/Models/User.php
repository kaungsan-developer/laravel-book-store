<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'profile',
        'address',
        'phone',
        'password',
        'position',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order')->orderByDesc('created_at');
    }

    public function cartBooks()
    {
        return $this->belongsToMany('App\Models\Book', 'user_books')
            ->where('cart', "=", 1)
            ->orderByPivot('created_at', 'desc')
            ->withPivot('id');
    }

    // public function wishLists()
    // {
    //     return $this->belongsToMany(Book::class, 'user_books')
    //         ->where('cart', '=', null)
    //         ->withPivot('id'); // Added 'cart' to the pivot attributes
    // }
}
