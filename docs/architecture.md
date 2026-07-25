# Architecture — file map and load order

## Repository layout

```
kindaid/                          ← the theme
├── style.css                     ← theme header block + WooCommerce patches
├── functions.php                 ← loader only, no logic
├── index.php                     ← blog list (template hierarchy fallback)
├── single.php                    ← post detail
├── page.php                       ← static page
├── archive.php                   ← category/tag/date/CPT archive
├── search.php
├── 404.php
├── comments.php
├── sidebar.php                   ← one line: dynamic_sidebar('blog-sidebar')
├── header.php                    ← <head> + preloader + back-to-top + do_action('header_before')
├── footer.php                    ← do_action('footer_before') + wp_footer()
│
├── include/
│   ├── common/
│   │   ├── after-setup-theme.php ← add_theme_support, register_nav_menus
│   │   ├── widgets-init.php      ← all register_sidebar() calls
│   │   └── theme-scripts.php     ← all wp_enqueue_style/script
│   ├── class-tgm-plugin-activation.php  ← vendor lib, do not edit
│   ├── add_plugin.php            ← required-plugin list for TGMPA
│   ├── nav-walker.php            ← KindAid_Walker_Nav_Menu
│   ├── breadcrumb.php            ← kindaid_breadcrumb(), hooked to header_before @11
│   ├── kindaid-kirki.php         ← all Customizer options
│   ├── kindaid-metafields.php    ← per-page metabox definitions
│   ├── kindaid-woocommerce.php   ← Woo hooks/filters
│   └── theme-helper.php          ← reusable output functions + kses whitelist
│
├── templates/
│   ├── header/
│   │   ├── header-1.php, header-2.php, header-3.php
│   │   ├── header-search.php     ← full-screen search overlay
│   │   ├── offcanvas.php         ← mobile menu panel
│   │   └── minicart.php          ← Woo side cart
│   ├── footer/
│   │   ├── footer-1.php, footer-2.php
│   ├── blog/
│   │   ├── blog-cat.php          ← category badge
│   │   ├── blog-meta.php         ← author / date / comment count
│   │   └── blog-btn.php          ← read-more button
│   ├── content.php               ← standard post format
│   ├── content-video.php, content-audio.php, content-gallery.php,
│   ├── content-image.php, content-quote.php
│   ├── content-page.php          ← used by page.php
│   ├── content-search.php        ← used by search.php
│   └── biography.php             ← author box on single.php
│
├── woocommerce/                  ← Woo template overrides (mirrors Woo's own folder structure)
├── eventin/templates/            ← Eventin plugin template overrides
└── assets/
    ├── css/  (bootstrap, animate, swiper, magnific-popup, font-awesome-pro,
    │          spacing.css, main.css + main.css.map, unit-test.css, custom.css)
    ├── js/
    ├── fonts/
    └── img/

plugin/kindaid-core/              ← the companion plugin
├── kindaid-core.php              ← plugin header + all require_once
├── include/
│   ├── kindaid-core-helper.php   ← kindaid_all_cat(), kindaid_all_post(), kindaid_kses_svg(), donation template filter
│   ├── ocdi.php                  ← One Click Demo Import config
│   ├── single-donation.php       ← Charitable single donation template
│   ├── common/pure-animation.php ← (currently commented out in loader)
│   ├── traits/
│   │   ├── normal-trait.php          ← Kindaid_Content_Style
│   │   ├── heading-control-trait.php
│   │   └── link-trait.php            ← Kindaid_Link_Control (URL control + attrs)
│   └── wp-widgets/               ← WP_Widget classes (footer + blog sidebar)
├── widgets/                      ← one file per Elementor widget
└── assets/                       ← pure-animations css/js
```

## Load order — theme

