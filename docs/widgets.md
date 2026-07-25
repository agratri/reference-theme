# Widget areas and WP_Widget classes

Two separate things, both called "widget":

1. **Widget areas (sidebars)** — registered in the **theme**, `include/common/widgets-init.php`.
2. **Widget classes** — `WP_Widget` subclasses, registered in the **plugin**,
   `plugin/kindaid-core/include/wp-widgets/`.

The area supplies the wrapper markup and animation; the class supplies the inner content.

---

## 1. Widget areas — `include/common/widgets-init.php`

All 12 areas are registered in one function:

```php
function kindaid_widgets() {
    register_sidebar( array( … ) );   // × 12
}
add_action( 'widgets_init', 'kindaid_widgets' );
```

### The registered areas

| ID | Used by |
|---|---|
| `blog-sidebar` | `sidebar.php` → index, single, archive, search |
| `product-sidebar` | WooCommerce shop/archive |
| `donation-sidebar` | Charitable single donation |
| `event-sidebar` | Eventin single event |
| `footer-1-widget-1` … `-4` | `templates/footer/footer-1.php` |
| `footer-2-widget-1` … `-4` | `templates/footer/footer-2.php` |

### The registration format

```php
register_sidebar( array(
   'name'          => __( 'Footer 1 : Widget 2', 'kindaid' ),
   'id'            => 'footer-1-widget-2',
   'description'   => __( 'Widgets in this area will be shown on Footer 1 : Widget 2', 'kindaid' ),
   'before_widget' => '<div id="%1$s" class="tp-footer-widget ml-65 mb-50 wow fadeInUp %2$s"
                        data-wow-duration=".9s" data-wow-delay=".4s">',
   'after_widget'  => '</div>',
   'before_title'  => '<h3 class="tp-footer-title mb-15">',
   'after_title'   => '</h3>',
) );
```

Rules:

- **`%1$s` and `%2$s` are mandatory.** `%1$s` is the widget's unique ID, `%2$s` is WordPress's own
  class list (`widget_nav_menu`, `widget_text`, …). Omitting `%2$s` breaks core widget styling and
  fails Theme Check.
- **Spacing and animation live here, not in the template.** `ml-65`, `ml-30`, `ml-75`, `mb-40`,
  `mb-50` differ per column.
- **Animation delays are staggered** — `.3s`, `.4s`, `.5s`, `.6s` across the four columns, so they
  rise in sequence on scroll. Keep this pattern.
- **`before_title` centralises heading style** — every widget title becomes
  `<h3 class="tp-footer-title mb-15">` automatically. Never hardcode a title tag inside a widget's
  `widget()` method; use `$args['before_title']`.

### Wrapper classes by area

| Area group | `before_widget` classes | `before_title` |
|---|---|---|
| blog / donation / event sidebar | `tp-widget-sidebar mb-20` | `tp-widget-main-title mb-25` |
| product sidebar | `tp-shop-widget mb-50` | `tp-shop-widget-title no-border` |
| footer 1 & 2 | `tp-footer-widget` + per-column spacing + `wow fadeInUp` | `tp-footer-title mb-15` |

### Adding a new area

```php
register_sidebar( array(
   'name'          => __( 'Footer 3 : Widget 1', 'kindaid' ),
   'id'            => 'footer-3-widget-1',
   'description'   => __( 'Widgets in this area will be shown on Footer 3 : Widget 1', 'kindaid' ),
   'before_widget' => '<div id="%1$s" class="tp-footer-widget mb-40 wow fadeInUp %2$s"
                        data-wow-duration=".9s" data-wow-delay=".3s">',
   'after_widget'  => '</div>',
   'before_title'  => '<h3 class="tp-footer-title mb-15">',
   'after_title'   => '</h3>',
) );
```

Then consume it in the template with the two-level guard:

```php
<?php if(is_active_sidebar('footer-3-widget-1') || …) : ?>
   <?php if(is_active_sidebar('footer-3-widget-1')) : ?>
   <div class="col-xxl-3"><?php dynamic_sidebar('footer-3-widget-1'); ?></div>
   <?php endif; ?>
<?php endif; ?>
```

---

## 2. WP_Widget classes — `plugin/kindaid-core/include/wp-widgets/`

### Existing classes

| File | Class | Purpose |
|---|---|---|
| `footer-info.php` | `Kindaid_Footer_Info_Widget` | logo + description + social links |
| `footer-contact-info.php` | contact info (footer 1) |
| `footer-contact-info-2.php` | contact info (footer 2) |
| `footer-newsletter.php` | subscribe form |
| `blog-author.php` | author card for blog sidebar |
| `blog-banner.php` | promo banner |
| `blog-recent-post.php` | recent posts |
| `event-recent-post.php` | recent events |

All are `require_once`d at the top of `plugin/kindaid-core/kindaid-core.php`.

### The class skeleton

