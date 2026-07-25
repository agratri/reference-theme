# Elementor widgets (in the plugin)

Every homepage/inner-page section that the user places themselves is an Elementor widget. They live
in `plugin/kindaid-core/widgets/`, one file per widget. **Never put these in the theme.**

## Registration

`plugin/kindaid-core/kindaid-core.php`:

```php
function kindaid_register_elementor_widgets( $widgets_manager ) {

	if(class_exists( 'Charitable' )){
		require_once( __DIR__ . '/widgets/charity-grid.php' );
		require_once( __DIR__ . '/widgets/charity-slider.php' );
		require_once( __DIR__ . '/widgets/charity-support.php' );
	}

	require_once( __DIR__ . '/widgets/icon-box.php' );
	// … one line per widget
}
add_action( 'elementor/widgets/register', 'kindaid_register_elementor_widgets' );
```

Each widget file ends with:

```php
$widgets_manager->register( new Kindaid_Icon_Box() );
```

`$widgets_manager` is in scope because the file is `require_once`d from inside the callback. Unusual,
but it is the convention here — keep it.

Widgets that depend on a third-party plugin are required **inside a `class_exists()` guard**.

The custom category:

```php
function kindaid_elementor_widget_categories( $elements_manager ) {
	$elements_manager->add_category(
		'kindaid-core',
		[
			'title' => esc_html__( 'Kindaid Core', 'textdomain' ),
			'icon'  => 'fa fa-plug',
		]
	);
}
add_action( 'elementor/elements/categories_registered', 'kindaid_elementor_widget_categories' );
```

Widgets that depend on a third-party plugin are required inside a `class_exists()` guard, so the
plugin never fatals when that dependency is missing.

## Widget anatomy

```php
<?php
class Kindaid_Icon_Box extends \Elementor\Widget_Base {

	public function get_name(): string       { return 'kindaid-icon-box'; }
	public function get_title(): string      { return esc_html__( 'Icon Box', 'kindaid-core' ); }
	public function get_icon(): string       { return 'eicon-components'; }
	public function get_categories(): array  { return [ 'kindaid-core' ]; }
	public function get_keywords(): array    { return [ 'icon box' ]; }

	protected function register_controls(): void {
		$this->register_controls_section();   // TAB_CONTENT
		$this->register_style_section();      // TAB_STYLE
	}

	protected function register_controls_section(){ … }
	protected function register_style_section(){ … }

	protected function render(): void { … }
}

$widgets_manager->register( new Kindaid_Icon_Box() );
```

Naming: class `Kindaid_Icon_Box`, slug `kindaid-icon-box`, category `kindaid-core`, text domain
`kindaid-core`.

`register_controls()` is split into two private methods so content and style controls stay readable.

## The layout-switch pattern

Almost every widget supports multiple designs from the same HTML template. The first control is
always a layout select:

```php
$this->add_control(
	'design-layout',
	[
		'label'   => esc_html__( 'Select Layout', 'kindaid-core' ),
		'type'    => \Elementor\Controls_Manager::SELECT,
		'default' => 'layout-1',
		'options' => [
			'layout-1' => esc_html__( 'Layout 01', 'kindaid-core' ),
			'layout-2' => esc_html__( 'Layout 02', 'kindaid-core' ),
		],
	]
);
```

And `render()` branches on it:

```php
<?php if($settings['design-layout'] == 'layout-2') : ?>
   <!-- markup for design 2 -->
<?php else : ?>
   <!-- markup for design 1 -->
<?php endif; ?>
```

This is the main mechanism for porting an HTML template that has, say, three service-section designs:
**one widget, three layouts** — not three widgets.

## Media / icon controls

The icon-source pattern (font icon, image, or raw SVG) with conditional controls:

```php
$this->add_control('icon_style', [
	'type'    => \Elementor\Controls_Manager::SELECT,
	'default' => 'icon_font',
	'options' => [
		'icon_font'  => esc_html__( 'Icon', 'kindaid-core' ),
		'image_icon' => esc_html__( 'Image', 'kindaid-core' ),
		'svg_icon'   => esc_html__( 'SVG', 'kindaid-core' ),
	],
]);

$this->add_control('icon', [
	'type'      => \Elementor\Controls_Manager::ICONS,
	'default'   => [ 'value' => 'fas fa-smile', 'library' => 'fa-solid' ],
	'condition' => [ 'icon_style' => 'icon_font' ],
]);

$this->add_control('image', [
	'type'      => \Elementor\Controls_Manager::MEDIA,
	'default'   => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
	'condition' => [ 'icon_style' => 'image_icon' ],
]);

$this->add_control('svg', [
	'type'      => \Elementor\Controls_Manager::TEXTAREA,
	'condition' => [ 'icon_style' => 'svg_icon' ],
]);
```

Rendered:

