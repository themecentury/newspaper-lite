<?php
/**
 * Newspaper Lite: Homepage Featured Slider
 *
 * Homepage slider section with featured section
 *
 * @package themecentury
 * @subpackage Newspaper Lite
 * @since 1.0.0
 */

add_action('widgets_init', 'newspaper_lite_register_featured_slider_widget');

function newspaper_lite_register_featured_slider_widget()
{
    register_widget('Newspaper_Lite_Featured_Slider');
}

class Newspaper_Lite_Featured_Slider extends WP_Widget
{

    /**
     * Register widget with WordPress.
     */
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'newspaper_lite_featured_slider clearfix',
            'description' => esc_html__('Display slider with featured posts.', 'newspaper-lite')
        );
        parent::__construct('newspaper_lite_featured_slider', esc_html__('Featured Slider', 'newspaper-lite'), $widget_ops);
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields()
    {

        $newspaper_lite_category_dropdown = newspaper_lite_category_dropdown();
        $newspaper_lite_tags_dropdown = newspaper_lite_tags_dropdown();
        $newspaper_lite_category_dropdown_parameter = newspaper_lite_category_dropdown_parameter();
        $newspaper_lite_tag_dropdown_parameter = newspaper_lite_tags_dropdown_parameter();
        $newspaper_lite_feature_slider_layout = newspaper_lite_feature_slider_layout();

        $fields = array(

            'newspaper_lite_slider_category' => array(
                'newspaper_lite_widgets_name' => 'newspaper_lite_slider_category',
                'newspaper_lite_widgets_title' => esc_html__('Category for Slider', 'newspaper-lite'),
                'newspaper_lite_widgets_default' => 0,
                'newspaper_lite_widgets_field_type' => 'select',
                'newspaper_lite_widgets_field_options' => $newspaper_lite_category_dropdown,
                'newspaper_lite_widgets_field_multiple' => true,

            ),
            'newspaper_lite_slider_category_parameter' => array(
                'newspaper_lite_widgets_name' => 'newspaper_lite_slider_category_parameter',
                'newspaper_lite_widgets_title' => esc_html__('Category Parameters for Slider Option', 'newspaper-lite'),
                'newspaper_lite_widgets_default' => 1,
                'newspaper_lite_widgets_field_type' => 'select',
                'newspaper_lite_widgets_field_options' => $newspaper_lite_category_dropdown_parameter,
            ),
            'newspaper_lite_slider_tags' => array(
                'newspaper_lite_widgets_name' => 'newspaper_lite_slider_tags',
                'newspaper_lite_widgets_title' => esc_html__('Tags for Slider', 'newspaper-lite'),
                'newspaper_lite_widgets_default' => 0,
                'newspaper_lite_widgets_field_type' => 'select',
                'newspaper_lite_widgets_field_options' => $newspaper_lite_tags_dropdown,
                'newspaper_lite_widgets_field_multiple' => true,

            ),
            'newspaper_lite_slider_tags_parameter' => array(
                'newspaper_lite_widgets_name' => 'newspaper_lite_slider_tags_parameter',
                'newspaper_lite_widgets_title' => esc_html__('Tags Parameters for Slider Option', 'newspaper-lite'),
                'newspaper_lite_widgets_default' => 1,
                'newspaper_lite_widgets_field_type' => 'select',
                'newspaper_lite_widgets_field_options' => $newspaper_lite_tag_dropdown_parameter,
            ),

            'newspaper_lite_slide_count' => array(
                'newspaper_lite_widgets_name' => 'newspaper_lite_slide_count',
                'newspaper_lite_widgets_title' => esc_html__('No. of slides', 'newspaper-lite'),
                'newspaper_lite_widgets_default' => 5,
                'newspaper_lite_widgets_field_type' => 'number'
            ),

            // Feature slider configuration
            'featured_header_section' => array(
                'newspaper_lite_widgets_name' => 'featured_header_section',
                'newspaper_lite_widgets_title' => esc_html__('Featured Posts Section', 'newspaper-lite'),
                'newspaper_lite_widgets_field_type' => 'widget_section_header'
            ),

            'newspaper_lite_featured_category' => array(
                'newspaper_lite_widgets_name' => 'newspaper_lite_featured_category',
                'newspaper_lite_widgets_title' => esc_html__('Category for Featured Posts', 'newspaper-lite'),
                'newspaper_lite_widgets_default' => 0,
                'newspaper_lite_widgets_field_type' => 'select',
                'newspaper_lite_widgets_field_options' => $newspaper_lite_category_dropdown,
                'newspaper_lite_widgets_field_multiple' => true,

            ),
            'newspaper_lite_feature_slider_category_parameter' => array(
                'newspaper_lite_widgets_name' => 'newspaper_lite_feature_slider_category_parameter',
                'newspaper_lite_widgets_title' => esc_html__('Category Parameters for Featured Posts', 'newspaper-lite'),
                'newspaper_lite_widgets_default' => 1,
                'newspaper_lite_widgets_field_type' => 'select',
                'newspaper_lite_widgets_field_options' => $newspaper_lite_category_dropdown_parameter,
            ),
            'newspaper_lite_feature_slider_tags' => array(
                'newspaper_lite_widgets_name' => 'newspaper_lite_feature_slider_tags',
                'newspaper_lite_widgets_title' => esc_html__('Tags for Featured Posts', 'newspaper-lite'),
                'newspaper_lite_widgets_default' => 0,
                'newspaper_lite_widgets_field_type' => 'select',
                'newspaper_lite_widgets_field_options' => $newspaper_lite_tags_dropdown,
                'newspaper_lite_widgets_field_multiple' => true,

            ),
            'newspaper_lite_feature_slider_tags_parameter' => array(
                'newspaper_lite_widgets_name' => 'newspaper_lite_feature_slider_tags_parameter',
                'newspaper_lite_widgets_title' => esc_html__('Tags Parameters for Featured Posts', 'newspaper-lite'),
                'newspaper_lite_widgets_default' => 1,
                'newspaper_lite_widgets_field_type' => 'select',
                'newspaper_lite_widgets_field_options' => $newspaper_lite_tag_dropdown_parameter,
            ),
            'newspaper_lite_slider_layout' => array(
                'newspaper_lite_widgets_name' => 'newspaper_lite_slider_layout',
                'newspaper_lite_widgets_title' => esc_html__('Layout', 'newspaper-lite'),
                'newspaper_lite_widgets_default' => 'left',
                'newspaper_lite_widgets_field_type' => 'select',
                'newspaper_lite_widgets_field_options' => $newspaper_lite_feature_slider_layout
            ),

        );

        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance)
    {
        extract($args);
        if (empty($instance)) {
            return;
        }
        $newspaper_lite_slide_count = intval(empty($instance['newspaper_lite_slide_count']) ? 5 : $instance['newspaper_lite_slide_count']);
        $newspaper_lite_featured_category_id = isset($instance['newspaper_lite_featured_category']) ? is_array($instance['newspaper_lite_featured_category']) ? array_map('absint', wp_unslash($instance['newspaper_lite_featured_category'])) : absint($instance['newspaper_lite_featured_category']) : 0;
        $newspaper_lite_feature_slider_category_parameter = intval(!isset($instance['newspaper_lite_feature_slider_category_parameter']) ? 1 : $instance['newspaper_lite_feature_slider_category_parameter']);
        $newspaper_lite_feature_slider_tag_id = isset($instance['newspaper_lite_feature_slider_tags']) ? is_array($instance['newspaper_lite_feature_slider_tags']) ? array_map('absint', wp_unslash($instance['newspaper_lite_feature_slider_tags'])) : absint($instance['newspaper_lite_feature_slider_tags']) : 0;
        $newspaper_lite_feature_slider_tags_parameter = intval(!isset($instance['newspaper_lite_feature_slider_tags_parameter']) ? 1 : $instance['newspaper_lite_feature_slider_tags_parameter']);

        $newspaper_lite_slider_category_parameter = intval(!isset($instance['newspaper_lite_slider_category_parameter']) ? 1 : $instance['newspaper_lite_slider_category_parameter']);
        $newspaper_lite_slider_category_id = isset($instance['newspaper_lite_slider_category']) ? is_array($instance['newspaper_lite_slider_category']) ? array_map('absint', wp_unslash($instance['newspaper_lite_slider_category'])) : absint($instance['newspaper_lite_slider_category']) : 0;
        $newspaper_lite_slider_tag_id = isset($instance['newspaper_lite_slider_tags']) ? is_array($instance['newspaper_lite_slider_tags']) ? array_map('absint', wp_unslash($instance['newspaper_lite_slider_tags'])) : absint($instance['newspaper_lite_slider_tags']) : 0;
        $newspaper_lite_slider_tag_parameter = intval(!isset($instance['newspaper_lite_slider_tags_parameter']) ? 1 : $instance['newspaper_lite_slider_tags_parameter']);
        $newspaper_lite_slider_layout = isset($instance['newspaper_lite_slider_layout']) ? $instance['newspaper_lite_slider_layout'] : '';
        echo $before_widget;
        ?>
        <div class="mg-feature-slider <?php echo esc_attr($newspaper_lite_slider_layout); ?>">

            <?php if ($newspaper_lite_slider_layout !== 'center') {
                $slider_args = newspaper_lite_query_args($newspaper_lite_slider_category_id, $newspaper_lite_slide_count, $newspaper_lite_slider_category_parameter, $newspaper_lite_slider_tag_id, $newspaper_lite_slider_tag_parameter);
                $slider_args['meta_query'] = array(
                    array(
                        'key' => '_thumbnail_id'
                    )
                );
                $slider_query = new WP_Query($slider_args);
                $slider_class = (absint($slider_query->post_count) > 1) ? 'slider_exist' : 'noslider';

                ?>
                <div class="mgs-featured-slider-wrapper">
                    <div class="mgs-slider-section  <?php echo $slider_class; ?>">
                        <?php

                        if ($slider_query->have_posts()) {
                            echo '<ul class="newspaper-liteSlider">';
                            while ($slider_query->have_posts()) {
                                $slider_query->the_post();
                                ?>
                                <li>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <?php
                                        $thumbnail_size = 'newspaper-lite-slider-large';
                                        if ($newspaper_lite_slider_layout == 'slider_only') {
                                            $thumbnail_size = 'full';
                                        }
                                        ?>
                                        <figure><?php the_post_thumbnail($thumbnail_size); ?></figure>
                                    </a>
                                    <div class="slider-content-wrapper">

                                        <h3 class="slide-title"><a
                                                    href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <div class="post-meta-wrapper">
                                            <?php newspaper_lite_posted_on(); ?>
                                            <?php newspaper_lite_post_comment(); ?>
                                        </div>
                                        <?php do_action('newspaper_lite_post_categories'); ?>
                                    </div><!-- .post-meta-wrapper -->
                                </li>
                                <?php
                            }
                            echo '</ul>';
                        }
                        wp_reset_postdata();
                        ?>
                    </div><!-- .mgs-slider-section -->
                </div><!-- .mgs-featured-slider-wrapper -->

            <?php } ?>
            <?php if ($newspaper_lite_slider_layout !== 'slider_only') { ?>
                <div class="feature-post">
                    <div class="featured-post-wrapper">
                        <?php
                        $number_of_left_posts = 2;
                        $featured_left_args = newspaper_lite_query_args($newspaper_lite_featured_category_id, $number_of_left_posts, $newspaper_lite_feature_slider_category_parameter, $newspaper_lite_feature_slider_tag_id, $newspaper_lite_feature_slider_tags_parameter);
                        $featured_left_args['meta_query'] = array(
                            array(
                                'key' => '_thumbnail_id'
                            )
                        );
                        $featured_left_query = new WP_Query($featured_left_args);
                        if ($featured_left_query->have_posts()) {
                            while ($featured_left_query->have_posts()) {
                                $featured_left_query->the_post();
                                $post_id = get_the_ID();
                                $image_path = get_the_post_thumbnail($post_id, 'newspaper-lite-featured-medium');
                                ?>
                                <div class="single-featured-wrap">
                                    <div class="single-slide">
                                        <div class="mg-post-thumb">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                <figure><?php echo $image_path; ?></figure>
                                            </a>
                                        </div>
                                        <div class="featured-content-wrapper">

                                            <h3 class="featured-title"><a
                                                        href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                            <div class="post-meta-wrapper"> <?php newspaper_lite_posted_on(); ?> </div>
                                            <?php do_action('newspaper_lite_post_categories'); ?>
                                        </div><!-- .post-meta-wrapper -->
                                    </div><!-- .single-featured-wrap -->
                                </div>
                                <?php
                            }
                        }
                        ?>

                        <?php

                        wp_reset_postdata();
                        if ($newspaper_lite_slider_layout === 'center') {
                            $slider_args = newspaper_lite_query_args($newspaper_lite_slider_category_id, $newspaper_lite_slide_count, $newspaper_lite_slider_category_parameter, $newspaper_lite_slider_tag_id, $newspaper_lite_slider_tag_parameter);
                            $slider_args['meta_query'] = array(
                                array(
                                    'key' => '_thumbnail_id'
                                )
                            );
                            $slider_query = new WP_Query($slider_args);
                            $slider_class = (absint($slider_query->post_count) > 1) ? 'slider_exist' : 'noslider';

                            ?>
                            <div class="mgs-featured-slider-wrapper">
                                <div class="mgs-slider-section  <?php echo $slider_class; ?>">
                                    <?php

                                    if ($slider_query->have_posts()) {
                                        echo '<ul class="newspaper-liteSlider">';
                                        while ($slider_query->have_posts()) {
                                            $slider_query->the_post();
                                            ?>
                                            <li>
                                                <a href="<?php the_permalink(); ?>"
                                                   title="<?php the_title_attribute(); ?>">
                                                    <?php
                                                    $thumbnail_size = 'newspaper-lite-slider-large';
                                                    if ($newspaper_lite_slider_layout == 'slider_only') {
                                                        $thumbnail_size = 'full';
                                                    }
                                                    ?>
                                                    <figure><?php the_post_thumbnail($thumbnail_size); ?></figure>
                                                </a>
                                                <div class="slider-content-wrapper">

                                                    <h3 class="slide-title"><a
                                                                href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h3>
                                                    <div class="post-meta-wrapper">
                                                        <?php newspaper_lite_posted_on(); ?>
                                                        <?php newspaper_lite_post_comment(); ?>
                                                    </div>
                                                    <?php do_action('newspaper_lite_post_categories'); ?>
                                                </div><!-- .post-meta-wrapper -->
                                            </li>
                                            <?php
                                        }
                                        echo '</ul>';
                                    }
                                    wp_reset_postdata();
                                    ?>
                                </div><!-- .mgs-slider-section -->
                            </div><!-- .mgs-featured-slider-wrapper -->
                            <?php
                        }
                        wp_reset_postdata();
                        ?>

                        <?php
                        $number_of_right_posts = 2;
                        $right_thumbnail_size = 'newspaper-lite-featured-medium';

                        if ($newspaper_lite_slider_layout === 'left' || empty($newspaper_lite_slider_layout)) {
                            $number_of_right_posts = 2;
                            $right_thumbnail_size = 'newspaper-lite-featured-medium';
                        }

                        $featured_right_args = newspaper_lite_query_args($newspaper_lite_featured_category_id, $number_of_right_posts, $newspaper_lite_feature_slider_category_parameter, $newspaper_lite_feature_slider_tag_id, $newspaper_lite_feature_slider_tags_parameter);
                        $featured_right_args['offset'] = $number_of_left_posts;
                        $featured_right_args['meta_query'] = array(
                            array(
                                'key' => '_thumbnail_id'
                            )
                        );
                        $featured_right_query = new WP_Query($featured_right_args);
                        if ($featured_right_query->have_posts()) {
                            while ($featured_right_query->have_posts()) {
                                $featured_right_query->the_post();
                                $post_id = get_the_ID();
                                $image_path = get_the_post_thumbnail($post_id, $right_thumbnail_size);
                                ?>
                                <div class="single-featured-wrap">
                                    <div class="single-slide">
                                        <div class="mg-post-thumb">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                <figure><?php echo $image_path; ?></figure>
                                            </a>
                                        </div>
                                        <div class="featured-content-wrapper">

                                            <h3 class="featured-title"><a
                                                        href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                            <div class="post-meta-wrapper"> <?php newspaper_lite_posted_on(); ?> </div>
                                            <?php do_action('newspaper_lite_post_categories'); ?>
                                        </div><!-- .post-meta-wrapper -->
                                    </div>
                                </div><!-- .single-featured-wrap -->
                                <?php
                            }
                        }
                        ?>

                    </div>

                </div>
            <?php } ?>

        </div>
        <?php
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see     WP_Widget::update()
     *
     * @param    array $new_instance Values just sent to be saved.
     * @param    array $old_instance Previously saved values from database.
     *
     * @uses    newspaper_lite_widgets_updated_field_value()        defined in newspaper-lite-widget-fields.php
     *
     * @return    array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            extract($widget_field);

            // Use helper function to get updated field values
            $new_widget_value = isset($new_instance[$newspaper_lite_widgets_name]) ? $new_instance[$newspaper_lite_widgets_name] : '';
            $instance[$newspaper_lite_widgets_name] = newspaper_lite_widgets_updated_field_value($widget_field, $new_widget_value );

        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see     WP_Widget::form()
     *
     * @param    array $instance Previously saved values from database.
     *
     * @uses    newspaper_lite_widgets_show_widget_field()        defined in newspaper-lite-widget-fields.php
     */
    public function form($instance)
    {
        $widget_fields = $this->widget_fields();
        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            // Make array elements available as variables
            extract($widget_field);
            $newspaper_lite_widgets_field_value = !empty($instance[$newspaper_lite_widgets_name]) ? wp_kses_post($instance[$newspaper_lite_widgets_name]) : '';
            newspaper_lite_widgets_show_widget_field($this, $widget_field, $newspaper_lite_widgets_field_value);
        }
    }

}
