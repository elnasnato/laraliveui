@props([
    'name' => $attributes->whereStartsWith('wire:model')->first(),
    'label' => null,
    'description' => null,
    'disabled' => false,
    'checked' => false,
    'size' => 'base',
    'onValue' => '1',
    'offValue' => '0',
])

@php
$sizeConfig = match ($size) {
    'sm' => ['switch' => 'h-5 w-9', 'thumb' => 'size-4', 'activeTranslate' => 'translate-x-4'],
    'lg' => ['switch' => 'h-7 w-12', 'thumb' => 'size-6', 'activeTranslate' => 'translate-x-5'],
    default => ['switch' => 'h-6 w-11', 'thumb' => 'size-5', 'activeTranslate' => 'translate-x-5'],
};
@endphp

<label {{ $attributes->class('inline-flex items-center gap-x-3') }}>
    <button
        type="button"
        role="switch"
        x-data="{ on: @js((bool) $checked) }"
        x-modelable="on"
        @if ($name) x-model="{{ $name }}" @endif
        x-on:click="on = !on"
        x-bind:class="on ? 'bg-zinc-800 dark:bg-white' : 'bg-zinc-200 dark:bg-zinc-700'"
        @disabled($disabled)
        class="relative inline-flex flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 dark:focus:ring-offset-zinc-900 {{ $sizeConfig['switch'] }}"
        x-bind:aria-checked="on"
    >
        <span
            x-bind:class="on ? '{{ $sizeConfig['activeTranslate'] }} bg-white dark:bg-zinc-900' : 'translate-x-0 bg-white'"
            class="pointer-events-none inline-flex transform rounded-full shadow ring-0 transition duration-200 ease-in-out {{ $sizeConfig['thumb'] }}"
        ></span>
    </button>

    @if ($label || $slot->isNotEmpty())
        <span class="text-sm font-medium text-zinc-800 dark:text-white">
            {{ $slot ?? $label }}
        </span>
    @endif
</label>
