@blaze(fold: true, unsafe: [
    'name', 'label', 'badge',
    'description', 'description:trailing',
    'label:badge', 'label:aside', 'label:trailing',
    'error:name', 'error:bag', 'error:message', 'error:icon', 'error:nested', 'error:deep',
])

@php
$name ??= $attributes->whereStartsWith('wire:model')->first();
@endphp

@props([
    'name' => $attributes->whereStartsWith('wire:model')->first(),
    'min' => 0,
    'max' => null,
    'addLabel' => 'Add item',
    'removeLabel' => 'Remove',
    'defaultItem' => '{}',
    'createButton' => null,
])

<laraliveui:with-field :$attributes :$name>
    <div
        x-data="{
            items: @entangle($attributes->wire('model')),
            min: @js($min),
            max: @js($max),
            addItem() {
                if (this.max && this.items.length >= this.max) return
                let newItem = {{ $defaultItem }}
                this.items.push(newItem)
            },
            removeItem(index) {
                if (this.items.length <= this.min) return
                this.items.splice(index, 1)
            }
        }"
        {{ $attributes->class('space-y-3') }}
        data-laraliveui-group-target
    >
        <template x-for="(item, index) in items" :key="index">
            <div class="relative rounded-lg border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800/50 p-4">
                <div class="absolute right-2 top-2">
                    <button
                        type="button"
                        x-on:click="removeItem(index)"
                        x-show="items.length > min"
                        class="inline-flex items-center justify-center rounded-md p-1 text-zinc-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition"
                        aria-label="{{ $removeLabel }}"
                    >
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor">
                            <path d="M5.28 4.22a.75.75 0 0 0-1.06 1.06L6.94 8l-2.72 2.72a.75.75 0 1 0 1.06 1.06L8 9.06l2.72 2.72a.75.75 0 1 0 1.06-1.06L9.06 8l2.72-2.72a.75.75 0 0 0-1.06-1.06L8 6.94 5.28 4.22Z" />
                        </svg>
                    </button>
                </div>
                {{ $slot }}
            </div>
        </template>

        @if ($createButton)
            {{ $createButton }}
        @else
            <button
                type="button"
                x-on:click="addItem()"
                x-show="!max || items.length < max"
                class="inline-flex items-center gap-2 rounded-lg border border-dashed border-zinc-300 dark:border-zinc-600 px-4 py-2 text-sm font-medium text-zinc-600 dark:text-zinc-400 hover:border-zinc-400 dark:hover:border-zinc-500 hover:text-zinc-800 dark:hover:text-zinc-200 transition bg-transparent w-full justify-center"
            >
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor">
                    <path d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
                </svg>
                {{ $addLabel }}
            </button>
        @endif
    </div>
</laraliveui:with-field>
