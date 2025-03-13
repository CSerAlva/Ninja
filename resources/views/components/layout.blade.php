<html lang="en">
<head>
    <title>{{ config('app.name', 'Ninja') }}</title>

    @include('layouts.meta')

    @include('components.css')

    <!-- 引入 Vite 生成的 manifest 文件-->
    <!-- Vite SCSS CSS-->
    @vite(['resources/sass/app.scss','resources/css/app.css'])
    <!-- Vite JS -->
    @vite('resources/js/app.js')

</head>
<body>
<div id="app">
    @include('layouts.nav')
    <div class="container">
        <main class="py-4">
            {{ $slot }}
        </main>
    </div>
</div>
</body>

@include('components.js')

</html>
