@extends("layouts.app")
@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header container-fluid">
                <div class="row">
                <div class="col-sm">一覧画面</div>
                <form method="get" action="{{ route('todo.index') }}">
                <div class="col-sc d-flex flex-row-reverse bd-highlight">
                    <div><input name="keyword" class="border border-gray-500 py-2" placeholder="キーワードを入力"></div>
                    <div><button class="ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">検索する</button></div>
                </div>
                </form>
                </div>

            </div>
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <a href="{{ url('todo/create') }}" class="btn btn-success mb-3">登録</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>title</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($todos as $todo)
                        <tr>
                            <td>{{ $todo->id }}</td>
                            <td>{{ $todo->title }}</td>
                            <td><a href="{{ url('todo/' . $todo->id) }}" class="btn btn-info">詳細</a></td>
                            <td><a href="{{ url('todo/' . $todo->id . '/edit') }}" class="btn btn-primary">編集</a></td>
                            <td>
                                <form method="POST" action="/todo/{{ $todo->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">削除</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection