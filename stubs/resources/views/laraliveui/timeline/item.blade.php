@props([
    'title' => null,
    'time' => null,
    'active' => false,
])

<li {{ $attributes->class('mb-6 ms-6') }}>
    <span class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full {{ $active ? 'bg-zinc-800 dark:bg-white' : 'bg-zinc-200 dark:bg-zinc-700' }}">
        @if ($active)
            <span class="h-2.5 w-2.5 rounded-full bg-white dark:bg-zinc-800"></span>
        @endif
    </span>
    <h3 class="font-medium text-zinc-800 dark:text-white">{{ $title ?? $slot }}</h3>
    @if ($time)
        <time class="block text-sm text-zinc-500 dark:text-zinc-400">{{ $time }}</time>
    @endif
</li>
