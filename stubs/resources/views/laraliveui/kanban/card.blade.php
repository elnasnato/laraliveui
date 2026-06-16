@props([
    'draggable' => true,
])

<div
    @if ($draggable)
        x-on:dragstart="event.dataTransfer.setData('text/plain', '')"
    @endif
    {{ $attributes->class('rounded-lg bg-white dark:bg-zinc-700 p-3 shadow-sm cursor-grab active:cursor-grabbing') }}
>
    {{ $slot }}
</div>
