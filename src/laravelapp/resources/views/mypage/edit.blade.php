@extends('layouts.app')

@section('content')
<div class="container">
    <h1>プロフィール変更</h1>
    <form action="{{ route('mypage.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="username">ユーザー名</label>
            <input type="text" name="username" id="username" value="{{ $user->username }}" required>
        </div>
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="form-group">
            <label for="zipcode">郵便番号</label>
            <input type="text" name="zipcode" id="zipcode" value="{{ $user->zipcode }}" required>
        </div>
        <div class="form-group">
            <label for="prefecture">都道府県</label>
            <input type="text" name="prefecture" id="prefecture" value="{{ $user->prefecture }}" required>
        </div>
        <div class="form-group">
            <label for="city">市町村</label>
            <input type="text" name="city" id="city" value="{{ $user->city }}" required>
        </div>
        <div class="form-group">
            <label for="housenumber">番地</label>
            <input type="text" name="housenumber" id="housenumber" value="{{ $user->housenumber }}" required>
        </div>
        <div class="form-group">
            <label for="buildingname">建物名</label>
            <input type="text" name="buildingname" id="buildingname" value="{{ $user->buildingname }}">
        </div>
        <button type="submit" class="btn btn-primary">更新する</button>
    </form>
</div>
@endsection