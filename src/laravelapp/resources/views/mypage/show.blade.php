@extends('layouts.app')

@section('content')
<div class="container">
    <h1>マイページ</h1>
    <p>ユーザー名: {{ $user->name }}</p>
    <p>メールアドレス: {{ $user->email }}</p>
    <a href="{{ route('mypage.edit') }}" class="btn btn-primary">プロフィール変更</a>
</div>
@endsection