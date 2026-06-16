@blaze(fold: true)

<laraliveui:button
    :attributes="$attributes->class('shrink-0')"
    variant="subtle"
    square
    x-data
    x-on:click="$dispatch('laraliveui-sidebar-toggle')"
    aria-label="{{ __('Toggle sidebar') }}"
    data-laraliveui-sidebar-toggle
/>
