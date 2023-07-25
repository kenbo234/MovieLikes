@extends('layouts.app')

@section('content')
<div class="container">
    <h1>マイページ</h1>
    <p>ユーザー名: {{ $user->username }}</p>
    <p>メールアドレス: {{ $user->email }}</p>
    <a href="{{ route('mypage.edit') }}" class="btn btn-primary">プロフィール変更</a>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
</div>
<div class="container mt-3">
    <a href="{{ route('mypage.products') }}" class="btn btn-primary">出品した商品</a>
    <a href="{{ route('mypage.purchases') }}" class="btn btn-success">購入履歴</a>
    

</div>
@endsection