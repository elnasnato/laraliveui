@blaze(fold: true)

@php $srOnly = $srOnly ??= $attributes->pluck('sr-only'); @endphp

@props([
    'srOnly' => null,
])

@php
$classes = Laraliveui::classes()
    ->add('text-sm text-zinc-500 dark:text-white/60')
    ->add($srOnly ? 'sr-only' : '')
    ;
@endphp

<ui-description {{ $attributes->class($classes) }} data-laraliveui-description>
    {{ $slot }}
</ui-description>
