@extends('app')

@section('title')
    派遣情報新規登録画面
@endsection

@section('content')
    <a href="{{ route('dispatch_index') }}" class="btn btn-danger">戻る</a>
    <form action="{{ route('dispatch_update', $dispatch->id) }}" method="post">
        @csrf
        <select name="event_select" id="">
            @foreach ($events as $event)
                <option value="{{ $event->name }}" {{ $dispatch->event->name == $event->name ? 'selected' : '' }}>
                    {{ $event->name }}</option>
            @endforeach
        </select>
        <select name="worker_select" id="">
            @foreach ($workers as $worker)
                <option value="{{ $worker->name }}" {{ $dispatch->worker->name == $worker->name ? 'selected' : '' }}>
                    {{ $worker->name }}</option>
            @endforeach
        </select>
        <input type="text" name="memo">
        <input type="submit" value="編集" class="btn btn-success">
        @if (session('message'))
            <div class="alert alert-danger">{{ session('message') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
    </form>
@endsection
