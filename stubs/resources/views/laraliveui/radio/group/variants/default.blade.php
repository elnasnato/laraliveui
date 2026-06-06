@blaze(fold: true, unsafe: [
    // laraliveui:with-field props
    'name', 'label', 'badge',
    'description', 'description:trailing',
    'label:badge', 'label:aside', 'label:trailing',
    'error:name', 'error:bag', 'error:message', 'error:icon', 'error:nested', 'error:deep',
])


@props([
    'name' => null,
    'variant' => null,
])

@php
// We only want to show the name attribute it has been set manually
// but not if it has been set from the `wire:model` attribute...
$showName = isset($name);
if (! isset($name)) {
    $name = $attributes->whereStartsWith('wire:model')->first();
}

$classes = Laraliveui::classes()
    // Adjust spacing between fields...
    ->add('*:data-laraliveui-field:mb-3')
    ->add('[&>[data-laraliveui-field]:has(>[data-laraliveui-description])]:mb-4')
    ->add('[&>[data-laraliveui-field]:last-child]:mb-0!')
    ;
@endphp

<laraliveui:with-field :$attributes>
    <ui-radio-group {{ $attributes->class($classes) }} @if($showName) name="{{ $name }}" @endif data-laraliveui-radio-group>
        {{ $slot }}
    </ui-radio-group>
</laraliveui:with-field>
