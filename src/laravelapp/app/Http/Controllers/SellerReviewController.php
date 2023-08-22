<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\SellerReview;
use Illuminate\Http\Request;

class SellerReviewController extends Controller
{
    public function index($user_id)
    {
        $user = User::findOrFail($user_id);

        $reviews = $user->sellerReviews;

        //出品者レビュー表示
        return view('seller_reviews', compact('user', 'reviews'));
    }

    public function showReviewForm($product_id)
    {
        // 商品情報を取得
        $product = Product::findOrFail($product_id);

        // 出品者へのレビューフォームを表示
        return view('show_seller_review_form', compact('product'));
    }

    public function saveReview(Request $request)
    {
        // バリデーションを行う
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',

            // 他に評価に関するバリデーションルールを追加する場合はここに記述
        ]);

        // 商品情報を取得
        $product = Product::findOrFail($validatedData['product_id']);

        // 出品者のIDを取得
        $seller_id = $product->user_id;

        // レビューを保存
        $review = new SellerReview();
        $review->product_id = $validatedData['product_id'];
        $review->user_id = $seller_id; // 出品者のIDを保存
        $review->rating = $validatedData['rating'];
        $review->comment = $validatedData['comment'];
        // 他のレビュー情報を保存する場合はここに追加

        // 保存
        $review->save();

        // レビューが保存された後のリダイレクト先を指定
        return redirect()->route('products.index')->with('success', 'レビューが保存されました');
    }

    public function getAverageRating($user_id)
    {
        // 出品者のレビューを取得
        $reviews = SellerReview::where('user_id', $user_id)->get();

        // レビューがない場合は0を返す
        if ($reviews->isEmpty()) {
            return 0;
        }

        // レビューの平均評価を計算
        $averageRating = $reviews->avg('rating');

        return $averageRating;
    }
}
