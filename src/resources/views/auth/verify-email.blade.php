@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('メールアドレスの確認') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('新しい認証リンクを送信しました。メールをご確認ください。') }}
                    </div>
                    @endif

                    {{ __('続行する前に、メールに記載されている認証リンクをご確認ください。') }}
                    {{ __('メールが届いていない場合は') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('こちらをクリックして再送信してください') }}</button>。
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection