@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('秘籍管理') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}  {{--  您已登录 --}}
                            <a href="{{ route('room.nowChat',\auth()->id()) }}">进入在线聊天室</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <a href="{{ route('books.create') }}" class="btn btn-primary btn-lg">新增秘籍</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <form action="{{ route('books.index') }}" method='GET'>
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">秘籍名称查询</label>
                            <input type="text" class="form-control" name="keyword" id="exampleFormControlInput1"
                                   placeholder="支持模糊查询">
                        </div>
                        <button type="submit" class="btn btn-secondary">提交</button>
                    </form>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">编号</th>
                            <th scope="col">秘籍名称</th>
                            <th scope="col">道场</th>
                            <th scope="col">作者</th>
                            <th scope="col">内容</th>
                            <th scope="col">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($books as $book)
                            <tr>
                                <th scope="row">{{ $book->id }}</th>
                                <td>{{ $book->name }}</td>
                                <td>{{ $book->dojo->name }}</td>
                                <td>{{ $book->ninja->name }}</td>
                                <td>{{ $book->description }}</td>
                                <td>
                                    <a href="{{ route('books.edit',$book->id) }}" class="btn btn-warning">编辑</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            @if($books->currentPage() > 1)
                                <li class="page-item">
                                    <a class="page-link" href="{{ $books->previousPageUrl() }}" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        上一页
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                        <span aria-hidden="true">&laquo;</span>
                                        无上一页
                                    </a>
                                </li>
                            @endif

                            @for($i=1;$i<=$books->lastPage();$i++)
                                <li class="page-item {{ ($books->currentPage() == $i) ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $books->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            @if($books->currentPage() < $books->lastPage())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $books->nextPageUrl() }}" aria-label="Next">
                                        下一页
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                        无下一页
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('inline_js')
    @parent
    alertHook('index.blade.php')
@endsection
