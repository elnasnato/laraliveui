@blaze(fold: true, unsafe: [
    // variant props
    'filterable', 'indicator', 'loading',
])

@aware([ 'variant', 'indicator' ])

@props([
    'variant' => 'default',
])

@php
// This prevents variants picked up by `@aware()` from other wrapping components like laraliveui::modal from being used here...
$variant = $variant !== 'default' && Laraliveui::componentExists('select.variants.' . $variant)
    ? 'custom'
    : 'default';
@endphp

<laraliveui:delegate-component :component="'select.option.variants.' . $variant">{{ $slot }}</laraliveui:delegate-component>
