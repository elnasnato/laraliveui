@props([
    'variant' => 'tabs',
])

@php
$classes = match($variant) {
    'tabs' => 'flex border-b border-zinc-200 dark:border-zinc-700',
    'pills' => 'flex flex-wrap gap-1',
    default => 'flex border-b border-zinc-200 dark:border-zinc-700',
};
@endphp

<div {{ $attributes->class($classes) }} role="tablist">
    {{ $slot }}
</div>
