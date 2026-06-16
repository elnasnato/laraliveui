@blaze(fold: true)

@props([
    'heading' => null,
])

@php
$classes = Laraliveui::classes()
    ->add('-mx-[.3125rem] px-[.3125rem]')
    ->add('[&+&>[data-laraliveui-menu-separator-top]]:hidden [&:first-child>[data-laraliveui-menu-separator-top]]:hidden [&:last-child>[data-laraliveui-menu-separator-bottom]]:hidden')
    ;
@endphp

<div {{ $attributes->class($classes) }} role="group" data-laraliveui-menu-group>
    <laraliveui:menu.separator data-laraliveui-menu-separator-top />

    <?php if ($heading): ?>
        <laraliveui:menu.heading>{{ $heading }}</laraliveui:menu.heading>
    <?php endif; ?>

    {{ $slot }}

    <laraliveui:menu.separator data-laraliveui-menu-separator-bottom />
</div>
