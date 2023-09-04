@extends('layouts.app')

@section('content')
    <div class="container" style="background-color: rgb(101, 96, 105) !important; color: rgb(255, 255, 255); position: static;">
        <h1>購入履歴</h1>
        @if ($purchases->isEmpty())
            <p>購入履歴はありません。</p>
        @else
            <div class="album py-5 bg-light" style="background-color: rgb(101, 96, 105) !important;">
                <div class="container">
                    <div class="row">
                        @foreach ($purchases as $purchase)
                            <div class="col-md-4">
                                <div class="card mb-4 box-shadow">
                                    <img class="card-img-top"
                                        src="{{ asset('storage/' . $purchase->product->images->first()->image_url) }}"
                                        alt="商品画像" style="height: 225px; width: 100%;">
                                    <div class="card-body">
                                        <p class="card-text">購入日時: {{ $purchase->purchased_at }}</p>
                                        <p class="card-text">商品名: {{ $purchase->product->name }}</p>
                                        <p class="card-text">価格: {{ $purchase->price }}円</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <!-- ページネーション -->
        {{ $purchases->links() }}
    </div>
@endsection
