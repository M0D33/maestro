<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('users', App\Http\Controllers\UserController::class)
    ->middleware([
        'auth',
        'admin',
    ]);

Route::resource('delivery-methods', App\Http\Controllers\DeliveryMethodController::class)
    ->middleware([
        'auth',
        'admin',
    ]);

Route::resource('orders', App\Http\Controllers\OrderController::class)
    ->middleware([
        'auth'
    ]);


Route::post('/cart/{cart}/{order}/update', [App\Http\Controllers\CartController::class, 'updateOrder'])
    ->middleware([
        'auth'
    ])
    ->name('cart.order.update');

Route::resource('cart', App\Http\Controllers\CartController::class)
    ->middleware([
        'auth'
        ]);

 Route::get('/cart/{cart}/checkout', [App\Http\Controllers\CartController::class, 'checkout'])
    ->middleware([
         'auth'
        ])
        ->name('cart.checkout');


Route::resource('promotions', App\Http\Controllers\PromotionController::class)
    ->middleware([
        'auth',
        'admin',
    ]);

    // Route::get('pizza/{id}', [
    //     App\Http\Controllers\PizzaController::class, 'show'
    // ])->name('pizza.show');

    Route::post('/cart/{cart}/{order}/thank-you', [App\Http\Controllers\CartController::class, 'completeCheckout'])
    ->middleware([
        'auth'
    ])
    ->name('cart.thank-you');
      Route::resource('pizza', App\Http\Controllers\PizzaController::class)
     ->middleware([
        'auth',
        'admin',
    ]);


    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


