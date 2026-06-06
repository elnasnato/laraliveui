@blaze(fold: true, unsafe: [
    // laraliveui:with-field props
    'name', 'label', 'badge',
    'description', 'description:trailing',
    'label:badge', 'label:aside', 'label:trailing',
    'error:name', 'error:bag', 'error:message', 'error:icon', 'error:nested', 'error:deep',
])

@props([
    'length' => null,
    'private' => false,
])

@php
    $classes = Laraliveui::classes()
        ->add('flex items-center gap-2 isolate w-fit')
        ->add('[&_[data-laraliveui-input-group]]:w-auto')
@endphp

<laraliveui:with-field :$attributes>
    <ui-otp
        {{ $attributes->class($classes) }}
        data-laraliveui-otp
        data-laraliveui-control
        role="group"
        data-laraliveui-input-aria-label="{{ __('Character {current} of {total}') }}"
    >
        <?php if($slot->isEmpty() && $length): ?>
            <?php for($i = 0; $i < $length; $i++): ?>
                <laraliveui:otp.input />
            <?php endfor; ?>
        <?php else: ?>
            {{ $slot }}
        <?php endif; ?>
    </ui-otp>
</laraliveui:with-field>