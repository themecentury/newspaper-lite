<?php
/**
 * Newspaper Lite: Block Posts (Grid)
 *
 * Widget show block posts in grid layout
 *
 * @package themecentury
 * @subpackage Newspaper Lite
 * @since 1.0.0
 */

add_action( 'widgets_init', 'newspaper_lite_register_block_grid_widget' );

function newspaper_lite_register_block_grid_widget() {
	register_widget( 'Newspaper_Lite_Block_Grid' );
}

class Newspaper_Lite_Block_Grid extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'newspaper_lite_block_grid',
			'description' => esc_html__( 'Display block posts in grid layout.', 'newspaper-lite' )
		);
		parent::__construct( 'newspaper_lite_block_grid', esc_html__( 'Grid Block Posts', 'newspaper-lite' ), $widget_ops );
	}

	/**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	private function widget_fields() {

		global $newspaper_lite_grid_columns;
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

			'newspaper_lite_block_grid_column' => array(
				'newspaper_lite_widgets_name'          => 'newspaper_lite_block_grid_column',
				'newspaper_lite_widgets_title'         => esc_html__( 'No. of Columns', 'newspaper-lite' ),
				'newspaper_lite_widgets_default'       => 2,
				'newspaper_lite_widgets_field_type'    => 'select',
				'newspaper_lite_widgets_field_options' => $newspaper_lite_grid_columns
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
		$newspaper_lite_block_grid_column = intval( empty( $instance['newspaper_lite_block_grid_column'] ) ? 2 : $instance['newspaper_lite_block_grid_column'] );
		$newspaper_lite_block_posts_count = intval( empty( $instance['newspaper_lite_block_posts_count'] ) ? 4 : $instance['newspaper_lite_block_posts_count'] );
		echo $before_widget;
		?>
		<div class="block-grid-wrapper clearfix column-<?php echo esc_attr( $newspaper_lite_block_grid_column ); ?>-layout">

			<?php newspaper_lite_block_title( $newspaper_lite_block_title, $newspaper_lite_block_cat_id ); ?>

			<div class="block-posts-wrapper">
				<?php
				$block_grid_args  = newspaper_lite_query_args( $newspaper_lite_block_cat_id, $newspaper_lite_block_posts_count );
				$block_grid_query = new WP_Query( $block_grid_args );
				if ( $block_grid_query->have_posts() ) {
					while ( $block_grid_query->have_posts() ) {
						$block_grid_query->the_post();
						?>
						<div class="single-post-wrapper">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<figure><?php the_post_thumbnail( 'newspaper-lite-block-medium' ); ?></figure>
							</a>
							<div class="post-content-wrapper">

								<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
								<div class="post-meta-wrapper">
									<?php newspaper_lite_posted_on(); ?>
								</div>
								<?php do_action( 'newspaper_lite_post_categories' ); ?>
							</div><!-- .post-meta-wrapper -->
						</div><!-- .single-post-wrapper -->
						<?php
					}
				}
				wp_reset_postdata();
				?>
			</div><!-- .block-posts-wrapper -->
		</div><!-- .block-grid-wrapper -->

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
	 * @uses    newspaper_lite_widgets_show_widget_field()       defined in newspaper-lite-widget-fields.php
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
