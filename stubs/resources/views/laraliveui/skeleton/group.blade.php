@blaze(fold: true)

@props([
    'animate' => null,
])

<div {{ $attributes }} data-laraliveui-skeleton-group>
    {{ $slot }}
</div>