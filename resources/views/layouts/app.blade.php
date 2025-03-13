<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('layouts.meta')

    @include('layouts.css')

    <!-- 引入 Vite 生成的 manifest 文件-->
    <!-- Vite SCSS-->
    @vite(['resources/sass/app.scss'])
    <!-- Vite JS -->
    @vite(['resources/js/app.js'])

    <!-- 确保在 Blade 模板中引入了编译后的 JavaScript 文件 -->
{{--    <script src="{{ asset('js/app.js') }}"></script>--}}

</head>
<body>
<div id="app">
    @include('layouts.nav')
    <div class="container">
        <main class="py-4">
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>
</div>
</body>

@include('layouts.js')

</html>
