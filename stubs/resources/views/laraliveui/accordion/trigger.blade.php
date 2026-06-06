@props([
    'id' => null,
])

@php
$itemId = $id ?? 'accordion-' . uniqid();
@endphp

<button
    x-on:click="$root.closest('[x-data]').__x.$data.toggle(itemId)"
    type="button"
    {{ $attributes->class('flex w-full items-center justify-between py-4 text-left text-sm font-medium text-zinc-800 dark:text-white') }}
>
    <span>{{ $slot }}</span>
    <svg class="h-4 w-4 shrink-0 text-zinc-500 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" x-bind:class="($root.closest('[x-data]').__x.$data.isOpen(itemId)) ? 'rotate-180' : ''">
        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
    </svg>
</button>
