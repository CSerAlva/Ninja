<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>

{{--    <script src="https://cdn.bootcdn.net/ajax/libs/socket.io/2.3.0/socket.io.js"></script>--}}

    <script src="{{asset('js/socket.io_v2.3.0.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>

</head>
<body class="antialiased">
<script>
    Echo.channel('messages_Zy')
        .listen('Messages_Zy', (e) => {
            console.log(e);
        });
</script>
</body>
</html>
