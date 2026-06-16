@blaze(fold: true, unsafe: [
    // variant props
    'size',
    // laraliveui:with-field props
    'name', 'label', 'badge',
    'description', 'description:trailing',
    'label:badge', 'label:aside', 'label:trailing',
    'error:name', 'error:bag', 'error:message', 'error:icon', 'error:nested', 'error:deep',
])

@aware([ 'variant', 'size', 'indicator' ])

@props([
    'variant' => 'default',
])

@php
// This prevents variants picked up by `@aware()` from other wrapping components like laraliveui::modal from being used here...
$variant = $variant !== 'default' && Laraliveui::componentExists('radio.variants.' . $variant)
    ? $variant
    : 'default';
@endphp

<laraliveui:delegate-component :component="'radio.variants.' . $variant">{{ $slot }}</laraliveui:delegate-component>
