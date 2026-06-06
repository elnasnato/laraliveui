@blaze(fold: true)

@props([
    'name' => $attributes->whereStartsWith('wire:model')->first(),
])

<laraliveui:with-inline-field variant="inline" :$attributes>
    {{-- We have to put tabindex="-1" here because otherwise, Livewire requests will wipe out tabindex state, --}}
    {{-- even with durable attributes for some reason... --}}
    {{-- We are redundantly setting the size of this container to 1.125rem so that the focus outline isn't oblong. --}}
    <ui-radio {{ $attributes->class('flex size-[1.125rem] rounded-full mt-px outline-offset-2') }} data-laraliveui-control data-laraliveui-radio tabindex="-1">
        <laraliveui:radio.indicator />
    </ui-radio>
</laraliveui:with-inline-field>
