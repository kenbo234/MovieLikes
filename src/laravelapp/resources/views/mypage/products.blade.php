@extends('layouts.app')

@section('content')
    <div class="album py-5 bg-light" style="background-color: rgb(101, 96, 105) !important;">
        <div class="container">
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            @if ($product->images->isNotEmpty())
                                <img src="{{ asset('storage/' . $product->images->first()->image_url) }}" alt="商品画像"
                                    style="height: 225px; width: 100%;">
                            @else
                                <img src="{{ asset('images/default_product_image.jpg') }}" alt="デフォルト商品画像">
                            @endif
                            <div class="card-body">
                                <p class="card-text">{{ $product->name }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{ route('products.show', ['id' => $product->id]) }}"
                                            class="btn btn-sm btn-outline-secondary">詳細を見る</a>
                                        <form action="{{ route('mypage.product.cancel', ['id' => $product->id]) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger">出品取り消し</button>
                                        </form>
                                    </div>
                                    <small class="text-muted">価格: {{ $product->price }}円</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- ページネーション -->
    {{ $products->links() }}

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    </div>
@endsection
