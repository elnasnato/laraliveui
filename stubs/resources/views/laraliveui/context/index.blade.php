@props([
    'position' => 'bottom-start',
])

<div
    x-data="{ open: false, x: 0, y: 0 }"
    x-on:contextmenu.prevent="open = true; x = $event.clientX; y = $event.clientY"
    x-on:click.away="open = false"
    x-on:keydown.escape="open = false"
    {{ $attributes }}
>
    {{ $slot }}
</div>
