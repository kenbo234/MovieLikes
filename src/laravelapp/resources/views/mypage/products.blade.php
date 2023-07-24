@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>出品した商品一覧</h1>
        <ul>
            @foreach ($products as $product)
                <li>
                    {{ $product->name }} - {{ $product->description }} - 価格: {{ $product->price }}
                    <form action="{{ route('mypage.product.cancel', ['id' => $product->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">出品取り消し</button>
                    </form>
                </li>
            @endforeach
        </ul>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
@endsection
