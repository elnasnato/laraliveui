@blaze(fold: true, unsafe: [
    'name', 'label', 'badge',
    'description', 'description:trailing',
    'label:badge', 'label:aside', 'label:trailing',
    'error:name', 'error:bag', 'error:message', 'error:icon', 'error:nested', 'error:deep',
])

@php
extract(Laraliveui::forwardedAttributes($attributes, [
    'name',
    'descriptionTrailing',
    'description',
    'label',
    'badge',
]));
@endphp

@php $descriptionTrailing = $descriptionTrailing ??= $attributes->pluck('description:trailing'); @endphp

@props([
    'name' => $attributes->whereStartsWith('wire:model')->first(),
    'descriptionTrailing' => null,
    'description' => null,
    'label' => null,
    'badge' => null,
])

<?php if (isset($label) || isset($description) || isset($descriptionTrailing)): ?>
    <?php

        $fieldAttributes = Laraliveui::attributesAfter('field:', $attributes, []);
        $labelAttributes = Laraliveui::attributesAfter('label:', $attributes, ['badge' => $badge]);
        $descriptionAttributes = Laraliveui::attributesAfter('description:', $attributes, []);
        $errorAttributes = Laraliveui::attributesAfter('error:', $attributes, ['name' => $name]);
    ?>
    <laraliveui:field :attributes="$fieldAttributes">
        <?php if (isset($label)): ?>
            <laraliveui:label :attributes="$labelAttributes">{{ $label }}</laraliveui:label>
        <?php endif; ?>

        <?php if (isset($description)): ?>
            <laraliveui:description :attributes="$descriptionAttributes">{{ $description }}</laraliveui:description>
        <?php endif; ?>

        {{ $slot }}

        {{-- We're using ->getAttributes() here because ->all() is only available since Laravel 11... --}}
        @unblaze(scope: ['attributes' => $errorAttributes->getAttributes()])
        <laraliveui:error :attributes="new \Illuminate\View\ComponentAttributeBag($scope['attributes'])" />
        @endunblaze

        <?php if (isset($descriptionTrailing)): ?>
            <laraliveui:description :attributes="$descriptionAttributes">{{ $descriptionTrailing }}</laraliveui:description>
        <?php endif; ?>
    </laraliveui:field>
<?php else: ?>
    {{ $slot }}
<?php endif; ?>
