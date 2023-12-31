<?php

use App\Http\Controllers\Auth\VerificationController;

use App\Http\Controllers\PostsController;

use App\Http\Controllers\RegistrationController;

use App\Http\Controllers\RyokanregisterController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\BookingsController;

use App\Http\Controllers\LikeController;

use App\Http\Controllers\ViolationController;

use App\Http\Controllers\AdminController;

use App\Http\Controllers\SearchController;


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

Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

Route::get('/', [PostsController::class, 'index'])->name('create.posts');

Route::get('/registerryokan', [RyokanregisterController::class, 'index'])->name('register.ryokan');

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::resource('posts', 'PostsController');

Route::get('/home', 'HomeController@index')->name('home');//新規登録後画面

Route::get('/logins', 'HomeController@logins')->name('logins');//ログイン後画面

//ログイン中のユーザーのみアクセス可能
Route::group(['middleware' => ['auth']], function () {
    Route::get('/users/{id}/', [UserController::class, 'index'])->name('users.detail');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.register');//順番変えるとエラーが出る
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/posts', [AdminController::class, 'posts'])->name('admin.posts');
    Route::resource('admin', 'AdminController');
    Route::resource('users', 'UserController');
    Route::resource('bookings', 'BookingsController');
    Route::get('likes', [LikeController::class, 'index'])->name('likes.index');
    Route::get('violation', [ViolationController::class, 'index'])->name('violation.index');
    Route::post('violations', [ViolationController::class, 'create']);
    Route::post('ajaxlike', 'PostsController@ajaxlike')->name('posts.ajaxlike');
});
