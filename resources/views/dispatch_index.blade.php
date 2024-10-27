@extends('app')

@section('title')
    派遣情報画面
@endsection

@section('content')
    <a href="{{ route('dashboard') }}" class="btn btn-danger">戻る</a>
    <a href="{{ route('dispatch_create') }}" class="btn btn-primary">派遣情報新規登録</a>
    <table class="table table-bordered">
        <tr>
            <th>event_name</th>
            <th>worker_name</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($dispatches as $dispatch)
            <tr>
                <td>{{ $dispatch->event->name }}</td>
                <td>{{ $dispatch->worker->name }}</td>
                <td><a href="{{ route('dispatch_edit', $dispatch->id) }}" class="btn btn-success">編集</a></td>
                <td><a href="{{ route('dispatch_destroy', $dispatch->id) }}" class="btn btn-danger"
                        onclick="return confirm('削除してよろしいですか？')">削除</a></td>
            </tr>
        @endforeach
    </table>
@endsection
