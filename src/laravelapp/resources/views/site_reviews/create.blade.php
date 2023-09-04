@extends('layouts.app')

@section('content')
    <div class="container" style="color: rgb(255, 255, 255); position: static;">
        <h1>サイトレビュー</h1>
        <form action="{{ route('site_reviews.store') }}" method="POST">
            @csrf

            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            
            <!-- 隠しフィールドにサイトレビューのIDを埋め込む -->
            {{-- <input type="hidden" name="site_review_id" value="{{ $siteReview->id }}"> --}}

            {{-- <div class="form-group">
              <label for="tag_id">タグ</label>
              <select name="tag_id" id="tag_id" class="form-control">
                  <option value="">任意で選択してください</option>
                  @foreach($tags as $tag)
                      <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                  @endforeach
              </select>
            </div> --}}

            <div class="form-group">
                <label for="comment">コメント</label>
                <textarea name="comment" id="comment" rows="5" class="form-control"></textarea>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
               @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
               @endforeach
              </ul>
            </div>
            @endif

            <button type="submit" class="btn btn-primary">送信</button>
        </form>
    </div>
@endsection