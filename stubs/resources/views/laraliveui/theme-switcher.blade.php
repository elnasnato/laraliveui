@props([
    'position' => 'bottom end',
])

@php
$classes = Laraliveui::classes()
    ->add('inline-flex items-center gap-1 rounded-lg border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 p-0.5 shadow-xs');
@endphp

<div
    x-data="{
        appearance: window.localStorage.getItem('laraliveui.appearance') || 'system',
        setAppearance(value) {
            this.appearance = value
            window.LaraLiveUI.applyAppearance(value)
        }
    }"
    {{ $attributes->class($classes) }}
    role="radiogroup"
>
    <button
        type="button"
        x-on:click="setAppearance('light')"
        x-bind:class="appearance === 'light' ? 'bg-zinc-100 dark:bg-zinc-700 text-zinc-800 dark:text-white shadow-xs' : 'text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300'"
        class="rounded-md p-1.5 transition"
        aria-label="{{ __('Light mode') }}"
    >
        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor">
            <path d="M8 1a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5A.75.75 0 0 1 8 1ZM10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0ZM12.95 4.11a.75.75 0 1 0-1.06-1.06l-1.062 1.06a.75.75 0 0 0 1.061 1.062l1.06-1.061ZM15 8a.75.75 0 0 1-.75.75h-1.5a.75.75 0 0 1 0-1.5h1.5A.75.75 0 0 1 15 8ZM14.25 11.95a.75.75 0 0 0-1.06-1.06l-1.062 1.06a.75.75 0 0 0 1.061 1.062l1.06-1.061ZM11.95 14.25a.75.75 0 1 0 1.06-1.06l-1.06-1.062a.75.75 0 0 0-1.062 1.061l1.061 1.06ZM8 12a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5A.75.75 0 0 1 8 12ZM5.172 14.25a.75.75 0 0 0 1.06-1.06l-1.06-1.062a.75.75 0 0 0-1.062 1.061l1.061 1.06ZM4.11 12.95a.75.75 0 0 0 0-1.06l-1.06-1.062a.75.75 0 0 0-1.062 1.061l1.06 1.06ZM3.05 4.11a.75.75 0 0 0-1.06 1.06l1.06 1.062a.75.75 0 0 0 1.062-1.061L3.05 4.11ZM1 8a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5h-1.5A.75.75 0 0 1 1 8Z" />
        </svg>
    </button>

    <button
        type="button"
        x-on:click="setAppearance('system')"
        x-bind:class="appearance === 'system' ? 'bg-zinc-100 dark:bg-zinc-700 text-zinc-800 dark:text-white shadow-xs' : 'text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300'"
        class="rounded-md p-1.5 transition"
        aria-label="{{ __('System mode') }}"
    >
        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor">
            <path fill-rule="evenodd" d="M2 4.25A2.25 2.25 0 0 1 4.25 2h7.5A2.25 2.25 0 0 1 14 4.25v5.5A2.25 2.25 0 0 1 11.75 12h-1.312c.1.128.21.248.328.36a.75.75 0 0 1-.234 1.243.75.75 0 0 1-.48-.043 5.935 5.935 0 0 1-.22-.088.584.584 0 0 0-.082-.034.75.75 0 0 1-.46-.564.75.75 0 0 1 .424-.822 5 5 0 0 0 .146-.052H4.25A2.25 2.25 0 0 1 2 9.75v-5.5Zm12 .25H2v5.25c0 .966.784 1.75 1.75 1.75h8.5A1.75 1.75 0 0 0 14 9.75V4.5Z" clip-rule="evenodd" />
        </svg>
    </button>

    <button
        type="button"
        x-on:click="setAppearance('dark')"
        x-bind:class="appearance === 'dark' ? 'bg-zinc-100 dark:bg-zinc-700 text-zinc-800 dark:text-white shadow-xs' : 'text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300'"
        class="rounded-md p-1.5 transition"
        aria-label="{{ __('Dark mode') }}"
    >
        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor">
            <path d="M14.438 10.148c.19-.425-.321-.787-.748-.601A5.5 5.5 0 0 1 6.453 2.31c.186-.427-.176-.938-.6-.748a6.501 6.501 0 1 0 8.585 8.586Z" />
        </svg>
    </button>
</div>
