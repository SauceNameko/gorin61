@extends('app')

@section('title')
    人材情報登録画面
@endsection

@section('content')
    <a href="{{ route('worker_index') }}" class="btn btn-danger">戻る</a>
    <form action="{{ route('worker_store') }}" method="post">
        @csrf
        name: <input type="text" name="name" id="">
        email: <input type="text" name="email" id="">
        password: <input type="text" name="password" id="">
        memo: <input type="text" name="memo" id="">
        <input type="submit" value="登録" class="btn btn-primary">
        @if (session('message'))
            <div class="alert alert-danger">{{ session('message') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
    </form>
@endsection
