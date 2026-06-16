@props([
    'name' => null,
    'min' => 0,
    'max' => 100,
    'step' => 1,
    'value' => null,
    'showValue' => false,
])

@php
$wireModel = $attributes->whereStartsWith('wire:model')->first();
$valueAttr = $value ?? $wireModel ?? 0;
@endphp

<div {{ $attributes->class('w-full') }}>
    <input
        type="range"
        min="{{ $min }}"
        max="{{ $max }}"
        step="{{ $step }}"
        @if ($wireModel)
            x-model="{{ $wireModel }}"
        @else
            value="{{ $valueAttr }}"
        @endif
        {{ $attributes->except('class') }}
        class="w-full h-2 bg-zinc-200 dark:bg-zinc-700 rounded-lg appearance-none cursor-pointer accent-zinc-800 dark:accent-white focus:outline-none"
    />

    @if ($showValue)
        <div class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">
            <span x-data="{ val: @js($value ?? 0) }" x-text="val"></span>
        </div>
    @endif
</div>
