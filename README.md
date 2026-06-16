# LaraLiveUI

A comprehensive UI component library for Livewire applications, built with Tailwind CSS.

> **Note:** This is a community-driven open-source project. LaraLiveUI provides both free and open-source components for your Livewire applications.
>
> 📚 [View Documentation](https://elnasnato.github.io/laraliveui-docs/)

## Prerequisites

- Laravel v10.0+
- Livewire v3.5.19+
- Tailwind CSS v4.0+

## Installation

```bash
composer require elnasnato/laraliveui
```

## Quick Start

### 1. Include Assets

Add the `@laraliveuiAppearance` and `@laraliveuiScripts` Blade directives to your layout:

```blade
<head>
    ...
    @laraliveuiAppearance
</head>

<body>
    ...
    @livewireScripts
    @laraliveuiScripts
</body>
```

### 2. Set up Tailwind CSS

Add to your `resources/css/app.css`:

```css
@import 'tailwindcss';
@import '../../vendor/elnasnato/laraliveui/dist/laraliveui.css';

@custom-variant dark (&:where(.dark, .dark *));
```

### 3. Usage

Use components with the `laraliveui:` prefix:

```blade
<laraliveui:button variant="primary">Click me</laraliveui:button>

<laraliveui:input name="email" placeholder="Email" />

<laraliveui:modal name="my-modal">
    <laraliveui:modal.trigger>
        <laraliveui:button>Open Modal</laraliveui:button>
    </laraliveui:modal.trigger>

    <laraliveui:modal.dialog>
        <h2>Modal Title</h2>
        <p>Modal content goes here.</p>
    </laraliveui:modal.dialog>
</laraliveui:modal>

<laraliveui:dropdown>
    <laraliveui:dropdown.trigger>
        <laraliveui:button>Menu</laraliveui:button>
    </laraliveui:dropdown.trigger>

    <laraliveui:menu>
        <laraliveui:menu.item>Profile</laraliveui:menu.item>
        <laraliveui:menu.item>Settings</laraliveui:menu.item>
        <laraliveui:menu.separator />
        <laraliveui:menu.item>Logout</laraliveui:menu.item>
    </laraliveui:menu>
</laraliveui:dropdown>

<laraliveui:table>
    <laraliveui:table.columns>
        <laraliveui:table.column label="Name" />
        <laraliveui:table.column label="Email" />
    </laraliveui:table.columns>
    <laraliveui:table.rows>
        <laraliveui:table.row>
            <laraliveui:table.cell>John Doe</laraliveui:table.cell>
            <laraliveui:table.cell>john@example.com</laraliveui:table.cell>
        </laraliveui:table.row>
    </laraliveui:table.rows>
</laraliveui:table>
```

## Components

### Free Components

- Accordion, Autocomplete, Avatar, Badge, Brand, Breadcrumbs, Button
- Callout, Card, Checkbox, Color Picker, Combobox, Command, Context
- Date Picker, Dropdown, Editor, Field, File Upload, Heading, Icon
- Input, Kanban, Layout (Header, Sidebar, Main, Footer), Modal
- Navbar, Navlist, OTP Input, Pagination, Pillbox, Popover
- Progress, Radio, Select, Separator, Skeleton, Slider, Switch
- Table, Tabs, Text, Textarea, Time Picker, Timeline, Toast, Tooltip

### Using Components

All components use the `laraliveui:` prefix with dot notation for sub-components:

```blade
<laraliveui:button variant="primary" size="base" icon="plus">
    New Item
</laraliveui:button>

<laraliveui:input.group>
    <laraliveui:input.group.prefix>https://</laraliveui:input.group.prefix>
    <laraliveui:input name="url" placeholder="example.com" />
</laraliveui:input.group>
```

## Icons

LaraLiveUI includes over 300 Heroicons-based SVG icon components:

```blade
<laraliveui:icon name="magnifying-glass" />
<laraliveui:icon name="x-mark" variant="solid" />
<laraliveui:icon name="check-circle" class="text-green-500" />
```

## Customization

To customize specific LaraLiveUI components, publish their Blade files:

```bash
php artisan laraliveui:publish
```

## License

LaraLiveUI is open-source software licensed under the MIT license.
