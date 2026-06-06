@props([
    'name' => null,
    'placeholder' => 'Search...',
    'query' => '',
])

<div
    x-data="{
        open: false,
        query: @js($query),
        selected: null,
        init() {
            this.$watch('query', () => { this.open = true })
        },
        select(value) {
            this.selected = value
            this.query = value
            this.open = false
        }
    }"
    x-on:click.away="open = false"
    x-on:keydown.escape="open = false"
    {{ $attributes->class('relative') }}
>
    <input
        x-model="query"
        x-on:focus="open = true"
        x-on:keydown.down.prevent="$focus.next()"
        x-on:keydown.up.prevent="$focus.prev()"
        type="text"
        placeholder="{{ $placeholder }}"
        class="w-full rounded-lg border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 px-3 py-2 text-sm text-zinc-800 dark:text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-500"
    />

    {{ $slot }}

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        style="display: none;"
        class="absolute z-50 mt-1 w-full rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 py-1 shadow-lg"
    >
        {{ $results }}
    </div>
</div>
