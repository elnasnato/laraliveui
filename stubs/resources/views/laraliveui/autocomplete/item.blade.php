@props([
    'value' => null,
])

<button
    type="button"
    x-on:click="$root.closest('[x-data]').__x.$data.select('{{ $value ?? $slot }}')"
    x-on:keydown.enter="$root.closest('[x-data]').__x.$data.select('{{ $value ?? $slot }}')"
    {{ $attributes->class('w-full px-3 py-2 text-left text-sm text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-700 focus:bg-zinc-100 dark:focus:bg-zinc-700 focus:outline-none') }}
    role="option"
    tabindex="-1"
>
    {{ $slot }}
</button>
