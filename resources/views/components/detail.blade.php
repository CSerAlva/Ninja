@props(['highlight' => false])

<div @class(['highlight' => $highlight,'card'])>
    {{ $slot }}
    <a href="{{ $attributes->get('href') }}" class="btn">查看详情</a>
</div>
