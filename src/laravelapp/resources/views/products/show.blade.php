@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- 画像表示の追加部分 -->
        @if ($product->images->isNotEmpty())
            <img src="{{ asset('storage/' . $product->images->first()->image_url) }}" alt="商品画像"
                style="max-width: 500px; max-height: 500px; display: block; margin: 0 auto;">
        @else
            <p>画像はありません</p>
        @endif

        <h1>{{ $product->name }}</h1>
        <p>{{ $product->description }}</p>
        <p>価格: {{ $product->price }}</p>

        <h4>タグ:</h4>
        <ul>
            @foreach ($product->tags as $tag)
                <li>{{ $tag->name }}</li>
            @endforeach
        </ul>


        <!-- 他の商品情報を表示するためのコードを追加 -->



        <form action="{{ route('products.purchase', ['id' => $product->id]) }}" method="POST">
            @csrf
            @if ($product->user_id !== optional(Auth::user())->id)
                <button class="btn btn-success">購入する</button>
                @if (Auth::check() && $userCouponsCount > 0)
                    <label>
                        <input type="checkbox" name="use_coupon"> クーポンを使用して購入
                    </label>
                @endif
            @endif
        </form>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
@endsection
