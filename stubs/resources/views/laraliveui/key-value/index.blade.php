@props([
    'items' => null,
    'variant' => 'stacked',
])

@php
$classes = Laraliveui::classes()
    ->add(match ($variant) {
        'grid' => 'grid grid-cols-2 gap-x-4 gap-y-2',
        'inline' => 'flex flex-wrap gap-x-4 gap-y-2',
        default => 'space-y-2',
    });
@endphp

<dl {{ $attributes->class($classes) }}>
    @if ($items)
        @foreach ($items as $key => $value)
            @php
            $keyClasses = Laraliveui::classes()
                ->add('text-sm font-medium text-zinc-500 dark:text-zinc-400');
            $valueClasses = Laraliveui::classes()
                ->add('text-sm text-zinc-800 dark:text-white');
            @endphp
            <div class="min-w-0">
                <dt {{ $keyClasses }}>{{ $key }}</dt>
                <dd {{ $valueClasses }}>{{ $value }}</dd>
            </div>
        @endforeach
    @else
        {{ $slot }}
    @endif
</dl>
