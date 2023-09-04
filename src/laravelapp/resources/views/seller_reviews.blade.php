@extends('layouts.app')

@section('content')
    <div class="container" style="color: rgb(255, 255, 255); position: static;">
        <h1>{{ $user->username }}さんのレビュー</h1>

        @if ($reviews->isEmpty())
            <p>レビューはありません。</p>
        @else
            <div>
                @php
                    $averageRating = app('App\Http\Controllers\SellerReviewController')->getAverageRating($user->id);
                @endphp
                <span class="mb-2"><strong>評価:</strong> </span>
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $averageRating)
                        <span class="star">&#9733;</span>
                    @else
                        <span class="star">&#9734;</span>
                    @endif
                @endfor
            </div>
            <div class="mt-3">
                <h2>レビュー一覧</h2>
                <ul>
                    @foreach ($reviews as $review)
                        <li>
                            <p>{{ $review->comment }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
