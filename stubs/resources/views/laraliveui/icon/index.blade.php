@blaze(fold: true, memo: true)

{{-- Credit: Heroicons (https://heroicons.com) --}}

@props([
    'icon' => null,
    'name' => null,
])

@php
$icon = $name ?? $icon;
@endphp

<laraliveui:delegate-component :component="'icon.' . $icon">{{ $slot }}</laraliveui:delegate-component>
