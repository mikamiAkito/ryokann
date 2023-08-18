<?php

use App\Http\Controllers\DisplayController;

use App\Http\Controllers\RegistrationController;

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

// Route::get('/', [DisplayController::class, 'index']);

Route::get('/', [RegistrationController::class, 'createPostsForm'])->name('create.posts');
Route::post('/', [RegistrationController::class, 'createPosts']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
