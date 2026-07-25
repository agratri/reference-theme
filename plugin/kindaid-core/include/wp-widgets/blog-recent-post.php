<?php
class Kindaid_Blog_Recent_Post extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'kindaid_blog_recent_post',
            __('Kindaid Blog Post With Thumb', 'kindaid'),
            array('description' => __('Display recent blog posts with thumbnails', 'kindaid'))
        );

    }


    // FRONT-END DISPLAY
    public function widget($args, $instance) {
        echo $args['before_widget'];

        $title = !empty($instance['title']) ? apply_filters('widget_title', $instance['title']) : '';
        $order = !empty($instance['order']) ? $instance['order'] : 'DESC';
        $posts_per_page = !empty($instance['posts_per_page']) ? $instance['posts_per_page'] : 3;

        // Display title
        if (!empty($title)) {
            echo $args['before_title'] . esc_html($title) . $args['after_title'];
        }

        // Query Args
        $query = new WP_Query(array(
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => $posts_per_page,
            'order'          => $order,
            'orderby'        => 'date',
        ));
        ?>

        <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
            <div class="tp-widget-post-list mb-15">
                <div class="tp-widget-post-thumb">
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                </div>
                <div class="tp-widget-post-content">
                    <span><i class="far fa-clock"></i> <?php echo get_the_date(); ?></span>
                    <h4 class="tp-widget-post-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                </div>
            </div>
        <?php endwhile; wp_reset_postdata(); ?>
        <?php else : ?>
            <p>No posts found</p>
        <?php endif; ?>

        <?php
        echo $args['after_widget'];
    }

    // BACK-END FORM
    public function form($instance) {

        $title = !empty($instance['title']) ? esc_attr($instance['title']) : '';
        $order = !empty($instance['order']) ? esc_attr($instance['order']) : 'DESC';
        $posts_per_page = !empty($instance['posts_per_page']) ? esc_attr($instance['posts_per_page']) : 3;
        ?>

        <!-- Widget Title -->
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
            <input class="widefat"
                   id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>"
                   type="text"
                   value="<?php echo $title; ?>">
        </p>

        <!-- Order Select -->
        <p>
            <label for="<?php echo $this->get_field_id('order'); ?>">Order:</label>
            <select class="widefat"
                    id="<?php echo $this->get_field_id('order'); ?>"
                    name="<?php echo $this->get_field_name('order'); ?>">
                <option value="DESC" <?php selected($order, 'DESC'); ?>>Descending (Latest First)</option>
                <option value="ASC" <?php selected($order, 'ASC'); ?>>Ascending (Oldest First)</option>
            </select>
        </p>

        <!-- Posts Per Page -->
        <p>
            <label for="<?php echo $this->get_field_id('posts_per_page'); ?>">Posts Per Page:</label>
            <input class="widefat"
                   id="<?php echo $this->get_field_id('posts_per_page'); ?>"
                   name="<?php echo $this->get_field_name('posts_per_page'); ?>"
                   type="number"
                   value="<?php echo $posts_per_page; ?>">
        </p>

        <?php
    }

    // SAVE WIDGET FIELDS
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['order'] = sanitize_text_field($new_instance['order']);
        $instance['posts_per_page'] = absint($new_instance['posts_per_page']);

        return $instance;
    }
}

// REGISTER WIDGET
function kindaid_register_recent_blog_post_widget() {
    register_widget('Kindaid_Blog_Recent_Post');
}
add_action('widgets_init', 'kindaid_register_recent_blog_post_widget');
