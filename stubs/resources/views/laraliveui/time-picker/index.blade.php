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
    'placeholder' => 'Pick a time',
    'invalid' => null,
    'size' => null,
    'interval' => 30,
    'format' => '12h',
])

<laraliveui:with-field :$attributes :$name>
    <div
        x-data="{
            open: false,
            selectedTime: @entangle($attributes->wire('model')),
            interval: {{ $interval }},
            format: '{{ $format }}',
            get hours() {
                if (this.format === '24h') return Array.from({length: 24}, (_, i) => i);
                return Array.from({length: 12}, (_, i) => i + 1);
            },
            get times() {
                const result = [];
                const total = this.format === '24h' ? 24 : 12;
                const periods = this.format === '24h' ? [''] : ['AM', 'PM'];
                for (const period of periods) {
                    for (let h = 0; h < total; h++) {
                        for (let m = 0; m < 60; m += this.interval) {
                            const hour = this.format === '24h' ? String(h).padStart(2, '0') : String(h === 0 ? 12 : h);
                            const minute = String(m).padStart(2, '0');
                            const label = this.format === '24h' ? hour + ':' + minute : hour + ':' + minute + ' ' + period;
                            const value = this.format === '24h' ? hour + ':' + minute : (h === 0 ? 12 : h) + ':' + minute + ' ' + period;
                            result.push({ label, value });
                        }
                    }
                }
                return result;
            },
            select(time) {
                this.selectedTime = time;
                this.open = false;
            }
        }"
        x-on:click.away="open = false"
        x-on:keydown.escape="open = false"
        class="relative"
        data-laraliveui-group-target
    >
        <button
            type="button"
            x-on:click="open = !open"
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
            <laraliveui:icon name="clock" variant="mini" class="size-4 shrink-0 text-zinc-400 dark:text-white/60" />
            <span class="flex-1 truncate" x-text="selectedTime || '{{ $placeholder }}'" x-bind:class="selectedTime ? 'text-zinc-800 dark:text-white' : 'text-zinc-400 dark:text-white/40'"></span>
            <laraliveui:icon name="chevron-up-down" variant="mini" class="size-4 shrink-0 text-zinc-400 dark:text-white/60" />
        </button>

        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            style="display: none;"
            class="absolute z-50 mt-1 w-48 max-h-60 overflow-y-auto rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 py-1 shadow-lg"
        >
            <template x-for="t in times" :key="t.value">
                <button
                    type="button"
                    x-on:click="select(t.value)"
                    x-text="t.label"
                    x-bind:class="selectedTime === t.value ? 'bg-zinc-100 dark:bg-zinc-700 text-zinc-800 dark:text-white' : 'text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-700'"
                    class="w-full px-3 py-1.5 text-sm text-start transition"
                ></button>
            </template>
        </div>
    </div>
</laraliveui:with-field>
