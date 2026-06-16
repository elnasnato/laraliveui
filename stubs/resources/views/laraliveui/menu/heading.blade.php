@blaze(fold: true)

@php
$classes = Laraliveui::classes([
    'p-2 pb-1 w-full',
    'flex items-center',
    'text-start text-xs font-medium',
    'text-zinc-500 font-medium dark:text-zinc-300',
]);
@endphp

<div {{ $attributes->class($classes) }} data-laraliveui-menu-heading>
    <div class="w-7 hidden [[data-laraliveui-menu]:has(>[data-laraliveui-menu-item-has-icon])_&]:block"></div>

    <div>{{ $slot }}</div>
</div>
