@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4">
                <h1 class="mb-4">マイページ</h1>
                <p class="mb-2"><strong>ユーザー名:</strong> {{ $user->username }}</p>
                <div>
                    @php
                        $averageRating = app('App\Http\Controllers\SellerReviewController')->getAverageRating(Auth::user()->id);
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
                <p class="mb-2"><strong>メールアドレス:</strong> {{ $user->email }}</p>
                <a href="{{ route('mypage.edit') }}" class="btn btn-primary">プロフィール変更</a>
                @if(session('success'))
                    <div class="alert alert-success mt-4">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4">
                <h2 class="mb-3">クーポン</h2>
                @if($userCoupons->isEmpty())
                    <p>利用可能なクーポンはありません。</p>
                @else
                    <ul>
                        @foreach($userCoupons as $coupon)
                            <li>{{ $coupon->price }}円のクーポン</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
