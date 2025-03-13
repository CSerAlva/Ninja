<!-- Scripts 引入编译后的 JavaScript 文件-->
{{--    <script type="module" src="{{ asset('js/app.js')}}" defer></script>--}}

<!-- Bootstrap@5.2.3 CDN -->
{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>--}}

<!--  Axios unpkg CDN -->
{{--    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>--}}

{{--    <script>--}}
{{--        window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';--}}
{{--    </script>--}}

<!-- Mix -->
{{--    <script src="{{ mix('js/app.js') }}" type="module" defer></script>--}}

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

{{-- https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js--}}
{{-- https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js--}}

<!-- JQuery 的 JS文件 -->
<script src="{{ asset('js/jquery/jquery-3.5.1.min.js') }}"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
