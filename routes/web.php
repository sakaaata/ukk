<?php

use App\Models\cart;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard',[FoodController::class,'index'])->name('dashboard');
    Route::get('/menu/create',[FoodController::class,'create'])->name('menu.create');
    Route::post('/menu',[FoodController::class,'store'])->name('menu.store');
    Route::get('/menu/{food}/edit',[FoodController::class,'edit'])->name('menu.edit');
    Route::put('/menu/{food}',[FoodController::class,'update'])->name('menu.update');
    

    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{food}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{food}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::patch('/cart/update/{food}', [CartController::class, 'updateQuantity'])->name('cart.update');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/checkout', [OrderController::class, 'create'])->name('checkout.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

require __DIR__.'/auth.php';
