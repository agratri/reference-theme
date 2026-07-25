# Template files, partials and post formats

## Template hierarchy in this theme

| Request | File used |
|---|---|
| Blog list / posts page | `index.php` |
| Single post | `single.php` |
| Static page | `page.php` |
| Category / tag / date / CPT archive | `archive.php` |
| Search results | `search.php` |
| Not found | `404.php` |
| Comments block | `comments.php` |
| Blog sidebar | `sidebar.php` |
| Shop archive | `woocommerce/archive-product.php` |
| Single campaign (Charitable) | `plugin/kindaid-core/include/single-donation.php` via `template_include` filter |

`index.php` is the mandatory fallback — WordPress will not recognise the directory as a theme without
it (plus `style.css`).

## The shared skeleton

`index.php`, `archive.php` and `single.php` are near-identical:

```php
<?php
get_header();
$post_center = is_active_sidebar('blog-sidebar') ? '' : 'justify-content-center';
?>

<div class="tp-blog-post-area pt-120 pb-80">
   <div class="container container-1424">
      <div class="row <?php echo esc_attr($post_center); ?>">
         <div class="col-xl-9 col-lg-8">
            <div class="tp-postbox-wrapper mr-85 mb-40">

               <?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>
                  <?php get_template_part('templates/content', get_post_format()); ?>
               <?php endwhile; else : ?>
                  <?php esc_html_e('Post not found','kindaid'); ?>
               <?php endif; ?>

               <div class="tp-pagination mt-40">
                  <?php kindaid_blog_pagination(); ?>
               </div>
            </div>
         </div>

         <?php if(is_active_sidebar('blog-sidebar')) : ?>
         <div class="col-xl-3 col-lg-4">
            <div class="tp-blog-sidebar mb-40"><?php get_sidebar(); ?></div>
         </div>
         <?php endif; ?>
      </div>
   </div>
</div>

<?php get_footer();
```

### The `$post_center` trick

```php
$post_center = is_active_sidebar('blog-sidebar') ? '' : 'justify-content-center';
```

The content column is `col-xl-9`. With no sidebar, the remaining 3 columns would be dead space on the
right. Adding `justify-content-center` to the row centres the 9-column block instead. The same
condition also gates the sidebar column itself — one boolean, two effects.

Apply this pattern to any layout with an optional sidebar.

### `single.php` — what it adds

Between the loop and the sidebar:

```php
<?php
   $prev_post = get_previous_post();
   $next_post = get_next_post();
?>

<?php if($prev_post || $next_post) : ?>
<div class="tp-blog-navigation-wrap mb-35 mt-90">
   <div class="row justify-content-between">
      <div class="col-xl-5 col-lg-6 col-md-6">
         <?php if($prev_post) : ?>
         <div class="tp-blog-navigation mb-30">
            <a href="<?php echo get_permalink($prev_post->ID); ?>">
               <i class="far fa-arrow-left"></i>
               <div class="tp-blog-navigation-text">
                  <span><?php echo esc_html__('Previous Post','kindaid'); ?></span>
                  <h4 class="tp-blog-navigation-title"><?php echo get_the_title($prev_post->ID); ?></h4>
               </div>
            </a>
         </div>
         <?php endif; ?>
      </div>
      <!-- next post, mirrored, text-end -->
   </div>
</div>
<?php endif; ?>

<?php get_template_part('templates/biography'); ?>

<?php if ( comments_open() || get_comments_number() ) : comments_template(); endif; ?>
```

Three guards: the outer `if($prev_post || $next_post)` kills the whole block on a single-post blog,
then each side is guarded individually, then comments only load if open or already present.

### `page.php`

No sidebar column, no pagination, and the partial is named explicitly rather than by post format:

