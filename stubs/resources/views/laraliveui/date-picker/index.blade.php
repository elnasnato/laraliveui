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
    'placeholder' => 'Pick a date',
    'invalid' => null,
    'size' => null,
])

<laraliveui:with-field :$attributes :$name>
    <div
        x-data="{
            open: false,
            selectedDate: @entangle($attributes->wire('model')),
            viewMonth: null,
            viewYear: null,
            init() {
                const d = this.selectedDate ? new Date(this.selectedDate) : new Date();
                this.viewMonth = d.getMonth();
                this.viewYear = d.getFullYear();
            },
            get monthName() {
                return new Date(this.viewYear, this.viewMonth).toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
            },
            get daysInMonth() {
                return new Date(this.viewYear, this.viewMonth + 1, 0).getDate();
            },
            get startDay() {
                return new Date(this.viewYear, this.viewMonth, 1).getDay();
            },
            isToday(day) {
                const t = new Date();
                return this.viewYear === t.getFullYear() && this.viewMonth === t.getMonth() && day === t.getDate();
            },
            isSelected(day) {
                if (!this.selectedDate) return false;
                const s = new Date(this.selectedDate);
                return this.viewYear === s.getFullYear() && this.viewMonth === s.getMonth() && day === s.getDate();
            },
            select(day) {
                const d = new Date(this.viewYear, this.viewMonth, day);
                this.selectedDate = d.toISOString().split('T')[0];
                this.open = false;
            },
            prevMonth() {
                if (this.viewMonth === 0) { this.viewMonth = 11; this.viewYear--; }
                else { this.viewMonth--; }
            },
            nextMonth() {
                if (this.viewMonth === 11) { this.viewMonth = 0; this.viewYear++; }
                else { this.viewMonth++; }
            },
            formatDate(dateStr) {
                if (!dateStr) return '';
                const d = new Date(dateStr + 'T12:00:00');
                return d.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
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
            <laraliveui:icon name="calendar-days" variant="mini" class="size-4 shrink-0 text-zinc-400 dark:text-white/60" />
            <span class="flex-1 truncate" x-text="formatDate(selectedDate) || '{{ $placeholder }}'" x-bind:class="selectedDate ? 'text-zinc-800 dark:text-white' : 'text-zinc-400 dark:text-white/40'"></span>
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
            class="absolute z-50 mt-1 w-72 rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 p-4 shadow-lg"
        >
            <div class="flex items-center justify-between mb-3">
                <button type="button" x-on:click="prevMonth" class="rounded-lg p-1 text-zinc-400 hover:text-zinc-600 hover:bg-zinc-100 dark:hover:text-zinc-300 dark:hover:bg-zinc-700">
                    <laraliveui:icon name="chevron-left" variant="mini" class="size-4" />
                </button>
                <span class="text-sm font-medium text-zinc-800 dark:text-white" x-text="monthName"></span>
                <button type="button" x-on:click="nextMonth" class="rounded-lg p-1 text-zinc-400 hover:text-zinc-600 hover:bg-zinc-100 dark:hover:text-zinc-300 dark:hover:bg-zinc-700">
                    <laraliveui:icon name="chevron-right" variant="mini" class="size-4" />
                </button>
            </div>

            <div class="grid grid-cols-7 gap-px text-center text-xs mb-1">
                <template x-for="d in ['Su','Mo','Tu','We','Th','Fr','Sa']" :key="d">
                    <div class="py-1 text-zinc-500 dark:text-zinc-400 font-medium" x-text="d"></div>
                </template>
            </div>

            <div class="grid grid-cols-7 gap-px text-center text-sm">
                <template x-for="blank in startDay" :key="'b'+blank">
                    <div></div>
                </template>
                <template x-for="day in daysInMonth" :key="day">
                    <button
                        type="button"
                        x-on:click="select(day)"
                        x-bind:class="{
                            'rounded-full bg-zinc-800 text-white dark:bg-white dark:text-zinc-800': isSelected(day),
                            'rounded-full bg-zinc-100 dark:bg-zinc-700': isToday(day) && !isSelected(day),
                            'text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-700': !isSelected(day),
                        }"
                        class="w-full py-1 rounded-full transition"
                        x-text="day"
                    ></button>
                </template>
            </div>
        </div>
    </div>
</laraliveui:with-field>
