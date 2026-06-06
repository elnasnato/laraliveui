@props([
    'id' => null,
    'open' => false,
])

@php
$itemId = $id ?? 'accordion-' . uniqid();
@endphp

<div x-data="{ itemId: '{{ $itemId }}' }" {{ $attributes->class('border-b border-zinc-200 dark:border-zinc-700') }}>
    {{ $slot }}
</div>
