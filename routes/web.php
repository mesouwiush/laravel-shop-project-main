<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductRatingController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\CartController;

Route::get('/', function () { return view('welcome'); })->name('home');

Route::resource('user', UserController::class);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::post('/products', [ProductController::class, 'store']);
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::post('/user/{user}/assign-role', [UserController::class, 'assignRole'])->name('user.assignRole');

Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::get('/users/{username}', [UserController::class, 'show'])->name('users.show');

Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
Route::get('/tags/{tag}/edit', [TagController::class, 'edit'])->name('tags.edit');
Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');
Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
Route::put('/tags/{tag}', [TagController::class, 'update'])->name('tags.update');
Route::get('/tags/{tag}', [TagController::class, 'show'])->name('tags.show');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::post('/products/{product}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::post('/send-email', [EmailController::class, 'sendEmail'])->name('send.email');
Route::post('/product-ratings/{product}', [ProductRatingController::class, 'store'])->name('product-ratings.store');
Route::get('/product-ratings/{id}', [ProductRatingController::class, 'index']);

Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.addToCart')->middleware('auth');
Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.add')->middleware('auth');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/show', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.addToCart')->middleware('auth');
Route::get('/cart/data', [CartController::class, 'getCartData'])->middleware('auth');

Route::get('/checkout', [CartController::class, 'showCheckoutPage'])->name('checkout.show')->middleware('auth');
Route::post('/checkout', [CartController::class, 'checkoutProcess'])->name('checkout.process')->middleware('auth');
Route::get('/purchased-products', [UserController::class, 'purchasedProducts'])->name('purchased_products');

Route::get('/product management', [DashboardController::class, 'pm'])->name('product management');

Route::get('/categories management', [DashboardController::class, 'cm'])->name('categories management');


Route::get('/thankyou', function () {
    return view('thankyou');
})->name('thankyou');




Route::get('/dashboard/2', function () {
    return view('dashboard/2');
})->name('dashboard/2');