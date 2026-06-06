@props([
    'name' => null,
])

<div
    x-show="selectedTab === '{{ $name ?? Str::slug($slot ?? 'panel') }}'"
    role="tabpanel"
    {{ $attributes->class('py-4') }}
>
    {{ $slot }}
</div>
