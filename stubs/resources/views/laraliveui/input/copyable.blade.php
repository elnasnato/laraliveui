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
    x-data="fluxInputCopyable"
    x-on:click="copy()"
    x-bind:data-copyable-copied="copied"
    aria-label="{{ __('Copy to clipboard') }}"
>
    <laraliveui:icon.clipboard-document-check :variant="$iconVariant" class="hidden [[data-copyable-copied]>&]:block" />
    <laraliveui:icon.clipboard-document :variant="$iconVariant" class="block [[data-copyable-copied]>&]:hidden" />
</laraliveui:button>
