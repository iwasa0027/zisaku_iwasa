<?php

//use App\Http\Controllers\PasswordController;

use App\Http\Controllers\PostController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\LikeController;
 use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminpostController;




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

// Route::get('/', function () {
//     return view('welcome');
// });


Auth::routes();

Route::group(['middleware'=>'auth','can:users',],function(){

Route::get('/', 'HomeController@index')->name('home');

//Route::get('/', [PasswordController::class, 'emailFormResetPassword'])->name('form');
// メール送信処理

//resourcecontroller
Route::resource('posts', 'PostController'); 


Route::resource('mypages', 'MypageController');


Route::post('/like', 'LikeController@like');

Route::get('/bookmarks', [PostController::class, 'bookmark_articles'])->name('bookmarks');


Route::get('/tagword', [PostController::class, 'tagwords'])->name('tagword');
Route::get('/basyoword', [PostController::class, 'basyowords'])->name('basyoword');
});

 Route::group(['middleware' => 'auth', 'can:admin_only'], function () {
    //Route::get('/home', 'HomeController@index')->name('home');
    //  Route::get('/admin_home', 'AdminHomeController@index')->name('admin_home');
  

Route::resource('adminuser','AdminUserController');
Route::resource('adminpost','AdminPostController');
Route::get('/crud_index', [AdminPostController::class,'index_crud'])->name('crud_index');      /* 一覧表示 */
Route::get('/user_crud_index', [AdminUserController::class,'user_index_crud'])->name('user_crud_index');      /* 一覧表示 */
});