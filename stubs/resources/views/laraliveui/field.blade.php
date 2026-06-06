@blaze(fold: true)

@props([
    'variant' => 'block',
])

@php
$classes = Laraliveui::classes()
    ->add('min-w-0') // This is here to allow nested input elements like laraliveui::input.file to truncate properly...
    ->add('[&:not(:has([data-laraliveui-field])):has([data-laraliveui-control][disabled])>[data-laraliveui-label]]:opacity-50') // Dim labels for fields with no nested fields when a control is disabled...
    ->add('[&:has(>[data-laraliveui-radio-group][disabled])>[data-laraliveui-label]]:opacity-50') // Special case for radio groups because they are nested fields...
    ->add('[&:has(>[data-laraliveui-checkbox-group][disabled])>[data-laraliveui-label]]:opacity-50') // Special case for checkbox groups because they are nested fields...
    ->add(match ($variant) {
        default => 'block',
        'bare' => '[:where(&)]:block',
        'inline' => [
            'grid gap-x-3 gap-y-1.5',
            'has-[[data-laraliveui-label]~[data-laraliveui-control]]:grid-cols-[1fr_auto]',
            'has-[[data-laraliveui-control]~[data-laraliveui-label]]:grid-cols-[auto_1fr]',
            '[&>[data-laraliveui-control]~[data-laraliveui-description]]:row-start-2 [&>[data-laraliveui-control]~[data-laraliveui-description]]:col-start-2',
            '[&>[data-laraliveui-control]~[data-laraliveui-error]]:col-span-2 [&>[data-laraliveui-control]~[data-laraliveui-error]]:mt-1', // Position error messages...
            '[&>[data-laraliveui-label]~[data-laraliveui-control]]:row-start-1 [&>[data-laraliveui-label]~[data-laraliveui-control]]:col-start-2',
        ],
    })
    ->add(match ($variant) {
        default => [ // Adjust spacing around label...
            '*:data-laraliveui-label:mb-3 [&>[data-laraliveui-label]:has(+[data-laraliveui-description])]:mb-2',
        ],
        'bare' => '',
        'inline' => '',
    })
    ->add(match ($variant) {
        default => [ // Adjust spacing around description...
            '[&>[data-laraliveui-label]+[data-laraliveui-description]]:mt-0',
            '[&>[data-laraliveui-label]+[data-laraliveui-description]]:mb-3',
            '[&>*:not([data-laraliveui-label])+[data-laraliveui-description]]:mt-3',
        ],
        'bare' => '',
        'inline' => '',
    });
@endphp

<ui-field {{ $attributes->class($classes) }} data-laraliveui-field>
    {{ $slot }}
</ui-field>