```
WordPress boots
 ├─ functions.php parsed
 │   ├─ include after-setup-theme.php   → registers kindaid_setup() on after_setup_theme
 │   ├─ include widgets-init.php        → registers kindaid_widgets() on widgets_init
 │   ├─ include theme-scripts.php       → registers kindaid_scripts() on wp_enqueue_scripts
 │   ├─ include TGMPA + add_plugin.php
 │   ├─ include nav-walker.php          → defines KindAid_Walker_Nav_Menu
 │   ├─ include breadcrumb.php          → hooks kindaid_breadcrumb to header_before @11
 │   ├─ conditional: kindaid-woocommerce.php / kindaid-metafields.php
 │   ├─ include theme-helper.php        → hooks kindaid_header @10, kindaid_footer @10
 │   └─ registers kindaid_kirki() on init
 │
 ├─ after_setup_theme  → kindaid_setup()      (theme supports, nav menus)
 ├─ init               → kindaid_kirki()      (Customizer options)
 │                     → dummy block style + pattern
 ├─ widgets_init       → kindaid_widgets()    (12 sidebars)
 │                     → each plugin WP_Widget's register function
 ├─ wp_enqueue_scripts → kindaid_scripts()
 └─ template loaded    → index.php / single.php / …
```

## Load order — plugin

```
kindaid-core.php parsed
 ├─ require all wp-widgets/*.php         (each self-registers on widgets_init)
 ├─ require kindaid-core-helper.php      (kindaid_kses_svg, kindaid_all_cat, kindaid_all_post,
 │                                        template_include filter @99)
 ├─ require ocdi.php
 ├─ require traits/normal-trait.php, heading-control-trait.php, link-trait.php
 ├─ hook kindaid_register_elementor_widgets on elementor/widgets/register
 │    └─ inside: require every widgets/*.php
 │       (Charitable widgets only if class_exists('Charitable'))
 └─ hook kindaid_elementor_widget_categories on elementor/elements/categories_registered
```

Note: Elementor widget files are `require_once`d **inside** the `elementor/widgets/register`
callback, and each file ends with `$widgets_manager->register( new Kindaid_X() );`. The
`$widgets_manager` variable is in scope because the file is included from inside the callback.
This is unusual but works — keep the pattern when adding widgets.

The category is registered separately on `elementor/elements/categories_registered`.

## Request flow for a front-end page

```
1. header.php
   ├─ wp_head()
   ├─ preloader        (if get_theme_mod('preloader_switch'))
   ├─ back-to-top      (if get_theme_mod('back_to_top_switch'))
   └─ do_action('header_before')
        ├─ @10 kindaid_header()
        │      ├─ templates/header/header-search.php
        │      ├─ templates/header/offcanvas.php
        │      ├─ templates/header/minicart.php   (if WooCommerce)
        │      └─ templates/header/header-{1|2|3}.php
        └─ @11 kindaid_breadcrumb()

2. the template file (index.php / single.php / page.php / …)
   └─ get_template_part('templates/content', get_post_format())
        └─ templates/blog/blog-cat.php, blog-meta.php, blog-btn.php

3. footer.php
   ├─ do_action('footer_before')
   │    └─ @10 kindaid_footer()
   │         └─ templates/footer/footer-{1|2}.php
   │         └─ dynamic_sidebar('footer-N-widget-1..4')
   │              └─ plugin WP_Widget classes render here
   └─ wp_footer()
```

## Dependency guards used in this repo

| Guard | Protects |
|---|---|
| `class_exists('WooCommerce')` | minicart, cart count, Woo includes |
| `class_exists('Charitable')` | charity-grid / charity-slider / charity-support widgets |
| `class_exists('Kirki')` | all Customizer options |
| `function_exists('tpmeta_field')` | per-page header/footer/breadcrumb overrides |
| `is_active_sidebar('...')` | every widget region |
| `has_post_thumbnail()` / `has_tag()` / `!empty()` | every optional markup block |

When porting a new template, apply the same discipline: **no output without a guard if the data
can be empty.**
