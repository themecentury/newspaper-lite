<?php
/**
 * Newspaper Lite: Homepage Carousel Widget
 *
 * Newspaper Lite Carousel section
 *
 * @package themecentury
 * @subpackage Newspaper Lite
 * @since 1.0.0
 */

add_action( 'widgets_init', 'newspaper_lite_register_post_carousel_widget' );

function newspaper_lite_register_post_carousel_widget() {
	register_widget( 'Newspaper_Lite_Post_Carousel' );
}

class Newspaper_Lite_Post_Carousel extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'newspaper_lite_post_carousel clearfix',
			'description' => esc_html__( 'Display carousel with posts.', 'newspaper-lite' )
		);
		parent::__construct( 'newspaper_lite_post_carousel', esc_html__( 'Carousel Posts', 'newspaper-lite' ), $widget_ops );
	}

	/**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	private function widget_fields() {

		$newspaper_lite_category_dropdown = newspaper_lite_category_dropdown();

		$fields = array(
			'newspaper_lite_carousel_title'    => array(
				'newspaper_lite_widgets_name'       => 'newspaper_lite_carousel_title',
				'newspaper_lite_widgets_title'      => esc_html__( 'Title', 'newspaper-lite' ),
				'newspaper_lite_widgets_field_type' => 'text'
			),
			'newspaper_lite_carousel_category' => array(
				'newspaper_lite_widgets_name'          => 'newspaper_lite_carousel_category',
				'newspaper_lite_widgets_title'         => esc_html__( 'Category for Slider', 'newspaper-lite' ),
				'newspaper_lite_widgets_default'       => 0,
				'newspaper_lite_widgets_field_type'    => 'select',
				'newspaper_lite_widgets_field_options' => $newspaper_lite_category_dropdown
			),

			'newspaper_lite_carousel_count'          => array(
				'newspaper_lite_widgets_name'       => 'newspaper_lite_carousel_count',
				'newspaper_lite_widgets_title'      => esc_html__( 'No. of slides', 'newspaper-lite' ),
				'newspaper_lite_widgets_default'    => 5,
				'newspaper_lite_widgets_field_type' => 'number'
			),
			'newspaper_lite_carousel_autoplay_speed' => array(
				'newspaper_lite_widgets_name'       => 'newspaper_lite_carousel_autoplay_speed',
				'newspaper_lite_widgets_title'      => esc_html__( 'Carousel Autoplay Speed ( in microsecond )', 'newspaper-lite' ),
				'newspaper_lite_widgets_default'    => 2200,
				'newspaper_lite_widgets_field_type' => 'number'
			),

			'newspaper_lite_carousel_category_random' => array(
				'newspaper_lite_widgets_name'       => 'newspaper_lite_carousel_category_random',
				'newspaper_lite_widgets_title'      => esc_html__( 'Show Random', 'newspaper-lite' ),
				'newspaper_lite_widgets_default'    => 1,
				'newspaper_lite_widgets_field_type' => 'checkbox',
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
	public function widget( $args, $instance ) {
		extract( $args );
		if ( empty( $instance ) ) {
			return;
		}

		$newspaper_lite_carousel_category_id     = intval( empty( $instance['newspaper_lite_carousel_category'] ) ? null : $instance['newspaper_lite_carousel_category'] );
		$newspaper_lite_carousel_count           = intval( empty( $instance['newspaper_lite_carousel_count'] ) ? 5 : $instance['newspaper_lite_carousel_count'] );
		$newspaper_lite_carousel_category_random = intval( empty( $instance['newspaper_lite_carousel_category_random'] ) ? null : $instance['newspaper_lite_carousel_category_random'] );
		$newspaper_lite_carousel_autoplay_speed  = intval( empty( $instance['newspaper_lite_carousel_autoplay_speed'] ) ? 2200 : $instance['newspaper_lite_carousel_autoplay_speed'] );
		$newspaper_lite_carousel_title           = empty( $instance['newspaper_lite_carousel_title'] ) ? '' : $instance['newspaper_lite_carousel_title'];

		echo $before_widget;

		$slider_args = newspaper_lite_query_args( $newspaper_lite_carousel_category_id, $newspaper_lite_carousel_count );

		if ( 1 === $newspaper_lite_carousel_category_random ) {
			$slider_args['orderby'] = 'rand';
		}
		$carousel_query = new WP_Query( $slider_args );
		if ( $carousel_query->have_posts() ) {

			wp_enqueue_style( 'owl-carousel2-style' );
			wp_enqueue_style( 'owl-carousel2-theme' );
			wp_enqueue_script( 'owl-carousel2-script' );

			?>
			<div class="widget-block-wrapper">
				<?php
				if ( ! empty( $newspaper_lite_carousel_title ) ) {
					newspaper_lite_block_title( $newspaper_lite_carousel_title, '' );
				}
				?>
				<div class="owl-carousel owl-theme newspaper-lite-carousel"
				     data-timer="<?php echo esc_attr( $newspaper_lite_carousel_autoplay_speed ); ?>">

					<?php


					while ( $carousel_query->have_posts() ) {
						$carousel_query->the_post();
						?>
						<div class="item">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<figure
									class="carousel-image-wrap"><?php the_post_thumbnail( 'newspaper-lite-carousel-image' ); ?></figure>
							</a>
							<div class="carousel-content-wrapper">
								<?php do_action( 'newspaper_lite_post_categories' ); ?>

								<h3 class="carousel-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>

							</div>
						</div>
						<?php
					}
					wp_reset_postdata();
					?>


				</div>
				<div style="clear:both"></div>
			</div>
		<?php } ?>
		<div style="clear:both"></div>


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
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$widget_fields = $this->widget_fields();

		// Loop through fields
		foreach ( $widget_fields as $widget_field ) {

			extract( $widget_field );

			$new_widget_val = isset($new_instance[ $newspaper_lite_widgets_name ]) ? $new_instance[ $newspaper_lite_widgets_name ] : '';
			// Use helper function to get updated field values
			$instance[ $newspaper_lite_widgets_name ] = newspaper_lite_widgets_updated_field_value( $widget_field, $new_widget_val );
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
	public function form( $instance ) {
		$widget_fields = $this->widget_fields();

		// Loop through fields
		foreach ( $widget_fields as $widget_field ) {

			// Make array elements available as variables
			extract( $widget_field );
			$newspaper_lite_widgets_field_value = ! empty( $instance[ $newspaper_lite_widgets_name ] ) ? wp_kses_post( $instance[ $newspaper_lite_widgets_name ] ) : '';
			newspaper_lite_widgets_show_widget_field( $this, $widget_field, $newspaper_lite_widgets_field_value );
		}
	}

}
