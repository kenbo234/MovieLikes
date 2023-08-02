@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>お気に入り商品一覧</h1>

        @if($favoriteProducts->isNotEmpty())
            <div class="album py-5 bg-light">
                <div class="container">
                    <div class="row">
                        @foreach ($favoriteProducts as $product)
                            <div class="col-md-4">
                                <div class="card mb-4 box-shadow">
                                    @if ($product->images->isNotEmpty())
                                        <img src="{{ asset('storage/' . $product->images->first()->image_url) }}" alt="商品画像">
                                    @else
                                        <img class="card-img-top" src="{{ asset('placeholder.jpg') }}" alt="No Image">
                                    @endif
                                    <div class="card-body">
                                        <p class="card-text">{{ $product->name }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <a href="{{ route('products.show', ['id' => $product->id]) }}" class="btn btn-sm btn-outline-secondary">詳細</a>
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
    </div>
@endsection