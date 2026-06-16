@props([
    'before' => null,
    'after' => null,
    'beforeLabel' => null,
    'afterLabel' => null,
    'startPosition' => 50,
])

<div
    x-data="{
        position: @js($startPosition),
        isDragging: false,
        container: null,
        init() {
            this.container = this.$refs.container
        },
        startDrag(e) {
            this.isDragging = true
            this.updatePosition(e)
            document.addEventListener('mousemove', this.onDrag = (ev) => this.updatePosition(ev))
            document.addEventListener('mouseup', this.stopDrag = () => this.isDragging = false)
            document.addEventListener('touchmove', this.onTouchDrag = (ev) => this.updatePosition(ev))
            document.addEventListener('touchend', this.stopDrag = () => this.isDragging = false)
        },
        updatePosition(e) {
            if (!this.isDragging || !this.container) return
            const rect = this.container.getBoundingClientRect()
            const x = (e.clientX ?? e.touches?.[0]?.clientX ?? 0) - rect.left
            this.position = Math.max(0, Math.min(100, (x / rect.width) * 100))
        }
    }"
    {{ $attributes->class('relative overflow-hidden select-none rounded-lg') }}
    role="figure"
    aria-label="{{ __('Image comparison') }}"
>
    <div x-ref="container" class="relative w-full">
        {{-- After image (default/full view) --}}
        <div class="w-full">
            @if ($after)
                <img src="{{ $after }}" alt="{{ $afterLabel ?? '' }}" class="w-full block" />
            @else
                {{ $after ?? '' }}
            @endif
        </div>

        {{-- Before image (clipped overlay) --}}
        <div
            class="absolute inset-0"
            x-bind:style="`clip-path: inset(0 ${100 - position}% 0 0)`"
        >
            @if ($before)
                <img src="{{ $before }}" alt="{{ $beforeLabel ?? '' }}" class="w-full block" />
            @else
                {{ $before ?? '' }}
            @endif
        </div>

        {{-- Labels --}}
        @if ($beforeLabel || $afterLabel)
            <div class="absolute inset-x-0 top-0 flex justify-between p-3 pointer-events-none">
                @if ($beforeLabel)
                    <span class="rounded bg-black/50 px-2 py-0.5 text-xs text-white">{{ $beforeLabel }}</span>
                @endif
                @if ($afterLabel)
                    <span class="rounded bg-black/50 px-2 py-0.5 text-xs text-white">{{ $afterLabel }}</span>
                @endif
            </div>
        @endif

        {{-- Divider line and handle --}}
        <div
            class="absolute inset-y-0 w-0.5 bg-white shadow-sm pointer-events-none"
            x-bind:style="`left: ${position}%`"
        ></div>

        <button
            type="button"
            x-on:mousedown.prevent="startDrag"
            x-on:touchstart.prevent="startDrag"
            x-bind:style="`left: ${position}%`"
            class="absolute top-1/2 -translate-x-1/2 -translate-y-1/2 z-10 flex items-center justify-center size-8 rounded-full bg-white shadow-md border border-zinc-200 cursor-ew-resize hover:scale-110 transition focus:outline-none focus:ring-2 focus:ring-zinc-500"
            aria-label="{{ __('Drag to compare') }}"
        >
            <svg class="size-4 text-zinc-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor">
                <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
</div>
