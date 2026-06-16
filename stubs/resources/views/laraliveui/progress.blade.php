@blaze(fold: true)

@props([
    'color' => null,
])

@php
$trackClasses = Laraliveui::classes()
    ->add('h-1.5 relative w-full overflow-hidden bg-zinc-200 dark:bg-white/10')
    ->add('[print-color-adjust:exact]')
    ->add('rounded-full')
    ->add(match ($color) {
        'red'     => '[--laraliveui-progress-color:var(--color-red-600)] dark:[--laraliveui-progress-color:var(--color-red-400)]',
        'orange'  => '[--laraliveui-progress-color:var(--color-orange-600)] dark:[--laraliveui-progress-color:var(--color-orange-400)]',
        'amber'   => '[--laraliveui-progress-color:var(--color-amber-600)] dark:[--laraliveui-progress-color:var(--color-amber-400)]',
        'yellow'  => '[--laraliveui-progress-color:var(--color-yellow-600)] dark:[--laraliveui-progress-color:var(--color-yellow-400)]',
        'lime'    => '[--laraliveui-progress-color:var(--color-lime-600)] dark:[--laraliveui-progress-color:var(--color-lime-400)]',
        'green'   => '[--laraliveui-progress-color:var(--color-green-600)] dark:[--laraliveui-progress-color:var(--color-green-400)]',
        'emerald' => '[--laraliveui-progress-color:var(--color-emerald-600)] dark:[--laraliveui-progress-color:var(--color-emerald-400)]',
        'teal'    => '[--laraliveui-progress-color:var(--color-teal-600)] dark:[--laraliveui-progress-color:var(--color-teal-400)]',
        'cyan'    => '[--laraliveui-progress-color:var(--color-cyan-600)] dark:[--laraliveui-progress-color:var(--color-cyan-400)]',
        'sky'     => '[--laraliveui-progress-color:var(--color-sky-600)] dark:[--laraliveui-progress-color:var(--color-sky-400)]',
        'blue'    => '[--laraliveui-progress-color:var(--color-blue-600)] dark:[--laraliveui-progress-color:var(--color-blue-400)]',
        'indigo'  => '[--laraliveui-progress-color:var(--color-indigo-600)] dark:[--laraliveui-progress-color:var(--color-indigo-400)]',
        'violet'  => '[--laraliveui-progress-color:var(--color-violet-600)] dark:[--laraliveui-progress-color:var(--color-violet-400)]',
        'purple'  => '[--laraliveui-progress-color:var(--color-purple-600)] dark:[--laraliveui-progress-color:var(--color-purple-400)]',
        'fuchsia' => '[--laraliveui-progress-color:var(--color-fuchsia-600)] dark:[--laraliveui-progress-color:var(--color-fuchsia-400)]',
        'pink'    => '[--laraliveui-progress-color:var(--color-pink-600)] dark:[--laraliveui-progress-color:var(--color-pink-400)]',
        'rose'    => '[--laraliveui-progress-color:var(--color-rose-600)] dark:[--laraliveui-progress-color:var(--color-rose-400)]',
        default   => '[--laraliveui-progress-color:var(--color-accent)]',
    })
    ;

$barClasses = Laraliveui::classes()
    ->add('h-full rounded-full transition-[width] duration-300 ease-out')
    ->add('bg-[var(--laraliveui-progress-color)]')
    ;
@endphp

<ui-progress {{ $attributes->class($trackClasses) }} data-laraliveui-progress>
    <div class="{{ $barClasses }}" style="width: var(--laraliveui-progress-percentage)"></div>
</ui-progress>
