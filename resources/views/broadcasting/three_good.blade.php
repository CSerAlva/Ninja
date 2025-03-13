<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{asset('js/socket.io_v2.3.0.js')}}"></script> {{--Zy--}}
<script src="{{asset('js/app.js')}}"></script>

<button onclick="axios.get('/broadcasting/Leo5')">Send</button>
