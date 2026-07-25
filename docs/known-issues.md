# Fixed issues and remaining decisions

This file used to be a bug list. Everything mechanically fixable has now been fixed in this repo, so it
serves a different purpose: **it records what was wrong, what the corrected pattern is, and the few
things left that are deliberate choices rather than bugs.**

When writing new code, copy the "after" side of every entry below.

---

## Part 1 — Fixed

### 1. `fallback_cb` pointed at a method that did not exist

`include/theme-helper.php` passes `'fallback_cb' => 'KindAid_Walker_Nav_Menu::fallback'` to
`wp_nav_menu()` in both `kindaid_main_menu()` and `kindaid_footer_menu()`, but the class defined no such
method. `wp_nav_menu()` checks `is_callable()` first, so it printed **nothing** when a location had no
menu assigned — a header with no navigation and no error explaining why.

A real static method now lives at the bottom of `include/nav-walker.php`:

```php
public static function fallback( $args = array() ) {

	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	$location = isset( $args['theme_location'] ) ? $args['theme_location'] : '';

	printf(
		'<ul class="tp-menu-fallback"><li><a href="%1$s">%2$s</a></li></ul>',
		esc_url( admin_url( 'nav-menus.php' ) ),
		esc_html( sprintf( __( 'Assign a menu to "%s"', 'kindaid' ), $location ) )
	);
}
```

`wp_nav_menu()` calls `fallback_cb` with `(array) $args`, hence the array parameter. The capability
check means visitors see nothing — only an admin gets the prompt.

**Rule:** never point `fallback_cb` at something that is not callable. Either use core's
`'wp_page_menu'` or provide a real method.

### 2. Widget media uploader — missing file, wrong path, eight duplicate hooks

Three problems at once:

1. All eight `WP_Widget` classes enqueued `assets/js/kindaid-widget.js`, **which did not exist**.
2. They resolved it with `get_template_directory_uri()` — a plugin pointing into the theme.
3. Each class hooked `admin_enqueue_scripts` from its own constructor. Constructors run on every
   request, so the same handler was registered eight times.

Upload still worked, because six of the `form()` methods each embedded an identical copy of the same
jQuery block in an inline `<script>` tag.

Now: one real file at `plugin/kindaid-core/assets/js/kindaid-widget.js`, one central enqueue, no inline
scripts, no per-widget hooks.

```php
define( 'KINDAID_CORE_VERSION', '1.0.0' );
define( 'KINDAID_CORE_URL', plugin_dir_url( __FILE__ ) );
define( 'KINDAID_CORE_PATH', plugin_dir_path( __FILE__ ) );

function kindaid_core_widget_admin_assets( $hook_suffix ) {

	if ( 'widgets.php' !== $hook_suffix && 'customize.php' !== $hook_suffix ) {
		return;
	}

	wp_enqueue_media();

	wp_enqueue_script(
		'kindaid-widget-media',
		KINDAID_CORE_URL . 'assets/js/kindaid-widget.js',
		array( 'jquery' ),
		KINDAID_CORE_VERSION,
		true
	);

	wp_localize_script( 'kindaid-widget-media', 'kindaidWidgetL10n', array(
		'frameTitle' => esc_html__( 'Select or upload an image', 'kindaid-core' ),
		'buttonText' => esc_html__( 'Use this image', 'kindaid-core' ),
	) );
}
add_action( 'admin_enqueue_scripts', 'kindaid_core_widget_admin_assets' );
```

The screen check matters — without it the media library loads on every admin page.

Markup contract for a media field in a widget form:

```php
<input type="text" class="widefat kindaid-upload-field" name="…" value="…">
<button type="button" class="button select-media-button">Upload</button>
<span class="kindaid-upload-preview"></span>   <!-- optional -->
```

Handlers are delegated from `document`, so they work for widgets added after page load and inside the
Customizer. An optional `.kindaid-remove-media` button and thumbnail preview are supported.

**Rules:** plugin assets resolve from `KINDAID_CORE_URL`, never `get_template_directory_uri()`. Admin
assets are enqueued once, centrally, screen-gated. Never inline `<script>` in a widget `form()`.

### 3. `'textdomain'` placeholder in 296 places

Every Elementor control, section and option label used the literal placeholder:

```php
'label' => esc_html__( 'Select Layout', 'textdomain' ),   // before
'label' => esc_html__( 'Select Layout', 'kindaid-core' ), // after
```

A text domain that does not match the plugin header is never loaded from the `.mo` file, so all 296
strings were permanently untranslatable. Worst offenders: `icon-box.php` (20),
`charity-support.php` (18), `testimonials.php` (18).

**Rule:** `kindaid` in the theme, `kindaid-core` in the plugin. Audit with
`grep -rn "'textdomain'" --include="*.php" .` — must return nothing.

### 4. Double escaping — two files, not one

