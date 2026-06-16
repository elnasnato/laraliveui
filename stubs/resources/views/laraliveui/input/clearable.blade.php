@blaze(fold: true, memo: true)

@props([
    'iconVariant' => 'mini',
    'size' => null,
])

@php
$attributes = $attributes->merge([
    'variant' => 'subtle',
    'class' => '-me-1 [[data-laraliveui-input]:has(input:placeholder-shown)_&]:hidden [[data-laraliveui-input]:has(input[disabled])_&]:hidden',
    'square' => true,
    'size' => null,
]);
@endphp

<laraliveui:button
    :$attributes
    :size="$size === 'sm' || $size === 'xs' ? 'xs' : 'sm'"
    x-data="laraliveuiInputClearable"
    x-on:click="clear()"
    tabindex="-1"
    aria-label="{{ __('Clear input') }}"
    data-laraliveui-clear-button
>
    <laraliveui:icon.x-mark :variant="$iconVariant" />
</laraliveui:button>
