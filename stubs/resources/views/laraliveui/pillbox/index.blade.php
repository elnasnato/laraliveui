@props([
    'name' => null,
    'placeholder' => 'Type and press enter...',
    'max' => null,
])

<div
    x-data="{
        items: @js($attributes->wire('model')->value() ?? []),
        input: '',
        addItem() {
            if (this.input.trim() === '') return
            if (this.max && this.items.length >= this.max) return
            this.items.push(this.input.trim())
            this.input = ''
        },
        removeItem(index) {
            this.items.splice(index, 1)
        }
    }"
    {{ $attributes->class('flex flex-wrap gap-1 rounded-lg border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 p-2') }}
>
    <template x-for="(item, index) in items" :key="index">
        <span class="inline-flex items-center gap-1 rounded-full bg-zinc-100 dark:bg-zinc-700 px-2.5 py-0.5 text-xs font-medium text-zinc-700 dark:text-zinc-300">
            <span x-text="item"></span>
            <button type="button" x-on:click="removeItem(index)" class="text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200">&times;</button>
        </span>
    </template>
    <input
        x-model="input"
        x-on:keydown.enter.prevent="addItem()"
        x-on:keydown.backspace="if (input === '') removeItem(items.length - 1)"
        type="text"
        placeholder="{{ $placeholder }}"
        class="min-w-[120px] flex-1 border-0 bg-transparent py-1 text-sm text-zinc-800 placeholder-zinc-400 outline-none dark:text-white"
    />
</div>
