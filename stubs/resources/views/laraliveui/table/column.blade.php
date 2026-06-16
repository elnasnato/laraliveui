@props([
    'name' => null,
    'sortable' => false,
    'width' => null,
    'align' => 'left',
    'label' => null,
])

@php
$alignClass = match ($align) {
    'center' => 'text-center',
    'right' => 'text-right',
    default => 'text-left',
};
@endphp

<th
    scope="col"
    {{ $attributes->class(['px-4 py-3 text-xs font-medium uppercase tracking-wider text-zinc-500 dark:text-zinc-400', $alignClass]) }}
    @if ($width) style="width: {{ $width }}" @endif
>
    @if ($sortable)
        <button type="button" class="group inline-flex items-center gap-1">
            <span>{{ $label ?? $slot }}</span>
            <svg class="h-3 w-3 text-zinc-400 group-hover:text-zinc-600 dark:group-hover:text-zinc-300" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
            </svg>
        </button>
    @else
        {{ $label ?? $slot }}
    @endif
</th>
