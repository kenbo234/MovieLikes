@extends('layouts.app')

@section('content')
    <div class="container">
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
            <button type="submit" class="btn btn-success">購入する</button>
        </form>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
@endsection
