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

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('books.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="1">
                        <div class="mb-3">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>
                                                {{$error}}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">秘籍名称</label>
                            <input type="text" class="form-control" name="name" id="exampleFormControlInput1"
                                   placeholder="名称必填" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">作者</label>
                            <select class="form-control" name="ninja_id" id="exampleFormControlSelect1">
                                @foreach($ninjas as $ninja)
                                    <option value="{{$ninja->id}}">{{$ninja->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlSelect2" class="form-label">所属道场</label>
                            <select multiple class="form-control" name="dojo_id" id="exampleFormControlSelect2">
                                @foreach($dojos as $dojo)
                                    <option value="{{$dojo->id}}">{{$dojo->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">心法口诀</label>
                            <textarea class="form-control" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlFile1" class="form-label">电子版</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                        <button type="submit" class="btn btn-primary">点击新增</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
