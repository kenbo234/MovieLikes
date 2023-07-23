@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>マイページ</h1>
        <p>ユーザー名: {{ $user->username }}</p>
        <p>メールアドレス: {{ $user->email }}</p>

        <!-- ここに出品した商品や購入履歴などの情報を表示するコードを追加 -->
    </div>
@endsection