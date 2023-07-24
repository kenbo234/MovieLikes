<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User;
use App\Models\Product;

class MyPageController extends Controller
{
    public function show()
    {
        $user = Auth::User();
        // 必要なデータを取得してマイページのビューに渡す
        return view('mypage.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('mypage.edit', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\MyUserModel $user **/
        $user = Auth::user();
    
        $validatedData = $request->validate([
            'username' => 'required|string|max:128',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => 'required|string|min:6',
            'zipcode' => 'required|string|max:7',
            'prefecture' => 'required|string',
            'city' => 'required|string',
            'housenumber' => 'required|string',
            'buildingname' => 'nullable|string',
        ]);
    
        // ユーザー情報を更新
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        $user->zipcode = $validatedData['zipcode'];
        $user->prefecture = $validatedData['prefecture'];
        $user->city = $validatedData['city'];
        $user->housenumber = $validatedData['housenumber'];
        $user->buildingname = $validatedData['buildingname'];
        $user->save();
    
        return redirect()->route('mypage.show')->with('success', 'プロフィールを更新しました');
    }

    public function products()
    {
        $user = Auth::user();
        $products = $user->products;
    
        return view('mypage.products', compact('products'));
    }

    public function cancelProduct($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('mypage.products')->with('error', '商品が見つかりません');
        }

        // 商品がログインユーザーのものかどうかを確認
        if ($product->user_id !== Auth::user()->id) {
            return redirect()->route('mypage.products')->with('error', 'この商品はあなたのものではありません');
        }

        // 商品を論理削除
        $product->delete();

        return redirect()->route('mypage.products')->with('success', '商品を出品取り消しました');
    }


}
