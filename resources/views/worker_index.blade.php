@extends('app')

@section('title')
    人材情報画面
@endsection

@section('content')
    <a href="{{ route('worker_create') }}" class="btn btn-primary">人材情報新規登録</a>
    <table class="table table-bordered">
        <tr>
            <th>name</th>
            <th>email</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($workers as $worker)
            <tr>
                <td>{{ $worker->name }}</td>
                <td>{{ $worker->email }}</td>
                <td><a href="{{ route('worker_edit', $worker->id) }}" class="btn btn-success">編集</a></td>
                <td><a href="{{ route('worker_destroy', $worker->id) }}" class="btn btn-danger"
                        onclick="return confirm('削除してよろしいですか？')">削除</a></td>
            </tr>
        @endforeach
    </table>
@endsection
