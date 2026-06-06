@props([
    'sticky' => false,
])

<thead {{ $attributes->class($sticky ? 'sticky top-0' : '') }}>
    <tr class="border-b border-zinc-200 dark:border-zinc-700">
        {{ $slot }}
    </tr>
</thead>
