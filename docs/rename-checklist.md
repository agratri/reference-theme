# Rename checklist — starting a new project from this base

Run this **first**, before porting any HTML. Renaming after the port means touching hundreds of files.

## Decide the four names

| Slot | Example | Rule |
|---|---|---|
| Theme slug / folder | `carewell` | lowercase, no spaces, no dashes if avoidable |
| Function prefix | `carewell_` | matches the slug |
| Class prefix | `Carewell_` | studly caps |
| CSS prefix | `cw-` or keep `tp-` | keep `tp-` only if the HTML template already uses it |

Ask the user for these if they are not stated. Do not invent them silently.

Text domains follow the slug: theme `carewell`, plugin `carewell-core`.

## 1. Folder and file names

```
kindaid/                          → carewell/
plugin/kindaid-core/              → plugin/carewell-core/
plugin/kindaid-core/kindaid-core.php → plugin/carewell-core/carewell-core.php
include/kindaid-kirki.php         → include/carewell-kirki.php
include/kindaid-metafields.php    → include/carewell-metafields.php   (fix the typo)
include/kindaid-woocommerce.php   → include/carewell-woocommerce.php
```

Update the matching `include_once` / `require_once` lines in `functions.php` and
`carewell-core.php`.

## 2. `style.css` header block

```css
/*
    Theme Name: CareWell
    Author: <author>
    Theme URI: <url>
    Author URI: <url>
    Description: CareWell - <description>
    Version: 1.0.0
    License: GNU General Public License v3 or later
    License URI: http://www.gnu.org/licenses/gpl-3.0.html
    Text Domain: carewell
    Requires at least: 6.0
    Tested up to: 7.0
    Requires PHP: 7.4
    Tags: custom-background, custom-logo, custom-menu, featured-images, threaded-comments, translation-ready
*/
```

`Text Domain` **must** equal the folder name, or translations break and Theme Check fails.

## 3. Plugin header

`plugin/carewell-core/carewell-core.php`:

```php
/**
 * Plugin Name: CareWell Core
 * Description: CareWell core plugin for widgets.
 * Version:     1.0.0
 * Author:      <author>
 * Author URI:  <url>
 * Text Domain: carewell-core
 *
 * Requires Plugins: elementor
 * Elementor tested up to: 3.33.5
 */
```

## 4. Find-and-replace, in this order

Order matters — do the longest strings first so you don't corrupt them.

| Find | Replace | Scope |
|---|---|---|
| `kindaid-core` | `carewell-core` | plugin folder, `add_plugin.php`, all text domains in plugin |
| `KindAid_` | `Carewell_` | `nav-walker.php`, all `new KindAid_...` |
| `Kindaid_` | `Carewell_` | plugin widget + WP_Widget classes |
| `kindaid_` | `carewell_` | all theme functions, all hooks |
| `kindaid-` | `carewell-` | Elementor slugs, asset handles |
| `'kindaid'` | `'carewell'` | text domains |
| `kindaid` | `carewell` | remaining paths, comments, prefixes |

Then verify nothing was missed:

```
grep -rin "kindaid" --include="*.php" --include="*.css" --include="*.js" .
```

The only acceptable remaining hits are in `docs/` and this checklist.

## 5. Fix the inherited sloppiness while you are in there

| Current | Change to | Why |
|---|---|---|
| `themename_register_dummy_block_style` | `carewell_register_dummy_block_style` | unprefixed global |
| `themename_register_dummy_block_pattern` | `carewell_register_dummy_block_pattern` | same |
| `themename/dummy-pattern` | `carewell/dummy-pattern` | same |
| `kindaid_register_elementor_widgets` | `carewell_register_elementor_widgets` | leftover boilerplate name |
| `header_info_section()`, `header_social_kirki()` etc. in the Kirki file | `carewell_header_info_section()` etc. | unprefixed globals |
| `'kindaid-core'` in Elementor labels | `'carewell-core'` | covered by the find-and-replace above; the old `'textdomain'` placeholder is already fixed in this repo |
| `kindaid_all_cat()`, `kindaid_all_post()` | `carewell_all_cat()`, `carewell_all_post()` | unprefixed plugin globals |
| `kindaid_kses_svg()` | `carewell_kses_svg()` | unprefixed |
| `Kindaid_Content_Style` trait | `Carewell_Content_Style` | unprefixed |
| `echo get_template_part(...)` | `get_template_part(...)` | function returns nothing |
| `<p>Post not found</p>` | `<?php esc_html_e('Post not found','carewell'); ?>` | untranslated |
| `time()` as `main.css` version | `$theme_version` | cache busting on every page load |
| `alt="<?php echo bloginfo(); ?>"` | `alt="<?php echo esc_attr(get_bloginfo('name')); ?>"` | `bloginfo()` echoes; `echo` is wrong |
| `wp_kses_post()` then `esc_html()` in `footer-info.php` | one or the other | double escaping |

See `docs/known-issues.md` for the full list.

## 6. Asset handles

In `include/common/theme-scripts.php`, theme-owned handles are prefixed, vendor handles are not:

```php
wp_enqueue_style( 'carewell-fonts',     carewell_fonts_url(), … );
wp_enqueue_style( 'bootstrap',          … );   // vendor, keep as-is
wp_enqueue_style( 'carewell-spacing',   … );
wp_enqueue_style( 'carewell-main',      … );
wp_enqueue_script( 'carewell-slider-init', … );
wp_enqueue_script( 'carewell-main',        … );
```

Keeping vendor handles unprefixed lets plugins that enqueue the same library dedupe.

## 7. Required plugin list

`include/add_plugin.php`: change the first entry's `name` and `slug` to the new core plugin, and
remove any plugin the new template does not use (Charitable, Eventin, WooCommerce). Every removal must
also remove the corresponding `class_exists()` guarded code — do not leave dead includes.

## 8. Sidebar IDs

Sidebar IDs are stored in the database against widget assignments. Renaming them on a fresh install is
free; renaming them later loses the user's widgets. Decide now:

```
blog-sidebar, product-sidebar, donation-sidebar, event-sidebar
footer-1-widget-1 … footer-1-widget-4
footer-2-widget-1 … footer-2-widget-4
```

If the new template has a different number of footers or columns, set the IDs to match before writing
any footer template.

## 9. Customizer setting IDs

Same reasoning, but the safe default is **keep the existing IDs** (`logo`, `footer_copyright`,
`header-global`, …). They are generic enough to carry over, and matching IDs mean the demo import data
still applies. Only rename if a setting is genuinely project-specific.

For any **new** setting, use underscores.

## 10. Verify before porting

```
# 1. no leftovers
grep -rin "kindaid\|themename\|hello_world\|'textdomain'" --include="*.php" .

# 2. syntax check every file
find . -name "*.php" -exec php -l {} \;

# 3. activate the theme + plugin on a clean install
#    → no PHP notices, TGMPA notice lists the right plugins,
#      Customizer panel appears, all sidebars listed under Appearance → Widgets
```

Only then start step 2 of `docs/html-to-wp-workflow.md`.
