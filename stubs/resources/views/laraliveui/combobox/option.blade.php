@props([
    'value' => null,
    'label' => null,
    'disabled' => false,
])

<button
    type="button"
    data-combobox-option
    data-value="{{ $value }}"
    data-label="{{ $label ?? $slot }}"
    role="option"
    x-on:click="select($el)"
    x-on:keydown.enter.prevent="select($el)"
    x-bind:class="{
        'bg-zinc-100 dark:bg-zinc-700': isSelected($el),
        'text-zinc-400 dark:text-zinc-500': '{{ $disabled }}' === '1',
    }"
    @disabled($disabled)
    {{ $attributes->class([
        'w-full text-left px-3 py-2 text-sm text-zinc-700 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition flex items-center gap-2',
    ]) }}
>
    @if ($label)
        {{ $label }}
    @else
        {{ $slot }}
    @endif

    <span x-show="isSelected($el)" class="ml-auto shrink-0 text-zinc-800 dark:text-white">
        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor">
            <path fill-rule="evenodd" d="M12.416 3.376a.75.75 0 0 1 .208 1.04l-5 7.5a.75.75 0 0 1-1.154.114l-3-3a.75.75 0 0 1 1.06-1.06l2.353 2.353 4.493-6.74a.75.75 0 0 1 1.04-.207Z" clip-rule="evenodd" />
        </svg>
    </span>
</button>
