# KindAid — WordPress Theme Reference

This repository is a **reference implementation**, not a live site. It exists so an AI assistant
can convert an HTML template into a WordPress theme that follows exactly these conventions.

**When the user attaches an HTML template and asks to convert it to WordPress, follow this file.
Do not invent a different architecture.**

---

## 0. How to use this repo

| The user says | You do |
|---|---|
| "Convert this HTML to WordPress using kindaid rules" | Copy the `kindaid/` + `plugin/` structure, rename per `docs/rename-checklist.md`, port the HTML section by section |
| "Add a new Elementor widget" | Follow `docs/elementor-widgets.md` |
| "Add a new header/footer variant" | Follow `docs/header-footer.md` |
| "Add a Customizer option" | Follow `docs/customizer.md` |
| "Add a footer widget" | Follow `docs/widgets.md` |

**Read the relevant `docs/` file before writing code.** Do not guess from memory.

If something the task needs does not exist in this repo (a pattern, a helper, a plugin
integration), **stop and tell the user** — state what is missing and propose an approach.
Do not silently invent a new convention.

---

## 1. Two-package architecture — non-negotiable

```
kindaid/                 ← THEME: presentation only
plugin/kindaid-core/     ← PLUGIN: functionality
```

**Rule: if the site would break when the theme is switched, it belongs in the plugin.**

| Goes in the THEME | Goes in the PLUGIN |
|---|---|
| Template files (`index.php`, `single.php`, …) | Elementor widgets |
| header / footer / sidebar markup | Custom post types & taxonomies |
| CSS, JS, fonts, images | WP dashboard widgets (`WP_Widget` classes) |
| Customizer (Kirki) options | Demo importer (OCDI) config |
| WooCommerce template overrides | Shortcodes |
| Metabox definitions | Third-party plugin integrations |

This split is a ThemeForest requirement. Never move Elementor widgets into the theme.

---

## 1b. Brand identity — Agratri, always

Everything built from this repo ships under **Agratri**. When porting an HTML template, the
template's own author/vendor strings are **not** carried over — replace them with these:

| Slot | Value |
|---|---|
| Brand name | `Agratri` |
| Brand site | `https://agratri.com` |
| `Author:` — `style.css`, plugin header, `main.css` / `_theme.scss` banner | `agratri` |
| `Author URI:` | `https://themeforest.net/user/agratri` |
| `Support:` — CSS/SCSS banner | `agratriinfo@gmail.com` |
| Footer copyright default | `© <year> <Theme Name>. is Proudly Powered by Agratri` |

`Theme URI:`, OCDI `preview_url` and the TGMPA `$url` are per-project demo URLs — **ask the user**,
never copy them from the reference or from the source template.

Never leave a third party's name, domain, or support email in generated code. Full detail and the
verification grep: `docs/rename-checklist.md` §0.

## 2. Naming conventions

| Thing | Pattern | Example |
|---|---|---|
| Theme functions | `kindaid_*` | `kindaid_footer_copyright()` |
| Theme classes | `KindAid_*` | `KindAid_Walker_Nav_Menu` |
| Plugin Elementor classes | `Kindaid_*` | `Kindaid_Icon_Box` |
| Plugin WP_Widget classes | `Kindaid_*_Widget` | `Kindaid_Footer_Info_Widget` |
| Elementor widget slug | `kindaid-*` | `kindaid-icon-box` |
| Theme text domain | `kindaid` | `__('Donate Now','kindaid')` |
| Plugin text domain | `kindaid-core` | `esc_html__('Icon Box','kindaid-core')` |
| CSS classes | `tp-*` | `tp-footer-widget`, `tp-header-logo` |
| Elementor style hooks | `el-*` | `el-title`, `el-bg`, `el-content` |
| Sidebar IDs | kebab-case | `footer-1-widget-1`, `blog-sidebar` |
| Customizer settings | mixed (see note) | `footer_copyright`, `header-global` |

**Note on Customizer keys:** the existing repo is inconsistent — layout selectors use dashes
(`header-global`, `footer-global`) while everything else uses underscores (`button_text`,
`footer_bg_image`). When adding new options, **use underscores**. Do not rename existing keys —
that breaks saved settings.

Every global function and trait in this repo is prefixed. The only unprefixed names are
`tgmpa`, `load_tgm_plugin_activation` and `tgmpa_load_bulk_installer` in
`include/class-tgm-plugin-activation.php` — a vendor library whose public API those names are.
Leave them alone; prefix everything you write.

