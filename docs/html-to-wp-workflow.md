# HTML → WordPress conversion playbook

Follow the steps in order. **Report progress at the end of each step and wait, rather than running the
whole conversion in one pass.** A wrong decision in step 3 is cheap to fix; the same decision
discovered in step 7 is not.

---

## Step 0 — Inventory the HTML template

Before writing any PHP, read the template and produce a written inventory:

1. **Pages** — list every `.html` file (`index.html`, `index-2.html`, `about.html`, `blog.html`,
   `blog-details.html`, `shop.html`, `contact.html`, `404.html` …).
2. **Header variants** — how many distinct headers, and which pages use which.
3. **Footer variants** — same.
4. **Sections** — for each homepage, list every section with its wrapper class
   (`.tp-hero-area`, `.tp-service-area`, …). Note which sections repeat across pages with a different
   design — those become one widget with a `design-layout` select, not two widgets.
5. **Assets** — CSS files and their order from `<head>`, JS files and their order from before
   `</body>`, fonts, image folders.
6. **JS libraries** — Swiper, WOW, Magnific Popup, counters, sliders. Note the init code and which
   selectors it binds to.
7. **Dynamic candidates** — anything that looks like a post list, product grid, event list, team
   list, testimonial slider.

Then **classify every section**:

| Signal | Destination |
|---|---|
| Appears identically on every page (header, footer, breadcrumb) | theme template + Customizer |
| Placed and reordered per page by the user | Elementor widget (plugin) |
| A list of things the user will manage in the dashboard | custom post type (plugin) + Elementor widget to display it |
| A list of things that only ever appear in one place | Elementor repeater inside a widget |
| Blog / archive / single markup | theme template + `templates/` partial |

Report the inventory and the classification. **Ask about anything ambiguous** — do not guess whether
a "Causes" grid should be a CPT or a repeater.

---

## Step 1 — Scaffold

1. Copy `kindaid/` → the new theme folder inside `wp-content/themes/`.
2. Copy `plugin/kindaid-core/` → `wp-content/plugins/<slug>-core/`.
3. Run **all** of `docs/rename-checklist.md`.
4. Delete what the new template does not need:
   - `woocommerce/` if there is no shop
   - `eventin/` if there are no events
   - `plugin/…/widgets/charity-*.php` and the Charitable guard if there is no donation feature
   - the corresponding entries in `include/add_plugin.php`
5. Activate both. Confirm: no notices, Customizer panel present, all sidebars listed.

**Report:** what was kept, what was deleted, what the new prefixes are.

---

## Step 2 — Assets

1. Copy the template's `css/`, `js/`, `img/`, `fonts/` into `assets/`, replacing the old ones.
2. Rewrite `include/common/theme-scripts.php` to match the template's own load order exactly — read it
   off the HTML `<head>` and footer, do not assume it matches KindAid's.
3. Keep the structural conventions:
   - vendor handles unprefixed, theme handles prefixed
   - all JS in the footer with `array('jquery')` as dependency
   - `$theme_version` as the version, **not** `time()`
   - `wp_enqueue_style( '<slug>-style', get_stylesheet_uri(), array(), $theme_version );` last
4. Rebuild `<slug>_fonts_url()` with the template's actual Google Fonts, keeping the
   `_x('on', 'Google font: on or off', '<slug>')` translator guard.
5. If the template ships SCSS, keep the source in the repo and note that `main.css` is generated.

**Report:** the final enqueue order, and any library in the HTML that has no enqueue yet.

---

## Step 3 — Header

For each header variant in the HTML:

1. Create `templates/header/header-N.php`.
2. Move the settings reads to the top of the file, derive layout classes into variables (see the
   `$header_menu_column` pattern in `docs/header-footer.md`).
3. Replace hardcoded content with helpers/dynamics:
   - logo → `<slug>_logo()` / `<slug>_transparent_logo()`
   - nav `<ul>` → `<slug>_main_menu()`
   - social links → `<slug>_social()`
   - button text/URL → `get_theme_mod()`
   - cart count → `WC()->cart->cart_contents_count` inside a `class_exists('WooCommerce')` guard
   - search / offcanvas / minicart → `get_template_part()` of shared partials
4. Guard every optional element with `!empty()` or a switch.
5. Extend the selector function, the Kirki select, and the metabox options — **all three**.

Repeat for `header-search.php`, `offcanvas.php`, `minicart.php`.

**Report:** which header markup became dynamic, which is still hardcoded and why.

---

## Step 4 — Footer

1. For each footer variant, create `templates/footer/footer-N.php`.
2. Decide the column count per variant and register `footer-N-widget-1..M` in `widgets-init.php`, with
   the per-column spacing classes and staggered WOW delays in `before_widget`.
