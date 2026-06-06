<div
    x-on:click="toggle()"
    {{ $attributes->class('cursor-pointer') }}
>
    {{ $slot }}
</div>
