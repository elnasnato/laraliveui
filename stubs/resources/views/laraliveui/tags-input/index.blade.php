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
    'placeholder' => 'Type and press enter...',
    'max' => null,
    'allowDuplicates' => false,
    'invalid' => null,
    'variant' => 'outline',
    'size' => null,
])

<laraliveui:with-field :$attributes :$name>
    <div
        x-data="{
            items: @entangle($attributes->wire('model')),
            input: '',
            allowDuplicates: @js($allowDuplicates),
            max: @js($max),
            addItem() {
                let val = this.input.trim()
                if (val === '') return
                if (this.max && this.items.length >= this.max) return
                if (!this.allowDuplicates && this.items.includes(val)) return
                this.items.push(val)
                this.input = ''
            },
            removeItem(index) {
                this.items.splice(index, 1)
            },
            editItem(index, newVal) {
                this.items[index] = newVal
            }
        }"
        x-on:keydown.escape="input = ''"
        {{ $attributes->class([
            'flex flex-wrap gap-1.5 rounded-lg border p-2',
            'bg-white dark:bg-white/10',
            $invalid
                ? 'border-red-500'
                : 'border-zinc-200 border-b-zinc-300/80 dark:border-white/10',
            match ($size) {
                'sm' => 'p-1.5',
                'xs' => 'p-1',
                default => 'p-2',
            },
        ]) }}
        data-laraliveui-control
        data-laraliveui-group-target
    >
        <template x-for="(item, index) in items" :key="index">
            <span
                class="inline-flex items-center gap-1 rounded-full bg-zinc-100 dark:bg-zinc-700 pl-2.5 pr-1 py-0.5 text-xs font-medium text-zinc-700 dark:text-zinc-300"
            >
                <span x-text="item"></span>
                <button
                    type="button"
                    x-on:click="removeItem(index)"
                    class="inline-flex items-center justify-center rounded-full p-0.5 text-zinc-400 hover:text-zinc-600 hover:bg-zinc-200 dark:hover:text-zinc-200 dark:hover:bg-zinc-600 transition"
                >
                    <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor">
                        <path d="M5.28 4.22a.75.75 0 0 0-1.06 1.06L6.94 8l-2.72 2.72a.75.75 0 1 0 1.06 1.06L8 9.06l2.72 2.72a.75.75 0 1 0 1.06-1.06L9.06 8l2.72-2.72a.75.75 0 0 0-1.06-1.06L8 6.94 5.28 4.22Z" />
                    </svg>
                </button>
            </span>
        </template>

        <input
            x-model="input"
            x-on:keydown.enter.prevent="addItem()"
            x-on:keydown.backspace="if (input === '' && items.length > 0) removeItem(items.length - 1)"
            type="text"
            placeholder="{{ $placeholder }}"
            class="min-w-[100px] flex-1 border-0 bg-transparent py-0.5 text-sm text-zinc-800 placeholder-zinc-400 outline-none dark:text-white dark:placeholder-zinc-500"
        />
    </div>
</laraliveui:with-field>
