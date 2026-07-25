# Header & Footer system

## The core idea

`header.php` and `footer.php` contain **no design markup**. They delegate to a selector function,
which picks one of several variant templates. The user chooses the variant globally in the
Customizer, and can override it per page with a metabox.

## Header

### `header.php`

Ends with an open hook — there is deliberately no `<header>` tag and no closing `?>`:

```php
<body <?php echo body_class(); ?>>
   <?php wp_body_open(); ?>

   <?php
      $preloader_switch   = get_theme_mod('preloader_switch',false);
      $back_to_top_switch = get_theme_mod('back_to_top_switch',false);
   ?>

   <?php if(!empty($preloader_switch)) : ?>
   <div class="preloader d-none"><div class="loader"></div></div>
   <?php endif; ?>

   <?php if(!empty($back_to_top_switch)) : ?>
   <div class="back-to-top-wrapper">
      <button id="back_to_top" type="button" class="back-to-top-btn"> … </button>
   </div>
   <?php endif; ?>

   <?php do_action('header_before');
```

### The selector — `include/theme-helper.php`

```php
function kindaid_header(){
   $header_from_page = function_exists('tpmeta_field') ? tpmeta_field('header-from-page') : '';
   $header_global    = get_theme_mod('header-global','header-global-1');

   if($header_from_page == 'header-page-1'){       get_template_part('templates/header/header-1'); }
   elseif($header_from_page == 'header-page-2'){   get_template_part('templates/header/header-2'); }
   elseif($header_from_page == 'header-page-3'){   get_template_part('templates/header/header-3'); }
   else{
      if($header_global == 'header-global-2'){     get_template_part('templates/header/header-2'); }
      elseif($header_global == 'header-global-3'){ get_template_part('templates/header/header-3'); }
      else{                                        get_template_part('templates/header/header-1'); }
   }
}
add_action('header_before','kindaid_header',10);
```

Three keys, three namespaces — keep them distinct:

| Where | Value format |
|---|---|
| Page metabox field `header-from-page` | `header-page-1`, `header-page-2`, `header-page-3` |
| Customizer setting `header-global` | `header-global-1`, `header-global-2`, `header-global-3` |
| Template file | `templates/header/header-1.php` |

### A header variant — `templates/header/header-1.php`

Top of file reads settings and derives layout classes:

```php
$header_button_text  = get_theme_mod('button_text', __('Donate Now','kindaid'));
$header_button_url   = get_theme_mod('button_url', __('#','kindaid'));
$header_right_switch = get_theme_mod('header_right_switch', false);

$header_menu_column = ($header_right_switch == false) ? 'col-xxl-9 col-xl-10' : 'col-xxl-6 col-xl-6';
$header_menu_pos    = ($header_right_switch == false) ? 'text-end' : 'text-center';
```

This is the **responsive-grid-from-settings** pattern: when the right-side action area is disabled,
the menu column widens and right-aligns; when enabled, the menu narrows and centres.

Then it pulls in the shared overlays:

```php
get_template_part('templates/header/header-search');
get_template_part('templates/header/offcanvas');
if(class_exists('WooCommerce')) get_template_part('templates/header/minicart');
```

Then the markup:

```php
<header class="tp-header-height">
   <div id="header-sticky" class="tp-header-area tp-header-2-style tp-header-lg-spacing tp-header-blur">
      <div class="container-fluid container-1790">
         <div class="row align-items-center">

            <div class="col-xxl-3 col-xl-2 col-5">
               <div class="tp-header-logo"><?php kindaid_logo(); ?></div>
            </div>

            <div class="<?php echo esc_attr($header_menu_column); ?> d-none d-xl-block">
               <div class="tp-main-menu <?php echo esc_attr($header_menu_pos); ?>">
                  <nav class="tp-mobile-menu-active"><?php kindaid_main_menu(); ?></nav>
               </div>
            </div>

            <?php if($header_right_switch) : ?>
            <div class="col-xxl-3 col-xl-4 col-7">
               <div class="tp-header-action d-flex align-items-center justify-content-end">
                  <!-- cart button (Woo guard) -->
                  <!-- search button: class="tp-search-click" -->
                  <!-- donate button (if $header_button_text) -->
                  <!-- hamburger: class="tp-header-toogle" d-xl-none -->
               </div>
            </div>
            <?php endif; ?>

            <?php if($header_right_switch == false) : ?>
            <!-- mobile-only hamburger column -->
            <?php endif; ?>

         </div>
      </div>
   </div>
</header>
```

### JS contract — do not rename these

