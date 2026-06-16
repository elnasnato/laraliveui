@blaze(fold: true, unsafe: [
    // laraliveui:with-inline-field props
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

<?php if ($label || $description): ?>
    <laraliveui:field variant="inline">
        <?php if ($label): ?>
            <laraliveui:label>{{ $label }}</laraliveui:label>
        <?php endif; ?>

        <?php if ($description): ?>
            <laraliveui:description>{{ $description }}</laraliveui:description>
        <?php endif; ?>

        {{ $slot }}

        @unblaze(scope: ['name' => $name])
            <laraliveui:error :name="$scope['name']" />
        @endunblaze
    </laraliveui:field>
<?php else: ?>
    {{ $slot }}
<?php endif; ?>

