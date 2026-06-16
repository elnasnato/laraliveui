@props([
    'title' => null,
    'color' => null,
])

<div {{ $attributes->class('flex-shrink-0 w-72') }}>
    <div class="mb-2 flex items-center justify-between">
        <h3 class="text-sm font-medium text-zinc-800 dark:text-white">{{ $title }}</h3>
    </div>
    <div class="space-y-2 rounded-xl bg-zinc-100 dark:bg-zinc-800/50 p-3">
        {{ $slot }}
    </div>
</div>
