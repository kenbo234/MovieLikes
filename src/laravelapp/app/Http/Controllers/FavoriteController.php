<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;
use App\Models\Favorite;



class FavoriteController extends Controller
{
    public function showFavorites()
    {
        // ログインユーザーがお気に入りした商品を取得
        $favoriteProducts = Auth::user()->favoriteProducts;

        // お気に入りした商品をビューに渡して表示
        return view('favorite', compact('favoriteProducts'));
    }

    public function toggleFavorite($product_id)
    {
        // ログインしているかを確認
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'お気に入りに登録するにはログインが必要です');
        }

        // 商品が存在するかを確認
        $product = Product::find($product_id);
        if (!$product) {
            return redirect()->back()->with('error', '商品が見つかりません');
        }

        // ログインユーザーのIDを取得
        $user_id = Auth::id();

        // 既にお気に入りに登録されているかを確認
        $existingFavorite = Favorite::where('user_id', $user_id)->where('product_id', $product_id)->first();

        if ($existingFavorite) {
            // お気に入りが既に存在する場合は削除
            $existingFavorite->delete();
            return redirect()->back()->with('success', 'お気に入りを解除しました');
        } else {
            // お気に入りが存在しない場合は新しく作成
            Favorite::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
            ]);
            return redirect()->back()->with('success', 'お気に入りに登録しました');
        }
    }
}
