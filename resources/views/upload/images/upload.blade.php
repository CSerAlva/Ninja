@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if (session('success'))
                        <div class="alert alert-success">
                            <li>{{ session('success') }}</li>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h1>上传一张图片</h1>
                    <form action="{{ route('images.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="name" value="1">
                        <div>
                            <label for="formFileLg" class="form-label">上传图片文件</label>
                            <input class="form-control form-control-lg" id="formFileLg" type="file"
                                   name="image">
                        </div>
                        <button type="submit" class="btn btn-primary">上传</button>
                    </form>
                    @if (isset($newImage) && $newImage)
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{ asset('storage/' . $newImage->path)  }}" class="img-thumbnail"
                                     alt="{{$newImage->name}}">
{{--                                <img src="{{ Storage::url($newImage->path)  }}" class="img-thumbnail"--}}
{{--                                     alt="{{$newImage->name}}">--}}
                            </div>
                        </div>
                        <p>这是最新的图片</p>
                    @else
                        <p>您还没有上传图片</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
