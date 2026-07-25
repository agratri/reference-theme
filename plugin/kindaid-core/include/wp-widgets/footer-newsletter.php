<?php
class Kindaid_Footer_Newsletter extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'kindaid_newsletter',
            __('Kindaid Footer Newsletter', 'kindaid'),
            array('description' => __('Display footer logo, newsletter, and social links', 'kindaid'))
        );

    }


    // FRONT-END DISPLAY
    public function widget($args, $instance) {
        echo $args['before_widget'];

        $logo = !empty($instance['logo']) ? esc_url($instance['logo']) : '';
        $info = !empty($instance['info']) ? wp_kses_post($instance['info']) : '';
        $newsletter_shortcode = !empty($instance['newsletter_shortcode']) ? wp_kses_post($instance['newsletter_shortcode']) : '';
        $social1 = !empty($instance['social1']) ? esc_url($instance['social1']) : '';
        $social2 = !empty($instance['social2']) ? esc_url($instance['social2']) : '';
        $social3 = !empty($instance['social3']) ? esc_url($instance['social3']) : '';
        $social4 = !empty($instance['social4']) ? esc_url($instance['social4']) : '';
        $linkedin_url = !empty($instance['linkedin_url']) ? esc_url($instance['linkedin_url']) : '';
        ?>


        <?php if (!empty($logo)): ?>
        <div class="tp-footer-logo mb-25">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <img data-width="108" src="<?php echo esc_url($logo); ?>" alt="">
            </a>
        </div>
        <?php endif; ?>

        <?php if (!empty($info)): ?>
            <p class="tp-footer-dec mb-15"><?php echo $info; // already sanitised with wp_kses_post() above ?></p>
        <?php endif; ?>

        <?php if (!empty($newsletter_shortcode)): ?>
        <div class="tp-footer-subscribe p-relative mb-30">
            <?php echo do_shortcode($newsletter_shortcode); ?>
        </div>
        <?php endif; ?>


        <div class="tp-footer-social">
            <?php if (!empty($social1)): ?>
            <a href="<?php echo esc_url($social1); ?>"><i class="fab fa-facebook-f"></i></a>
            <?php endif; ?>
            <?php if (!empty($social2)): ?>
            <a href="<?php echo esc_url($social2); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 16 14" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.28884 0.714844H0.666992L6.14691 7.9153L1.01754 13.9556H3.38746L7.26697 9.38713L10.7118 13.9136H15.3337L9.69453 6.50391L9.70451 6.51669L14.5599 0.798959H12.19L8.58427 5.04503L5.28884 0.714844ZM3.21817 1.97588H4.65702L12.7825 12.6525H11.3436L3.21817 1.97588Z" fill="currentColor"/>
                </svg>
            </a>
            <?php endif; ?>
            <?php if (!empty($social3)): ?>
            <a href="<?php echo esc_url($social3); ?>"><i class="fas fa-globe"></i></a>
            <?php endif; ?>
            <?php if (!empty($social4)): ?>
            <a href="<?php echo esc_url($social4); ?>"><i class="fab fa-instagram"></i></a>
            <?php endif; ?>

            <?php if (!empty($linkedin_url)): ?>
            <a href="<?php echo esc_url($linkedin_url); ?>"><i class="fab fa-linkedin"></i></a>
            <?php endif; ?>
            
        </div>

        <?php
        echo $args['after_widget'];
    }

    // BACK-END FORM
    public function form($instance) {
        $logo = !empty($instance['logo']) ? esc_url($instance['logo']) : '';
        $info = !empty($instance['info']) ? esc_textarea($instance['info']) : '';
        $newsletter_shortcode = !empty($instance['newsletter_shortcode']) ? esc_textarea($instance['newsletter_shortcode']) : '';
        $social1 = !empty($instance['social1']) ? esc_url($instance['social1']) : '';
        $social2 = !empty($instance['social2']) ? esc_url($instance['social2']) : '';
        $social3 = !empty($instance['social3']) ? esc_url($instance['social3']) : '';
        $social4 = !empty($instance['social4']) ? esc_url($instance['social4']) : '';
        $linkedin_url = !empty($instance['linkedin_url']) ? esc_url($instance['linkedin_url']) : '';
        ?>

        <!-- Logo Upload -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('logo')); ?>">Logo Upload:</label><br>
            <input type="text" class="widefat kindaid-upload-field" id="<?php echo esc_attr($this->get_field_id('logo')); ?>" name="<?php echo esc_attr($this->get_field_name('logo')); ?>" value="<?php echo esc_attr($logo); ?>">
            <button type="button" class="button select-media-button">Upload</button>
        </p>

        <!-- Footer Info -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('info')); ?>">Footer Info:</label>
            <textarea class="widefat" rows="4" id="<?php echo esc_attr($this->get_field_id('info')); ?>" name="<?php echo esc_attr($this->get_field_name('info')); ?>"><?php echo esc_textarea($info); ?></textarea>
        </p>

        <!-- Footer Newsletter -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('newsletter_shortcode')); ?>">Footer Newsletter Shortcode:</label>

            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('newsletter_shortcode')); ?>" name="<?php echo esc_attr($this->get_field_name('newsletter_shortcode')); ?>" value="<?php echo esc_attr($newsletter_shortcode); ?>">
        </p>

        <!-- Social URLs -->
        <p><label>Facebook URL:</label><input class="widefat" name="<?php echo esc_attr($this->get_field_name('social1')); ?>" type="url" value="<?php echo esc_attr($social1); ?>"></p>
        <p><label>Twitter/X URL:</label><input class="widefat" name="<?php echo esc_attr($this->get_field_name('social2')); ?>" type="url" value="<?php echo esc_attr($social2); ?>"></p>
        <p><label>Website URL:</label><input class="widefat" name="<?php echo esc_attr($this->get_field_name('social3')); ?>" type="url" value="<?php echo esc_attr($social3); ?>"></p>

        <p><label>Instagram URL:</label><input class="widefat" name="<?php echo esc_attr($this->get_field_name('social4')); ?>" type="url" value="<?php echo esc_attr($social4); ?>"></p>

        <p><label>Linkedin URL:</label><input class="widefat" name="<?php echo esc_attr($this->get_field_name('linkedin_url')); ?>" type="url" value="<?php echo esc_attr($linkedin_url); ?>"></p>

        <?php
    }

    // SAVE
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['logo'] = (!empty($new_instance['logo'])) ? esc_url_raw($new_instance['logo']) : '';
        $instance['info'] = (!empty($new_instance['info'])) ? wp_kses_post($new_instance['info']) : '';
        $instance['newsletter_shortcode'] = (!empty($new_instance['newsletter_shortcode'])) ? wp_kses_post($new_instance['newsletter_shortcode']) : '';
        $instance['social1'] = esc_url_raw($new_instance['social1']);
        $instance['social2'] = esc_url_raw($new_instance['social2']);
        $instance['social3'] = esc_url_raw($new_instance['social3']);
        $instance['social4'] = esc_url_raw($new_instance['social4']);
        $instance['linkedin_url'] = esc_url_raw($new_instance['linkedin_url']);
        return $instance;
    }
}

// REGISTER WIDGET
function kindaid_register_footer_newsletter_widget() {
    register_widget('Kindaid_Footer_Newsletter');
}
add_action('widgets_init', 'kindaid_register_footer_newsletter_widget');
