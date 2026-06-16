@blaze(fold: true)

@props([
    'container' => null,
])

<?php if ($container): ?>
    <laraliveui:container class="{!! $attributes->get('class') !!}">
        {{ $slot }}
    </laraliveui:container>
<?php else: ?>
    {{ $slot }}
<?php endif; ?>
