@props([
    'position' => 'bottom',
    'align' => 'center',
    'offset' => 6,
])

<div
    x-show="open"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-75"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    x-anchor.{{ $position }}.{{ $align }}.offset.{{ $offset }}="$el.parentElement.querySelector('[x-on\\:click]')"
    style="display: none;"
    {{ $attributes->class('z-50 rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 p-3 shadow-lg') }}
>
    {{ $slot }}
</div>
