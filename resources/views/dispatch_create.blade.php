@extends('app')

@section('title')
    派遣情報新規登録画面
@endsection

@section('content')
    <a href="{{ route('dispatch_index') }}" class="btn btn-danger">戻る</a>
    <form action="{{ route('dispatch_store') }}" method="post">
        @csrf
        <select name="event_select" id="">
            @foreach ($events as $event)
                <option value="{{ $event->name }}">{{ $event->name }}</option>
            @endforeach
        </select>
        <select name="workers_select[]" id="" multiple>
            @foreach ($workers as $worker)
                <option value="{{ $worker->name }}">{{ $worker->name }}</option>
            @endforeach
        </select>
        <input type="text" name="memo">
        <input type="submit" value="登録" class="btn btn-primary">
        @if (session('message'))
            <div class="alert alert-danger">{{ session('message') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
    </form>
@endsection
