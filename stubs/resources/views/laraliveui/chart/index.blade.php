@props([
    'type' => 'bar',
    'labels' => [],
    'datasets' => [],
    'height' => 300,
])

<div {{ $attributes->class('w-full') }} style="height: {{ $height }}px;">
    <canvas
        x-data="{
            chart: null,
            init() {
                // Simple chart rendering without Chart.js dependency
                // For production, integrate with Chart.js or a similar library
            }
        }"
        x-init="init()"
    ></canvas>
</div>
