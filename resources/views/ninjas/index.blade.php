<x-layout>
    <h1>432</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('忍者管理') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}  {{--  您已登录 --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h2>{{ session('message') }}</h2>

                    {{--    如果没有权限不让更新--}}
                    @can('update',$ninjas)
                        <h2>编辑</h2>
                    @endcan
                    {{--    如果没有权限不让删除--}}
                    @can('delete',$ninjas)
                        <h2>删除</h2>
                    @endcan

                    @if($greeting == 'hi')
                        <table class="table">
                            <thead>
                            <div class="">
                                <a href="{{ route('ninjas.index') }}"
                                   class="btn btn-primary btn-lg float-left">所有忍者</a>
                                <a href="{{ route('ninjas.create') }}"
                                   class="btn btn-success btn-lg float-right">新增忍者</a>
                            </div>
                            </thead>
                            <tbody>
                            <ul>
                                @foreach($ninjas as $ninja)
                                    <li>
                                        <div>
                                            {{--                                        <x-card href="/ninjas/{{ $ninja['id'] }}" :highlight="true">--}}
                                            <x-detail href="{{ route('ninjas.show',$ninja) }}"
                                                      :highlight="$ninja['skill'] > 50">
                                                <div style="">
                                                    <div style="float: left">
                                                        <a href="{{ route('ninjas.edit',$ninja) }}"><h3>{{ $ninja['name'] }}</h3></a>
                                                    </div>
                                                    <div style="float: right">
                                                        <h2>{{ $ninja->dojo->name }}</h2>
                                                    </div>
                                                </div>
                                            </x-detail>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                @if($ninjas->currentPage() > 1)
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $ninjas->previousPageUrl() }}"
                                           aria-label="Previous">
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

                                @for($i=1;$i<=$ninjas->lastPage();$i++)
                                    <li class="page-item {{ ($ninjas->currentPage() == $i) ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $ninjas->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                @if($ninjas->currentPage() < $ninjas->lastPage())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $ninjas->nextPageUrl() }}" aria-label="Next">
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

                        {{--                        通过数据对象 调用links 方法 显示数据码 --}}
                        {{--                        {{ $ninjas->links() }}--}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>