3. Wrap the widget row in the two-level guard (outer: any area active; inner: this area active).
4. Background image via `get_theme_mod()` and a real `<img>` in `.tp-footer-bg`.
5. Bottom bar → `<slug>_footer_copyright()` + `<slug>_footer_menu()`.
6. Convert each footer column's static content into a `WP_Widget` class in the plugin
   (`include/wp-widgets/`), following `docs/widgets.md`. Do **not** hardcode footer content in the
   template.
7. Extend the footer selector, the Kirki select, and the metabox options.

**Report:** the sidebar IDs created, and which widget class covers which column.

---

## Step 5 — Customizer

Add the Kirki options the header and footer now read, plus:

- logos (main, transparent, offcanvas)
- social URLs
- breadcrumb switch
- blog meta switches, read-more text
- copyright, footer background
- 404 texts
- preloader / back-to-top switches
- shop options if WooCommerce is kept

One section per logical group, one wrapper function per section, panel `<slug>_panel`. Underscored
setting IDs. Every read paired with a default.

**Report:** the full list of settings with their defaults.

---

## Step 6 — Blog templates

1. `index.php`, `archive.php`, `search.php` — the shared skeleton with `$post_center`.
2. `single.php` — plus prev/next navigation, author box, comments.
3. `page.php` — no sidebar.
4. `404.php` — reads the `error_*` Customizer options.
5. `comments.php` — port the template's comment design.
6. `templates/content.php` and one file per post format the template supports.
7. Extract the repeated card bits into `templates/blog/` micro-partials, gated by the blog switches.
8. `sidebar.php` → `dynamic_sidebar('blog-sidebar')`.
9. Blog sidebar widget designs → `WP_Widget` classes in the plugin.
10. Add a `<slug>_breadcrumb()` branch for every post type the template has.

**Report:** which post formats are supported, which card designs map to which partial.

---

## Step 7 — Elementor widgets

One file per section, in this order (later widgets often reuse earlier traits):

1. Traits first — `Content_Style`, heading/subtitle group, anything shared.
2. Simple content widgets — heading, button, icon box, image box.
3. Repeater widgets — brands, facts, FAQ, team, testimonials, gallery, steps.
4. Query widgets — blog posts, products, events, causes (these need `all_cat()` / `all_post()`
   helpers and CPTs to exist first).
5. Complex widgets — hero, slider, anything with Swiper.

For each, follow `docs/elementor-widgets.md`: layout select first, `el-*` style hooks, the WOW
animation section, `!empty()` guards, `kindaid_kses_svg()` for rich text.

Where a section has several designs across the template's pages, make it **one widget with
`design-layout` options** rather than several widgets.

Swiper sections need matching init code in `assets/js/slider-init.js`.

**Report after every 3–4 widgets**, not at the very end.

---

## Step 8 — WooCommerce overrides

Only override the templates whose markup actually differs from Woo's default. Mirror Woo's folder
structure exactly under `woocommerce/`. Typical set: `content-product.php`,
`content-single-product.php`, `archive-product.php`, `cart/`, `checkout/`, `myaccount/form-login.php`,
`single-product/`, `loop/`.

Hook-based changes (wrappers, review markup, badges) go in `include/<slug>-woocommerce.php` as
filters, not as template overrides.

---

## Step 9 — Demo content

Last. Export the finished site, configure OCDI in `plugin/<slug>-core/include/ocdi.php`, include the
Customizer export and widget assignments.

---

## Step 10 — Pre-release verification

```
# PHP syntax
find . -name "*.php" -exec php -l {} \;

# leftovers from the base theme
grep -rin "kindaid\|themename\|'textdomain'\|hello_world" --include="*.php" .

# unescaped output
grep -rn "echo \$" --include="*.php" . | grep -v "esc_\|kses\|before_widget\|after_widget"
```

Manual checks:

- [ ] Theme Check plugin: no errors
- [ ] Debug mode on (`WP_DEBUG`): no notices on any page
- [ ] Every header variant and every footer variant selectable and rendering
- [ ] Every Customizer option changes something visible
- [ ] All widget areas empty → no layout gaps, no stray padding
- [ ] Deactivate WooCommerce / Charitable / Eventin / Pure Metafields / Kirki one at a time → no fatals
- [ ] `main.css` version is `$theme_version`, not `time()`
- [ ] Mobile: hamburger, offcanvas, minicart, search overlay all work
- [ ] RTL and a translation file, if the template claims support

---

## Things to stop and ask about

- The theme slug / prefix / text domain, if not given.
- A section with no equivalent pattern in the reference repo.
- Customizer vs. Elementor widget vs. CPT, when the section could plausibly be any of them.
- A third-party plugin the HTML implies but that is not in the required list.
- Whether a list should be a CPT (user manages it in the dashboard, appears in several places) or a
  repeater (only ever appears in this one section).
- Whether to keep or drop WooCommerce / Charitable / Eventin.
