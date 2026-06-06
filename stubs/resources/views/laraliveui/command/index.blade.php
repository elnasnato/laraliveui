@props([
    'placeholder' => 'Search...',
    'open' => false,
])

<div
    x-data="{
        open: @js($open),
        query: '',
        init() {
            this.$watch('open', val => {
                if (val) this.\$nextTick(() => this.\$refs.input?.focus())
            })
        }
    }"
    x-on:keydown.meta.k.prevent="open = !open"
    x-on:keydown.ctrl.k.prevent="open = !open"
    x-on:keydown.escape="open = false"
    {{ $attributes }}
>
    {{ $slot }}

    <template x-teleport="body">
        <div x-show="open" style="display: none;" class="fixed inset-0 z-50 flex items-start justify-center pt-32">
            <div x-on:click="open = false" class="fixed inset-0 bg-black/50"></div>
            <div
                x-show="open"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                class="relative w-full max-w-lg rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 shadow-2xl"
            >
                <div class="border-b border-zinc-200 dark:border-zinc-700 px-4">
                    <x-laraliveui::icon name="magnifying-glass" class="absolute left-4 top-3.5 h-5 w-5 text-zinc-400" />
                    <input
                        x-ref="input"
                        x-model="query"
                        type="text"
                        placeholder="{{ $placeholder }}"
                        class="w-full border-0 bg-transparent py-3 pl-8 text-sm text-zinc-800 outline-none placeholder-zinc-400 dark:text-white"
                    />
                </div>
                <div class="max-h-72 overflow-y-auto py-2">
                    {{ $results }}
                </div>
            </div>
        </div>
    </template>
</div>
