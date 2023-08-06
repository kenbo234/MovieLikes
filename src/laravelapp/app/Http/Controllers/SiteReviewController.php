<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteReview;
use App\Models\User;
use App\Models\Tag;

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

        // レビュー作成フォームビューを表示
        return view('site_reviews.create', compact('users', 'tags'));
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

        // リダイレクトして一覧ページに戻る
        return redirect()->route('site_reviews.index')->with('success', 'サイトレビューが作成されました');
    }

    // 他のアクション（show、edit、update、destroyなど）も同様に実装する
}
