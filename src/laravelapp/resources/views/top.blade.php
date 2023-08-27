@extends('layouts.app')

<head>
    {{-- <style>
      /* ここにカスタムCSSを記述 */
      .custom-search-form {
          flex: 1;
      }

      .custom-search-input {
          width: 40%;
      }
      /* 検索アイコンのフォントサイズをフォームの高さに合わせる */
      .custom-search-input .btn {
          font-size: 160%;
      }
  </style> --}}
</head>
{{-- メインコンテンツ --}}
@section('content')
    <header>
        <div class="navbar navbar-dark bg-dark box-shadow">
            <div class="container d-flex justify-content-between">
                <a href="#" class="navbar-brand d-flex align-items-center">
                    <strong>Movies</strong>
                </a>
                <form action="{{ route('products.search') }}" method="GET"
                    class="form-inline my-2 my-lg-0 custom-search-input">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="キーワードを入力してください"
                            aria-label="Search" value="{{ trim(request('keyword')) }}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-light" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('products.create') }}" class="btn btn-primary btn-lg"
                    style="background-color: rgb(122, 62, 182); font-weight: 700; border-width: 4px; border-color: rgb(122, 62, 182); float: none;">
                    出品
                </a>
            </div>
        </div>
    </header>
    <main role="main">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="album py-5 bg-light" style="background-color: rgb(234, 231, 249) !important;">
            <div class="container">

                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                @if ($product->images->isNotEmpty())
                                    <img src="{{ asset('storage/' . $product->images->first()->image_url) }}" alt="商品画像"
                                        style="height: 225px; width: 100%;">
                                @else
                                    <img class="card-img-top"
                                        data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail"
                                        alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;"
                                        src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22208%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20208%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1890733640f%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A11pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1890733640f%22%3E%3Crect%20width%3D%22208%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2266.9296875%22%20y%3D%22117.45%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
                                        data-holder-rendered="true" style="height: 225px; width: 100%;">
                                @endif
                                <div class="card-body">
                                    <p class="card-text">{{ $product->name }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group align-items-center">
                                            <a href="{{ route('products.show', ['id' => $product->id]) }}"
                                                class="btn btn-sm btn-outline-secondary">詳細</a>
                                            <!-- お気に入りアイコン -->
                                            @if ($product->isFavorite())
                                                <a href="{{ route('toggleFavorite', ['product_id' => $product->id]) }}"
                                                    class="btn btn-sm btn-outline-secondary toggle-favorite"
                                                    style="padding: 7.8;">
                                                    <i class="fas fa-heart" style="color: #e00000;"></i> <!-- ハートのアイコン -->
                                                </a>
                                            @else
                                                <a href="{{ route('toggleFavorite', ['product_id' => $product->id]) }}"
                                                    class="btn btn-sm btn-outline-secondary toggle-favorite"
                                                    style="padding: 7.8;">
                                                    <i class="far fa-heart" style="color: #e00000;"></i>
                                                    <!-- ハートのアウトラインアイコン -->
                                                </a>
                                            @endif
                                        </div>
                                        <!-- 出品者の名前を表示するリンク -->
                                        <div>
                                            <a href="{{ route('seller.reviews', ['user_id' => $product->user->id]) }}">
                                                {{ $product->user->username }}さんのレビューを見る
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- ページネーション -->
            {{ $products->links() }}

        </div>


        <!-- <nav aria-label="Page navigation example" style="">	  <ul class="pagination">		<li class="page-item"><a class="page-link" href="#">Previous</a></li>		<li class="page-item"><a class="page-link" href="#">1</a></li>		<li class="page-item"><a class="page-link" href="#">2</a></li>		<li class="page-item"><a class="page-link" href="#">3</a></li>		<li class="page-item"><a class="page-link" href="#">Next</a></li>	  </ul>	</nav></div> -->


    </main>
@endsection('content')