```php
<?php if($settings['icon_style'] == 'icon_font') : ?>
	<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
<?php elseif($settings['icon_style'] == 'image_icon') : ?>
	<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
<?php else : ?>
	<?php echo kindaid_kses_svg($settings['svg']); ?>
<?php endif; ?>
```

## Image URL + alt — the standard three lines

Always resolve the attachment ID first so image sizes and alt text work:

```php
if(!empty($settings['image'])){
	$image_url = !empty($settings['image']['id'])
		? wp_get_attachment_image_url($settings['image']['id'],'full')
		: $settings['image']['url'];
	$image_alt = !empty($settings['image']['id'])
		? get_post_meta($settings['image']['id'], '_wp_attachment_image_alt', true)
		: '';
}
```

Inside a repeater loop, the same three lines with `$item['image']`.

## Repeaters

For any list (brands, facts, FAQs, team members, slides):

```php
$repeater = new \Elementor\Repeater();

$repeater->add_control('image', [
	'label'   => esc_html__( 'Image Icon', 'kindaid-core' ),
	'type'    => \Elementor\Controls_Manager::MEDIA,
	'default' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
]);

$repeater->add_control('url', [
	'label'       => esc_html__( 'url', 'kindaid-core' ),
	'type'        => \Elementor\Controls_Manager::TEXT,
	'default'     => esc_html__( '#', 'kindaid-core' ),
	'label_block' => true,
]);

$this->add_control('list', [
	'label'  => esc_html__( 'Brand List', 'kindaid-core' ),
	'type'   => \Elementor\Controls_Manager::REPEATER,
	'fields' => $repeater->get_controls(),
]);
```

Render:

```php
<?php foreach( $settings['list'] as $item ) :
	if(!empty($item['image'])){
		$image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url($item['image']['id'],'full') : $item['image']['url'];
		$image_alt = !empty($item['image']['id']) ? get_post_meta($item['image']['id'], '_wp_attachment_image_alt', true) : '';
	}
?>
	<div class="swiper-slide">
		<div class="tp-brand-2-item">
			<a target="_blank" href="<?php echo esc_url($item['url']); ?>">
				<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
			</a>
		</div>
	</div>
<?php endforeach; ?>
```

The repeater control is conventionally named `list`.

## The WOW animation section

Every widget that animates gets this control section:

```php
$this->start_controls_section('wow_section', [
	'label' => esc_html__( 'Animation', 'kindaid-core' ),
	'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
]);

$this->add_control('enable_wow', [
	'label'        => __('Enable Animation', 'kindaid-core'),
	'type'         => \Elementor\Controls_Manager::SWITCHER,
	'label_on'     => __('Yes', 'kindaid-core'),
	'label_off'    => __('No', 'kindaid-core'),
	'return_value' => 'yes',
	'default'      => 'yes',
]);

$this->add_control('animation_type', [
	'type'      => \Elementor\Controls_Manager::SELECT,
	'default'   => 'fadeInUp',
	'options'   => [
		'fadeIn' => 'Fade In', 'fadeInUp' => 'Fade In Up', 'fadeInDown' => 'Fade In Down',
		'zoomIn' => 'Zoom In', 'slideInLeft' => 'Slide In Left', 'slideInRight' => 'Slide In Right',
	],
	'condition' => [ 'enable_wow' => 'yes' ],
]);

$this->add_control('wow_duration', [
	'type' => \Elementor\Controls_Manager::TEXT, 'default' => '.9s',
	'condition' => [ 'enable_wow' => 'yes' ],
]);

$this->add_control('wow_delay', [
	'type' => \Elementor\Controls_Manager::TEXT, 'default' => '.3s',
	'condition' => [ 'enable_wow' => 'yes' ],
]);

$this->end_controls_section();
```

And in `render()`, before any markup:

```php
$wow_class = '';
$duration  = '';
$delay     = '';

if ($settings['enable_wow'] === 'yes') {
	$wow_class = 'wow ' . $settings['animation_type'];
	$duration  = 'data-wow-duration="' . esc_attr($settings['wow_duration']) . '"';
	$delay     = 'data-wow-delay="'    . esc_attr($settings['wow_delay'])    . '"';
}
```

Applied as:

```php
<div class="tp-contact-item el-bg <?php echo esc_attr($wow_class); ?>" <?php echo $duration; ?> <?php echo $delay; ?>>
```

`$duration` / `$delay` are full attribute strings already escaped internally, so they are echoed raw.

## Style controls via traits

`plugin/kindaid-core/include/traits/normal-trait.php` defines `Kindaid_Content_Style`, a reusable style
section generator:

