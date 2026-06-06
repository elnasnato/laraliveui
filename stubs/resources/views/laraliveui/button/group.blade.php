@blaze(fold: true)

@php
$classes = Laraliveui::classes()
    ->add('flex group/button')
    ->add([
        // With the external borders, let's always make sure the first and last children have outside borders.
        // For internal borders, we will ensure that all left borders are removed, but the right borders remain.
        // But when there is a input groupsuffix, then there should be no right internal border.
        // That way we shouldn't ever have a double border...

        // All inputs borders...
        '[&>[data-laraliveui-input]:last-child:not(:first-child)>[data-laraliveui-group-target]:not([data-invalid])]:border-s-0',
        '[&>[data-laraliveui-input]:not(:first-child):not(:last-child)>[data-laraliveui-group-target]:not([data-invalid])]:border-s-0',
        '[&>[data-laraliveui-input]:has(+[data-laraliveui-input-group-suffix])>[data-laraliveui-group-target]:not([data-invalid])]:border-e-0',

        // Selects and date pickers borders...
        '[&>*:last-child:not(:first-child)>[data-laraliveui-group-target]:not([data-invalid])]:border-s-0',
        '[&>*:not(:first-child):not(:last-child)>[data-laraliveui-group-target]:not([data-invalid])]:border-s-0',
        '[&>*:has(+[data-laraliveui-input-group-suffix])>[data-laraliveui-group-target]:not([data-invalid])]:border-e-0',

        // Buttons borders...
        '[&>[data-laraliveui-group-target]:last-child:not(:first-child)]:border-s-0',
        '[&>[data-laraliveui-group-target]:not(:first-child):not(:last-child)]:border-s-0',
        '[&>[data-laraliveui-group-target]:has(+[data-laraliveui-input-group-suffix])]:border-e-0',

        // "Weld" the borders of inputs together by overriding their border radiuses...
        '[&>[data-laraliveui-group-target]:not(:first-child):not(:last-child)]:rounded-none',
        '[&>[data-laraliveui-group-target]:first-child:not(:last-child)]:rounded-e-none',
        '[&>[data-laraliveui-group-target]:last-child:not(:first-child)]:rounded-s-none',

        // "Weld" borders for sub-children of group targets (button element inside ui-select element, etc.)...
        '[&>*:not(:first-child):not(:last-child):not(:only-child)>[data-laraliveui-group-target]]:rounded-none',
        '[&>*:first-child:not(:last-child)>[data-laraliveui-group-target]]:rounded-e-none',
        '[&>*:last-child:not(:first-child)>[data-laraliveui-group-target]]:rounded-s-none',

        // "Weld" borders for sub-sub-children of group targets (input element inside div inside ui-select element (combobox))...
        '[&>*:not(:first-child):not(:last-child):not(:only-child)>[data-laraliveui-input]>[data-laraliveui-group-target]]:rounded-none',
        '[&>*:first-child:not(:last-child)>[data-laraliveui-input]>[data-laraliveui-group-target]]:rounded-e-none',
        '[&>*:last-child:not(:first-child)>[data-laraliveui-input]>[data-laraliveui-group-target]]:rounded-s-none',

        // "Weld" borders for sub-children wrapped in tooltips (button inside tooltip inside modal trigger, etc.)...
        '[&>*:not(:first-child):not(:last-child):not(:only-child)>[data-laraliveui-tooltip]>[data-laraliveui-group-target]]:rounded-none',
        '[&>*:first-child:not(:last-child)>[data-laraliveui-tooltip]>[data-laraliveui-group-target]]:rounded-e-none',
        '[&>*:last-child:not(:first-child)>[data-laraliveui-tooltip]>[data-laraliveui-group-target]]:rounded-s-none',

        // Borders for sub-children wrapped in tooltips...
        '[&>*:last-child:not(:first-child)>[data-laraliveui-tooltip]>[data-laraliveui-group-target]:not([data-invalid])]:border-s-0',
        '[&>*:not(:first-child):not(:last-child)>[data-laraliveui-tooltip]>[data-laraliveui-group-target]:not([data-invalid])]:border-s-0',
    ])
    ;
@endphp

<div {{ $attributes->class($classes) }} data-laraliveui-button-group>
    {{ $slot }}
</div>