```php
$info = !empty($instance['info']) ? wp_kses_post($instance['info']) : '';
…
<p class="tp-footer-dec mb-30"><?php echo esc_html($info); ?></p>   // before
<p class="tp-footer-dec mb-30"><?php echo $info; ?></p>             // after
```

`wp_kses_post()` allows HTML, then `esc_html()` turned it back into entities, so a description
containing `<strong>` displayed the literal tags. Present in both `footer-info.php` **and**
`footer-newsletter.php`.

**Rule:** sanitise once, at assignment. Never stack `wp_kses_post()` and `esc_html()` on the same value.

### 5. `echo bloginfo()` in image alt text — three sites, not two

```php
alt="<?php echo bloginfo(); ?>"                             // before
alt="<?php echo esc_attr(get_bloginfo('name')); ?>"         // after
```

`bloginfo()` echoes rather than returns, and with no argument prints nothing useful. Fixed in
`kindaid_logo()`, `kindaid_offcanvas_logo()` and `templates/header/offcanvas.php`.

### 6. Elementor widgets reaching into the theme for images

`services-list.php` and `who-we-are.php` hardcoded theme paths, unescaped:

```php
src="<?php echo get_template_directory_uri(); ?>/assets/img/service/shape.png"          // before
src="<?php echo esc_url( KINDAID_CORE_URL . 'assets/img/service/shape.png' ); ?>"       // after
```

Both images were copied into `plugin/kindaid-core/assets/img/`, so the widgets no longer depend on
which theme is active.

`include/ocdi.php` still uses `get_template_directory()` — that one is legitimate, because the demo
content files genuinely live in the theme.

### 7. `echo get_template_part(...)` — 44 occurrences

`get_template_part()` prints directly and returns `null`. The `echo` was meaningless. Removed from all
14 files that had it.

```php
<?php echo get_template_part('templates/content', get_post_format()); ?>   // before
<?php get_template_part('templates/content', get_post_format()); ?>        // after
```

### 8. Untranslated strings

```php
<p>Post not found</p>                                          // before
<p><?php esc_html_e('Post not found','kindaid'); ?></p>         // after
```

Fixed in `index.php`, `single.php`, `archive.php`, `search.php`, and `page.php` (which said
"Page Post not found" — now "Page not found").

### 9. `main.css` cache-busted with `time()`

```php
wp_enqueue_style( 'kindaid-main', $theme_uri . 'css/main.css', array(), time(), 'all' );          // before
wp_enqueue_style( 'kindaid-main', $theme_uri . 'css/main.css', array(), $theme_version, 'all' );  // after
```

`time()` produces a new version string on every request, so the browser can never cache the file.

### 10. Dead code in `page.php`

`$post_center` was computed but never used — `page.php` has no sidebar column. Removed.

### 11. Unprefixed global functions

Every global in the theme and plugin now starts with `kindaid_`. Renamed, with all call sites updated:

| Before | After |
|---|---|
| `themename_register_dummy_block_style` | `kindaid_register_dummy_block_style` |
| `themename_register_dummy_block_pattern` | `kindaid_register_dummy_block_pattern` |
| `custom_comment_list` | `kindaid_comment_list` |
| `move_comment_textarea_to_bottom` | `kindaid_move_comment_textarea_to_bottom` |
| `header_info_section`, `header_social_kirki`, `header_logo_kirki`, `header_offcanvas_kirki`, `breadcrumb_section_kirki`, `blog_section_kirki`, `footer_section_kirki`, `error_section_kirki`, `product_section_kirki`, `preloader_section_kirki` | same names with a `kindaid_` prefix |
| `tp_all_cat` / `tp_all_post` | `kindaid_all_cat` / `kindaid_all_post` |
| `kd_kses` | `kindaid_kses_svg` |
| `kd_remove_donation_fields` | `kindaid_remove_donation_fields` |
| `donation_single_template` | `kindaid_donation_single_template` |
| `get_campaign_total_donations_count` | `kindaid_campaign_total_donations_count` |
| `register_hello_world_widget` | `kindaid_register_elementor_widgets` |
| `pure_ocdi_import_files` / `pure_ocdi_after_import_setup` | `kindaid_ocdi_import_files` / `kindaid_ocdi_after_import_setup` |
| `register_Kindaid_Footer_Contact_Info_Widget` and the other seven widget registrars (mixed casing) | `kindaid_register_*_widget` |

`kindaid_kses_svg` alone had 71 call sites across the widget files.

**Deliberately not renamed:** `load_tgm_plugin_activation`, `tgmpa`, `tgmpa_load_bulk_installer` in
`include/class-tgm-plugin-activation.php`. That is a vendor library and those names are its public API.

### 12. Unprefixed traits

PHP traits share one global namespace:

| Before | After |
|---|---|
| `TP_Content_Style` | `Kindaid_Content_Style` |
| `TP_Heading_Control` | `Kindaid_Heading_Control` |

### 13. Filename typos

