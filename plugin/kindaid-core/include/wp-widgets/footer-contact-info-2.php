<?php
class Kindaid_Footer_Contact_Info_Widget_2 extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'kindaid_footer_contact_info_2',
            __('Kindaid Footer Contact Info 02', 'kindaid'),
            array('description' => __('Display footer contact image, url, and info links', 'kindaid'))
        );

    }


    // FRONT-END DISPLAY
    public function widget($args, $instance) {
        echo $args['before_widget'];

        $title = !empty($instance['title']) ? apply_filters('widget_title', $instance['title']) : '';
        $address = !empty($instance['address']) ? wp_kses_post($instance['address']) : '';
        $address_url = !empty($instance['address_url']) ? esc_url($instance['address_url']) : '';
        $phone = !empty($instance['phone']) ? esc_textarea($instance['phone']) : '';
        $mail = !empty($instance['mail']) ? esc_textarea($instance['mail']) : '';

        // Display title
        if (!empty($title)) {
            echo $args['before_title'] . esc_html($title) . $args['after_title'];
        }

        ?>

        <div class="tp-footer-3-cta">
            <?php if(!empty($address)) : ?>
            <h3 class="tp-footer-cta-title mb-30"><a class="common-underline" href="<?php echo esc_url($address_url); ?>" target="_blank"><?php echo kindaid_kses($address); ?></a></h3>
            <?php endif; ?>    

            <?php if(!empty($phone)) : ?>    
            <a class="tp-footer-cta-link mb-5" href="tel:<?php echo esc_attr($phone); ?>">
                <span>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.6837 8.95768C14.3253 8.95768 14.042 8.66602 14.042 8.31602C14.042 8.00768 13.7337 7.36602 13.217 6.80768C12.7087 6.26602 12.1503 5.94935 11.6837 5.94935C11.3253 5.94935 11.042 5.65768 11.042 5.30768C11.042 4.95768 11.3337 4.66602 11.6837 4.66602C12.517 4.66602 13.392 5.11602 14.1587 5.92435C14.8753 6.68268 15.3337 7.62435 15.3337 8.30768C15.3337 8.66602 15.042 8.95768 14.6837 8.95768Z" fill="#FFCA24" />
                        <path d="M17.6915 8.95964C17.3331 8.95964 17.0498 8.66797 17.0498 8.31797C17.0498 5.35964 14.6415 2.95964 11.6915 2.95964C11.3331 2.95964 11.0498 2.66797 11.0498 2.31797C11.0498 1.96797 11.3331 1.66797 11.6831 1.66797C15.3498 1.66797 18.3331 4.6513 18.3331 8.31797C18.3331 8.66797 18.0415 8.95964 17.6915 8.95964Z" fill="#FFCA24" />
                        <path d="M9.82532 11.843L7.10033 14.568C6.80032 14.3013 6.50866 14.0263 6.22532 13.743C5.36699 12.8763 4.59199 11.968 3.90033 11.018C3.21699 10.068 2.66699 9.11797 2.26699 8.1763C1.86699 7.2263 1.66699 6.31797 1.66699 5.4513C1.66699 4.88464 1.76699 4.34297 1.96699 3.84297C2.16699 3.33464 2.48366 2.86797 2.92533 2.4513C3.45866 1.9263 4.04199 1.66797 4.65866 1.66797C4.89199 1.66797 5.12532 1.71797 5.33366 1.81797C5.55032 1.91797 5.74199 2.06797 5.89199 2.28464L7.82533 5.00964C7.97532 5.21797 8.08366 5.40964 8.15866 5.59297C8.23366 5.76797 8.27532 5.94297 8.27532 6.1013C8.27532 6.3013 8.21699 6.5013 8.10032 6.69297C7.99199 6.88463 7.83366 7.08464 7.63366 7.28464L7.00032 7.94297C6.90866 8.03464 6.86699 8.14297 6.86699 8.2763C6.86699 8.34297 6.87533 8.4013 6.89199 8.46797C6.91699 8.53464 6.94199 8.58463 6.95866 8.63463C7.10866 8.90964 7.36699 9.26797 7.73366 9.7013C8.10866 10.1346 8.50866 10.5763 8.94199 11.018C9.24199 11.3096 9.53366 11.593 9.82532 11.843Z" fill="#FFCA24" />
                        <path d="M18.3083 15.2752C18.3083 15.5085 18.2667 15.7502 18.1833 15.9835C18.1583 16.0502 18.1333 16.1169 18.1 16.1835C17.9583 16.4835 17.775 16.7669 17.5333 17.0335C17.125 17.4835 16.675 17.8085 16.1667 18.0169C16.1583 18.0169 16.15 18.0252 16.1417 18.0252C15.65 18.2252 15.1167 18.3335 14.5417 18.3335C13.6917 18.3335 12.7833 18.1335 11.825 17.7252C10.8667 17.3169 9.90833 16.7669 8.95833 16.0752C8.63333 15.8335 8.30833 15.5919 8 15.3335L10.725 12.6085C10.9583 12.7835 11.1667 12.9169 11.3417 13.0085C11.3833 13.0252 11.4333 13.0502 11.4917 13.0752C11.5583 13.1002 11.625 13.1085 11.7 13.1085C11.8417 13.1085 11.95 13.0585 12.0417 12.9669L12.675 12.3419C12.8833 12.1335 13.0833 11.9752 13.275 11.8752C13.4667 11.7585 13.6583 11.7002 13.8667 11.7002C14.025 11.7002 14.1917 11.7335 14.375 11.8085C14.5583 11.8835 14.75 11.9919 14.9583 12.1335L17.7167 14.0919C17.9333 14.2419 18.0833 14.4169 18.175 14.6252C18.2583 14.8335 18.3083 15.0419 18.3083 15.2752Z" fill="#FFCA24" />
                    </svg>
                </span>
                <?php echo esc_html($phone); ?>
            </a>
            <?php endif; ?>    

            <?php if(!empty($mail)) : ?>
            <a class="tp-footer-cta-link" href="mailto:<?php echo esc_attr($mail); ?>">
                <span>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.167 17.0837H5.83366C3.33366 17.0837 1.66699 15.8337 1.66699 12.917V7.08366C1.66699 4.16699 3.33366 2.91699 5.83366 2.91699H14.167C16.667 2.91699 18.3337 4.16699 18.3337 7.08366V12.917C18.3337 15.8337 16.667 17.0837 14.167 17.0837Z" fill="#FFCA24" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.6547 7.10997C14.8701 7.37968 14.8261 7.77295 14.5564 7.98837L11.9473 10.0723C10.8611 10.937 9.12991 10.937 8.04375 10.0723L8.04221 10.0711L5.44221 7.98776C5.17284 7.77192 5.12945 7.37858 5.34529 7.10921C5.56113 6.83984 5.95448 6.79644 6.22385 7.01229L8.82302 9.09496C9.45354 9.59627 10.5381 9.59615 11.1685 9.09462C11.1684 9.0947 11.1686 9.09455 11.1685 9.09462L13.7763 7.01168C14.046 6.79626 14.4393 6.84026 14.6547 7.10997Z" fill="#620035" />
                    </svg>
                </span>
                <?php echo esc_html($mail); ?>
            </a>
            <?php endif; ?>    


        </div>

        <?php
        echo $args['after_widget'];
    }

    // BACK-END FORM
    public function form($instance) {
        $title = !empty($instance['title']) ? esc_attr($instance['title']) : '';
        $address = !empty($instance['address']) ? esc_textarea($instance['address']) : '';
        $address_url = !empty($instance['address_url']) ? esc_url($instance['address_url']) : '';
        $phone = !empty($instance['phone']) ? esc_textarea($instance['phone']) : '';
        $mail = !empty($instance['mail']) ? esc_textarea($instance['mail']) : '';
        ?>

        <!-- Widget Title -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title:</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" 
                   type="text" value="<?php echo esc_attr($title); ?>">
        </p>

        <!-- Footer Address -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('address')); ?>">Footer address:</label>
            <textarea class="widefat" rows="4" id="<?php echo esc_attr($this->get_field_id('address')); ?>" name="<?php echo esc_attr($this->get_field_name('address')); ?>"><?php echo kindaid_kses($address); ?></textarea>
        </p>

        <!-- Social URLs -->
        <p><label>Address URL:</label><input class="widefat" name="<?php echo esc_attr($this->get_field_name('address_url')); ?>" type="url" value="<?php echo esc_attr($address_url); ?>"></p>

        <p><label>Phone Number:</label><input class="widefat" name="<?php echo esc_attr($this->get_field_name('phone')); ?>" type="text" value="<?php echo esc_attr($phone); ?>"></p>

        <p><label>Mail:</label><input class="widefat" name="<?php echo esc_attr($this->get_field_name('mail')); ?>" type="text" value="<?php echo esc_attr($mail); ?>"></p>

        <?php
    }


    // SAVE
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['address'] = (!empty($new_instance['address'])) ? $new_instance['address'] : '';
        $instance['address_url'] = esc_url_raw($new_instance['address_url']);
        $instance['phone'] = $new_instance['phone'];
        $instance['mail'] = $new_instance['mail'];
        return $instance;
    }
}

// REGISTER WIDGET
function kindaid_register_footer_contact_info_widget_2() {
    register_widget('Kindaid_Footer_Contact_Info_Widget_2');
}
add_action('widgets_init', 'kindaid_register_footer_contact_info_widget_2');
