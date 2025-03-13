<script>
    {{--    @section('inline_js')--}}
    {{--        function alertHook(message) {--}}
    {{--            alert('alertHook: ' + message)--}}
    {{--        }--}}
    {{--    @show--}}
</script>

<!-- 在 <body>底部 包含 Bootstrap 的 JS文件 -->
<script src="{{ asset('js/bootstrap/4.3.1/jquery-3.3.1.slim.min.js') }}"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>

<script src="{{ asset('js/bootstrap/4.3.1/popper.min.js') }}"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>

{{--<script src="{{ asset('js/bootstrap/4.3.1/bootstrap@4.3.1.min.js') }}"--}}
{{--        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"--}}
{{--        crossorigin="anonymous"></script>--}}
<script src="{{ asset('js/bootstrap/4.3.1/bootstrap@4.3.1.min.js') }}"></script>

<!-- JQuery 的 JS文件 -->
<script src="{{ asset('js/jquery/jquery-3.5.1.min.js') }}"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
