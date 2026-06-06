@blaze(fold: true, unsafe: ['icon:variant'])

@php $iconVariant ??= $attributes->pluck('icon:variant'); @endphp

@props([
    'separator' => null,
    'iconVariant' => 'mini',
    'icon' => null,
    'href' => null,
])

@php
$classes = Laraliveui::classes()
    ->add('flex items-center')
    ->add('text-sm font-medium')
    ->add('group/breadcrumb')
    ;

$linkClasses = Laraliveui::classes()
    ->add('text-zinc-800 dark:text-white')
    ->add('hover:underline decoration-zinc-800/20 underline-offset-4');

$staticTextClasses = Laraliveui::classes()
    ->add('text-gray-500 dark:text-white/80')
    ;

$separatorClasses = Laraliveui::classes()
    ->add('mx-1 text-zinc-300 dark:text-white/80')
    ->add('group-last/breadcrumb:hidden')
    ;

$iconClasses = Laraliveui::classes()
    // When using the outline icon variant, we need to size it down to match the default icon sizes...
    ->add($iconVariant === 'outline' ? 'size-5' : '')
    ;

[ $styleAttributes, $attributes ] = Laraliveui::splitAttributes($attributes);
@endphp

<div {{ $styleAttributes->class($classes) }} data-laraliveui-breadcrumbs-item>
    <?php if ($href): ?>
        <a {{ $attributes->class($linkClasses) }} href="{{ $href }}">
            <?php if ($icon): ?>
                <laraliveui:icon :$icon :variant="$iconVariant" class="{{ $iconClasses }}" />
            <?php else: ?>
                {{ $slot }}
            <?php endif; ?>
        </a>
    <?php else: ?>
        <div {{ $attributes->class($staticTextClasses) }}>
            <?php if ($icon): ?>
                <laraliveui:icon :$icon :variant="$iconVariant" class="{{ $iconClasses }}" />
            <?php else: ?>
                {{ $slot }}
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ($separator == null): ?>
        <laraliveui:icon icon="chevron-right" variant="mini" class="{{ $separatorClasses->add('rtl:hidden') }}" />
        <laraliveui:icon icon="chevron-left" variant="mini" class="{{ $separatorClasses->add('hidden rtl:inline') }}" />
    <?php elseif (! is_string($separator)): ?>
        {{ $separator }}
    <?php elseif ($separator === 'slash'): ?>
        <laraliveui:icon icon="slash" variant="mini" class="{{ $separatorClasses->add('rtl:-scale-x-100') }}" />
    <?php else: ?>
        <laraliveui:icon :icon="$separator" variant="mini" class="{{ $separatorClasses }}" />
    <?php endif; ?>
</div>
