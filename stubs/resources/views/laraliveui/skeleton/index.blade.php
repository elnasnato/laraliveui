@blaze(fold: true)

@aware(['animate' => null])

@props([
    'animate' => null,
])

@php
    $classes = Laraliveui::classes()
        ->add('[:where(&)]:h-4 [:where(&)]:rounded-md [:where(&)]:bg-zinc-400/20')
        ->add(match ($animate) {
            'shimmer' => [
                'relative before:absolute before:inset-0 before:-translate-x-full',
                'overflow-hidden isolate',
                '[:where(&)]:[--laraliveui-shimmer-color:white]',
                'dark:[:where(&)]:[--laraliveui-shimmer-color:var(--color-zinc-900)]',
                'before:z-10 before:animate-[laraliveui-shimmer_2s_infinite]',
                'before:bg-gradient-to-r before:from-transparent before:via-[var(--laraliveui-shimmer-color)]/50 dark:before:via-[var(--laraliveui-shimmer-color)]/50 before:to-transparent',
            ],
            'pulse' => 'animate-pulse',
            default => '',
        })
        ;
@endphp

<div {{ $attributes->class($classes) }} data-laraliveui-skeleton>
    {{ $slot }}
</div>