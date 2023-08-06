@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>レビュー一覧</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('site_reviews.create') }}" class="btn btn-primary mb-3">レビューする</a>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ユーザー名</th>
                    <th>タグ</th>
                    <th>コメント</th>
                    <th>作成日時</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siteReviews as $siteReview)
                    <tr>
                        <td>{{ $siteReview->id }}</td>
                        <td>{{ $siteReview->user->username }}</td>
                        <td>{{ $siteReview->tag ? $siteReview->tag->name : 'タグなし' }}</td>
                        <td>{{ $siteReview->comment }}</td>
                        <td>{{ $siteReview->created_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">レビューはありません</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection