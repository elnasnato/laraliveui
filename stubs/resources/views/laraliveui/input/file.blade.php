@blaze(fold: true)

@php
extract(Laraliveui::forwardedAttributes($attributes, [
    'name',
    'multiple',
    'size',
]));
@endphp

@props([
    'name' => $attributes->whereStartsWith('wire:model')->first(),
    'multiple' => null,
    'size' => null,
])

@php
$classes = Laraliveui::classes()
    ->add('w-full flex items-center gap-4')
    ->add('[[data-laraliveui-input-group]_&]:items-stretch [[data-laraliveui-input-group]_&]:gap-0')

    // NOTE: We need to add relative positioning here to prevent odd overflow behaviors because of
    // "sr-only": https://github.com/tailwindlabs/tailwindcss/discussions/12429
    ->add('relative')
    ;

[ $styleAttributes, $attributes ] = Laraliveui::splitAttributes($attributes);
@endphp

<div
    {{ $styleAttributes->class($classes) }}
    data-laraliveui-input-file
    wire:ignore
    tabindex="0"
    x-data="fluxInputFile({ files: '{{ __('files') }}', noFile: '{{ __('No file chosen') }}' })"
    x-on:click.prevent.stop="$refs.input.click()"
    x-on:keydown.enter.prevent.stop="$refs.input.click()"
    x-on:keydown.space.prevent.stop
    x-on:keyup.space.prevent.stop="$refs.input.click()"
    x-on:change="updateLabel($event)"
>
    <input
        x-ref="input"
        x-on:click.stop {{-- Without this, the parent element's click listener will ".prevent" the file input from being clicked... --}}
        type="file"
        class="sr-only"
        tabindex="-1"
        {{ $attributes }} {{ $multiple ? 'multiple' : '' }} @if($name)name="{{ $name }}"@endif
    >

    <laraliveui:button as="div" class="cursor-pointer" :$size aria-hidden="true">
        <?php if ($multiple) : ?>
            {!! __('Choose files') !!}
        <?php else : ?>
            {!! __('Choose file') !!}
        <?php endif; ?>
    </laraliveui:button>

    <div
        x-ref="name"
        @class([
            'cursor-default select-none truncate whitespace-nowrap text-sm text-zinc-500 dark:text-zinc-400 font-medium',
            '[[data-laraliveui-input-group]_&]:flex-1 [[data-laraliveui-input-group]_&]:border-e [[data-laraliveui-input-group]_&]:border-y [[data-laraliveui-input-group]_&]:shadow-xs [[data-laraliveui-input-group]_&]:border-zinc-200 dark:[[data-laraliveui-input-group]_&]:border-zinc-600 [[data-laraliveui-input-group]_&]:px-4 [[data-laraliveui-input-group]_&]:bg-white dark:[[data-laraliveui-input-group]_&]:bg-zinc-700 [[data-laraliveui-input-group]_&]:flex [[data-laraliveui-input-group]_&]:items-center dark:[[data-laraliveui-input-group]_&]:text-zinc-300',
        ])
        aria-hidden="true"
    >
        {!! __('No file chosen') !!}
    </div>
</div>
