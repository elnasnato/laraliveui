@props([
    'size' => 'md',
    'separator' => '+',
])

@php
$classes = Laraliveui::classes()
    ->add('inline-flex items-center gap-0.5 font-mono')
    ->add(match ($size) {
        'xs' => 'text-[10px]',
        'sm' => 'text-xs',
        'lg' => 'text-sm',
        default => 'text-xs',
    });
@endphp

<span {{ $attributes->class($classes) }}>
    @if ($slot->isNotEmpty())
        {{ $slot }}
    @endif
</span>