```php
<?php
class Kindaid_Footer_Info_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'kindaid_footer_info',                                  // base ID
            __('Kindaid Footer Info', 'kindaid'),                   // admin name
            array('description' => __('Display footer logo, info, and social links', 'kindaid'))
        );
        add_action('admin_enqueue_scripts', array($this, 'enqueue_media_uploader'));
    }

    public function enqueue_media_uploader() {
        wp_enqueue_media();
        wp_enqueue_script('kindaid-media-upload',
            get_template_directory_uri() . '/assets/js/kindaid-widget.js',
            array('jquery'), false, true);
    }

    public function widget($args, $instance) {      // FRONT END
        echo $args['before_widget'];
        // … markup …
        echo $args['after_widget'];
    }

    public function form($instance) { … }           // ADMIN FORM
    public function update($new_instance, $old_instance) { … }   // SAVE
}

function register_kindaid_footer_info_widget() {
    register_widget('Kindaid_Footer_Info_Widget');
}
add_action('widgets_init', 'register_kindaid_footer_info_widget');
```

Each widget file **self-registers** at the bottom. Do not add registrations to the main plugin file.

### `widget()` — the front-end method

```php
public function widget($args, $instance) {
    echo $args['before_widget'];

    $logo    = !empty($instance['logo'])    ? esc_url($instance['logo'])    : '';
    $info    = !empty($instance['info'])    ? wp_kses_post($instance['info']) : '';
    $social1 = !empty($instance['social1']) ? esc_url($instance['social1']) : '';
    ?>

    <?php if (!empty($logo)): ?>
    <div class="tp-footer-logo mb-25">
        <a href="<?php echo esc_url(home_url('/')); ?>">
            <img data-width="108" src="<?php echo esc_url($logo); ?>" alt="">
        </a>
    </div>
    <?php endif; ?>

    <?php if (!empty($info)): ?>
        <p class="tp-footer-dec mb-30"><?php echo $info; ?></p>
    <?php endif; ?>

    <div class="tp-footer-social">
        <?php if (!empty($social1)): ?>
        <a href="<?php echo esc_url($social1); ?>"><i class="fab fa-facebook-f"></i></a>
        <?php endif; ?>
        …
    </div>

    <?php
    echo $args['after_widget'];
}
```

Rules:

1. **Always** `echo $args['before_widget'];` first and `echo $args['after_widget'];` last — that is
   what applies the wrapper and animation from `widgets-init.php`.
2. Sanitise **once**, at the top, into local variables. Then output the variable.
3. Guard every field with `!empty()` — a widget with only a logo set should not print an empty
   `<p>` or a bare social row.
4. Use `$args['before_title'] . $title . $args['after_title']` for titles, never a hardcoded `<h3>`.

> **Bug in the current `footer-info.php`:** `$info` is sanitised with `wp_kses_post()` and then
> printed with `esc_html($info)`. That double-escapes and shows literal tags. Print `$info`
> directly, as in the snippet above. See `docs/known-issues.md`.

### `form()` and `update()`

```php
public function form($instance) {
    $logo = !empty($instance['logo']) ? esc_url($instance['logo']) : '';
    ?>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('logo')); ?>">
        <?php esc_html_e('Logo', 'kindaid'); ?>
      </label>
      <input class="widefat kindaid-media-url" type="text"
             id="<?php echo esc_attr($this->get_field_id('logo')); ?>"
             name="<?php echo esc_attr($this->get_field_name('logo')); ?>"
             value="<?php echo esc_attr($logo); ?>">
      <button class="button kindaid-media-upload"><?php esc_html_e('Upload', 'kindaid'); ?></button>
    </p>
    <?php
}

public function update($new_instance, $old_instance) {
    $instance = array();
    $instance['logo'] = !empty($new_instance['logo']) ? esc_url_raw($new_instance['logo']) : '';
    $instance['info'] = !empty($new_instance['info']) ? wp_kses_post($new_instance['info']) : '';
    return $instance;
}
```

- `$this->get_field_id()` / `get_field_name()` — never build names by hand; WordPress needs its own
  index format for multiple instances to work.
- Sanitise on **save** (`update()`) with `esc_url_raw` / `sanitize_text_field` / `wp_kses_post`, and
  escape again on **output**.
- Media-upload fields rely on `assets/js/kindaid-widget.js` in the theme. Note that the plugin
  loading a script from `get_template_directory_uri()` couples plugin to theme — if you split them
  properly, move that JS into the plugin's own `assets/`.

### Adding a new WP_Widget

1. Create `plugin/kindaid-core/include/wp-widgets/my-thing.php` with the skeleton above.
2. `require_once` it in `plugin/kindaid-core/kindaid-core.php` alongside the others.
3. If it needs its own wrapper classes, register a dedicated sidebar in the theme's
   `widgets-init.php` rather than hardcoding wrapper markup in `widget()`.
