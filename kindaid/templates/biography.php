<?php

    $author_description = get_the_author_meta( 'description', get_query_var( 'author' ) );
    $display_name = get_the_author_meta( 'display_name');
    $kindaid_facebook = get_the_author_meta( 'kindaid_facebook');
    $kindaid_linkedin = get_the_author_meta( 'kindaid_linkedin');
    $kindaid_instagram = get_the_author_meta( 'kindaid_instagram');
    $kindaid_youtube = get_the_author_meta( 'kindaid_youtube');

?>


<div class="tp-postbox-biography mt-40 mb-95">
    <div class="d-flex align-items-start">
        <div class="tp-postbox-biography-img">
            <?php print get_avatar( get_the_author_meta( 'user_email' ), '100', '', '', [ 'class' => 'media-object img-circle' ] );?>  
        </div>
        <div class="tp-postbox-biography-content">
            <span><?php echo esc_html__('About Author','kindaid'); ?></span>

            <h4 class="tp-postbox-biography-name"><?php echo esc_html($display_name); ?></h4>

            <p>
                <?php echo esc_html($author_description); ?>
            </p>

            <div class="tp-postbox-biography-social">
                <?php if(!empty($kindaid_facebook)): ?>
                <a href="<?php echo esc_url($kindaid_facebook); ?>">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
                <?php endif; ?>
                <?php if(!empty($kindaid_instagram)): ?>
                <a href="<?php echo esc_url($kindaid_instagram); ?>">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <?php endif; ?>
                <?php if(!empty($kindaid_linkedin)): ?>
                <a href="<?php echo esc_url($kindaid_linkedin); ?>">
                <i class="fa-brands fa-linkedin-in"></i>
                </a>
                <?php endif; ?>
                <?php if(!empty($kindaid_youtube)): ?>
                <a href="<?php echo esc_url($kindaid_youtube); ?>">
                <i class="fa-brands fa-youtube"></i>
                </a>
                <?php endif; ?>   
            </div>
        </div>
    </div>
</div>