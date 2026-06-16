@blaze(fold: true)

<nav {{ $attributes->class('flex flex-col overflow-visible min-h-auto') }} data-laraliveui-sidebar-nav>
    {{ $slot }}
</nav>
