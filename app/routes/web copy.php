<?php

use App\Http\Controllers\PostsController;

use App\Http\Controllers\RegistrationController;

use App\Http\Controllers\RyokanregisterController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\BookingsController;

use App\Http\Controllers\LikeController;

use App\Http\Controllers\ViolationController;

use App\Http\Controllers\AdminController;


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

Route::get('/', [PostsController::class, 'index'])->name('create.posts');

Route::get('/registerryokan', [RyokanregisterController::class, 'index'])->name('register.ryokan');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.register');
Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
Route::get('/admin/posts', [AdminController::class, 'posts'])->name('admin.posts');

Route::get('/users/{id}/', [UserController::class, 'index'])->name('users.detail');

Route::post('admin', [AdminController::class, 'displaystop'])->name('admin.displaystop');

Route::resource('posts', 'PostsController');
Route::resource('users', 'UserController');
Route::resource('bookings', 'BookingsController');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('likes', [LikeController::class, 'index'])->name('likes.index');

Route::get('violation', [ViolationController::class, 'index'])->name('violation.index');
Route::post('violations', [ViolationController::class, 'create']);

//ログイン中のユーザーのみアクセス可能
Route::group(['middleware' => ['auth']], function () {
    //「ajaxlike.jsファイルのurl:'ルーティング'」に書くものと合わせる。
    Route::post('ajaxlike', 'PostsController@ajaxlike')->name('posts.ajaxlike');
});