| Selector | Behaviour (in `assets/js/main.js`) |
|---|---|
| `#header-sticky` | gets a sticky class on scroll |
| `.tp-header-height` | reserves space so content doesn't jump when header becomes fixed |
| `.tp-header-toogle` | opens the offcanvas panel |
| `.tp-search-click` | opens the search overlay |
| `.cartmini-open-btn` | opens the minicart |
| `.tp-mobile-menu-active` | the nav that gets cloned into the mobile menu |
| `.header-sticky` | added to `#header-sticky` by JS; `main.css` uses it to swap `.logo-1` / `.logo-2` |
| `#back_to_top` | scroll-to-top button |

If a new HTML template uses different class names, either rename them in the HTML to match, or
update `main.js` — but **be consistent across all variants**.

### Logo helpers — `include/theme-helper.php`

```php
function kindaid_logo(){
   $kindaid_logo_url = get_theme_mod('logo', get_template_directory_uri().'/assets/img/logo/logo.png');
   ?>
   <a href="<?php echo esc_url(home_url()); ?>">
      <img data-width="108" src="<?php echo esc_url($kindaid_logo_url); ?>" alt="<?php echo bloginfo(); ?>">
   </a>
   <?php
}
```

Two-logo variant for transparent headers. Used by `header-3.php` only. The swap is **CSS-driven, not
JS**: `assets/js/main.js` adds the class `header-sticky` to `#header-sticky` on scroll, and
`main.css` then does the swap:

```css
.header-sticky .tp-header-logo .logo-1 { /* hide */ }
.header-sticky .tp-header-logo .logo-2 { /* show */ }
```

So `.logo-2` ships with `d-none` in the markup and CSS overrides it once the header is sticky:

```php
function kindaid_transparent_logo(){
   $kindaid_logo_url             = get_theme_mod('logo', …);
   $kindaid_logo_transparent_url = get_theme_mod('logo-transparent', …/logo-yellow.png);
   ?>
   <a href="<?php echo esc_url(home_url()); ?>">
      <img class="logo-1"        data-width="108" src="<?php echo esc_url($kindaid_logo_transparent_url); ?>" alt="logo">
      <img class="logo-2 d-none" data-width="108" src="<?php echo esc_url($kindaid_logo_url); ?>" alt="logo">
   </a>
   <?php
}
```

`kindaid_offcanvas_logo()` is a third variant reading `offcanvas_logo`.

Note: `alt="<?php echo bloginfo(); ?>"` is wrong — `bloginfo()` already echoes, so `echo` is
redundant and the default `bloginfo()` with no argument prints nothing useful. Use
`esc_attr(get_bloginfo('name'))` in new code.

### Menu helper

```php
function kindaid_main_menu(){
    wp_nav_menu(array(
        'theme_location' => 'main-menu',
        'container'      => '',
        'menu_class'     => '',
        'menu_id'        => '',
        'fallback_cb'    => 'KindAid_Walker_Nav_Menu::fallback',
        'walker'         => new KindAid_Walker_Nav_Menu,
    ));
}
```

Empty `container` / `menu_class` / `menu_id` = no wrapper `<div>`, no auto classes — the theme's own
`<nav class="tp-mobile-menu-active">` is the only wrapper. The custom walker
(`include/nav-walker.php`) produces the submenu / megamenu markup; submenus get
`class="sub-menu hello-new-menu"`.

`main-menu` and `footer-menu` are registered in `include/common/after-setup-theme.php`.

---

## Footer

### `footer.php`

Symmetrical with the header — fires a hook, prints no markup of its own:

```php
   <?php do_action('footer_before'); ?>
   <?php wp_footer(); ?>
</body>
</html>
```

`wp_footer()` must stay immediately before `</body>`; that is where WordPress and every plugin inject
their JavaScript. Remove it and the whole front end stops working.

### The selector

Hooked at priority 10, so a plugin can inject before the footer with a lower priority or after it with
a higher one:

```php
add_action('footer_before','kindaid_footer',10);
```

```php
function kindaid_footer(){
   $footer_from_page = function_exists('tpmeta_field') ? tpmeta_field('footer-from-page') : '';
   $footer_global    = get_theme_mod('footer-global','footer-global-1');

   if($footer_from_page == 'footer-page-1'){     get_template_part('templates/footer/footer-1'); }
   elseif($footer_from_page == 'footer-page-2'){ get_template_part('templates/footer/footer-2'); }
   else{
      if($footer_global == 'footer-global-2'){   get_template_part('templates/footer/footer-2'); }
      else{                                      get_template_part('templates/footer/footer-1'); }
   }
}
```

