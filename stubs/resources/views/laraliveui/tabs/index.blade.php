@props([
    'selected' => null,
    'variant' => 'tabs',
])

<div
    x-data="{
        selectedTab: @js($selected ?? null),
        init() {
            if (! this.selectedTab) {
                const firstTab = this.$el.querySelector('[data-slot=\"tab\"]')
                if (firstTab) this.selectedTab = firstTab.getAttribute('data-name') || firstTab.textContent.trim()
            }
        },
        handleTabClick(tab) {
            this.selectedTab = tab.getAttribute('data-name') || tab.textContent.trim()
        },
        isActive(tab) {
            return (tab.getAttribute('data-name') || tab.textContent.trim()) === this.selectedTab
        }
    }"
    {{ $attributes }}
>
    {{ $slot }}
</div>
