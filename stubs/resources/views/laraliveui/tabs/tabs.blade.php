@props([
    'name' => null,
    'label' => null,
])

@php
$tabName = $name ?? $label ?? Str::slug($slot ?? 'tab');
$active = "selectedTab === '{$tabName}'";
@endphp

<button
    x-on:click="handleTabClick($el)"
    data-slot="tab"
    data-name="{{ $tabName }}"
    x-bind:data-active="selectedTab === '{{ $tabName }}'"
    {{ $attributes->class([
        'px-4 py-2 text-sm font-medium transition-colors',
        'border-b-2 border-transparent hover:text-zinc-600 dark:hover:text-zinc-300',
        'data-[active=true]:border-zinc-800 data-[active=true]:text-zinc-800 dark:data-[active=true]:border-white dark:data-[active=true]:text-white',
    ]) }}
    role="tab"
    x-bind:aria-selected="selectedTab === '{{ $tabName }}'"
    type="button"
>
    {{ $slot ?? $label }}
</button>
