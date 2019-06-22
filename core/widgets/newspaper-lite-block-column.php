<?php
/**
 * Newspaper Lite: Block Posts (Column)
 *
 * Widget show block posts as column
 *
 * @package themecentury
 * @subpackage Newspaper Lite
 * @since 1.0.0
 */

add_action( 'widgets_init', 'newspaper_lite_register_block_column_widget' );

function newspaper_lite_register_block_column_widget() {
	register_widget( 'Newspaper_Lite_Block_Column' );
}

class Newspaper_Lite_Block_Column extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'newspaper_lite_block_column',
			'description' => esc_html__( 'Display block posts as Column layout.', 'newspaper-lite' )
		);
		parent::__construct( 'newspaper_lite_block_column', esc_html__( 'Column Block Posts', 'newspaper-lite' ), $widget_ops );
	}

	/**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	private function widget_fields() {

		$newspaper_lite_category_dropdown = newspaper_lite_category_dropdown();

		$fields = array(

			'newspaper_lite_block_title' => array(
				'newspaper_lite_widgets_name'       => 'newspaper_lite_block_title',
				'newspaper_lite_widgets_title'      => esc_html__( 'Block Title', 'newspaper-lite' ),
				'newspaper_lite_widgets_field_type' => 'text'
			),

			'newspaper_lite_block_cat_id' => array(
				'newspaper_lite_widgets_name'          => 'newspaper_lite_block_cat_id',
				'newspaper_lite_widgets_title'         => esc_html__( 'Category for Block Post', 'newspaper-lite' ),
				'newspaper_lite_widgets_default'       => 0,
				'newspaper_lite_widgets_field_type'    => 'select',
				'newspaper_lite_widgets_field_options' => $newspaper_lite_category_dropdown
			),

			'newspaper_lite_block_posts_count' => array(
				'newspaper_lite_widgets_name'       => 'newspaper_lite_block_posts_count',
				'newspaper_lite_widgets_title'      => esc_html__( 'No. of Posts', 'newspaper-lite' ),
				'newspaper_lite_widgets_default'    => 4,
				'newspaper_lite_widgets_field_type' => 'number'
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

		$newspaper_lite_block_title       = empty( $instance['newspaper_lite_block_title'] ) ? '' : $instance['newspaper_lite_block_title'];
		$newspaper_lite_block_cat_id      = intval( empty( $instance['newspaper_lite_block_cat_id'] ) ? '' : $instance['newspaper_lite_block_cat_id'] );
		$newspaper_lite_block_posts_count = intval( empty( $instance['newspaper_lite_block_posts_count'] ) ? 4 : $instance['newspaper_lite_block_posts_count'] );
		echo $before_widget;
		?>
		<div class="block-column-wrapper">
		<?php if($newspaper_lite_block_title): ?>
		<?php newspaper_lite_block_title( $newspaper_lite_block_title, $newspaper_lite_block_cat_id ); ?>
		<?php endif; ?>

		<div class="block-posts-wrapper column-posts-block">
			<?php
			$block_column_args  = newspaper_lite_query_args( $newspaper_lite_block_cat_id, $newspaper_lite_block_posts_count );
			$block_column_query = new WP_Query( $block_column_args );
			$post_count         = 0;
			if ( $block_column_query->have_posts() ) {
				while ( $block_column_query->have_posts() ) {
					$block_column_query->the_post();
					$post_count ++;
					$post_id = get_the_ID();
					if ( $post_count == 1 ) {
						$post_class = 'primary-post';
						$image_path = get_the_post_thumbnail( $post_id, 'newspaper-lite-block-medium' );
					} else {
						$post_class = 'secondary-post';
						$image_path = get_the_post_thumbnail( $post_id, 'newspaper-lite-block-thumb' );
					}
					?>
					<div class="single-post-wrapper <?php echo esc_attr( $post_class ); ?> clearfix">
						<div class="post-thumb-wrapper">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<figure><?php echo $image_path; ?></figure>
							</a>
						</div><!-- .post-thumb-wrapper -->
						<div class="post-content-wrapper">
							<?php if ( $post_count == 1 ) {
								do_action( 'newspaper_lite_post_categories' );
							} ?>
							<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="post-meta-wrapper">
								<?php newspaper_lite_posted_on(); ?>
								<?php newspaper_lite_post_comment(); ?>
							</div>
							<?php if ( $post_count == 1 ) {
								the_excerpt();
							} ?>
						</div><!-- .post-meta-wrapper -->
					</div><!-- .single-post-wrapper -->
					<?php
				}
			}
			wp_reset_postdata();
			?>
		</div>
		</div><!-- .block-column-wrapper -->
		<?php
		echo $after_widget;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see     WP_Widget::update()
	 *
	 * @param   array $new_instance Values just sent to be saved.
	 * @param   array $old_instance Previously saved values from database.
	 *
	 * @uses    newspaper_lite_widgets_updated_field_value()     defined in newspaper-lite-widget-fields.php
	 *
	 * @return  array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$widget_fields = $this->widget_fields();

		// Loop through fields
		foreach ( $widget_fields as $widget_field ) {

			extract( $widget_field );

			// Use helper function to get updated field values
			$instance[ $newspaper_lite_widgets_name ] = newspaper_lite_widgets_updated_field_value( $widget_field, $new_instance[ $newspaper_lite_widgets_name ] );
		}

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see     WP_Widget::form()
	 *
	 * @param   array $instance Previously saved values from database.
	 *
	 * @uses    newspaper_lite_widgets_show_widget_field()       defined in widget-fields.php
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
