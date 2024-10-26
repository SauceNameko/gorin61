@extends('app')

@section('title')
    人材情報編集画面
@endsection

@section('content')
    <form action="{{ route('worker_update', $worker->id) }}" method="post">
        @csrf
        name: <input type="text" name="name" id="" value="{{ $worker->name }}">
        email: <input type="text" name="email" id="" value="{{ $worker->email }}">
        memo: <input type="text" name="memo" id="" value="{{ $worker->memo }}">
        <input type="submit" value="編集" class="btn btn-primary">
        @if (session('message'))
            <div class="alert alert-danger">{{ session('message') }}</div>
        @endif
    </form>
@endsection
