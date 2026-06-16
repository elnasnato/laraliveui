@blaze(fold: true)

@props([
    'variant' => null,
])

@php
$classes = Laraliveui::classes()
    ->add('flex flex-col')
    ->add('overflow-visible min-h-auto')
    ;
@endphp

<nav {{ $attributes->class($classes) }} data-laraliveui-navlist>
    {{ $slot }}
</nav>
