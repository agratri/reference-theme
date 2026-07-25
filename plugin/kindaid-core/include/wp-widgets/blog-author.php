<?php
class Kindaid_Blog_Author extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'kindaid_blog_author',
            __('Kindaid Blog Author', 'kindaid'),
            array('description' => __('Display footer blog author image, url, and info links', 'kindaid'))
        );

    }


    // FRONT-END DISPLAY
    public function widget($args, $instance) {
        echo $args['before_widget'];

        $bg_img = !empty($instance['bg_img']) ? esc_url($instance['bg_img']) : '';
        $designation = !empty($instance['designation']) ? esc_html($instance['designation']) : '';
        $author_name = !empty($instance['author_name']) ? esc_html($instance['author_name']) : '';
        $social1 = !empty($instance['social1']) ? esc_url($instance['social1']) : '';
        $social2 = !empty($instance['social2']) ? esc_url($instance['social2']) : '';
        $social3 = !empty($instance['social3']) ? esc_url($instance['social3']) : '';
        $social4 = !empty($instance['social4']) ? esc_url($instance['social4']) : '';
        $linkedin_url = !empty($instance['linkedin_url']) ? esc_url($instance['linkedin_url']) : '';
        
        ?>

   <div class="tp-widget-author text-center mb-20">
      <?php if (!empty($bg_img)): ?>  
      <div class="tp-widget-author-thumb mb-35 pt-15">
         <img src="<?php echo esc_url($bg_img); ?>" alt="">
      </div>
      <?php endif; ?>

      <div class="tp-widget-author-content">
        <?php if (!empty($designation)): ?>
         <span class="tp-widget-author-subtitle d-inline-block mb-5"><?php echo esc_html($designation); ?></span>
         <?php endif; ?>
         <?php if (!empty($author_name)): ?>
         <h3 class="tp-widget-author-title mb-15"><?php echo esc_html($author_name); ?></h3>
         <?php endif; ?>
         <div class="tp-footer-social justify-content-center">
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
      </div>
   </div>

        <?php
        echo $args['after_widget'];
    }

    // BACK-END FORM
    public function form($instance) {
        $bg_img = !empty($instance['bg_img']) ? esc_url($instance['bg_img']) : '';
        $designation = !empty($instance['designation']) ? esc_textarea($instance['designation']) : '';
        $author_name = !empty($instance['author_name']) ? esc_textarea($instance['author_name']) : '';
        $social1 = !empty($instance['social1']) ? esc_url($instance['social1']) : '';
        $social2 = !empty($instance['social2']) ? esc_url($instance['social2']) : '';
        $social3 = !empty($instance['social3']) ? esc_url($instance['social3']) : '';
        $social4 = !empty($instance['social4']) ? esc_url($instance['social4']) : '';
        $linkedin_url = !empty($instance['linkedin_url']) ? esc_url($instance['linkedin_url']) : '';
        ?>

        <!-- Image Upload -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('bg_img')); ?>">Image Upload:</label><br>
            <input type="text" class="widefat kindaid-upload-field" id="<?php echo esc_attr($this->get_field_id('bg_img')); ?>" name="<?php echo esc_attr($this->get_field_name('bg_img')); ?>" value="<?php echo esc_attr($bg_img); ?>">
            <button type="button" class="button select-media-button">Upload</button>
        </p>


        <p><label>Designation:</label><input class="widefat" name="<?php echo esc_attr($this->get_field_name('designation')); ?>" type="text" value="<?php echo esc_attr($designation); ?>"></p>

        <p><label>Name:</label><input class="widefat" name="<?php echo esc_attr($this->get_field_name('author_name')); ?>" type="text" value="<?php echo esc_attr($author_name); ?>"></p>


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
        $instance['bg_img'] = (!empty($new_instance['bg_img'])) ? esc_url_raw($new_instance['bg_img']) : '';
        $instance['designation'] = (!empty($new_instance['designation'])) ? wp_kses_post($new_instance['designation']) : '';
        $instance['author_name'] = (!empty($new_instance['author_name'])) ? wp_kses_post($new_instance['author_name']) : '';
        $instance['social1'] = esc_url_raw($new_instance['social1']);
        $instance['social2'] = esc_url_raw($new_instance['social2']);
        $instance['social3'] = esc_url_raw($new_instance['social3']);
        $instance['social4'] = esc_url_raw($new_instance['social4']);
        $instance['linkedin_url'] = esc_url_raw($new_instance['linkedin_url']);
        return $instance;
    }
}

// REGISTER WIDGET
function kindaid_register_blog_author_widget() {
    register_widget('Kindaid_Blog_Author');
}
add_action('widgets_init', 'kindaid_register_blog_author_widget');
