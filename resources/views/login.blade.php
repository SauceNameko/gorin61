@extends('app')

@section('title')
    ログイン画面
@endsection

@section('content')
    <form action="{{ route('check') }}" method="post">
        @csrf
        ID: <input type="text" name="email" id="">
        PASS: <input type="text" name="password" id="">
        <input type="submit" value="送信" class="btn btn-primary">
        @if (session('message'))
            <div class="alert alert-danger">{{ session('message') }}</div>
        @endif
    </form>
@endsection
