@blaze(fold: true)

@props([
    'legend' => null,
    'description' => null,
])

@php
$classes = Laraliveui::classes()
    ->add('[&[disabled]_[data-laraliveui-label]]:opacity-50') // Dim labels when the fieldset is disabled...
    ->add('[&[disabled]_[data-laraliveui-legend]]:opacity-50') // Dim legend when the fieldset is disabled...

    // Adjust spacing between fields...
    ->add('*:data-laraliveui-field:mb-3')

    // Adjust spacing between fields...
    ->add('*:data-laraliveui-field:mb-3')
    ->add('[&>[data-laraliveui-field]:has(>[data-laraliveui-description])]:mb-4')
    ->add('[&>[data-laraliveui-field]:last-child]:mb-0!')

    // Adjust spacing below legend...
    ->add('[&>[data-laraliveui-legend]]:mb-4')
    ->add('[&>[data-laraliveui-legend]:has(+[data-laraliveui-description])]:mb-2')

    // Adjust spacing below description...
    ->add('[&>[data-laraliveui-legend]+[data-laraliveui-description]]:mb-4')
    ;
@endphp

<fieldset {{ $attributes->class($classes) }} data-laraliveui-fieldset>
    <?php if ($legend): ?>
        <laraliveui:legend>{{ $legend }}</laraliveui:legend>
    <?php endif; ?>

    <?php if ($description): ?>
        <laraliveui:description>{{ $description }}</laraliveui:description>
    <?php endif; ?>

    {{ $slot }}
</fieldset>
