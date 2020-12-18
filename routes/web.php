<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'App\Http\Controllers\Admin',
    'middleware' => 'role',
], function() {
    Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('home');
    Route::get('/profile', [App\Http\Controllers\Admin\AdminController::class, 'showProfile'])->name('profile');
    Route::patch('/profile/update', [App\Http\Controllers\Admin\AdminController::class, 'updateProfile'])->name('profile.update');
    Route::resource('/users', 'UserController');
    Route::get('/users/{user}/products', [App\Http\Controllers\Admin\UserController::class, 'showProducts'])->name('users.show-products');
});

Route::group([
    'prefix' => 'editor',
    'as' => 'editor.',
    'namespace' => 'App\Http\Controllers\Editor',
    'middleware' => 'role',
], function() {
    Route::get('/', [App\Http\Controllers\Editor\EditorController::class, 'index'])->name('home');
    Route::get('/profile', [App\Http\Controllers\Editor\EditorController::class, 'showProfile'])->name('profile');
    Route::patch ('/profile/update', [App\Http\Controllers\Editor\EditorController::class, 'updateProfile'])->name('profile.update');
    Route::resource('/products', 'ProductController');
    Route::resource('/orders', 'OrderController');
    Route::resource('/catalogs', 'CatalogController');
    Route::get('/orders/user/{user}',[App\Http\Controllers\Editor\OrderController::class, 'showUser'])->name('orders.show-user');
    Route::delete('/orders/{order}/products/{product}', [App\Http\Controllers\Editor\OrderController::class, 'destroyProduct'])->name('orders.destroy-product');
});

