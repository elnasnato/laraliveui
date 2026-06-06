@blaze(fold: true)

@props([
    'collapsible' => null,
    'stashable' => null, // @deprecated
    'sticky' => null,
])

@php
$collapsibleOnMobile = $stashable || $collapsible === 'mobile' || $collapsible === true;

if ($stashable && $collapsible === null) {
    $collapsible = 'mobile';
}

$classes = Laraliveui::classes('[grid-area:sidebar]')
    ->add('z-1 flex flex-col gap-4 [:where(&)]:w-64 p-4')
    ->add('data-laraliveui-sidebar-collapsed-desktop:w-14 data-laraliveui-sidebar-collapsed-desktop:px-2')
    ->add('data-laraliveui-sidebar-collapsed-desktop:cursor-e-resize rtl:data-laraliveui-sidebar-collapsed-desktop:cursor-w-resize')
    ;

if ($sticky) {
    $attributes = $attributes->merge([
        'class' => 'max-h-dvh overflow-y-auto overscroll-contain',
    ]);
}

if ($collapsibleOnMobile) {
    $attributes = $attributes->merge([
        // Prevent mobile sidebar from transitioning out on load...
        'x-init' => '$el.classList.add(\'transition-transform\')',
    ])->class([
        // Prevent mobile sidebar from flashing on-load...
        'max-lg:data-laraliveui-sidebar-cloak:hidden',
        'data-laraliveui-sidebar-on-mobile:data-laraliveui-sidebar-collapsed-mobile:-translate-x-full data-laraliveui-sidebar-on-mobile:data-laraliveui-sidebar-collapsed-mobile:rtl:translate-x-full',
        'z-20! data-laraliveui-sidebar-on-mobile:start-0! data-laraliveui-sidebar-on-mobile:fixed! data-laraliveui-sidebar-on-mobile:top-0! data-laraliveui-sidebar-on-mobile:min-h-dvh! data-laraliveui-sidebar-on-mobile:max-h-dvh!'
    ]);
}
@endphp

<?php if ($collapsibleOnMobile): ?>
    <laraliveui:sidebar.backdrop />
<?php endif; ?>

<ui-sidebar
    {{ $attributes->class($classes) }}
    @if ($collapsible) collapsible="{{ $collapsible === 'mobile' ? 'mobile' : 'true' }}" @endif
    @if ($stashable) stashable @endif
    @if ($sticky) sticky @endif
    x-data
    data-laraliveui-sidebar-cloak
    data-laraliveui-sidebar
>
    {{ $slot }}
</ui-sidebar>
