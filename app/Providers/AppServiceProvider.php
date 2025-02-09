<?php

namespace App\Providers;

use App\Models\Book;
use App\Policies\BookPolicy;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Book::class, BookPolicy::class);
        Gate::define('profile', function ($user, $user_profile) {
            return $user->id === $user_profile->id;
        });

        Gate::define('user-cart', function ($user, $cart) {
            return $user->id === $cart->id;
        });
        Paginator::useBootstrap();
    }
}
