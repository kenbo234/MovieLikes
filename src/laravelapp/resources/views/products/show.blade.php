@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success"  style="color: rgb(255, 255, 255); position: static; font-weight: 700;">
                        <h3>{{ $product->name }}</h3>
                    </div>

                    <div class="card-body">
                        <div class="text-center">
                            <!-- 商品画像表示 -->
                            @if ($product->images->isNotEmpty())
                                <img src="{{ asset('storage/' . $product->images->first()->image_url) }}" alt="商品画像"
                                    class="product-image" style="object-fit: contain; max-height: 300px; width: 100%;">
                            @else
                                <p>画像はありません</p>
                            @endif
                        </div>

                        <div class="text-center mt-3">
                            <p class="product-description">{{ $product->description }}</p>
                            <p class="product-price">価格: {{ $product->price }}円</p>

                            <!-- タグ表示 -->
                            <ul class="list-unstyled">
                                @foreach ($product->tags as $tag)
                                    <li>#{{ $tag->name }}</li>
                                @endforeach
                            </ul>

                            <!-- 購入フォーム -->
                            <form action="{{ route('products.purchase', ['id' => $product->id]) }}" method="POST">
                                @csrf
                                @if ($product->user_id !== optional(Auth::user())->id)
                                    <button class="btn btn-success">購入する</button>
                                    @if (Auth::check() && $userCouponsCount > 0)
                                        <label class="mt-2">
                                            <input type="checkbox" name="use_coupon"> クーポンを使用して購入
                                        </label>
                                    @endif
                                @endif
                            </form>

                            @if (session('success'))
                                <div class="alert alert-success mt-3">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
