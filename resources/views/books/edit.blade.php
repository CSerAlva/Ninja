@extends('layouts.app')

@section('content')
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

                    <form action="{{ route('books.update',$book->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">秘籍名称</label>
                            <input type="text" class="form-control" name="name" value="{{$book->name}}"
                                   id="exampleFormControlInput1"
                                   placeholder="名称必填">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">作者</label>
                            <select class="form-control" name="ninja_id" id="exampleFormControlSelect1">
                                @foreach($ninjas as $ninja)
                                    @if($book->ninja_id == $ninja->id)
                                        <option value="{{$ninja->id}}" selected>{{$ninja->name}}</option>
                                    @else
                                        <option value="{{$ninja->id}}">{{$ninja->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlSelect2" class="form-label">所属道场</label>
                            <select multiple class="form-control" name="dojo_id" id="exampleFormControlSelect2">
                                @foreach($dojos as $dojo)
                                    @if($book->dojo_id == $dojo->id)
                                        <option value="{{$dojo->id}}" selected>{{$dojo->name}}</option>
                                    @else
                                        <option value="{{$dojo->id}}">{{$dojo->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">心法口诀</label>
                            <textarea class="form-control" name="description" rows="3">
                                    {{$book->description}}
                                </textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">点击修改</button>
                    </form>
                    <form action="{{ route('books.destroy',$book->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
