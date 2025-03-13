@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                        您已登录
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <button type="button" class="btn btn-primary btn-lg"
                            onclick="window.location.href='{{ route('dojos.create') }}'">
                        新增道场
                    </button>

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">编号</th>
                            <th scope="col">道场名称</th>
                            <th scope="col">位置</th>
                            <th scope="col">描述</th>
                            <th scope="col">创建时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dojos as $dojo)
                            <tr>
                                <th scope="row">{{$dojo->id}}</th>
                                <td>{{$dojo->name}}</td>
                                <td>{{$dojo->location}}</td>
                                <td>{{$dojo->description}}</td>
                                <td>{{$dojo->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

