# Customizer options (Kirki)

All theme options live in `include/kindaid-kirki.php`. They are read anywhere with
`get_theme_mod('setting_id', $default)`.

## Loading

Kirki is a plugin, so it is not available while `functions.php` is being parsed. The include is
deferred to `init`:

```php
function kindaid_kirki(){
    if(class_exists( 'Kirki' )){
        include_once('include/kindaid-kirki.php');
    }
}
add_action('init','kindaid_kirki');
```

Because of this guard, **every `get_theme_mod()` call must pass a sensible default** — if Kirki is
deactivated, no option exists and the theme must still render.

## Structure: one panel, many sections, one function per section

```php
new \Kirki\Panel(
	'kindaid_panel',
	[
		'priority'    => 10,
		'title'       => esc_html__( 'KindAid Options', 'kindaid' ),
		'description' => esc_html__( 'KindAid All Option Panel Here.', 'kindaid' ),
	]
);
```

Then each section is wrapped in a function that is called immediately below its own definition:

```php
function header_info_section(){
    new \Kirki\Section(
        'header_info_section',
        [
            'title'       => esc_html__( 'Header Info', 'kindaid' ),
            'description' => esc_html__( 'Here header information', 'kindaid' ),
            'panel'       => 'kindaid_panel',
            'priority'    => 160,
        ]
    );

    new \Kirki\Field\Select([ … ]);
    new \Kirki\Field\Checkbox_Switch([ … ]);
    new \Kirki\Field\Text([ … ]);
}
header_info_section();
```

The wrapper function exists purely to scope the code — it is not hooked. Keep the pattern for
consistency, but note the function names are unprefixed (`header_info_section`,
`header_social_kirki`). **Prefix them (`kindaid_header_info_section`) in a new project** to avoid
collisions.

## Sections and their settings

| Section | Settings |
|---|---|
| `header_info_section` | `header-global`, `header_right_switch`, `button_text`, `button_url` |
| `header_social_section` | `fb_url`, `tw_url`, `inst_url` |
| logo section | `logo`, `logo-transparent`, `offcanvas_logo` |
| offcanvas section | `offcanvas_title`, `offcanvas_desc`, `offcanvas_gallery`, `offcanvas_info` |
| breadcrumb section | `breadcrumb_switch` |
| blog section | `blog_cat_switch`, `blog_meta_author_switch`, `blog_meta_date_switch`, `blog_meta_comment_switch`, `blog_btn_text` |
| footer section | `footer-global`, `footer_bg_image`, `footer_copyright`, `back_to_top_switch` |
| 404 section | `error_text`, `error_subtitle`, `error_content`, `error_btn_text` |
| shop section | `product_social_switch`, `payment_text`, `payment_image` |
| general | `preloader_switch` |

## Field patterns

### Select — used for layout variants

```php
new \Kirki\Field\Select(
    [
        'settings'    => 'header-global',
        'label'       => esc_html__( 'Select Your Default Header', 'kindaid' ),
        'section'     => 'header_info_section',
        'default'     => 'header-global-1',
        'placeholder' => esc_html__( 'Choose an option', 'kindaid' ),
        'choices'     => [
            'header-global-1' => esc_html__( 'Header One', 'kindaid' ),
            'header-global-2' => esc_html__( 'Header Two', 'kindaid' ),
            'header-global-3' => esc_html__( 'Header Three', 'kindaid' ),
        ],
    ]
);
```

### Checkbox_Switch — on/off toggles

```php
new \Kirki\Field\Checkbox_Switch(
    [
        'settings'    => 'header_right_switch',
        'label'       => esc_html__( 'Header Right Info switch', 'kindaid' ),
        'description' => esc_html__( 'Header Right switch', 'kindaid' ),
        'section'     => 'header_info_section',
        'default'     => 'off',
        'choices'     => [
            'on'  => esc_html__( 'Enable', 'kindaid' ),
            'off' => esc_html__( 'Disable', 'kindaid' ),
        ],
    ]
);
```

**Careful:** the stored value is the string `'off'`, which is truthy in PHP. The templates read it as
`get_theme_mod('header_right_switch', false)` and test `if($header_right_switch)`. That works only
because Kirki's switch actually stores boolean-ish values in this setup. When adding a new switch,
test both states in the browser rather than assuming.

### Text

```php
new \Kirki\Field\Text(
    [
        'settings' => 'button_text',
        'label'    => esc_html__( 'Button Text', 'kindaid' ),
        'section'  => 'header_info_section',
        'default'  => esc_html__( 'Donate Now', 'kindaid' ),
        'priority' => 10,
    ]
);
```

### Image / Upload

Used for `logo`, `logo-transparent`, `offcanvas_logo`, `footer_bg_image`, `payment_image`. Stored as
a URL string, so templates read it directly:

```php
$footer_bg_image = get_theme_mod('footer_bg_image');
if(!empty($footer_bg_image)) { echo '<img src="'.esc_url($footer_bg_image).'" alt="">'; }
```

## Reading options in templates

Always at the top of the file, never inline in markup:

```php
<?php
   $header_button_text  = get_theme_mod('button_text', __('Donate Now','kindaid'));
   $header_right_switch = get_theme_mod('header_right_switch', false);
?>
```

Then use `esc_html()` / `esc_url()` / `esc_attr()` at the point of output. Text that may contain
markup (copyright, descriptions) goes through `kindaid_kses()`.

For image URLs the default is a bundled asset:

```php
$kindaid_logo_url = get_theme_mod('logo', get_template_directory_uri().'/assets/img/logo/logo.png');
```

## Adding a new option

1. Pick the section, or create one with a new wrapper function + `new \Kirki\Section(...)`.
2. Add the field with `'settings' => 'my_new_option'` and `'section' => 'that_section'`.
3. Read it in the template with a default: `get_theme_mod('my_new_option', 'fallback')`.
4. Guard the markup with `!empty()`.

Use **underscores** for new setting IDs. Do not rename existing dashed keys (`header-global`,
`footer-global`, `logo-transparent`) — that discards saved user settings.

## When to use Customizer vs. Elementor widget vs. metabox

| Data | Where |
|---|---|
| Same on every page (logo, social URLs, copyright) | Customizer |
| Chosen per page (which header layout) | Metabox, falling back to Customizer |
| Placed and arranged by the user per page (hero, testimonials) | Elementor widget |
| Per-post extras (video URL for a video-format post) | Metabox |
