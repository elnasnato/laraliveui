@props([
    'align' => 'left',
])

@php
$alignClass = match ($align) {
    'center' => 'text-center',
    'right' => 'text-right',
    default => 'text-left',
};
@endphp

<td {{ $attributes->class(['px-4 py-3 text-sm text-zinc-700 dark:text-zinc-300', $alignClass]) }}>
    {{ $slot }}
</td>