**Read `docs/known-issues.md` before writing code.** It records what was wrong in the original
code and what the corrected pattern is. Short version of the rules it establishes:

- Give `fallback_cb` a real callable. `KindAid_Walker_Nav_Menu::fallback()` exists for this.
- Plugin assets resolve from `KINDAID_CORE_URL`, never `get_template_directory_uri()`.
- Admin scripts are enqueued **once**, centrally, gated on the screen — not from a widget
  constructor, and never as inline `<script>` in a widget `form()`.
- Sanitise once at assignment. Never stack `wp_kses_post()` and `esc_html()` on the same value.
- `get_template_part()` returns nothing — do not `echo` it.
- Every user-facing string goes through `esc_html__()` / `esc_html_e()` with the right text domain.
- Elementor widget slugs (`get_name()`) are permanent once shipped — Elementor stores them in post
  content. Rename files freely, never slugs.

---

## 3. `functions.php` is a loader only

Never write logic in `functions.php`. It only `include_once`s files from `include/`.

```php
include_once('include/common/after-setup-theme.php');  // add_theme_support, menus
include_once('include/common/widgets-init.php');       // register_sidebar
include_once('include/common/theme-scripts.php');      // wp_enqueue_*
include_once('include/class-tgm-plugin-activation.php');
include_once('include/add_plugin.php');                // required plugin list
include_once('include/nav-walker.php');
include_once('include/breadcrumb.php');
include_once('include/theme-helper.php');              // all reusable output functions
```

**Guard optional dependencies:**

```php
if(class_exists('WooCommerce')){ include_once('include/kindaid-woocommerce.php'); }
if(function_exists('tpmeta_field')){ include_once('include/kindaid-metafields.php'); }
```

