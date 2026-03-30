# CSS Tailwind Convention

## Description
This document defines the CSS + Tailwind convention used in this project to keep HTML clean, readable, and maintainable.

## Main Rule
Do not place long Tailwind utility lists directly in HTML templates.
Create semantic CSS classes in project CSS files and compose styles with `@apply`.

## Nested CSS Directive
Nested CSS is allowed and encouraged for component states and structure.

Use nesting for:
- `:hover`, `:focus-visible`, `:active`
- modifier classes (for example `&.active`)
- pseudo-elements (`&::before`, `&::after`)
- media-query blocks inside the component

Keep nesting shallow (recommended max depth: 2 levels) to avoid hard-to-maintain selectors.

Example:
```scss
.menu-link {
    @apply inline-flex items-center rounded-md px-3 py-2 text-sm font-medium uppercase tracking-wide;
    @apply text-slate-700 transition-colors;

    &:hover {
        @apply bg-slate-100 text-slate-900;
    }

    &.active {
        @apply bg-slate-200 text-slate-900;
    }

    &:focus-visible {
        @apply outline outline-2 outline-offset-2 outline-blue-500;
    }

    &::after {
        content: '';
        @apply absolute bottom-0 left-0 h-[3px] w-0 bg-current transition-[width] duration-300;
    }

    &:hover::after {
        @apply w-full;
    }
}
```

## Benefits
- Cleaner and more readable HTML
- Centralized and maintainable styles
- Better component reuse
- Easier global refactors
- Clear separation between structure and presentation

## Correct Usage

### Incorrect: Tailwind utilities directly in HTML
```php
<a href="<?php echo esc_url( $item->url ); ?>"
     class="inline-flex items-center rounded-md px-3 py-2 text-sm font-medium uppercase tracking-wide md:text-white md:hover:bg-white md:hover:bg-opacity-20 text-slate-700 hover:bg-slate-100 hover:text-slate-900">
        <?php echo esc_html( $item->title ); ?>
</a>
```

### Correct: semantic class in HTML + `@apply` in CSS
In HTML (`template-parts/menu-primary.php`):
```php
<a href="<?php echo esc_url( $item->url ); ?>" class="menu-link">
        <?php echo esc_html( $item->title ); ?>
</a>
```

In CSS (`assets/css/header.css`):
```scss
.menu-link {
    @apply inline-flex items-center rounded-md px-3 py-2 text-sm font-medium uppercase tracking-wide;
    @apply text-slate-700 hover:bg-slate-100 hover:text-slate-900;

    @media (min-width: 768px) {
        @apply text-white;
    }
}
```

## Use Cases

### 1. Reusable Components
```scss
.btn-primary {
    @apply rounded-lg bg-blue-500 px-4 py-2 font-medium text-white transition-colors hover:bg-blue-600;
}

.btn-secondary {
    @apply rounded-lg border-2 border-gray-300 px-4 py-2 text-gray-700 transition-colors hover:border-gray-400;
}
```

### 2. Complex States
```scss
.nav-item {
    @apply px-3 py-2 text-slate-700 transition-colors hover:bg-slate-100;

    &.active {
        @apply bg-slate-200 font-semibold text-slate-900;
    }

    &:focus-visible {
        @apply outline-2 outline-offset-2 outline-blue-500;
    }
}
```

### 3. Responsive Variants
```scss
.card {
    @apply w-full;

    @media (min-width: 768px) {
        @apply w-1/2;
    }

    @media (min-width: 1024px) {
        @apply w-1/3;
    }
}
```

## Naming Conventions
- Use kebab-case class names
- Use descriptive, component-oriented names
- Add component prefixes when useful

Examples:
- `.menu-link` - menu link
- `.mobile-menu-button` - mobile menu toggle button
- `.hero-section` - hero section
- `.card-primary` - primary card variant

## Style Location

| Component Type | Location |
|---|---|
| Header and navigation | `assets/css/header.css` |
| Footer | `assets/css/footer.css` |
| WooCommerce | `assets/css/woocommerce.css` |
| Buttons and core | `assets/css/core/buttons.css` |
| Global styles | `assets/css/style.css` |

## Build Process
After changing CSS files:

```bash
npm run build
```

This generates synchronized output under `dist/`.

## theme.json Guidance
For color palette and global variables:
- Define base palette in `theme.json`
- Reuse CSS variables in component CSS
- Avoid hardcoded colors in one-off selectors

## Exceptions
Direct Tailwind classes in HTML can be acceptable for:
1. One-off single-line utilities in isolated cases
2. Unique styles used only once
3. Fast prototypes (must be refactored later)

Even in these cases, prefer semantic CSS classes whenever possible.

## Review Checklist
- [ ] HTML classes are semantic and use kebab-case
- [ ] Styles are defined in CSS files
- [ ] Tailwind composition is done with `@apply`
- [ ] Reusable UI patterns are centralized
- [ ] Nesting is used for states/modifiers without excessive depth
- [ ] Tailwind utility clutter is avoided in templates
- [ ] Build was run after style updates (`npm run build`)
