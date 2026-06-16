@props([
    'title' => null,
    'description' => null,
    'action' => null,
    'icon' => null,
])

@php
$classes = Laraliveui::classes()
    ->add('flex flex-col items-center justify-center py-12 px-4 text-center');
@endphp

<div {{ $attributes->class($classes) }}>
    @if ($icon)
        <div class="mb-4 text-zinc-300 dark:text-zinc-600">
            <laraliveui:icon :icon="$icon" variant="outline" class="size-12" />
        </div>
    @endif

    @if ($title)
        <h3 {{ $title->attributes->class('text-base font-semibold text-zinc-800 dark:text-white') }}>
            {{ $title }}
        </h3>
    @endif

    @if ($description)
        <p {{ $description->attributes->class('mt-1 text-sm text-zinc-500 dark:text-zinc-400 max-w-sm') }}>
            {{ $description }}
        </p>
    @endif

    {{ $slot }}

    @if ($action)
        <div class="mt-6">
            {{ $action }}
        </div>
    @endif
</div>
