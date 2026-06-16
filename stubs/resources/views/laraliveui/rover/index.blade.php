@props([
    'orientation' => 'vertical',
    'loop' => true,
])

@php
$nextKey = match ($orientation) {
    'horizontal' => 'arrow-right',
    'both' => 'arrow-right',
    default => 'arrow-down',
};
$prevKey = match ($orientation) {
    'horizontal' => 'arrow-left',
    'both' => 'arrow-left',
    default => 'arrow-up',
};
@endphp

<div
    x-data="{
        focusedIndex: 0,
        items: [],
        loop: @js($loop),
        init() {
            this.$nextTick(() => {
                this.items = this.$el.querySelectorAll('[data-rover-item]')
                if (this.items.length > 0) {
                    this.focusedIndex = 0
                    this.focusCurrent()
                }
            })
        },
        focusCurrent() {
            this.items.forEach((el, i) => {
                el.setAttribute('tabindex', i === this.focusedIndex ? '0' : '-1')
                if (i === this.focusedIndex) el.focus()
            })
        },
        focusNext() {
            if (this.items.length === 0) return
            let next = this.focusedIndex + 1
            if (next >= this.items.length) {
                if (this.loop) next = 0
                else return
            }
            this.focusedIndex = next
            this.focusCurrent()
        },
        focusPrev() {
            if (this.items.length === 0) return
            let prev = this.focusedIndex - 1
            if (prev < 0) {
                if (this.loop) prev = this.items.length - 1
                else return
            }
            this.focusedIndex = prev
            this.focusCurrent()
        },
        focusFirst() { this.focusedIndex = 0; this.focusCurrent() },
        focusLast() { this.focusedIndex = this.items.length - 1; this.focusCurrent() },
        handleItemClick(index) {
            this.focusedIndex = index
        }
    }"
    x-on:keydown.{{ $nextKey }}.prevent="focusNext()"
    x-on:keydown.{{ $prevKey }}.prevent="focusPrev()"
    x-on:keydown.home.prevent="focusFirst()"
    x-on:keydown.end.prevent="focusLast()"
    role="{{ $orientation === 'vertical' ? 'listbox' : 'menubar' }}"
    {{ $attributes }}
>
    {{ $slot }}
</div>
