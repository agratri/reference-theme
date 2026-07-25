# KindAid — WordPress theme reference

A reference implementation of a ThemeForest-standard WordPress theme, kept so that an AI assistant can
convert HTML templates into WordPress themes that follow one consistent architecture.

This is **not** a live site and not meant to be installed as-is. It is the pattern library.

## What's here

```
kindaid/                 theme — templates, header/footer variants, Customizer, assets
plugin/kindaid-core/     companion plugin — Elementor widgets, WP_Widget classes, demo import
CLAUDE.md                the rules an assistant must follow (read automatically)
PROJECT-INSTRUCTIONS.md  copy-paste setup for a Claude Desktop project
docs/                    detailed reference for each subsystem
```

## Docs

| File | Covers |
|---|---|
| [`docs/architecture.md`](docs/architecture.md) | full file map, load order, request flow, dependency guards |
| [`docs/header-footer.md`](docs/header-footer.md) | the variant system, the `header_before` hook chain, adding a variant |
| [`docs/widgets.md`](docs/widgets.md) | `register_sidebar()` format, `WP_Widget` classes, wrapper markup |
| [`docs/customizer.md`](docs/customizer.md) | Kirki panel/section/field patterns, reading options safely |
| [`docs/metabox.md`](docs/metabox.md) | Pure Metafields per-page options, the override pattern |
| [`docs/elementor-widgets.md`](docs/elementor-widgets.md) | widget anatomy, layout switches, repeaters, `el-*` style hooks, traits |
| [`docs/templates.md`](docs/templates.md) | template hierarchy, content partials, post formats, breadcrumb |
| [`docs/html-to-wp-workflow.md`](docs/html-to-wp-workflow.md) | the 10-step conversion playbook |
| [`docs/rename-checklist.md`](docs/rename-checklist.md) | every string to change when starting a new project |
| [`docs/known-issues.md`](docs/known-issues.md) | bugs in this repo — do not replicate |

## Core conventions, in brief

**Two packages.** Presentation in the theme, functionality in the plugin. If switching themes would
break the site, it belongs in the plugin. Elementor widgets and custom post types are never in the
theme.

**`functions.php` is a loader.** No logic, only `include_once` of files in `include/`.

**Header and footer are variant-driven.** `header.php` contains no `<header>` markup; it fires
`do_action('header_before')`, and `kindaid_header()` picks a template from
`templates/header/header-N.php` using a three-level fallback: page metabox → Customizer → hardcoded
default.

**Nothing is hardcoded that a user might change.** Logos, social links, button text, copyright,
background images and layout choices all come from `get_theme_mod()` with a default.

**Nothing renders unguarded.** Every optional region is wrapped in `is_active_sidebar()`,
`has_post_thumbnail()`, `!empty()` or a `class_exists()` check, so an empty area leaves no gap and a
missing plugin causes no fatal.

**Escape at output.** `esc_html()` / `esc_attr()` / `esc_url()` for plain values, `kindaid_kses()`
(theme) or `kindaid_kses_svg()` (plugin) for text that may legitimately contain markup.

Full detail in [`CLAUDE.md`](CLAUDE.md).

## Using this as a conversion reference

See [`PROJECT-INSTRUCTIONS.md`](PROJECT-INSTRUCTIONS.md). Short version:

1. Push this repo to GitHub (public).
2. Create a Claude Desktop project and paste the instruction block into its Instructions.
3. Also clone this repo locally next to your sites so it can be read without the network.
4. In a new chat: connect the folder containing both the reference and your WordPress install, then
   point at the HTML template you want converted.

The assistant then works through `docs/html-to-wp-workflow.md`, reporting at each step, and asks
rather than guessing when the template needs something this repo has no pattern for.

## Stack the reference assumes

Elementor, Kirki, Pure Metafields, TGM Plugin Activation, One Click Demo Import, Contact Form 7, and
optionally WooCommerce, Charitable and Eventin. Bootstrap 5, Swiper, WOW.js, Magnific Popup,
PureCounter on the front end.
