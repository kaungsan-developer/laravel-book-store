<?php

use App\Models\GetAllBooksData;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\owner\CategoryController;
use App\Http\Controllers\user\BookController;
use App\Http\Controllers\user\CartController;
use App\Http\Controllers\owner\UserController;
use App\Http\Controllers\user\ReviewController;

use App\Http\Controllers\owner\AdminsController;
use App\Http\Controllers\owner\OrdersController;
use App\Http\Controllers\user\PaymentController;
use App\Http\Controllers\user\ProfileController;
use App\Http\Controllers\AuthenticatedController;
use App\Http\Controllers\owner\NewBookController;
use App\Http\Controllers\owner\AllBooksController;
use App\Http\Controllers\owner\DiscountController;
use App\Http\Controllers\user\UserOrderController;
use App\Http\Controllers\GetAllBooksDataController;
use App\Http\Controllers\owner\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// split user and owner after login in
Route::get('/authenticated/home', [AuthenticatedController::class, "authenticated"])->middleware('auth');

// owner's routes
Route::group(['prefix' => '/owner', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('owner.dashboard');
    Route::get('/categories', [CategoryController::class, 'index'])->name('owner.categories');
    Route::post('/categories', [CategoryController::class, 'add'])->name('owner.add.category');
    Route::get('/categories/delete/{id}', [CategoryController::class, 'delete'])->name('owner.delete.category');
    Route::get('/coupon_and_discount', [DiscountController::class, 'index'])->name('owner.discount');
    Route::get('/add/newBook', [NewBookController::class, 'index'])->name('owner.add_book');
    Route::post('/add/newBook', [NewBookController::class, 'add'])->name('add_book');

    Route::get('/allBooks', [AllBooksController::class, 'index'])->name('owner.all.books');

    Route::get('/orders', [OrdersController::class, 'index'])->name('owner.orders');    //to see orders list
    Route::get('/users', [UserController::class, 'index'])->name('owner.users');
    Route::get('users/detail/{id}', [UserController::class, "detail"])->name("owner.user.detail");

    Route::get('/book/detail/{id}', [AllBooksController::class, 'detail'])->name('owner.book.detail'); //to show details of book
    Route::get('book/detail/delete/{id}', [AllBooksController::class, 'delete'])->name('owner.delete.book');
    Route::post('/book/detail/update/{id}', [AllBooksController::class, 'update'])->name('owner.update_book'); //edit info of book
    Route::get('/orders/detail/{id}', [OrdersController::class, 'detail'])->name('owner.order.detail');
    Route::get('/orders/detail/accept/{id}', [OrdersController::class, 'accept'])->name('owner.order.accept');
    Route::get('/orders/detail/reject/{id}', [OrdersController::class, 'reject'])->name('owner.order.reject');

    Route::post('/add/discount', [DiscountController::class, 'addDiscount'])->name('owner.add.discount');
    Route::post('/remove/discount', [DiscountController::class, 'removeDiscount'])->name('owner.remove.discount');

    Route::post('add/admin', [AdminsController::class, 'add'])->name('owner.add.admin');
    Route::get('add/admin', [AdminsController::class, 'index'])->name('owner.admins');
    Route::get('delete/admin/{id}', [AdminsController::class, 'delete'])->name('owner.delete.admin');
});






// normal user page
Route::group(['middleware' => ['auth', 'user']], function () {
    Route::get('/home/books', [BookController::class, 'all_books'])->name('user.all.books');
    Route::get('/book/detail/{id}', [BookController::class, 'book_detail_page'])->name('book.detail');
    Route::get('/payment', [PaymentController::class, 'payment_page'])->name('payment');


    Route::get('/profile/{id}', [ProfileController::class, 'index'])->name('profile');

    // order route
    Route::post('/add/order', [UserOrderController::class, 'add'])->name('user.add.order');

    // cart route
    Route::get('/user/cart/{id}', [CartController::class, 'show'])->name('cart');
    Route::post('/add/cart', [CartController::class, 'add'])->name('add.cart');
    Route::get('wishList/delete/{id}', [ProfileController::class, 'wishListDelete'])->name('wishList.delete');
    Route::get('cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
    // review route
    Route::post('/user/review/add/', [ReviewController::class, 'add'])->name('user.review');
    Route::get('user/review/delete/{id}', [ReviewController::class, 'delete'])->name('review.delete');
    Route::get('/search/{id}', [BookController::class, 'bookSearchByCategory'])->name('searched_books');
    Route::post('/search', [BookController::class, 'bookSearchBySearchBar'])->name('bookSearchByBar');
});
Route::get('/home', [HomeController::class, "index"])->name('home');
