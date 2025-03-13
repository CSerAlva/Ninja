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
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{asset('js/socket.io_v2.3.0.js')}}"></script>
    <script src="{{asset('js/vue_v2.7.16.js')}}"></script>
    <script>
        var roomId = "{{ $roomId }}";
        //6.获取当前连接的 socketId
    </script>
    <script src="{{asset('js/app.js')}}"></script>
    <script>
        var roomId = {{ $roomId }};
        window.Echo.join(`chat.${roomId}`)
            .here((users) => {
                console.log(users);
            })
            .joining((user) => {
                console.log(user.name + ' 来了');
            })
            .leaving((user) => {
                console.log(user.name + ' 走了');
            })
            .listen('NewMessage_Leo', (e) => {
                // .listen('server.created', (e) => { //1.设置广播名称
                    console.log(e.user.name + ": " + e.msg);
            });
        // 7.退出频道 Leo
        // Echo.leaveChannel('orders'); //退出公有频道 控制台 console 中输入
        // Echo.leave('chat.1');        //退出公有、私有和在线频道

        Echo.private('chat')
            .listenForWhisper('typing', (e) => {
                console.log('typing...');
                console.log(e);
            });
    </script>
</head>
<body>
<div id="app">
    <input type="text" id="msg" v-model="msg">
    <button onclick="axios.get('/room/{{ $roomId }}/'+document.getElementById('msg').value)">发送</button>
</div>
</body>
<script>
    new Vue({
        el: '#app',
        data() {
            return {
                msg: ''
            }
        },
        watch: {
            msg(value) {
                Echo.private('chat')
                    .whisper('typing', {
                        roomId: roomId
                    });
            }
        }
    })
</script>
</html>
