<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat Interface</title>
    <!-- 引入Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        .chat-message {
            overflow-y: scroll;
            height: 300px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card mt-5">
                <div class="card-header">
                    在线聊天室
                    <span style="float:right; "></span>
                </div>
                <div class="card-body chat-message">
                    33<!-- 聊天信息区域 -->
                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <form id="myForm">
                            @csrf
                            @method('POST')
                            <input type="text" class="form-control" placeholder="Type your message here..."
                                   id="messageInput" id="msg" name="msg" v-model="msg">
                            <input type="hidden" id="roomId" name='roomId' value="{{ $roomId }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" id="sendButton">发送</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 引入Bootstrap JS -->
<script src="{{ asset('js/bootstrap/jquery-3.3.1.slim.min.js') }}"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="{{ asset('js/bootstrap/popper.min.js') }}"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

<!-- 引入Socket.io JS -->
<script src="{{ asset('js/socket.io_v2.3.0.js') }}"></script>

<!-- 引入Vue JS -->
<script src="{{ asset('js/vue_v2.7.16.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        // 发送消息的函数
        $('#sendButton').click(function (e) {
            e.preventDefault();
            var message = $('#messageInput').val();
            var roomId = $('#roomId').val();
            // 发送PUT请求
            var formData = $('#myForm').serialize(); // 序列化表单数据

            $('.chat-message').append('<div class="alert alert-primary">' + message + '</div>');
            $('#messageInput').val('');

            var url = '/room/' + roomId; // 生成路由URL
{{--            var url = {{ route('room.msg', ['roomId' => $roomId]) }}; // 生成路由URL--}}

            // 提交表单
            $.ajax({
                type: 'PUT',
                url: url,
                data: formData,
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        // 成功后的操作，例如：更新UI或显示消息
                        // console.log('发送消息成功');
                        console.log(response.data);
                    }
                },
                error: function (xhr, status, error) {
                    // 错误回调
                    console.error('An error occurred:', status, error);
                }
            })
        })
    });
</script>
<script>
    var roomId = {{ $roomId }};
    window.Echo.join(`chat.${roomId}`)
        .here((users) => {
            console.log(users);
            $('span').text('实时在线人数:' + users.length);
        })
        .joining((user) => {
            $('.chat-message').append('<div class="alert alert-dark">' + user.name + ' 来了' + '</div>');
        })
        .leaving((user) => {
            $('.chat-message').append('<div class="alert alert-info">' + user.name + ' 走了' + '</div>');
        })
        .listen('NewMessage_Leo', (e) => {
            // .listen('server.created', (e) => { //1.设置广播名称
            console.log(e.user.name + ": " + e.msg);
        });

    Echo.private('chat')
        .listenForWhisper('typing', (e) => {
            console.log('typing...');
            console.log(e);
        });
</script>
</body>
</html>
