# Spacing in Block Themes and Blocks

Use this reference when a block task touches spacing controls, defaults, or output in the editor/frontend.

## Scope split: `block.json` vs `theme.json`

- Use `block.json` (`supports.spacing`) to control which spacing UI appears for a block.
- Use `theme.json` (`settings.spacing` and `styles.spacing`) to define presets, defaults, and design system behavior.
- In practice, spacing bugs often require checking both files.

## `settings.spacing` quick map

Use these keys in `theme.json` under `settings.spacing`:

- `blockGap`: controls Block Spacing UI and generated CSS behavior.
- `margin`: enables margin controls on supported blocks.
- `padding`: enables padding controls on supported blocks.
- `customSpacingSize`: allows or disallows user-entered custom values.
- `spacingScale`: generated preset scale.
- `spacingSizes`: explicit custom presets (fixed or fluid values).
- `units`: allowed CSS units for custom values.

## `blockGap` behavior matrix

`settings.spacing.blockGap` has three meaningful states:

- `null`: UI disabled and WordPress-generated block gap CSS disabled.
- `true`: UI enabled and WordPress-generated block gap CSS enabled.
- `false`: UI disabled but WordPress-generated block gap CSS remains enabled.

Prefer `true` for most block theme designs unless you intentionally handle spacing entirely via custom CSS.

## Scale vs custom sizes

Choose one main strategy for maintainability:

- `spacingScale`: best for quick, math-driven scale setup.
- `spacingSizes`: best for exact semantic sizes and fluid presets (`clamp()`).

Notes:

- Setting `spacingScale.steps: 0` disables the generated scale.
- More than 7 spacing presets changes the UI from slider to dropdown.
- Fluid spacing presets are supported via `spacingSizes` and CSS functions like `clamp()`.

## Using presets in styles

Presets are available as CSS custom properties:

- `--wp--preset--spacing--{slug}`

Use them in `theme.json` styles and custom CSS, for example in:

- root styles (`styles.spacing`)
- per-block styles (`styles.blocks["core/..."]`)
- custom CSS where contextual spacing is needed

## Block-level spacing support checks

When adding/changing spacing in a block:

1. Confirm the block has appropriate `supports.spacing` configuration.
2. Confirm theme settings enable the related controls (`margin`, `padding`, `blockGap`).
3. Confirm any expected presets exist (`spacingScale` or `spacingSizes`).
4. Test in both editor and frontend.

## Contextual spacing caveat

`blockGap` often controls vertical rhythm and can override expected margin patterns in flow layouts. If you need contextual exceptions (for example, heading rhythm after paragraphs), use targeted CSS and validate editor parity (`.wp-block-post-content` selectors may be necessary).

## Root padding aware alignments

If root horizontal padding is used and full-width blocks should visually bleed to edges, consider enabling:

- `settings.useRootPaddingAwareAlignments: true`

Validate nested full-width block behavior after enabling.

## Completion checklist

- Spacing controls shown only where intended.
- Presets map to expected values and names.
- Editor and frontend spacing match.
- No unintended regressions in nested blocks, flow/flex/grid layouts, or full-width blocks.
