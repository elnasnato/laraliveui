@props([
    'position' => 'left',
])

<ol {{ $attributes->class('relative border-s border-zinc-200 dark:border-zinc-700 ms-3') }}>
    {{ $slot }}
</ol>
