@blaze(fold: true, unsafe: [
    // variant props
    'size', 'name',
    // laraliveui:with-field props
    'name', 'label', 'badge',
    'description', 'description:trailing',
    'label:badge', 'label:aside', 'label:trailing',
    'error:name', 'error:bag', 'error:message', 'error:icon', 'error:nested', 'error:deep',
])

@props([
    'variant' => 'default',
])

<laraliveui:delegate-component :component="'checkbox.group.variants.' . $variant">{{ $slot }}</laraliveui:delegate-component>