```php
<div class="tp-page-area pt-120 pb-80">
   <div class="container container-1424">
      <div class="tp-page-wrapper mr-85 mb-40">
         <?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>
            <?php get_template_part('templates/content','page'); ?>
         <?php endwhile; else : ?>
            <?php esc_html_e('Page Post not found','kindaid'); ?>
         <?php endif; ?>
      </div>
   </div>
</div>
```

It still computes `$post_center` even though it never uses it — dead code, drop it in a new project.

## Post formats

Declared in `include/common/after-setup-theme.php`:

```php
add_theme_support( 'post-formats', array( 'image', 'video', 'quote', 'gallery', 'audio' ) );
```

Dispatched in the loop:

```php
get_template_part('templates/content', get_post_format());
```

| `get_post_format()` returns | File loaded |
|---|---|
| `'video'` | `templates/content-video.php` |
| `'audio'` | `templates/content-audio.php` |
| `'gallery'` | `templates/content-gallery.php` |
| `'image'` | `templates/content-image.php` |
| `'quote'` | `templates/content-quote.php` |
| `false` (standard) | `templates/content.php` |

For a standard post, `get_post_format()` returns `false`, so `get_template_part()` looks for
`templates/content-.php`, does not find it, and falls back to `templates/content.php`. That fallback
is the whole reason the base file has no suffix.

Video / audio / gallery formats read their media from metabox fields
(`kindaid-post-format-video`, `kindaid-post-format-audio`, gallery) — see `docs/metabox.md`.

## Content partials

`templates/content.php` branches on context rather than being split into two files:

```php
<?php if(is_single()) : ?>

<article id="post-<?php the_ID(); ?>" <?php post_class("tp-postbox-item mb-30"); ?>>
    <?php if(has_post_thumbnail()) : ?>
    <div class="tp-postbox-thumb mb-30"><?php the_post_thumbnail(); ?></div>
    <?php endif; ?>
    <div class="tp-postbox-content p-0">
        <?php get_template_part('templates/blog/blog-cat'); ?>
        <h2 class="tp-postbox-title mb-15"><?php the_title(); ?></h2>
        <?php get_template_part('templates/blog/blog-meta'); ?>
        <div class="tp-post-box-details-content mb-40"><?php the_content(); ?></div>

        <?php if(has_tag()) : ?>
        <div class="tp-tag-social">
           <!-- tags left, share right -->
           <?php kindaid_post_tags(); ?>
           <?php kindaid_blog_share(); ?>
        </div>
        <?php endif; ?>
    </div>
</article>

<?php else: ?>

<article id="post-<?php the_ID(); ?>" <?php post_class("tp-postbox-item mb-30"); ?>>
    <?php if(has_post_thumbnail()) : ?>
    <div class="tp-postbox-thumb">
        <?php the_post_thumbnail(); ?>
        <?php get_template_part('templates/blog/blog-cat'); ?>
    </div>
    <?php endif; ?>
    <div class="tp-postbox-content pt-30">
        <?php get_template_part('templates/blog/blog-meta'); ?>
        <h2 class="tp-postbox-title mb-15"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p><?php the_excerpt(); ?></p>
        <?php get_template_part('templates/blog/blog-btn'); ?>
    </div>
</article>

<?php endif; ?>
```

Differences between the two branches:

| | `is_single()` | list view |
|---|---|---|
| Title | plain `the_title()` | wrapped in `the_permalink()` link |
| Body | `the_content()` | `the_excerpt()` |
| Category badge | above the title, in content | overlaid on the thumbnail |
| Extra | tags + share row | read-more button |

Mandatory bits in both:

- `id="post-<?php the_ID(); ?>"` and `post_class()` on the `<article>` — required by Theme Check and
  by core/plugin CSS.
- `has_post_thumbnail()` guard around the image.

### Micro-partials — `templates/blog/`

| File | Content | Gated by |
|---|---|---|
| `blog-cat.php` | category badge | `blog_cat_switch` |
| `blog-meta.php` | author / date / comment count | `blog_meta_author_switch`, `blog_meta_date_switch`, `blog_meta_comment_switch` |
| `blog-btn.php` | read-more button | `blog_btn_text` |

