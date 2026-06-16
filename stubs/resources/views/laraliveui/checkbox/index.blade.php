@blaze(fold: true, unsafe: [
    // variant props
    'name', 'accent', 'size', 'label', 'icon', 'description', 'indicator',
    'icon:variant',
])

@aware([ 'variant' ])

@props([
    'variant' => 'default',
])

@php
// This prevents variants picked up by `@aware()` from other wrapping components like laraliveui::modal from being used here...
$variant = $variant !== 'default' && Laraliveui::componentExists('checkbox.variants.' . $variant)
    ? $variant
    : 'default';
@endphp

<laraliveui:delegate-component :component="'checkbox.variants.' . $variant">{{ $slot }}</laraliveui:delegate-component>