Two variants only, versus three for the header.

### A footer variant — `templates/footer/footer-1.php`

```php
<?php $footer_bg_image = get_theme_mod('footer_bg_image'); ?>

<footer>
  <div class="tp-footer-area tp-footer-overly position-relative">

    <?php if(!empty($footer_bg_image)) : ?>
    <div class="tp-footer-bg"><img src="<?php echo esc_url($footer_bg_image); ?>" alt=""></div>
    <?php endif; ?>

    <?php if(is_active_sidebar('footer-1-widget-1') || is_active_sidebar('footer-1-widget-2')
          || is_active_sidebar('footer-1-widget-3') || is_active_sidebar('footer-1-widget-4')) : ?>
    <div class="container container-1424 pt-130">
      <div class="row pb-60">
        <?php if(is_active_sidebar('footer-1-widget-1')) : ?>
        <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6"><?php dynamic_sidebar('footer-1-widget-1'); ?></div>
        <?php endif; ?>
        <!-- widget 2, 3, 4 the same, different col widths -->
      </div>
    </div>
    <?php endif; ?>

    <div class="tp-footer-bottom">
      <div class="container container-1424">
        <div class="row">
          <div class="col-lg-6">
            <div class="tp-footer-copyright mb-20"><?php kindaid_footer_copyright(); ?></div>
          </div>
          <div class="col-lg-6">
            <div class="tp-footer-policy mb-20 text-lg-end"><?php kindaid_footer_menu(); ?></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
```

Two levels of guard, and both matter:

- **Outer** — if all four areas are empty, the whole container (including `pt-130`) disappears, so
  no dead whitespace.
- **Inner** — an empty area's `<div class="col-…">` is not printed at all, so remaining columns
  redistribute naturally in the Bootstrap row.

Background image is a real `<img>` inside `.tp-footer-bg` (absolutely positioned by CSS), not a CSS
background — keeps responsive images and lazy loading working.

Column widths per variant:

| Variant | xl column split |
|---|---|
| footer-1 | 3 / 3 / 2 / 4 |
| footer-2 | 4 / 2 / 3 / 3 |

### Footer bottom helpers

```php
function kindaid_footer_copyright(){
   $footer_copyright = get_theme_mod('footer_copyright',
       esc_html__('© 2026 Charity. is Proudly Powered by Aqlova','kindaid'));
   ?>
   <p class="mb-0"><?php echo kindaid_kses($footer_copyright); ?></p>
   <?php
}
```

`kindaid_kses()` (not `esc_html()`) because the copyright line normally contains a link.

```php
function kindaid_footer_menu(){
    wp_nav_menu(array(
        'theme_location' => 'footer-menu',
        'container' => '', 'menu_class' => '', 'menu_id' => '',
        'fallback_cb' => 'KindAid_Walker_Nav_Menu::fallback',
        'walker' => new KindAid_Walker_Nav_Menu,
    ));
}
```

### Where footer spacing actually lives

Not in the footer template — in `include/common/widgets-init.php`, in each area's `before_widget`:

```php
'before_widget' => '<div id="%1$s" class="tp-footer-widget ml-65 mb-50 wow fadeInUp %2$s"
                     data-wow-duration=".9s" data-wow-delay=".4s">',
```

So to change a footer column's left margin or its animation delay, edit `widgets-init.php`.

---

## Adding a new header variant (worked example: header-4)

1. **Template** — create `templates/header/header-4.php`. Read its settings at the top, guard every
   optional block, reuse `kindaid_logo()` / `kindaid_main_menu()` rather than inlining markup.

2. **Selector** — in `include/theme-helper.php`, extend `kindaid_header()`:

```php
elseif($header_from_page == 'header-page-4'){ get_template_part('templates/header/header-4'); }
…
elseif($header_global == 'header-global-4'){  get_template_part('templates/header/header-4'); }
```

3. **Customizer** — in `include/kindaid-kirki.php`, add to the `header-global` select choices:

```php
'header-global-4' => esc_html__( 'Header Four', 'kindaid' ),
```

4. **Metabox** — in `include/kindaid-metafields.php`, add to the `header-from-page` options:

```php
'header-page-4' => esc_html__('Header Four','kindaid'),
```

All four edits are required. Missing step 3 or 4 means the variant exists but cannot be selected.

Adding a footer variant is the same, minus the offcanvas/minicart includes, plus four new
`register_sidebar()` calls (`footer-3-widget-1..4`) in `widgets-init.php`.
