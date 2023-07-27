<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SellerReview;
use Illuminate\Http\Request;

class SellerReviewController extends Controller
{
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
            // 他に評価に関するバリデーションルールを追加する場合はここに記述
        ]);

        // ログインユーザーのIDを取得
        $user_id = auth()->user()->id;

        // レビューを保存
        $review = new SellerReview();
        $review->product_id = $validatedData['product_id'];
        $review->user_id = $user_id; // ログインユーザーのIDを保存
        $review->rating = $validatedData['rating'];
        // 他のレビュー情報を保存する場合はここに追加

        // 保存
        $review->save();

        // レビューが保存された後のリダイレクト先を指定
        return redirect()->route('products.show', ['id' => $validatedData['product_id']])
            ->with('success', 'レビューが保存されました');
    }
}