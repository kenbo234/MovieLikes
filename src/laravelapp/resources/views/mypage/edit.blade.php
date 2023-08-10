@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('プロフィール変更') }}</div>
                    <div class="card-body">
                        <form action="{{ route('mypage.update') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('ユーザー名') }}</label>
                                <div class="col-md-6">
                                    <input type="text" name="username" id="username" value="{{ $user->username }}"
                                        class="form-control" required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('メールアドレス') }}</label>

                                <div class="col-md-6">
                                    <input type="email" name="email" id="email" value="{{ $user->email }}"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('パスワード') }}</label>

                                <div class="col-md-6">
                                    <input type="password" name="password" id="password" class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="zipcode"
                                    class="col-md-4 col-form-label text-md-end">{{ __('郵便番号') }}</label>

                                <div class="col-md-6">
                                    <input type="text" name="zipcode" id="zipcode" value="{{ $user->zipcode }}"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="prefecture"
                                    class="col-md-4 col-form-label text-md-end">{{ __('都道府県') }}</label>

                                <div class="col-md-6">
                                    <input type="text" name="prefecture" id="prefecture" value="{{ $user->prefecture }}"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="city"
                                    class="col-md-4 col-form-label text-md-end">{{ __('市町村') }}</label>

                                <div class="col-md-6">
                                    <input type="text" name="city" id="city" value="{{ $user->city }}"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="housenumber"
                                    class="col-md-4 col-form-label text-md-end">{{ __('番地') }}</label>

                                <div class="col-md-6">
                                    <input type="text" name="housenumber" id="housenumber"
                                        value="{{ $user->housenumber }}" class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="buildingname"
                                    class="col-md-4 col-form-label text-md-end">{{ __('建物名') }}</label>

                                <div class="col-md-6">
                                    <input type="text" name="buildingname" id="buildingname"
                                        value="{{ $user->buildingname }}" class="form-control">
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-6 offset-md-4" >
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('更新する') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
