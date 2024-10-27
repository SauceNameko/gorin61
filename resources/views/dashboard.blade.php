@extends('app')

@section('title')
    ダッシュボード画面
@endsection

@section('content')
    <a href="{{ route('logout') }}" class="btn btn-danger">ログアウト</a>
    <a href="{{ route('event_index') }}" class="btn btn-primary">イベント情報</a>
    <a href="{{ route('worker_index') }}" class="btn btn-primary">人材情報</a>
    <a href="{{ route('dispatch_index') }}" class="btn btn-primary">派遣情報</a>
   
@endsection
