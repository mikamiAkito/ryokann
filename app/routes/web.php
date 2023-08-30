<?php

use App\Http\Controllers\PostsController;

use App\Http\Controllers\RegistrationController;

use App\Http\Controllers\RyokanregisterController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\BookingsController;


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

Route::get('/', [PostsController::class, 'index'])->name('create.posts');

Route::get('/registerryokan', [RyokanregisterController::class, 'index'])->name('register.ryokan');

Route::get('/users/{id}/', [UserController::class, 'index'])->name('users.detail');

Route::resource('posts', 'PostsController');
Route::resource('users', 'UserController');
Route::resource('bookings', 'BookingsController');

// Route::get('reservation', 'ReservationController@create'); // 入力フォーム
// Route::post('reservation', 'ReservationController@store'); // 送信先


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
