@props([
    'columns' => [],
])

<div {{ $attributes->class('flex gap-4 overflow-x-auto pb-4') }}>
    {{ $slot }}
</div>
