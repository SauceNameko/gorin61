@extends('app')

@section('title')
    イベント登録画面
@endsection

@section('content')
    <form action="{{ route('event_update', $event->id) }}" method="post">
        @csrf
        name: <input type="text" name="name" id="" value="{{ $event->name }}">
        place: <input type="text" name="place" id="" value="{{ $event->place }}">
        event_date: <input type="text" name="event_date" id="" value="{{ $event->event_date }}">
        <input type="submit" value="保存" class="btn btn-success">
        @if (session('message'))
            <div class="alert alert-danger">{{ session('message') }}</div>
        @endif
    </form>
@endsection
