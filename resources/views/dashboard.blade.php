@extends('app')

@section('title')
    ダッシュボード画面
@endsection

@section('content')
    <a href="{{ route('logout') }}" class="btn btn-danger">ログアウト</a>
    <a href="{{ route('event_create') }}" class="btn btn-primary">イベント情報新規登録</a>
    <a href="{{ route('worker_index') }}" class="btn btn-primary">人材情報</a>
    <a href="{{ route('dispatch_index') }}" class="btn btn-primary">派遣情報</a>
    <table class="table table-bordered">
        <tr>
            <th>name</th>
            <th>email</th>
            <th>password</th>
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
