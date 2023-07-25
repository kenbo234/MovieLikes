@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>購入履歴</h1>
        @if ($purchases->isEmpty())
            <p>購入履歴はありません。</p>
        @else
            <ul>
                @foreach ($purchases as $purchase)
                    <li>
                        購入日時: {{ $purchase->purchased_at }}
                        商品名: {{ $purchase->product->name }}
                        価格: {{ $purchase->price }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection