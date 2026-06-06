@props([
    'name' => null,
    'placeholder' => 'Write a message...',
])

<div {{ $attributes->class('rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800') }}>
    <div
        x-data="{ content: '' }"
        class="flex flex-col"
    >
        <div
            x-ref="editable"
            contenteditable="true"
            x-on:input="content = $el.innerHTML"
            class="min-h-[100px] w-full bg-transparent p-4 text-sm text-zinc-800 dark:text-white focus:outline-none"
            placeholder="{{ $placeholder }}"
        ></div>
        <div class="flex items-center justify-between border-t border-zinc-200 dark:border-zinc-700 px-4 py-2">
            <div class="flex items-center gap-1">
                <button type="button" class="rounded p-1 text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300">
                    <x-laraliveui::icon name="paper-clip" class="h-4 w-4" />
                </button>
            </div>
            <span x-text="content.length + ' characters'" class="text-xs text-zinc-400"></span>
        </div>
    </div>
</div>
