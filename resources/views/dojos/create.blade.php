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

                    <form action="{{ route('dojos.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">道场名称</label>
                            <input type="text" class="form-control" name="name" id="exampleFormControlInput1"
                                   placeholder="必填">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">位置</label>
                            <input type="text" class="form-control" name="location" id="exampleFormControlInput1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">描述</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">点击新增</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
