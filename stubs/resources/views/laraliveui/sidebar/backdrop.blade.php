@blaze(fold: true)

@php
$classes = Laraliveui::classes()
    ->add('z-20 fixed inset-0 bg-black/10 hidden')
    ->add('data-laraliveui-sidebar-on-mobile:not-data-laraliveui-sidebar-collapsed-mobile:block')
    ;
@endphp

<ui-sidebar-toggle {{ $attributes->class($classes) }} data-laraliveui-sidebar-backdrop></ui-sidebar-toggle>
