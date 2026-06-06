@blaze(fold: true, unsafe: ['icon:trailing', 'icon:variant'])

@php $iconTrailing ??= $attributes->pluck('icon:trailing'); @endphp
@php $iconVariant ??= $attributes->pluck('icon:variant'); @endphp

@props([
    'iconVariant' => 'mini',
    'iconTrailing' => null,
    'heading' => '',
    'icon' => null,
    'keepOpen' => false,
])

@php
$iconClasses = Laraliveui::classes()
    ->add('ms-auto text-zinc-400 [[data-laraliveui-menu-item]:hover_&]:text-current')
    // When using the outline icon variant, we need to size it down to match the default icon sizes...
    ->add($iconVariant === 'outline' ? 'size-5' : '');
@endphp

<ui-submenu data-laraliveui-menu-submenu>
    <laraliveui:menu.item :$icon :$iconVariant>
        {{ $heading }}

        <x-slot:suffix>
            <?php if (is_string($iconTrailing) && $iconTrailing !== ''): ?>
                <laraliveui:icon :icon="$iconTrailing" :variant="$iconVariant" :class="$iconClasses" />
            <?php elseif ($iconTrailing): ?>
                {{ $iconTrailing }}
            <?php else: ?>
                <laraliveui:icon icon="chevron-right" :variant="$iconVariant" :class="$iconClasses->add('rtl:hidden')" />
                <laraliveui:icon icon="chevron-left" :variant="$iconVariant" :class="$iconClasses->add('hidden rtl:inline')" />
            <?php endif; ?>
        </x-slot:suffix>
    </laraliveui:menu.item>

    <laraliveui:menu :keep-open="$keepOpen">
        {{ $slot }}
    </laraliveui:menu>
</ui-submenu>
