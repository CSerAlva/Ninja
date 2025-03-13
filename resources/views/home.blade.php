@extends('layouts.app')

@section('content')
    <h1><span>h1 、span</span></h1>
    <div id="vue-app">
        <hello-world></hello-world>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('管理') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ Auth::user()->name .' '. __('You are logged in!') }}  {{--  您已登录 --}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Ninja管理</h5>
                                <p class="card-text">忍者管理可以帮助您快速管理新增忍者等操作。</p>
                                <a id="ninja" href="{{route('ninjas.index')}}" class="btn btn-primary">Go</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Dojo管理</h5>
                                <p class="card-text">道场管理可以帮助您快速完成新增道场等操作。</p>
                                <a href="{{route('dojos.index')}}" class="btn btn-primary">Go</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Book管理</h5>
                                <p class="card-text">秘籍管理可以帮助您快速完成新增书籍等操作。</p>
                                <a href="{{route('books.index')}}" class="btn btn-primary">Go</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
