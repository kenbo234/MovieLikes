<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
    public function index()
    {
        $user = Auth::User();
        // 必要なデータを取得してマイページのビューに渡す
        return view('mypage', compact('user'));
    }
}
