<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\SellerReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\SiteReviewController;



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
    return view('top');
});

Route::get('/', [ProductController::class, 'index'])->name('products.index');

Route::get('/guest_login', [LoginController::class, 'guestLogin'])->name('guest.login'); //ゲストログイン

Route::get('/mypage', [MyPageController::class, 'show'])->name('mypage.show'); // マイページ
Route::get('/mypage/edit', [MyPageController::class, 'edit'])->name('mypage.edit'); // マイページ編集
Route::post('/mypage/update', [MyPageController::class, 'update'])->name('mypage.update'); 
Route::get('/mypage/products', [MyPageController::class, 'products'])->name('mypage.products');// 出品履歴
Route::post('/mypage/products/{id}/cancel', [MyPageController::class, 'cancelProduct'])->name('mypage.product.cancel');
Route::get('/mypage/purchases', [MyPageController::class, 'purchases'])->name('mypage.purchases'); // 購入履歴

Route::get('/favorite', [FavoriteController::class, 'showFavorites'])->name('favorite'); //お気に入り
Route::get('/toggleFavorite/{product_id}', [FavoriteController::class, 'toggleFavorite'])->name('toggleFavorite');

Route::get('/seller-reviews/{user_id}', [SellerReviewController::class, 'index'])->name('seller.reviews'); //出品者レビュー
Route::get('/show_seller_review_form/{product_id}', [SellerReviewController::class, 'showReviewForm'])->name('show_seller_review_form'); // 出品者へのレビューフォーム
Route::post('/save_seller_review', [SellerReviewController::class, 'saveReview'])->name('save_seller_review');

Route::get('/site_reviews', [SiteReviewController::class, 'index'])->name('site_reviews.index'); // サイトレビュー一覧表示
Route::get('/site_reviews/create', [SiteReviewController::class, 'create'])->name('site_reviews.create'); // サイトレビュー作成フォーム表示
Route::post('/site_reviews', [SiteReviewController::class, 'store'])->name('site_reviews.store'); // サイトレビュー保存処理

Route::get('/products/search',[ProductController::class, 'search'])->name('products.search'); // 検索
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show'); // 商品詳細ページ
Route::post('/products/{id}/purchase', [ProductController::class, 'purchase'])->name('products.purchase')->middleware('auth'); // 購入処理
Route::get('/product/create', [ProductController::class, 'create'])->name('products.create'); // 商品登録ページ
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store'); 
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
