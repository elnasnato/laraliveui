@blaze(fold: true, memo: true)

@props([
    'iconVariant' => 'mini',
    'size' => null,
])

@php
$attributes = $attributes->merge([
    'variant' => 'subtle',
    'class' => '-me-1',
    'square' => true,
    'size' => null,
]);
@endphp

<laraliveui:button
    :$attributes
    :size="$size === 'sm' || $size === 'xs' ? 'xs' : 'sm'"
    x-data="laraliveuiInputViewable"
    x-on:click="toggle()"
    x-bind:data-viewable-open="open"
    aria-label="{{ __('Toggle password visibility') }}"
>
    <laraliveui:icon.eye-slash :variant="$iconVariant" class="hidden [[data-viewable-open]>&]:block" />
    <laraliveui:icon.eye :variant="$iconVariant" class="block [[data-viewable-open]>&]:hidden" />
</laraliveui:button>
