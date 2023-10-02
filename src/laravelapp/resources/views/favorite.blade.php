@extends('layouts.app')

@section('content')
<div class="container" style="background-color: rgb(101, 96, 105) !important; color: rgb(255, 255, 255); position: static;">
        <h1>お気に入り商品一覧</h1>

        @if ($favoriteProducts->isNotEmpty())
            <div class="album py-5 bg-light" style="bbackground-color: rgb(101, 96, 105) !important;">
                <div class="container">
                    <div class="row">
                        @foreach ($favoriteProducts as $product)
                            <div class="col-md-4">
                                <div class="card mb-4 box-shadow">
                                    @if ($product->images->isNotEmpty())
                                        <img src="{{ Storage::disk('s3')->url($product->images->first()->image_url) }}"
                                            alt="商品画像" style="height: 225px; width: 100%;">
                                    @else
                                        <img class="card-img-top" src="{{ asset('placeholder.jpg') }}" alt="No Image"
                                            style="height: 225px; width: 100%;">
                                    @endif
                                    <div class="card-body">
                                        <p class="card-text">{{ $product->name }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <a href="{{ route('products.show', ['id' => $product->id]) }}"
                                                    class="btn btn-sm btn-outline-secondary">詳細</a>
                                                <!-- お気に入りアイコン -->
                                                @if ($product->favoritedByUsers->contains(auth()->user()))
                                                    <a href="{{ route('toggleFavorite', ['product_id' => $product->id]) }}"
                                                        class="btn btn-sm btn-outline-danger toggle-favorite">
                                                        <i class="fas fa-heart" style="color: #e00000;"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('toggleFavorite', ['product_id' => $product->id]) }}"
                                                        class="btn btn-sm btn-outline-secondary toggle-favorite">
                                                        <i class="far fa-heart" style="color: #e00000;"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <p>お気に入り商品はありません</p>
        @endif
        <!-- ページネーション -->
        {{ $favoriteProducts->links() }}
    </div>
@endsection
