<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\EmailController;


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
    return redirect()->route('home');
});

Auth::routes();

Route::get('/GP2', [HomeController::class, 'index'])->name('home');
Route::get('/GP2/{id}', [HomeController::class, 'subcategories'])->name('home.subcategories');
Route::get('/GP2/{id}/ordersummary', [HomeController::class, 'ordersummary'])->name('home.ordersummary');
Route::get('/stores/regiser', [StoreController::class, 'storesForm'])->name('store.form');
Route::post('/stores/regiser', [StoreController::class, 'register'])->name('store.register');
Route::get('/order/{id}/send', [OrderController::class, 'send'])->name('order.send');
Route::get('send/email/{id}', [EmailController::class, 'sendEmail'])->name('email.send');



Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('subcategories', SubcategoryController::class);
    Route::resource('stores', StoreController::class);
    Route::resource('orders', OrderController::class);
    Route::get('/categories/display/{id}', [CategoryController::class, 'display'])->name('subcategories.display');

});