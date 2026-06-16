@props([
    'name' => null,
    'direction' => 'asc',
])

<span {{ $attributes->class('inline-flex items-center gap-1') }}>
    {{ $slot }}
    <svg class="h-3 w-3 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
        @if ($direction === 'asc')
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
        @else
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
        @endif
    </svg>
</span>
