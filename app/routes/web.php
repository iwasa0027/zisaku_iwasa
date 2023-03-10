<?php

//use App\Http\Controllers\PasswordController;

use App\Http\Controllers\PostController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\LikeController;




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


Auth::routes();

Route::group(['middleware'=>'auth'],function(){

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/', [PasswordController::class, 'emailFormResetPassword'])->name('form');
// メール送信処理

//resourcecontroller
Route::resource('posts', 'PostController'); 


Route::resource('mypages', 'MypageController');
});

//いいねを付ける
Route::get('/like/{post}','LikeController@like')->name('like');

//いいねを表示するページ
Route::get('/','LikeController@index');