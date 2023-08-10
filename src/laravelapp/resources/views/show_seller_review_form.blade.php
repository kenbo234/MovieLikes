@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>出品者へのレビュー</h1>
        <p>商品名：{{ $product->name }}</p>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('save_seller_review') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            
            <div class="form-group">
                <label for="rating">評価（1から5の整数）:</label>
                <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" required>
            </div>
            
            <!-- 他の評価項目を追加する場合はここに入力フォームを追加 -->

            <button type="submit" class="btn btn-primary">レビューを投稿</button>
        </form>
    </div>
@endsection
