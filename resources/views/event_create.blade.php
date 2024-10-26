@extends('app')

@section('title')
    イベント登録画面
@endsection

@section('content')
    <form action="{{ route('event_store') }}" method="post">
        @csrf
        name: <input type="text" name="name" id="">
        place: <input type="text" name="place" id="">
        event_date: <input type="text" name="event_date" id="">
        <input type="submit" value="登録" class="btn btn-primary">
        @if (session('message'))
            <div class="alert alert-danger">{{ session('message') }}</div>
        @endif
    </form>
@endsection
