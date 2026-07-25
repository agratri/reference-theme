# Per-page / per-post options (Pure Metafields)

Metaboxes are defined in `include/kindaid-metafields.php`.

## Dependency

Provided by the **Pure Metafields** plugin. The include is guarded in `functions.php`:

```php
if(function_exists( 'tpmeta_field' )){
	include_once('include/kindaid-metafields.php');
}
```

And every read is guarded too:

```php
$header_from_page = function_exists('tpmeta_field') ? tpmeta_field('header-from-page') : '';
```

Never call `tpmeta_field()` unguarded — the theme must survive the plugin being deactivated.

## Definition format

One filter callback returns an array of metabox definitions:

```php
function kindaid_metafields( $meta_boxes ) {

    $meta_boxes[] = array(
        'metabox_id' => 'kindaid-metafields',
        'title'      => esc_html__( 'Page Options', 'kindaid' ),
        'post_type'  => 'page',          // page, post, or a custom post type name
        'context'    => 'normal',
        'priority'   => 'core',
        'fields'     => array(
            array(
                'label'       => 'Breadcrumb On/Off',
                'id'          => "breadcrumb_page_switch",
                'type'        => 'switch',
                'placeholder' => '',
                'default'     => 'on',           // do not remove the default key
            ),
            array(
                'label'   => esc_html__('Header Layout', 'kindaid'),
                'id'      => "header-from-page",
                'type'    => 'select',
                'options' => array(
                    'blank-header'  => esc_html__('Select Your header','kindaid'),
                    'header-page-1' => esc_html__('Header One','kindaid'),
                    'header-page-2' => esc_html__('Header Two','kindaid'),
                    'header-page-3' => esc_html__('Header Three','kindaid'),
                ),
                'placeholder' => esc_html__('Select an item','kindaid'),
                'conditional' => array(),
                'default'     => '',
                'multiple'    => false,
            ),
            array(
                'label'   => esc_html__('Footer Layout', 'kindaid'),
                'id'      => "footer-from-page",
                'type'    => 'select',
                'options' => array(
                    'blank-header'  => esc_html__('Select Your Footer','kindaid'),
                    'footer-page-1' => esc_html__('Footer One','kindaid'),
                    'footer-page-2' => esc_html__('Footer Two','kindaid'),
                ),
                'placeholder' => esc_html__('Select an item','kindaid'),
                'conditional' => array(),
                'default'     => '',
                'multiple'    => false,
            )
        ),
    );

    // more $meta_boxes[] entries …

    return $meta_boxes;
}
```

## Defined metaboxes

| metabox_id | post_type | Fields |
|---|---|---|
| `kindaid-metafields` | `page` | `breadcrumb_page_switch`, `header-from-page`, `footer-from-page` |
| `post-format-video-metafields` | `post` (post_format: video) | `kindaid-post-format-video` |
| `post-format-audio-metafields` | `post` (post_format: audio) | `kindaid-post-format-audio` |
| `post-format-gallery-metafields` | `post` (post_format: gallery) | gallery images |

## Binding a metabox to a post format

```php
$meta_boxes[] = array(
    'metabox_id' => 'post-format-video-metafields',
    'title'      => esc_html__( 'Post Video URL', 'kindaid' ),
    'post_type'  => 'post',
    'context'    => 'normal',
    'priority'   => 'core',
    'fields'     => array(
        array(
            'label'       => esc_html__( 'Video Format', 'kindaid' ),
            'id'          => "kindaid-post-format-video",
            'type'        => 'text',
            'placeholder' => esc_html__( 'Video url here', 'kindaid' ),
            'default'     => '',
            'conditional' => array()
        ),
    ),
    'post_format' => 'video'    // only shows when the post format is Video
);
```

The `post_format` key makes the box appear only for that format. It pairs with
`templates/content-video.php`, which reads the field.

## The override pattern

Metabox values always take precedence over Customizer values, with a hardcoded final fallback. Both
`kindaid_header()` and `kindaid_footer()` follow it (see `docs/header-footer.md`), and so does the
breadcrumb — but note the breadcrumb combines them with AND, not as an override:

```php
$breadcrumb_page_switch = function_exists('tpmeta_field') ? tpmeta_field('breadcrumb_page_switch') : 'on';
$breadcrumb_global      = get_theme_mod('breadcrumb_switch', true);

$breadcrumb_on_off = $breadcrumb_global && ($breadcrumb_page_switch == 'on');
```

So the global switch acts as a master kill-switch: turning it off hides breadcrumbs everywhere,
regardless of the per-page setting. Turning it on lets each page opt out.

Two different semantics in the same theme — be explicit about which one you want when adding a new
option, and document it.

## Adding a new metabox field

1. Add the field array to the appropriate `$meta_boxes[]` entry in `include/kindaid-metafields.php`.
2. Read it with the guard:

```php
$my_value = function_exists('tpmeta_field') ? tpmeta_field('my-field-id') : '';
```

3. Guard the markup with `!empty($my_value)`.

If the field is a layout selector, remember it needs matching entries in **both** the metabox options
and the Kirki select choices (see `docs/header-footer.md`, "Adding a new header variant").
