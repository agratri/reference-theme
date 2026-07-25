<?php 

 $post_format_gallery = function_exists('tpmeta_gallery_field') ? tpmeta_gallery_field('kindaid-post-format-gallery') : '';

if(is_single()) : ?> 

<article id="post-<?php the_ID(); ?>" <?php post_class("tp-postbox-item mb-30"); ?>>

    <?php if(!empty($post_format_gallery)) : ?>
    <div class="tp-postbox-thumb mb-30">
        <div class="swiper-container tp-postbox-gallery-active">
            <div class="swiper-wrapper">
                <?php foreach($post_format_gallery as $item) : ?>
                <div class="swiper-slide">
                    <div class="tp-postbox-thumb-overlay">
                        <img src="<?php  echo esc_url($item['url']); ?>" alt="">
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>
        <div class="tp-blog-gallery-arrow">
            <button class="tp-gallery-arrow-prev tp-gallery-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none">
                <path d="M7 13L1 7L7 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <button class="tp-gallery-arrow-next tp-gallery-arrow ml-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none">
                <path d="M1 13L7 7L1 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
    </div>
    <?php endif; ?>

    <div class="tp-postbox-content p-0">

        <?php get_template_part('templates/blog/blog-cat'); ?>

        <h2 class="tp-postbox-title mb-15"><?php the_title(); ?></h2>

        <?php get_template_part('templates/blog/blog-meta'); ?>

        <div class="tp-post-box-details-content mb-40">
            <?php the_content(); ?>
        </div>


        <?php if(has_tag()) : ?>
        <div class="tp-tag-social">  
            <div class="tp-blog-tag-social">
                <div class="row">
                    <div class="col-xl-8">
                        <?php kindaid_post_tags(); ?>
                    </div>
                    <div class="col-xl-4">
                        <div class="tp-blog-social text-xl-end mn-20">
                            <?php kindaid_blog_share(); ?>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</article> 

<?php else: ?>

<article id="post-<?php the_ID(); ?>" <?php post_class("tp-postbox-item mb-30"); ?>>

    <?php if(!empty($post_format_gallery)) : ?>
    <div class="tp-postbox-thumb">
        <div class="swiper-container tp-postbox-gallery-active">
            <div class="swiper-wrapper">
                <?php foreach($post_format_gallery as $item) : ?>
                <div class="swiper-slide">
                    <div class="tp-postbox-thumb-overlay">
                        <img src="<?php  echo esc_url($item['url']); ?>" alt="">
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>
        <div class="tp-blog-gallery-arrow">
            <button class="tp-gallery-arrow-prev tp-gallery-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none">
                <path d="M7 13L1 7L7 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <button class="tp-gallery-arrow-next tp-gallery-arrow ml-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none">
                <path d="M1 13L7 7L1 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>

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
<?php endif;