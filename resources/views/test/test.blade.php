<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="{{asset('js/socket.io_v2.3.0.js')}}"></script>
<script src="{{mix('js/app.js')}}"></script> {{--Leo 把客户端带进来--}}
<body>
 <div>
     <span>{{ $message }}</span>
 </div>
</body>