Kirki must load on `init` (the plugin isn't ready during `functions.php` parse):

```php
function kindaid_kirki(){
    if(class_exists('Kirki')){ include_once('include/kindaid-kirki.php'); }
}
add_action('init','kindaid_kirki');
```

---

## 4. The header / footer hook chain

**`header.php` never contains `<header>` markup.** It fires a hook and ends:

```php
<?php do_action('header_before');
```

`footer.php` mirrors it exactly:

```php
<?php do_action('footer_before'); ?>
<?php wp_footer(); ?>
```

What is hooked where (order matters):

| Hook | Priority | Function | File |
|---|---|---|---|
| `header_before` | 10 | `kindaid_header()` | `include/theme-helper.php` |
| `header_before` | 11 | `kindaid_breadcrumb()` | `include/breadcrumb.php` |
| `footer_before` | 10 | `kindaid_footer()` | `include/theme-helper.php` |

Both selectors use the same 3-level fallback:

```php
$from_page = function_exists('tpmeta_field') ? tpmeta_field('header-from-page') : '';
$global    = get_theme_mod('header-global','header-global-1');
// 1. page metabox  →  2. Customizer global  →  3. hardcoded default
```

Full detail: **`docs/header-footer.md`**

---

## 5. Template file rules

Every template is thin. Pattern:

```php
<?php
get_header();
$post_center = is_active_sidebar('blog-sidebar') ? '' : 'justify-content-center';
?>
<div class="tp-blog-post-area pt-120 pb-80">
  <div class="container container-1424">
    <div class="row <?php echo esc_attr($post_center); ?>">
      <div class="col-xl-9 col-lg-8">
        <?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>
            <?php get_template_part('templates/content', get_post_format()); ?>
        <?php endwhile; else : ?>
            <?php esc_html_e('Post not found','kindaid'); ?>
        <?php endif; ?>
      </div>
      <?php if(is_active_sidebar('blog-sidebar')) : ?>
      <div class="col-xl-3 col-lg-4"><?php get_sidebar(); ?></div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php get_footer();
```

Rules:

1. **No raw HTML blocks longer than a screen** — split into `templates/` partials.
2. **Every optional region gets an `is_active_sidebar()` / `!empty()` guard** so empty areas don't leave gaps.
3. **Grid adapts to what exists** — the `$post_center` trick centers content when the sidebar is empty.
4. Post-format dispatch is always `get_template_part('templates/content', get_post_format())`.
5. `container container-1424` is the standard content wrapper; header uses `container-fluid container-1790`.

---

## 6. Output & escaping rules

| Situation | Use |
|---|---|
| Plain text | `esc_html()` / `esc_html__()` / `esc_html_e()` |
| HTML attribute | `esc_attr()` |
| URL | `esc_url()` |
| User text that may contain `<a>`, `<strong>` etc. | `kindaid_kses()` (theme) / `kindaid_kses_svg()` (plugin) |
| Elementor icon | `\Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden'=>'true'])` |

**Never** run `wp_kses_post()` and then `esc_html()` on the same value — that double-escapes and
prints literal tags. (This bug exists in `plugin/kindaid-core/include/wp-widgets/footer-info.php`.)

`kindaid_kses()` lives at the bottom of `include/theme-helper.php` and holds the allowed-tag
whitelist. Extend that array rather than switching to raw `echo`.

---

## 7. Assets

All CSS/JS registration lives in `include/common/theme-scripts.php`. Load order matters:

```
bootstrap → animate → swiper-bundle → magnific-popup → font-awesome-pro
→ spacing.css → main.css → unit-test.css → custom.css → style.css
```

- `main.css` is compiled from SCSS (`main.css.map` present) — **edit the SCSS source, not `main.css`**.
- `custom.css` is the safe place for small overrides.
- Google Fonts are built by `kindaid_fonts_url()` with a `Google font: on or off` translator string — keep that pattern for translation compliance.
- **Version every asset with `$theme_version`**, never `time()` — `time()` defeats browser caching entirely.
- All JS is enqueued in the footer (`true` as the 5th argument) and depends on `jquery`.

JS libraries in use, and the markup that triggers them:

| Library | Trigger |
|---|---|
| WOW.js | `class="wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".3s"` |
| Swiper | init code in `assets/js/slider-init.js` |
| PureCounter | counter markup in the `fact` Elementor widget |
| Magnific Popup | gallery / video popup links |
| Nice Select | `<select>` elements |

---

## 8. Required plugins

Declared via TGMPA in `include/add_plugin.php`.

Required: `kindaid-core`, `elementor`, `wp-event-solution` (Eventin), `charitable`,
`classic-editor`, `pure-metafields`, `kirki`, `contact-form-7`, `woocommerce`,
`one-click-demo-import`.

Optional: WPC Smart Wishlist / Compare / Quick View, Breadcrumb NavXT.

**Every use of an optional plugin's API must be guarded**, e.g. `class_exists('WooCommerce')`,
`class_exists('Charitable')`, `function_exists('tpmeta_field')`.

---

## 9. HTML → WordPress conversion order

When converting a new HTML template, work in this order. Do not skip ahead.

1. **Scaffold** — copy `kindaid/` and `plugin/`, run the rename checklist (`docs/rename-checklist.md`).
2. **Assets** — drop the new template's CSS/JS/images into `assets/`, rewrite `theme-scripts.php` to match.
3. **Header** — port each header variant into `templates/header/header-N.php`, wire into `kindaid_header()`.
4. **Footer** — port each footer variant, register its widget areas in `widgets-init.php`.
5. **Customizer** — add the Kirki options the header/footer read.
6. **Blog templates** — `index.php`, `single.php`, `archive.php`, `search.php`, `404.php`, `templates/content*.php`.
7. **Elementor widgets** — one file per homepage section, in dependency order.
8. **WooCommerce overrides** — only the templates that actually need custom markup.
9. **Demo content** — OCDI config last.

At the end of each step, report what was done and what is still missing before starting the next.

---

## 10. What to ask the user about

Ask — do not assume — when:

- The new project's theme slug / text domain / prefix is not stated.
- The HTML has a section with no equivalent pattern in this repo.
- A section could be either a Customizer option or an Elementor widget (rule of thumb: appears on every page → Customizer; placed by the user per page → Elementor widget).
- The HTML depends on a third-party plugin not in the required list.
- Dynamic data source is ambiguous (custom post type vs. Elementor repeater vs. widget setting).

---

## Docs index

- `docs/architecture.md` — full file map, what loads what, in what order
- `docs/header-footer.md` — header/footer variant system, adding a new one
- `docs/widgets.md` — sidebars, `register_sidebar` format, `WP_Widget` classes
- `docs/customizer.md` — Kirki panel/section/field patterns
- `docs/metabox.md` — Pure Metafields per-page options
- `docs/elementor-widgets.md` — anatomy of a widget, traits, controls, render
- `docs/templates.md` — template hierarchy, content partials, post formats
- `docs/html-to-wp-workflow.md` — step-by-step conversion playbook
- `docs/rename-checklist.md` — every string to change when starting a new project
- `docs/known-issues.md` — bugs in this repo, do not replicate
