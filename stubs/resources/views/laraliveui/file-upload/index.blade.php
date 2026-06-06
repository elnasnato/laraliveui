@props([
    'name' => null,
    'accept' => null,
    'multiple' => false,
])

<div
    x-data="{ files: [] }"
    {{ $attributes->class('relative') }}
>
    <label class="flex cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-zinc-300 dark:border-zinc-600 bg-zinc-50 dark:bg-zinc-800/50 px-6 py-8 hover:border-zinc-400 dark:hover:border-zinc-500">
        <x-laraliveui::icon name="cloud-arrow-up" class="mb-2 h-8 w-8 text-zinc-400" />
        <span class="text-sm text-zinc-600 dark:text-zinc-400">
            Click to upload
        </span>
        <input
            type="file"
            @if ($name) name="{{ $name }}" @endif
            @if ($accept) accept="{{ $accept }}" @endif
            @if ($multiple) multiple @endif
            x-on:change="files = Array.from($event.target.files)"
            class="sr-only"
        />
    </label>

    <template x-for="(file, index) in files" :key="index">
        <div class="mt-2 flex items-center gap-2 rounded-lg bg-zinc-100 dark:bg-zinc-800 px-3 py-2 text-sm text-zinc-700 dark:text-zinc-300">
            <x-laraliveui::icon name="document" class="h-4 w-4" />
            <span x-text="file.name"></span>
        </div>
    </template>
</div>
