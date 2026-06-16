# AGENTS.md — LaraLiveUI Project Context

## Project Overview

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

## Documentation
All documentation is at https://elnasnato.github.io/laraliveui-docs/
Each repo's README must link to this URL.
