@props([
    'autoplay' => false,
    'interval' => 3000,
])

<div
    x-data="{
        current: 0,
        slides: [],
        init() {
            this.slides = [...this.\$el.querySelectorAll('[data-slide]')]
            if (this.autoplay) {
                setInterval(() => this.next(), {{ $interval }})
            }
        },
        next() {
            this.current = (this.current + 1) % this.slides.length
            this.update()
        },
        prev() {
            this.current = (this.current - 1 + this.slides.length) % this.slides.length
            this.update()
        },
        update() {
            this.slides.forEach((slide, i) => {
                slide.style.display = i === this.current ? '' : 'none'
            })
        }
    }"
    x-data="{ autoplay: @js($autoplay) }"
    {{ $attributes->class('relative overflow-hidden rounded-xl') }}
>
    {{ $slot }}
</div>
