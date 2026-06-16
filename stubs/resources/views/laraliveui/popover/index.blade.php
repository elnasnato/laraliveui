@props([
    'position' => 'bottom',
    'align' => 'center',
    'offset' => 6,
    'onHover' => false,
])

<div
    x-data="{
        open: false,
        toggle() { this.open = !this.open },
        show() { this.open = true },
        hide() { this.open = false }
    }"
    x-on:click.away="hide()"
    x-on:keydown.escape="hide()"
    {{ $attributes->class('relative inline-block') }}
>
    {{ $slot }}
</div>