| Before | After |
|---|---|
| `include/kindaid-metafileds.php` | `include/kindaid-metafields.php` |
| `include/wp-widgets/blog-reent-post.php` | `blog-recent-post.php` |
| `include/wp-widgets/event-reent-post.php` | `event-recent-post.php` |
| `widgets/mision-vision.php` | `widgets/mission-vision.php` |

All `include_once` / `require_once` lines updated.

**Note:** only the *filenames* changed. The Elementor widget slug inside `mission-vision.php` is still
`kindaid-mision` — changing `get_name()` would orphan every page that already uses the widget, because
Elementor stores the slug in post content. Slugs are permanent once shipped.

### 14. `link-trait.php` was an empty file

It existed, was never loaded, and was never used. Rather than leave a stub, it now contains a real
`Kindaid_Link_Control` trait and is loaded by the plugin.

It solves a pattern the widgets currently do by hand — a plain TEXT control for a URL, which throws away
Elementor's "open in new window" and "nofollow" options:

```php
use Kindaid_Link_Control;

// controls
$this->kindaid_link_control( 'box_url', esc_html__( 'Button Link', 'kindaid-core' ) );

// render
<a class="el-link" <?php echo $this->kindaid_link_attrs( $settings['box_url'] ); ?>>
```

`kindaid_link_attrs()` emits an escaped `href`, plus `target="_blank"` and
`rel="nofollow noopener noreferrer"` as appropriate. It also accepts a plain string, so it works on
widgets still using a TEXT control.

### 15. Header used a hook, footer did not

`header.php` fired `do_action('header_before')` while `footer.php` called `kindaid_footer()` directly —
two conventions for the same job. The footer now matches:

```php
// footer.php
<?php do_action('footer_before'); ?>
<?php wp_footer(); ?>

// include/theme-helper.php
add_action('footer_before','kindaid_footer',10);
```

Both sides are now hookable, so a plugin can inject before or after either region by choosing a
priority below or above 10.

---

## Part 2 — Deliberate, not bugs

These look like inconsistencies but each is a considered choice. Do not "fix" them without deciding
what you actually want.

### A. Mixed Customizer key style

```
header-global, footer-global, logo-transparent     ← dashes
button_text, footer_bg_image, preloader_switch     ← underscores
```

Setting IDs are database keys. Renaming one silently discards whatever the user had saved, and breaks
any demo-import data that references it. So the dashed keys stay.

**For new settings, use underscores.**

### B. Breadcrumb combines global and per-page with AND, header/footer use override

```php
// header / footer: page metabox wins outright
$from_page = tpmeta_field('header-from-page');
$global    = get_theme_mod('header-global','header-global-1');

// breadcrumb: global is a master kill-switch
$breadcrumb_on_off = $breadcrumb_global && ($breadcrumb_page_switch == 'on');
```

Both semantics are useful — override for "which variant", kill-switch for "on or off everywhere".
Changing either would alter behaviour on existing sites.

**When adding a new option, pick one deliberately and document which.**

### C. Block editor is switched off

`include/common/after-setup-theme.php` calls `remove_theme_support('widgets-block-editor')`, and
`classic-editor` is a required plugin in `include/add_plugin.php`.

This is required for the classic `WP_Widget` classes to be usable and for the Elementor-first workflow.
It does mean the theme does not support the block editor at all — state that in the theme description
rather than letting buyers discover it.

### D. `include/common/pure-animation.php` is not loaded

It declares `namespace TPCore\Common` — leftover from a different product — and would add animation
controls to every Elementor element. This theme animates per-widget with the WOW.js control section
instead, so the file is inert. The commented-out `require_once` has been replaced with an explanatory
comment.

**Delete before release:** `include/common/pure-animation.php`,
`assets/css/pure-animations.css`, `assets/js/pure-animations.js`. Shipping unused assets fails
ThemeForest review. (Left in place here because this is a reference repo, not a shipped product.)

### E. `widgets/test.php` and `widgets/tin.php`

Placeholder filenames for real widgets ("Test Post" / "Test Event", slugs `kindaid-test` and
`kindaid-tin`). Renaming the files is safe; renaming the slugs is not, for the reason in item 13.

Give them real names in a new project, before anything ships.

---

## Audit commands

```bash
# unprefixed function declarations (TGMPA's three are expected)
grep -rhoP '^\s*function \K\w+' kindaid/ plugin/ --include="*.php" | sort -u | grep -v '^kindaid'

# placeholder text domain
grep -rn "'textdomain'" --include="*.php" .

# unescaped echo
grep -rn "echo \$" --include="*.php" . | grep -v "esc_\|kses\|before_widget\|after_widget\|link_attrs"

# redundant echo before get_template_part
grep -rn "echo get_template_part" --include="*.php" .

# plugin reaching into the theme
grep -rn "get_template_directory" plugin/ --include="*.php"

# untranslated literal text
grep -rn "<p>[A-Z]" --include="*.php" .

# PHP syntax, every file
find . -name "*.php" -exec php -l {} \;
```
