@extends('app')

@section('title')
    派遣情報新規登録画面
@endsection

@section('content')
    <form action="{{ route('dispatch_store') }}" method="post">
        @csrf
        <select name="event_select" id="">
            @foreach ($events as $event)
                <option value="{{ $event->name }}">{{ $event->name }}</option>
            @endforeach
        </select>
        <select name="worker_select[]" id="" multiple>
            @foreach ($workers as $worker)
                <option value="{{ $worker->name }}">{{ $worker->name }}</option>
            @endforeach
        </select>
        <input type="text" name="memo">
        <input type="submit" value="登録" class="btn btn-primary">
        @if (session('message'))
            <div class="alert alert-danger">{{ session('message') }}</div>
        @endif
    </form>
@endsection
