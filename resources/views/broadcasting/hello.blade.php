<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="{{asset('js/socket.io_v2.3.0.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script> {{--Leo 把客户端带进来--}}
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
        });
</script>

