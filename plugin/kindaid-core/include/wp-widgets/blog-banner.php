<?php
class Kindaid_Blog_Banner extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'kindaid_blog_banner',
            __('Kindaid Blog Banner', 'kindaid'),
            array('description' => __('Display footer contact image, url, and info links', 'kindaid'))
        );

    }


    // FRONT-END DISPLAY
    public function widget($args, $instance) {
        echo $args['before_widget'];

        $bg_img = !empty($instance['bg_img']) ? esc_url($instance['bg_img']) : '';
        $title = !empty($instance['title']) ? apply_filters('widget_title', $instance['title']) : '';
        $sub_title = !empty($instance['sub_title']) ? wp_kses_post($instance['sub_title']) : '';
        $banner_title = !empty($instance['banner_title']) ? wp_kses_post($instance['banner_title']) : '';
        $banner_button = !empty($instance['banner_button']) ? esc_textarea($instance['banner_button']) : '';
        $banner_button_url = !empty($instance['banner_button_url']) ? esc_url($instance['banner_button_url']) : '';

        // Display title
        if (!empty($title)) {
            echo $args['before_title'] . esc_html($title) . $args['after_title'];
        }

        ?>

        <div class="tp-widget-support tp-widget-ad-overly position-relative z-1">
            <div class="tp-widget-ad-bg">
                <img src="<?php echo esc_url($bg_img); ?>" alt="">
            </div>
            <div class="tp-widget-sidebar">
                <?php if(!empty($sub_title)) : ?>
                <span class="tp-section-subtitle mb-15 d-inline-block" data-color="#ffcf4e"><?php echo esc_html($sub_title); ?></span>
                <?php endif; ?>
                <?php if(!empty($banner_title)) : ?>
                <h2 class="tp-widget-support-title"><?php echo wp_kses_post($banner_title); ?></h2>
                <?php endif; ?>
            </div>
            <?php if(!empty($banner_button)) : ?>
            <a class="tp-btn tp-btn-secondary-white text-capitalize tp-btn-animetion w-100 justify-content-center" href="<?php echo esc_html($banner_button_url); ?>">
                <span class="btn-icon">
                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.15195 0.500138C6.71895 0.517281 7.26794 0.6157 7.79984 0.79554H7.85294C7.88894 0.812539 7.91594 0.831328 7.93394 0.848328C8.13283 0.911853 8.32093 0.983431 8.50093 1.08185L8.84293 1.23395C8.97793 1.30553 9.13992 1.43884 9.22992 1.49342C9.31992 1.54621 9.41892 1.60079 9.49992 1.66253C10.4998 0.902906 11.7139 0.491334 12.9649 0.500138C13.5328 0.500138 14.0998 0.579912 14.6389 0.759751C17.9607 1.83342 19.1577 5.45704 18.1578 8.62436C17.5908 10.2429 16.6638 11.7201 15.4498 12.9271C13.7119 14.6002 11.8048 16.0854 9.75192 17.3649L9.52692 17.5L9.29292 17.3559C7.23284 16.0854 5.31496 14.6002 3.56088 12.9181C2.3549 11.7111 1.42701 10.2429 0.851011 8.62436C-0.165978 5.45704 1.03101 1.83342 4.38887 0.740961C4.64987 0.651489 4.91897 0.588859 5.18897 0.553965H5.29696C5.54986 0.517281 5.80096 0.500138 6.05296 0.500138H6.15195ZM14.1709 3.3276C13.8019 3.20145 13.3969 3.39918 13.2619 3.77496C13.1359 4.15075 13.3339 4.56232 13.7119 4.69563C14.2888 4.91037 14.6749 5.47494 14.6749 6.10035V6.12808C14.6578 6.33297 14.7199 6.53071 14.8459 6.68281C14.9719 6.83491 15.1609 6.92349 15.3589 6.94228C15.7279 6.93244 16.0428 6.63807 16.0698 6.2614V6.15492C16.0968 4.90142 15.3328 3.76602 14.1709 3.3276Z" fill="currentColor" />
                    </svg>
                </span>
                <span class="btn-text"><?php echo esc_html($banner_button); ?></span>
            </a>
            <?php endif; ?>
        </div>

        <?php
        echo $args['after_widget'];
    }

    // BACK-END FORM
    public function form($instance) {
        $bg_img = !empty($instance['bg_img']) ? esc_url($instance['bg_img']) : '';
        $title = !empty($instance['title']) ? esc_attr($instance['title']) : '';

        $sub_title = !empty($instance['sub_title']) ? wp_kses_post($instance['sub_title']) : '';
        $banner_title = !empty($instance['banner_title']) ? wp_kses_post($instance['banner_title']) : '';
        $banner_button = !empty($instance['banner_button']) ? esc_textarea($instance['banner_button']) : '';
        $banner_button_url = !empty($instance['banner_button_url']) ? esc_url($instance['banner_button_url']) : '';
        ?>

        <!-- Widget Title -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title:</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" 
                   type="text" value="<?php echo esc_attr($title); ?>">
        </p>

        <!-- Image Upload -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('bg_img')); ?>">Image Upload:</label><br>
            <input type="text" class="widefat kindaid-upload-field" id="<?php echo esc_attr($this->get_field_id('bg_img')); ?>" name="<?php echo esc_attr($this->get_field_name('bg_img')); ?>" value="<?php echo esc_attr($bg_img); ?>">
            <button type="button" class="button select-media-button">Upload</button>
        </p>

        <!-- Banner Sub Title -->
        <p><label>Banner Sub Title:</label><input class="widefat" name="<?php echo esc_attr($this->get_field_name('sub_title')); ?>" type="text" value="<?php echo esc_attr($sub_title); ?>"></p>

        <p><label>Banner Title:</label><input class="widefat" name="<?php echo esc_attr($this->get_field_name('banner_title')); ?>" type="text" value="<?php echo esc_attr($banner_title); ?>"></p>

        <p><label>Banner Button:</label><input class="widefat" name="<?php echo esc_attr($this->get_field_name('banner_button')); ?>" type="text" value="<?php echo esc_attr($banner_button); ?>"></p>

        <p><label>Banner Button URL:</label><input class="widefat" name="<?php echo esc_attr($this->get_field_name('banner_button_url')); ?>" type="text" value="<?php echo esc_attr($banner_button_url); ?>"></p>

        <?php
    }


    // SAVE
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['bg_img'] = (!empty($new_instance['bg_img'])) ? esc_url_raw($new_instance['bg_img']) : '';
        $instance['title'] = sanitize_text_field($new_instance['title']);

        $instance['sub_title'] = (!empty($new_instance['sub_title'])) ? $new_instance['sub_title'] : '';
        $instance['banner_title'] = $new_instance['banner_title'];
        $instance['banner_button'] = $new_instance['banner_button'];
        $instance['banner_button_url'] = $new_instance['banner_button_url'];
        return $instance;
    }
}

// REGISTER WIDGET
function kindaid_register_blog_banner_widget() {
    register_widget('Kindaid_Blog_Banner');
}
add_action('widgets_init', 'kindaid_register_blog_banner_widget');