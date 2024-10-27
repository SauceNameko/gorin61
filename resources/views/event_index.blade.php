@extends('app')

@section('title')
    イベント情報画面
@endsection

@section('content')
    <a href="{{ route('event_create') }}" class="btn btn-primary">イベント情報新規登録</a>
    <a href="{{ route('dashboard') }}" class="btn btn-danger">戻る</a>
    <table class="table table-bordered">
        <tr>
            <th>name</th>
            <th>place</th>
            <th>event_date</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($events as $event)
            <tr>
                <td>{{ $event->name }}</td>
                <td>{{ $event->place }}</td>
                <td>{{ $event->event_date }}</td>
                <td><a href="{{ route('event_edit', $event->id) }}" class="btn btn-success">編集</a></td>
                <td><a href="{{ route('event_destroy', $event->id) }}" class="btn btn-danger"
                        onclick="return confirm('削除してよろしいですか？')">削除</a></td>
            </tr>
        @endforeach
    </table>
@endsection