They exist so the same meta row can be reused by `content.php`, `content-video.php`,
`content-quote.php`, search results and any future card layout. **When porting a new template, extract
anything that appears in more than one card design into `templates/blog/`.**

## Breadcrumb

`include/breadcrumb.php`, hooked to `header_before` at priority 11 (right after the header):

```php
function kindaid_breadcrumb(){
   global $post;

   if ( is_front_page() && is_home() )      { $title = __('Blog','kindaid'); }
   elseif ( is_front_page() )               { $title = __('Blog','kindaid'); }
   elseif ( is_home() )                     { if ( get_option('page_for_posts') ) { $title = get_the_title(get_option('page_for_posts')); } }
   elseif ( is_single() && 'post' == get_post_type() )    { $title = get_the_title(); }
   elseif ( is_single() && 'product' == get_post_type() ) { $title = get_theme_mod('breadcrumb_product_details', __('Shop','kindaid')); }
   elseif ( is_search() )                   { $title = esc_html__('Search Results for : ','kindaid') . get_search_query(); }
   elseif ( is_404() )                      { $title = esc_html__('404 Page not Found','kindaid'); }
   elseif ( is_archive() )                  { $title = get_the_archive_title(); }
   else                                     { $title = get_the_title(); }

   $breadcrumb_page_switch = function_exists('tpmeta_field') ? tpmeta_field('breadcrumb_page_switch') : 'on';
   $breadcrumb_global      = get_theme_mod('breadcrumb_switch', true);
   $breadcrumb_on_off      = $breadcrumb_global && ($breadcrumb_page_switch == 'on');

   if($breadcrumb_on_off) : ?>
      <!-- breadcrumb markup -->
   <?php endif;
}
add_action('header_before','kindaid_breadcrumb',11);
```

Add a branch for every new custom post type. The global Customizer switch is a master kill-switch
(AND, not override) — see `docs/metabox.md`.

## Helper functions used by templates

All in `include/theme-helper.php`:

| Function | Used by |
|---|---|
| `kindaid_blog_pagination()` | index, archive, search |
| `kindaid_post_tags()` | `content.php` (single branch) |
| `kindaid_blog_share()` | `content.php` (single branch) |
| `kindaid_kses()` | anywhere user text may contain markup |
| `kindaid_sidebar_search()` | filter on `get_search_form` |
| `kindaid_archive_count_span()` / `kindaid_cat_count_span()` | filters that move the post count inside the link, for widget styling |

### Pagination

```php
function kindaid_blog_pagination(){
    $pages = paginate_links( array(
        'type'      => 'array',
        'prev_text' => __('<i class="far fa-arrow-left"></i>','kindaid'),
        'next_text' => __('<i class="far fa-arrow-right"></i>','kindaid'),
    ) );
    if( $pages ) {
        echo '<ul>';
        foreach ( $pages as $page ) { echo "<li>$page</li>"; }
        echo '</ul>';
    }
}
```

`'type' => 'array'` so the theme supplies its own `<ul><li>` wrapper instead of core's
`<div class="nav-links">`. Keep this approach whenever the design's pagination markup differs from
core's.

### Search form

Core's search form is replaced wholesale via filter rather than by overriding `searchform.php`:

```php
function kindaid_sidebar_search( $form ) {
	$form = '<div class="tp-widget-search mb-20">
      <form action="' . home_url( '/' ) . '" method="get">
         <input name="s" type="text" value="' . get_search_query() . '"
                placeholder="' . esc_attr__( 'Search for:','kindaid' ) . '">
         <button type="submit"><svg …></svg></button>
      </form>
   </div>';
	return $form;
}
add_filter( 'get_search_form', 'kindaid_sidebar_search' );
```

This way the core Search widget, WooCommerce and any plugin calling `get_search_form()` all get the
themed markup.
