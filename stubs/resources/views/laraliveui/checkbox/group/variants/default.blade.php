@blaze(fold: true, unsafe: [
    // laraliveui:with-field props
    'name', 'label', 'badge',
    'description', 'description:trailing',
    'label:badge', 'label:aside', 'label:trailing',
    'error:name', 'error:bag', 'error:message', 'error:icon', 'error:nested', 'error:deep',
])


@php
$classes = Laraliveui::classes()
    ->add('*:data-laraliveui-field:mb-3')
    ->add('[&>[data-laraliveui-field]:has(>[data-laraliveui-description])]:mb-4')
    ->add('[&>[data-laraliveui-field]:last-child]:mb-0!')
    ;

// Support adding the .self modifier to the wire:model directive...
if (($wireModel = $attributes->wire('model')) && $wireModel->directive && ! $wireModel->hasModifier('self')) {
    unset($attributes[$wireModel->directive]);

    $wireModel->directive .= '.self';

    $attributes = $attributes->merge([$wireModel->directive => $wireModel->value]);
}
@endphp

<laraliveui:with-field :$attributes>
    <ui-checkbox-group {{ $attributes->class($classes) }} data-laraliveui-checkbox-group>
        {{ $slot }}
    </ui-checkbox-group>
</laraliveui:with-field>
