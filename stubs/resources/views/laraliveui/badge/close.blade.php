@blaze(fold: true, memo: true, unsafe: ['icon:variant'])

@php $iconVariant ??= $attributes->pluck('icon:variant'); @endphp

@props([
    'iconVariant' => 'micro',
    'icon' => 'x-mark',
])

@php
// When using the outline icon variant, we need to size it down to match the default icon sizes...
$iconClasses = Laraliveui::classes()->add($iconVariant === 'outline' ? 'size-4' : '');

$classes = Laraliveui::classes()
    ->add('p-1 -my-1 -me-1 opacity-50 hover:opacity-100')
    ;
@endphp

<button type="button" {{ $attributes->class($classes) }} data-laraliveui-badge-close>
    <?php if (is_string($icon) && $icon !== ''): ?>
        <laraliveui:icon :$icon :variant="$iconVariant" :class="$iconClasses" />
    <?php else: ?>
        {{ $icon }}
    <?php endif; ?>
</button>
