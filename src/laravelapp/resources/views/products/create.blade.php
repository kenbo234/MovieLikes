@extends('layouts.app')

@section('content')
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="name">商品名</label>
            <input type="text" name="name" id="name" required>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="description">商品説明</label>
            <textarea name="description" id="description" required></textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="price">商品価格</label>
            <input type="text" name="price" id="price" required>
            @error('price')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="category_id">カテゴリー</label>
            <select name="category_id" id="category_id" required>
                <option value="">カテゴリーを選択してください</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="tags">タグ</label>
            <input type="text" name="tags[]" id="tags" placeholder="タグを入力してください">
            @error('tags')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="image">画像</label>
            <input type="file" name="image" id="image" class="form-control-file" accept="image/*" required>
        </div>

        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">


        @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
               @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
               @endforeach
              </ul>
            </div>
        @endif


        <!-- 他の商品情報の入力フォームを追加 -->

        <div>
            <button type="submit">商品を出品する</button>
        </div>
    </form>
@endsection
