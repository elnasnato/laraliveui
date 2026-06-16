@blaze(fold: true, unsafe: [
    'name', 'label', 'description',
])

@php
extract(Laraliveui::forwardedattributes($attributes, [
    'name',
    'description',
    'label',
]));
@endphp

@props([
    'name' => $attributes->whereStartsWith('wire:model')->first(),
    'description' => null,
    'label' => null,
])

<?php if (isset($label) || isset($description)): ?>
    <laraliveui:field variant="inline">
        {{ $slot }}

        <?php if (isset($label)): ?>
            <laraliveui:label>{{ $label }}</laraliveui:label>
        <?php endif; ?>

        <?php if (isset($description)): ?>
            <laraliveui:description>{{ $description }}</laraliveui:description>
        <?php endif; ?>

        @unblaze(scope: ['name' => $name])
            <laraliveui:error :name="$scope['name']" />
        @endunblaze
    </laraliveui:field>
<?php else: ?>
    {{ $slot }}
<?php endif; ?>

