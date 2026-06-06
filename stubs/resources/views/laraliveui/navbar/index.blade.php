@blaze(fold: true)

@props([
    'scrollable' => false,
    'variant' => null,
])

@php
$classes = Laraliveui::classes()
    ->add('flex items-center gap-1 py-3')
    ->add($scrollable ? ['overflow-x-auto overflow-y-hidden'] : [])
    ;
@endphp

<nav {{ $attributes->class($classes) }} data-laraliveui-navbar>
    {{ $slot }}
</nav>