```php
trait Kindaid_Content_Style{
    protected function tp_content_style($section = 'heading', $label = 'Title', $selector = 'el-title'){
        $this->start_controls_section($section . '_section_style', [
            'label' => $label,
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control($section.'_color', [
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} '.$selector => 'color: {{VALUE}};' ],
        ]);

        $this->add_control($section.'_mark_color', [
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} '.$selector.' span' => 'color: {{VALUE}};' ],
        ]);

        // margin, padding (DIMENSIONS) …
        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
            'name'     => $section.'_typography',
            'selector' => '{{WRAPPER}} '.$selector,
        ]);

        $this->end_controls_section();
    }
}
```

Used in a widget — real example from `widgets/heading.php`:

```php
class Kindaid_Heading extends \Elementor\Widget_Base {
	use Kindaid_Content_Style;

	protected function register_style_section(){
		$this->tp_content_style('sub',     'Section Sub Heading', '.el-sub-title');
		$this->tp_content_style('heading', 'Section Heading',     '.el-title');
		$this->tp_content_style('content', 'Section Content',     '.el-content');
	}
}
```

Signature: `tp_content_style($section, $label, $selector)`. `$section` becomes the control-ID prefix
(`heading_color`, `heading_margin`, `heading_typography`), `$selector` is the CSS hook — **pass it with
the leading dot**.

Not every widget uses the trait. `widgets/icon-box.php`, for instance, writes its own
`register_style_section()` by hand. Prefer the trait when the widget exposes standard
colour/margin/padding/typography controls; write it out only when the widget needs something the trait
does not cover.

`widgets/heading-trait.php` shows both traits combined:

```php
use Kindaid_Content_Style, Kindaid_Heading_Control;
…
$this->tp_heading_control('tp','Title Section');    // content controls
$this->tp_heading_control('sv','Service Title Section');
…
$this->tp_content_style('sub','Section Sub Heading','.el-sub-title');   // style controls
```

**This is why the `el-*` classes exist.** Markup carries semantic `tp-*` classes for the design plus
an `el-*` hook for Elementor's style selectors:

```html
<h5 class="tp-service-title el-title">…</h5>
<div class="tp-service-content el-content">…</div>
<div class="tp-service-item el-bg">…</div>
```

| Hook | Targets |
|---|---|
| `el-title` | headings |
| `el-content` | body text |
| `el-bg` | the box/card background |
| `el-link` | links / buttons |

Never point Elementor selectors at `tp-*` classes — those are shared across the whole theme and a
per-widget colour change would leak. Always add an `el-*` hook.

Other traits:

| File | Trait | Provides |
|---|---|---|
| `include/traits/normal-trait.php` | `Kindaid_Content_Style` | a TAB_STYLE section: color, mark color, margin, padding, typography |
| `include/traits/heading-control-trait.php` | `Kindaid_Heading_Control` | a TAB_CONTENT section: sub-heading / heading / content fields |
| `include/traits/link-trait.php` | `Kindaid_Link_Control` | a URL control plus `kindaid_link_attrs()` for href/target/rel |

## Escaping in widgets

| Value | Function |
|---|---|
| Title, description, any rich text | `kindaid_kses_svg()` |
| SVG markup | `kindaid_kses_svg()` |
| URL | `esc_url()` |
| Attribute | `esc_attr()` |
| Plain text | `esc_html()` |
| Icon | `\Elementor\Icons_Manager::render_icon()` |

`kindaid_kses_svg()` is in `plugin/kindaid-core/include/kindaid-core-helper.php` and its whitelist includes
`svg` and its child elements — that is why it, not `kindaid_kses()`, is used for inline SVG.

## Data helpers

`plugin/kindaid-core/include/kindaid-core-helper.php`:

```php
kindaid_all_cat('category')      // → [ slug => name ]  for a SELECT of categories
kindaid_all_post('post')         // → [ ID => title ]   for a SELECT of posts
```

Use them to build query controls:

```php
$this->add_control('category', [
	'type'    => \Elementor\Controls_Manager::SELECT2,
	'options' => kindaid_all_cat('category'),
	'multiple'=> true,
]);
```

## Adding a new widget — checklist

1. Create `plugin/kindaid-core/widgets/my-section.php`.
2. Class `Kindaid_My_Section`, slug `kindaid-my-section`, category `kindaid-core`, text domain
   `kindaid-core`.
3. `use Kindaid_Content_Style;` if it has styleable text.
4. Controls: `design-layout` select first, then content controls, then the animation section.
5. `render()`: read `$settings`, build `$wow_class`/`$duration`/`$delay`, resolve image URLs, branch
   on layout, guard every optional field with `!empty()`, escape everything.
6. Add `el-*` hooks to every element you expose a style control for.
7. End the file with `$widgets_manager->register( new Kindaid_My_Section() );`.
8. `require_once` it in `kindaid-core.php` inside `kindaid_register_elementor_widgets()`.
9. If it depends on a third-party plugin, wrap the require in `class_exists()`.
10. If it needs a Swiper instance, add the init code to the theme's `assets/js/slider-init.js` and
    use the matching wrapper classes.
