@blaze(fold: true)

@php
$classes = Laraliveui::classes()
    ->add('mx-auto w-full [:where(&)]:max-w-7xl px-6 lg:px-8')
    ;
@endphp

<div {{ $attributes->class($classes) }} data-laraliveui-container>
    {{ $slot }}
</div>
