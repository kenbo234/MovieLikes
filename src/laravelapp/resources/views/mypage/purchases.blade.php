@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>購入履歴</h1>
        @if ($purchases->isEmpty())
            <p>購入履歴はありません。</p>
        @else
            <div class="album py-5 bg-light">
                <div class="container">
                    <div class="row">
                        @foreach ($purchases as $purchase)
                            <div class="col-md-4">
                                <div class="card mb-4 box-shadow">
                                    <img class="card-img-top" src="{{ asset('storage/' . $purchase->product->images->first()->image_url) }}" alt="商品画像" style="height: 225px; width: 100%;">
                                    <div class="card-body">
                                        <p class="card-text">購入日時: {{ $purchase->purchased_at }}</p>
                                        <p class="card-text">商品名: {{ $purchase->product->name }}</p>
                                        <p class="card-text">価格: {{ $purchase->price }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
@endsection
