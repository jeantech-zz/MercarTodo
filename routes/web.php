<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\UserController;  
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\OrderProduct\OrderProductController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth','verified'])->group(function () {

    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::Resource('users', UserController::class)->only(['index','create','store','edit','update']);
    Route::Resource('products', ProductController::class)->only(['index','create','store','edit', 'update','destroy']);
    Route::Resource('orders', OrderController::class)->only(['index','destroy']);
    Route::Resource('orderProducts', OrderProductController::class)->only(['index','destroy']);
    
    Route::put('/products/disable/{product}', [ProductController::class, 'disable'])->name('products.disable');
    Route::put('/users/disable/{user}', [UserController::class, 'disable'])->name('users.disable');
    Route::get('products/indexClient',[ProductController::class,'indexClient'])->name('products.indexClient');

    Route::post('/products/addProductOrder/{product}', [ProductController::class, 'addProductOrder'])->name('products.addProductOrder');
    Route::post('/orderProducts/addProductOrder/{orderProduct}', [OrderProductController::class, 'addProductOrder'])->name('orderProducts.addProductOrder');

    Route::put('/orders/orderPay/{order}', [OrderController::class, 'orderPay'])->name('orders.orderPay');
    Route::get('/orders/{order}', [OrderController::class, 'showPay'])->name('orders.showPay');

    Route::get('payments/storePay',[OrderController::class, 'storePay']);
    
});
