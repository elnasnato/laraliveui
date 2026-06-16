@props([
    'name' => null,
])

<div
    data-wizard-step
    @if ($name) data-step-name="{{ $name }}" @endif
    x-show="$root.isStepActive($el)"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-x-4"
    x-transition:enter-end="opacity-100 translate-x-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-x-0"
    x-transition:leave-end="opacity-0 -translate-x-4"
    {{ $attributes->except(['class']) }}
>
    {{ $slot }}
</div>
