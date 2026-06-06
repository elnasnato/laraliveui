@blaze(fold: true, unsafe: ['tooltip:position', 'tooltip:kbd', 'tooltip'])

@php
extract(Laraliveui::forwardedAttributes($attributes, [
    'tooltipPosition',
    'tooltipKbd',
    'tooltip',
]));
@endphp

@php $tooltipPosition = $tooltipPosition ??= $attributes->pluck('tooltip:position'); @endphp
@php $tooltipKbd = $tooltipKbd ??= $attributes->pluck('tooltip:kbd'); @endphp
@php $tooltip = $tooltip ??= $attributes->pluck('tooltip'); @endphp

@props([
    'tooltipPosition' => 'top',
    'tooltipKbd' => null,
    'tooltip' => null,
])

<?php if ($tooltip): ?>
    <laraliveui:tooltip :content="$tooltip" :position="$tooltipPosition" :kbd="$tooltipKbd">
        {{ $slot }}
    </laraliveui:tooltip>
<?php else: ?>
    {{ $slot }}
<?php endif; ?>
