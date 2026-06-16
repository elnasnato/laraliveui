@blaze(fold: true)

@php
$classes = Laraliveui::classes('[grid-area:footer]')
    ->add($attributes->has('container') ? '' : 'p-6 lg:p-8')
    ;
@endphp

<div {{ $attributes->class($classes) }} data-laraliveui-footer>
    <laraliveui:with-container :attributes="$attributes->except('class')->class('p-6 lg:p-8')">
        {{ $slot }}
    </laraliveui:with-container>
</div>
