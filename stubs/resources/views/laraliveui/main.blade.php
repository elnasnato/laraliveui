@blaze(fold: true)

@props([
    'container' => null,
])

@php
$classes = Laraliveui::classes('[grid-area:main]')
    ->add('p-6 lg:p-8')
    ->add('[[data-laraliveui-container]_&]:px-0') // If there is a wrapping container, let IT handle the x padding...
    ->add($container ? 'mx-auto w-full [:where(&)]:max-w-7xl' : '')
    ;
@endphp

<div {{ $attributes->class($classes) }} data-laraliveui-main>
    {{ $slot }}
</div>
