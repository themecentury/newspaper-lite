<?php
/**
 * Newspaper Lite: Block Layout
 *
 * Widget shows the posts in style 1
 *
 * @package themecentury
 * @subpackage Newspaper Lite
 * @since 1.0.0
 */

add_action( 'widgets_init', 'newspaper_lite_register_block_layout_widget' );

function newspaper_lite_register_block_layout_widget() {
	register_widget( 'Newspaper_Lite_Block_Layout' );
}

class Newspaper_Lite_Block_Layout extends WP_widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'newspaper_lite_block_layout',
			'description' => esc_html__( 'Display posts in block layout', 'newspaper-lite' )
		);
		parent::__construct( 'newspaper_lite_block_layout', esc_html__( 'Block Layout', 'newspaper-lite' ), $widget_ops );
	}

	/**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	private function widget_fields() {
		$newspaper_lite_category_dropdown           = newspaper_lite_category_dropdown();
		$newspaper_lite_tags_dropdown               = newspaper_lite_tags_dropdown();
		$newspaper_lite_category_dropdown_parameter = newspaper_lite_category_dropdown_parameter();
		$newspaper_lite_tag_dropdown_parameter      = newspaper_lite_tags_dropdown_parameter();


		$fields = array(

			'newspaper_lite_block_title' => array(
				'newspaper_lite_widgets_name'       => 'newspaper_lite_block_title',
				'newspaper_lite_widgets_title'      => esc_html__( 'Block Title', 'newspaper-lite' ),
				'newspaper_lite_widgets_field_type' => 'text'
			),

			'newspaper_lite_block_cat_id'             => array(
				'newspaper_lite_widgets_name'           => 'newspaper_lite_block_cat_id',
				'newspaper_lite_widgets_title'          => esc_html__( 'Category for Block Layout', 'newspaper-lite' ),
				'newspaper_lite_widgets_default'        => 0,
				'newspaper_lite_widgets_field_type'     => 'select',
				'newspaper_lite_widgets_field_options'  => $newspaper_lite_category_dropdown,
				'newspaper_lite_widgets_field_multiple' => true,

			),
			'newspaper_lite_block_category_parameter' => array(
				'newspaper_lite_widgets_name'          => 'newspaper_lite_block_category_parameter',
				'newspaper_lite_widgets_title'         => esc_html__( 'Category Parameters for Block Layout', 'newspaper-lite' ),
				'newspaper_lite_widgets_default'       => 1,
				'newspaper_lite_widgets_field_type'    => 'select',
				'newspaper_lite_widgets_field_options' => $newspaper_lite_category_dropdown_parameter,
			),
			'newspaper_lite_block_tags'               => array(
				'newspaper_lite_widgets_name'           => 'newspaper_lite_block_tags',
				'newspaper_lite_widgets_title'          => esc_html__( 'Tags for Block Layout', 'newspaper-lite' ),
				'newspaper_lite_widgets_default'        => 0,
				'newspaper_lite_widgets_field_type'     => 'select',
				'newspaper_lite_widgets_field_options'  => $newspaper_lite_tags_dropdown,
				'newspaper_lite_widgets_field_multiple' => true,

			),
			'newspaper_lite_block_tags_parameter'     => array(
				'newspaper_lite_widgets_name'          => 'newspaper_lite_block_tags_parameter',
				'newspaper_lite_widgets_title'         => esc_html__( 'Tags Parameters for Block Layout', 'newspaper-lite' ),
				'newspaper_lite_widgets_default'       => 1,
				'newspaper_lite_widgets_field_type'    => 'select',
				'newspaper_lite_widgets_field_options' => $newspaper_lite_tag_dropdown_parameter,
			),

			'newspaper_lite_block_posts_count' => array(
				'newspaper_lite_widgets_name'       => 'newspaper_lite_block_posts_count',
				'newspaper_lite_widgets_title'      => esc_html__( 'No. of Posts', 'newspaper-lite' ),
				'newspaper_lite_widgets_default'    => 5,
				'newspaper_lite_widgets_field_type' => 'number'
			),
			'newspaper_lite_block_layout'      => array(
				'newspaper_lite_widgets_name'          => 'newspaper_lite_block_layout',
				'newspaper_lite_widgets_title'         => __( 'Layout Style', 'newspaper-lite' ),
				'newspaper_lite_widgets_default'       => 'layout1',
				'newspaper_lite_widgets_field_type'    => 'selector',
				'newspaper_lite_widgets_field_options' => array(
					'layout1' => esc_url( get_template_directory_uri() . '/assets/images/block-layout1.png' ),
					'layout2' => esc_url( get_template_directory_uri() . '/assets/images/block-layout2.png' ),
					'layout3' => esc_url( get_template_directory_uri() . '/assets/images/block-layout3.png' ),
					'layout4' => esc_url( get_template_directory_uri() . '/assets/images/alternate-block.png' )
				)
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
		$newspaper_lite_block_title              = empty( $instance['newspaper_lite_block_title'] ) ? '' : $instance['newspaper_lite_block_title'];
		$newspaper_lite_block_posts_count        = intval( empty( $instance['newspaper_lite_block_posts_count'] ) ? 5 : $instance['newspaper_lite_block_posts_count'] );
		$newspaper_lite_block_cat_id             = isset( $instance['newspaper_lite_block_cat_id'] ) ? is_array( $instance['newspaper_lite_block_cat_id'] ) ? array_map( 'absint', wp_unslash( $instance['newspaper_lite_block_cat_id'] ) ) : absint( $instance['newspaper_lite_block_cat_id'] ) : 0;
		$newspaper_lite_block_category_parameter = intval( ! isset( $instance['newspaper_lite_block_category_parameter'] ) ? 1 : $instance['newspaper_lite_block_category_parameter'] );
		$newspaper_lite_block_tags               = isset( $instance['newspaper_lite_block_tags'] ) ? is_array( $instance['newspaper_lite_block_tags'] ) ? array_map( 'absint', wp_unslash( $instance['newspaper_lite_block_tags'] ) ) : absint( $instance['newspaper_lite_block_tags'] ) : 0;
		$newspaper_lite_block_tags_parameter     = intval( ! isset( $instance['newspaper_lite_block_tags_parameter'] ) ? 1 : $instance['newspaper_lite_block_tags_parameter'] );
		$newspaper_lite_block_layout             = empty( $instance['newspaper_lite_block_layout'] ) ? 'layout1' : esc_html( $instance['newspaper_lite_block_layout'] );

		echo $before_widget;
		?>
		<div class="block-layout-wrapper">
			<?php
			$newspaper_lite_block_cat_id_for_title = is_array( $newspaper_lite_block_cat_id ) ? count( $newspaper_lite_block_cat_id ) === 1 ? $newspaper_lite_block_cat_id[0] : null : $newspaper_lite_block_cat_id;
			if ( $newspaper_lite_block_category_parameter === 3 ) {
				$newspaper_lite_block_cat_id_for_title = null;
			}
			newspaper_lite_block_title( $newspaper_lite_block_title, $newspaper_lite_block_cat_id_for_title ); ?>
			<?php
			switch ( $newspaper_lite_block_layout ) {
				case 'layout2':
					$this->newspaper_lite_block_layout_2( $newspaper_lite_block_layout, $newspaper_lite_block_cat_id, $newspaper_lite_block_posts_count, $newspaper_lite_block_category_parameter, $newspaper_lite_block_tags, $newspaper_lite_block_tags_parameter );
					break;

				case 'layout3':
					$this->newspaper_lite_block_layout_3( $newspaper_lite_block_layout, $newspaper_lite_block_cat_id, $newspaper_lite_block_posts_count, $newspaper_lite_block_category_parameter, $newspaper_lite_block_tags, $newspaper_lite_block_tags_parameter );
					break;

				case 'layout4':
					$this->newspaper_lite_block_layout_4( $newspaper_lite_block_layout, $newspaper_lite_block_cat_id, $newspaper_lite_block_posts_count, $newspaper_lite_block_category_parameter, $newspaper_lite_block_tags, $newspaper_lite_block_tags_parameter );
					break;

				default:
					$this->newspaper_lite_block_layout_default( $newspaper_lite_block_layout, $newspaper_lite_block_cat_id, $newspaper_lite_block_posts_count, $newspaper_lite_block_category_parameter, $newspaper_lite_block_tags, $newspaper_lite_block_tags_parameter );
					break;
			}
			?>


		</div><!-- .block-layout-wrapper-->
		<?php
		echo $after_widget;
	}

	public function newspaper_lite_block_layout_2( $newspaper_lite_block_layout, $newspaper_lite_block_cat_id, $newspaper_lite_block_posts_count, $newspaper_lite_block_category_parameter, $newspaper_lite_block_tags, $newspaper_lite_block_tags_parameter ) {
		?>
		<div class="block-posts-wrapper clearfix mgs-column-wrapper <?php echo esc_attr( $newspaper_lite_block_layout ); ?>">
			<?php
			$block_layout_args  = newspaper_lite_query_args( $newspaper_lite_block_cat_id, $newspaper_lite_block_posts_count, $newspaper_lite_block_category_parameter, $newspaper_lite_block_tags, $newspaper_lite_block_tags_parameter );
			$block_layout_query = new WP_Query( $block_layout_args );
			$post_count         = 0;
			$total_posts_count  = $block_layout_query->post_count;
			$total_post_left    = $total_posts_count > 0 ? ceil( $total_posts_count / 2 ) : 0;
			$total_post_right   = $total_posts_count - $total_post_left;
			if ( $block_layout_query->have_posts() ) {
				while ( $block_layout_query->have_posts() ) {

					$block_layout_query->the_post();
					$post_count ++;
					$post_id = get_the_ID();
					if ( $post_count == 1 ) {
						$post_class = 'primary-post';
						$image_path = get_the_post_thumbnail( $post_id, 'newspaper-lite-block-medium' );
						echo '<div class="left-column-wrapper block-posts-block list-posts-block mgs-column-2">';
					} elseif ( $post_count <= $total_post_left ) {
						$post_class = 'secondary-post';
						$image_path = get_the_post_thumbnail( $post_id, 'newspaper-lite-block-thumb' );
					} elseif ( $post_count == ( $total_post_left + 1 ) ) {
						$post_class = 'primary-post';
						$image_path = get_the_post_thumbnail( $post_id, 'newspaper-lite-block-medium' );
						echo '<div class="right-column-wrapper block-posts-block list-posts-block mgs-column-2">';
					} else {
						$image_path = get_the_post_thumbnail( $post_id, 'newspaper-lite-block-thumb' );
						$post_class = 'secondary-post';
					}
					?>
					<div class="single-post-wrapper clearfix <?php echo esc_attr( $post_class ); ?>">
						<div class="post-thumb-wrapper">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<figure><?php echo $image_path; ?></figure>
							</a>
						</div><!-- .post-thumb-wrapper -->
						<div class="post-content-wrapper">
							<?php if ( $post_count == ( $total_post_left + 1 ) || $post_count == 1 ) {
								do_action( 'newspaper_lite_post_categories' );
							} ?>
							<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<div class="post-meta-wrapper">
								<?php newspaper_lite_posted_on(); ?>
								<?php newspaper_lite_post_comment(); ?>
							</div>
							<?php if ( $post_count == ( $total_post_left + 1 ) || $post_count == 1 ) {
								the_excerpt();
							} ?>
						</div><!-- .post-meta-wrapper -->
					</div><!-- .single-post-wrapper -->
					<?php
					if ( $post_count == $total_post_left || $post_count == $total_posts_count ) {
						echo '</div>';
					}
				}
			}
			?>
		</div><!-- .block-posts-wrapper -->
		<?php
	}

	public function newspaper_lite_block_layout_default( $newspaper_lite_block_layout, $newspaper_lite_block_cat_id, $newspaper_lite_block_posts_count, $newspaper_lite_block_category_parameter, $newspaper_lite_block_tags, $newspaper_lite_block_tags_parameter ) {
		?>
		<div class="block-posts-wrapper clearfix mgs-column-wrapper <?php echo esc_attr( $newspaper_lite_block_layout ); ?>">
			<?php
			$block_layout_args  = newspaper_lite_query_args( $newspaper_lite_block_cat_id, $newspaper_lite_block_posts_count, $newspaper_lite_block_category_parameter, $newspaper_lite_block_tags, $newspaper_lite_block_tags_parameter );
			$block_layout_query = new WP_Query( $block_layout_args );
			$post_count         = 0;
			$total_posts_count  = $block_layout_query->post_count;
			if ( $block_layout_query->have_posts() ) {
				while ( $block_layout_query->have_posts() ) {
					$block_layout_query->the_post();
					$post_count ++;
					$post_id = get_the_ID();
					if ( $post_count == 1 ) {
						$post_class = 'primary-post';
						$image_path = get_the_post_thumbnail( $post_id, 'newspaper-lite-block-medium' );
						echo '<div class="left-column-wrapper block-posts-block grid-posts-block mgs-column-2">';
					} elseif ( $post_count == 2 ) {
						$post_class = 'secondary-post';
						$image_path = get_the_post_thumbnail( $post_id, 'newspaper-lite-block-thumb' );
						echo '<div class="right-column-wrapper block-posts-block list-posts-block mgs-column-2">';
					} else {
						$image_path = get_the_post_thumbnail( $post_id, 'newspaper-lite-block-thumb' );
						$post_class = 'secondary-post';
					}
					?>
					<div class="single-post-wrapper clearfix <?php echo esc_attr( $post_class ); ?>">
						<div class="post-thumb-wrapper">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<figure><?php echo $image_path; ?></figure>
							</a>
						</div><!-- .post-thumb-wrapper -->
						<div class="post-content-wrapper">
							<?php if ( $post_count == 1 ) {
								do_action( 'newspaper_lite_post_categories' );
							} ?>
							<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
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
					if ( $post_count == 1 || $post_count == $total_posts_count ) {
						echo '</div>';
					}
				}
			}
			?>
		</div><!-- .block-posts-wrapper -->
		<?php
	}

	public function newspaper_lite_block_layout_3( $newspaper_lite_block_layout, $newspaper_lite_block_cat_id, $newspaper_lite_block_posts_count, $newspaper_lite_block_category_parameter, $newspaper_lite_block_tags, $newspaper_lite_block_tags_parameter ) {
		?>
		<div class="block-posts-wrapper clearfix mgs-column-wrapper <?php echo esc_attr( $newspaper_lite_block_layout ); ?>">
			<?php
			$block_layout_args  = newspaper_lite_query_args( $newspaper_lite_block_cat_id, $newspaper_lite_block_posts_count, $newspaper_lite_block_category_parameter, $newspaper_lite_block_tags, $newspaper_lite_block_tags_parameter );
			$block_layout_query = new WP_Query( $block_layout_args );
			$post_count         = 0;
			$total_posts_count  = $block_layout_query->post_count;
			if ( $block_layout_query->have_posts() ) {
				while ( $block_layout_query->have_posts() ) {
					$block_layout_query->the_post();
					$post_count ++;
					$post_id = get_the_ID();
					if ( $post_count == 1 ) {
						$post_class = 'primary-post';
						$image_path = get_the_post_thumbnail( $post_id, 'newspaper-lite-slider-large' );
						echo '<div class="top-column-wrapper block-posts-block grid-posts-block mgs-column-1">';
					} elseif ( $post_count % 3 == 2 ) {
						$post_class = 'secondary-post';
						$image_path = get_the_post_thumbnail( $post_id, 'newspaper-lite-block-thumb' );
						echo '<div class="bottom-column-wrapper block-posts-block list-posts-block mgs-column-1">';
					} else {
						$image_path = get_the_post_thumbnail( $post_id, 'newspaper-lite-block-thumb' );
						$post_class = 'secondary-post';
					}
					?>
					<div class="single-post-wrapper clearfix <?php echo esc_attr( $post_class ); ?>">
						<div class="post-thumb-wrapper">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<figure><?php echo $image_path; ?></figure>
							</a>
						</div><!-- .post-thumb-wrapper -->
						<div class="post-content-wrapper">
							<?php if ( $post_count == 1 ) {
								do_action( 'newspaper_lite_post_categories' );
							} ?>
							<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
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
					if ( $post_count == 1 || ( $post_count % 3 == 1 && $post_count > 2 ) || $post_count == $total_posts_count ) {
						echo '</div>';
					}
				}
			}
			?>
		</div><!-- .block-posts-wrapper -->
		<?php
	}

	public function newspaper_lite_block_layout_4( $newspaper_lite_block_layout, $newspaper_lite_block_cat_id, $newspaper_lite_block_posts_count, $newspaper_lite_block_category_parameter, $newspaper_lite_block_tags, $newspaper_lite_block_tags_parameter ) {
		?>
		<div class="block-posts-wrapper clearfix mgs-column-wrapper <?php echo esc_attr( $newspaper_lite_block_layout ); ?>">
			<?php
			$block_layout_args  = newspaper_lite_query_args( $newspaper_lite_block_cat_id, $newspaper_lite_block_posts_count, $newspaper_lite_block_category_parameter, $newspaper_lite_block_tags, $newspaper_lite_block_tags_parameter );
			$block_layout_query = new WP_Query( $block_layout_args );
			$post_count         = 0;
			$total_posts_count  = $block_layout_query->post_count;
			if ( $block_layout_query->have_posts() ) {
				while ( $block_layout_query->have_posts() ) {
					$block_layout_query->the_post();
					$post_count ++;
					$post_id = get_the_ID();
					if ( $post_count % 3 == 1 ) {
						$post_class = 'secondary-post';
						$image_path = get_the_post_thumbnail( $post_id, 'newspaper-lite-block-thumb' );
						echo '<div class="bottom-column-wrapper block-posts-block list-posts-block mgs-column-1">';
					} else {
						$image_path = get_the_post_thumbnail( $post_id, 'newspaper-lite-block-thumb' );
						$post_class = 'secondary-post';
					}
					?>

					<div class="single-post-wrapper clearfix <?php echo esc_attr( $post_class ); ?>">
						<?php
 						if ( $post_count % 3 == 1 || wp_is_mobile() ) { ?>
							<div class="post-thumb-wrapper">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<figure><?php echo $image_path; ?></figure>
								</a>
							</div><!-- .post-thumb-wrapper -->
							<div class="post-content-wrapper">
								<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
								<div class="post-meta-wrapper">
									<?php newspaper_lite_posted_on(); ?>
									<?php newspaper_lite_post_comment(); ?>
								</div>
								<?php
								echo newspaper_lite_post_excerpt( get_the_content(), 100 );
								?>
							</div><!-- .post-meta-wrapper -->

						<?php } else if ( $post_count % 3 == 2 ) { ?>
							<div class="post-content-wrapper">
								<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
								<div class="post-meta-wrapper">
									<?php newspaper_lite_posted_on(); ?>
									<?php newspaper_lite_post_comment(); ?>
								</div>
								<?php
								echo newspaper_lite_post_excerpt( get_the_content(), 100 );
								?>
							</div><!-- .post-meta-wrapper -->
							<div class="post-thumb-wrapper">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<figure><?php echo $image_path; ?></figure>
								</a>
							</div><!-- .post-thumb-wrapper -->

						<?php } else { ?>
							<div class="post-thumb-wrapper">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<figure><?php echo $image_path; ?></figure>
								</a>
							</div><!-- .post-thumb-wrapper -->
							<div class="post-content-wrapper">
								<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
								<div class="post-meta-wrapper">
									<?php newspaper_lite_posted_on(); ?>
									<?php newspaper_lite_post_comment(); ?>
								</div>
								<?php
								echo newspaper_lite_post_excerpt( get_the_content(), 100 );
								?>
							</div><!-- .post-meta-wrapper -->
						<?php } ?>


					</div><!-- .single-post-wrapper -->
					<?php
					if ( $post_count % 3 == 0 || $post_count == $total_posts_count ) {
						echo '</div>';
					}
				}
			}
			?>
		</div><!-- .block-posts-wrapper -->
		<?php
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
