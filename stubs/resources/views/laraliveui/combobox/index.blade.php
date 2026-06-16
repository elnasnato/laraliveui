@blaze(fold: true, unsafe: [
    'name', 'label', 'badge',
    'description', 'description:trailing',
    'label:badge', 'label:aside', 'label:trailing',
    'error:name', 'error:bag', 'error:message', 'error:icon', 'error:nested', 'error:deep',
])

@php
$name ??= $attributes->whereStartsWith('wire:model')->first();
$invalid ??= ($name && $errors->has($name));
@endphp

@props([
    'name' => $attributes->whereStartsWith('wire:model')->first(),
    'placeholder' => 'Select an option...',
    'searchPlaceholder' => 'Search...',
    'emptyText' => 'No results found.',
    'invalid' => null,
    'size' => null,
    'clearable' => false,
    'position' => 'bottom',
])

<laraliveui:with-field :$attributes :$name>
    <div
        x-data="{
            open: false,
            query: '',
            selectedLabel: null,
            selectedValue: @entangle($attributes->wire('model')),
            items: [],
            init() {
                this.items = this.$el.querySelectorAll('[data-combobox-option]')
            },
            get filteredItems() {
                if (!this.query) return this.items
                return Array.from(this.items).filter(el => {
                    const label = el.getAttribute('data-label') || el.textContent.trim()
                    return label.toLowerCase().includes(this.query.toLowerCase())
                })
            },
            select(el) {
                const value = el.getAttribute('data-value') ?? el.textContent.trim()
                const label = el.getAttribute('data-label') || el.textContent.trim()
                this.selectedValue = value
                this.selectedLabel = label
                this.query = ''
                this.open = false
            },
            isSelected(el) {
                const value = el.getAttribute('data-value') ?? el.textContent.trim()
                return value === this.selectedValue
            },
            clear() {
                this.selectedValue = null
                this.selectedLabel = null
                this.query = ''
            },
            focusNext() {
                const items = this.filteredItems
                const current = items.indexOf(document.activeElement?.closest('[data-combobox-option]'))
                const next = Math.min(current + 1, items.length - 1)
                if (next >= 0) items[next]?.focus()
            },
            focusPrev() {
                const items = this.filteredItems
                const current = items.indexOf(document.activeElement?.closest('[data-combobox-option]'))
                const prev = Math.max(current - 1, 0)
                if (prev >= 0) items[prev]?.focus()
            }
        }"
        x-on:click.away="open = false"
        x-on:keydown.escape="open = false"
        class="relative"
        data-laraliveui-group-target
    >
        {{-- Trigger button --}}
        <button
            type="button"
            x-on:click="open = !open"
            x-on:keydown.down.prevent="open = true; $nextTick(() => { const first = filteredItems[0]; if (first) first.focus() })"
            {{ $attributes->class([
                'w-full flex items-center gap-2 text-start rounded-lg border px-3 py-2 text-sm shadow-xs transition',
                'bg-white dark:bg-white/10',
                $invalid
                    ? 'border-red-500'
                    : 'border-zinc-200 border-b-zinc-300/80 dark:border-white/10',
                match ($size) {
                    'sm' => 'h-8 py-1.5 text-sm rounded-md',
                    'xs' => 'h-6 py-1 text-xs rounded-md',
                    default => 'h-10 py-2',
                },
                'disabled:shadow-none disabled:opacity-50',
            ]) }}
            data-laraliveui-control
        >
            <span x-show="selectedLabel" x-text="selectedLabel" class="flex-1 truncate text-zinc-800 dark:text-white"></span>
            <span class="flex-1 truncate text-zinc-400 dark:text-white/40" x-show="!selectedLabel">{{ $placeholder }}</span>

            @if ($clearable)
                <button
                    type="button"
                    x-show="selectedValue"
                    x-on:click.stop="clear()"
                    class="shrink-0 text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300"
                >
                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor">
                        <path d="M5.28 4.22a.75.75 0 0 0-1.06 1.06L6.94 8l-2.72 2.72a.75.75 0 1 0 1.06 1.06L8 9.06l2.72 2.72a.75.75 0 1 0 1.06-1.06L9.06 8l2.72-2.72a.75.75 0 0 0-1.06-1.06L8 6.94 5.28 4.22Z" />
                    </svg>
                </button>
            @endif

            <svg class="size-4 shrink-0 text-zinc-400 dark:text-white/60" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
        </button>

        {{-- Dropdown --}}
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            style="display: none;"
            class="absolute z-50 mt-1 w-full rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 shadow-lg"
            x-bind:class="{
                'mt-1 mb-1': '{{ $position }}' === 'bottom',
                'bottom-full mb-1': '{{ $position }}' === 'top',
            }"
        >
            {{-- Search input --}}
            <div class="border-b border-zinc-200 dark:border-zinc-700 px-3 py-2">
                <input
                    x-model="query"
                    x-ref="search"
                    type="text"
                    placeholder="{{ $searchPlaceholder }}"
                    x-on:keydown.down.prevent="focusNext()"
                    x-on:keydown.up.prevent="focusPrev()"
                    x-on:keydown.enter.prevent="const first = filteredItems[0]; if (first) select(first)"
                    class="w-full border-0 bg-transparent text-sm text-zinc-800 outline-none placeholder-zinc-400 dark:text-white dark:placeholder-zinc-500"
                />
            </div>

            {{-- Options --}}
            <div class="max-h-60 overflow-y-auto py-1" role="listbox">
                {{ $slot }}

                <div
                    x-show="filteredItems.length === 0"
                    class="px-3 py-4 text-center text-sm text-zinc-500 dark:text-zinc-400"
                >
                    {{ $emptyText }}
                </div>
            </div>
        </div>
    </div>
</laraliveui:with-field>
