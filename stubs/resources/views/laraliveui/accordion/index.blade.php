@props([
    'multiple' => false,
    'collapsible' => true,
    'defaultOpen' => null,
])

<div
    x-data="{
        openItems: @js($defaultOpen ? (array) $defaultOpen : []),
        multiple: @js($multiple),
        collapsible: @js($collapsible),
        toggle(id) {
            if (this.multiple) {
                if (this.openItems.includes(id)) {
                    this.openItems = this.openItems.filter(i => i !== id)
                } else {
                    this.openItems.push(id)
                }
            } else {
                if (this.openItems.includes(id) && this.collapsible) {
                    this.openItems = []
                } else if (!this.openItems.includes(id)) {
                    this.openItems = [id]
                }
            }
        },
        isOpen(id) {
            return this.openItems.includes(id)
        }
    }"
    {{ $attributes }}
>
    {{ $slot }}
</div>
