@props([
    'name' => null,
    'sortable' => false,
    'striped' => false,
    'hover' => false,
])

<div {{ $attributes->class('w-full overflow-x-auto') }}>
    <table class="w-full text-left text-sm">
        {{ $slot }}
    </table>
</div>
