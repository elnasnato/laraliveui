# AGENTS.md — LaraLiveUI Project Context

## Project Overview

LaraLiveUI is a **UI clone of FluxUI v2** for Laravel + Livewire + Tailwind CSS v4. FluxUI v2 has 49 component groups (29 free + 2 layouts + 18 pro). All are ported to `laraliveui:` namespace.

**Sheaf UI** (https://sheafui.dev, https://github.com/sheafui/components) is used as a functional reference for implementing FluxUI pro components and extra value-add components that don't exist in FluxUI v2. LaraLiveUI follows FluxUI conventions, NOT SheafUI conventions.

Three interconnected repositories:

### 1. `elnasnato/laraliveui` (this repo)
UI component library for Livewire + Tailwind CSS v4.
- **Packagist:** https://packagist.org/packages/elnasnato/laraliveui
- **GitHub:** https://github.com/elnasnato/laraliveui
- **Latest tag:** v1.0.4

### 2. `elnasnato/laraliveui-starter-kit`
Laravel starter kit installable via `laravel new app --using=elnasnato/laraliveui-starter-kit`.
- **Packagist:** https://packagist.org/packages/elnasnato/laraliveui-starter-kit
- **GitHub:** https://github.com/elnasnato/laraliveui-starter-kit
- **Latest tag:** v1.1.5

### 3. `elnasnato/laraliveui-docs`
Docusaurus documentation site, auto-deployed to GitHub Pages.
- **Site:** https://elnasnato.github.io/laraliveui-docs/
- **GitHub:** https://github.com/elnasnato/laraliveui-docs

## Key Names & Conventions

- **Package name:** `elnasnato/laraliveui` (NOT `laralive/laraliveui`)
- **Vendor path:** `vendor/elnasnato/laraliveui/` (NOT `vendor/laralive/laraliveui/`)
- **Component prefix:** `laraliveui:` (NOT `flux:`)
- **JS namespace:** `window.LaraLiveUI` (NOT `window.Flux`)
- **Alpine store:** `$laraliveui` (NOT `$flux`)
- **CSS prefix:** `data-laraliveui-` (NOT `data-flux-`), `--laraliveui-` (NOT `--flux-`)
- **Directives:** `@laraliveuiScripts`, `@laraliveuiAppearance` (NOT `@fluxScripts`)
- **Facade:** `Laraliveui::` (NOT `Flux::`)
- **View namespace:** `laraliveui::` (NOT `flux::`)

## Architecture

### Component Loading
- Blade components are stored in `stubs/resources/views/laraliveui/`
- Registered via `LaraliveuiServiceProvider::bootComponentPath()` as anonymous component path for `laraliveui:` namespace
- Custom tag compiler (`LaraliveuiTagCompiler`) compiles `<laraliveui:button>` syntax at compile time
- Icon components use `laraliveui:icon name="icon-name"` which delegates to `icon/icon-name.blade.php`

### Assets
- `dist/laraliveui.js` and `dist/laraliveui.min.js` served via AssetManager routes
- `dist/laraliveui.css` imported manually in user's `resources/css/app.css`
- `@laraliveuiAppearance` generates inline `<style>` and `<script>` for dark mode
- `@laraliveuiScripts` generates `<script>` tag loading the dist JS

### Starter Kit Features
- Auth: login, register, password reset, email verification, 2FA, passkeys
- Profile: update name/email, password, 2FA setup
- Appearance: light/dark/system toggle (persisted in localStorage as `laraliveui.appearance`)
- Layout: sidebar (collapsible, sticky), header, navbar, dashboard

## Important Commands

### Releasing new versions
```bash
# laraliveui
git tag v1.0.x && git push origin v1.0.x

# laraliveui-starter-kit
git tag v1.1.x && git push origin v1.1.x
```

### Before pushing a tag
1. Check git status and log
2. Verify README docs link is present
3. Check FUNDING.yml exists with PayPal link
4. Ensure no `flux` references remain in dist/ files

## Funding
- GitHub: `elnasnato`
- PayPal: https://paypal.me/CrunchyNatto
- FUNDING.yml is synced across all 3 repos

## Value-Add Components (beyond FluxUI v2)

Built from SheafUI functional reference, following LaraLiveUI/FluxUI conventions:
- **Kbd** (`kbd.blade.php`) — keyboard shortcut display
- **Theme Switcher** (`theme-switcher.blade.php`) — light/dark/system toggle
- **Empty** (`empty/index.blade.php`) — empty state placeholder
- **Key Value** (`key-value/index.blade.php`) — key-value display rows
- **Tags Input** (`tags-input/index.blade.php`) — tag/chip input with `laraliveui:with-field`
- **Image Diff** (`image-diff/index.blade.php`) — before/after image comparison slider
- **Rover** (`rover/index.blade.php` + `rover/item.blade.php`) — roving tabindex keyboard navigation
- **Combobox** (`combobox/index.blade.php` + `combobox/option.blade.php`) — searchable select
- **Repeater** (`repeater/index.blade.php`) — repeatable form field groups
- **Wizard** (`wizard/index.blade.php` + `wizard/step.blade.php`) — multi-step form wizard

Note: Carousel, Navmenu, Navlist exist in LaraLiveUI but are NOT in FluxUI v2.

## Documentation
All documentation is at https://elnasnato.github.io/laraliveui-docs/
Each repo's README must link to this URL.
