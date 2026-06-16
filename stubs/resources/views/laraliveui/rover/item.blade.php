@props([
    'disabled' => false,
    'index' => null,
])

<div
    data-rover-item
    role="option"
    tabindex="-1"
    x-on:click="$root.closest('[x-data]').__x.$data.handleItemClick({{ $index ?? 'Array.from($root.closest(\'[x-data]\').querySelectorAll(\'[data-rover-item]\')).indexOf($el)' }})"
    @disabled($disabled)
    {{ $attributes->class([
        'outline-none',
        'opacity-50 pointer-events-none' => $disabled,
        'focus:bg-zinc-100 dark:focus:bg-zinc-700 focus:outline-none' => !$disabled,
    ]) }}
>
    {{ $slot }}
</div>
