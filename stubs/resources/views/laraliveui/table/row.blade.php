@props([
    'striped' => false,
    'hover' => false,
])

<tr
    {{ $attributes->class([
        'transition-colors',
        'hover:bg-zinc-50 dark:hover:bg-zinc-800/50' => $hover,
        'even:bg-zinc-50 dark:even:bg-zinc-800/30' => $striped,
    ]) }}
>
    {{ $slot }}
</tr>
