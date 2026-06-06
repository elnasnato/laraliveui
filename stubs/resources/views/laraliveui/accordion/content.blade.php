@props([
    'id' => null,
])

@php
$itemId = $id ?? 'accordion-' . uniqid();
@endphp

<div
    x-show="$root.closest('[x-data]').__x.$data.isOpen(itemId)"
    x-collapse
    {{ $attributes->class('pb-4 text-sm text-zinc-600 dark:text-zinc-400') }}
>
    {{ $slot }}
</div>
