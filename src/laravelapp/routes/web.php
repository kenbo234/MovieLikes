<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyPageController;



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

Route::get('/top', [ProductController::class, 'index'])->name('products.index');
Route::get('/mypage', [MyPageController::class, 'index'])->name('mypage'); // マイページ
Route::get('/products/search',[ProductController::class, 'search'])->name('products.search'); // 検索
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show'); // 商品詳細ページ
Route::post('/products/{id}/purchase', [ProductController::class, 'purchase'])->name('products.purchase')->middleware('auth');
Route::get('/product/create', [ProductController::class, 'create'])->name('products.create'); // 商品登録ページ
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store'); // 商品購入
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
