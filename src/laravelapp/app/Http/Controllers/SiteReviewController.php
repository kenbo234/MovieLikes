<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteReview;
use App\Models\User;
use App\Models\Tag;
use App\Models\Coupon;

class SiteReviewController extends Controller
{
    public function index()
    {
        // サイトレビューの一覧を取得
        $siteReviews = SiteReview::all();

        // 一覧ビューを表示
        return view('site_reviews.index', compact('siteReviews'));
    }

    public function create()
    {
        // ユーザーとタグの一覧を取得
        $users = User::all();
        $tags = Tag::all();

        // 空のSiteReviewモデルを作成してビューに渡す
        $siteReview = new SiteReview();

        // レビュー作成フォームビューを表示
        return view('site_reviews.create', compact('users', 'tags','siteReview'));
    }

    public function store(Request $request)
    {
        // バリデーションルールを定義
        $rules = [
            'user_id' => 'required',
            'tag_id' => 'nullable',
            'comment' => 'required'
        ];

        // バリデーション
        $request->validate($rules);

        // サイトレビューを作成
        $siteReview = new SiteReview();
        $siteReview->user_id = $request->user_id;
        $siteReview->tag_id = $request->tag_id;
        $siteReview->comment = $request->comment;
        $siteReview->save();

        // クーポンを差し上げる処理
        $user_id = $request->user_id;
        if ($user_id) {
            $couponAmount = 500; // クーポンの金額
            $coupon = new Coupon();
            $coupon->user_id = $user_id;
            $coupon->price = $couponAmount;
            $coupon->save();
        }

        // リダイレクトして一覧ページに戻る
        return redirect()->route('site_reviews.index')->with('success', 'サイトレビューが作成されました');
    }
}
