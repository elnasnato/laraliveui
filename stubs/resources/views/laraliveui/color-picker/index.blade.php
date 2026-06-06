@props([
    'name' => null,
    'value' => '#000000',
])

<div {{ $attributes->class('flex items-center gap-2') }}>
    <input
        type="color"
        value="{{ $value }}"
        @if ($name) name="{{ $name }}" @endif
        class="h-8 w-8 cursor-pointer rounded border border-zinc-200 dark:border-zinc-700"
    />
    <input
        type="text"
        value="{{ $value }}"
        class="w-24 rounded-lg border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 px-2 py-1 text-xs text-zinc-800 dark:text-white"
    />
</div>
