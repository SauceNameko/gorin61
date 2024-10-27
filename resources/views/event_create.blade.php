@extends('app')

@section('title')
    イベント登録画面
@endsection

@section('content')
    <a href="{{ route('event_index') }}" class="btn btn-danger">戻る</a>
    <form action="{{ route('event_store') }}" method="post">
        @csrf
        name: <input type="text" name="name" id="">
        place: <input type="text" name="place" id="">
        event_date: <input type="text" name="event_date" id="">
        <input type="submit" value="登録" class="btn btn-primary">
        @if (session('message'))
            <div class="alert alert-danger">{{ session('message') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
    </form>
@endsection
