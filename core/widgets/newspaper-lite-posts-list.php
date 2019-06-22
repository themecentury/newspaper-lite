<?php
/**
 * Newspaper Lite: Posts List
 *
 * Widget show latest or random posts in list view
 *
 * @package themecentury
 * @subpackage Newspaper Lite
 * @since 1.0.0
 */

add_action( 'widgets_init', 'newspaper_lite_register_posts_list_widget' );

function newspaper_lite_register_posts_list_widget() {
	register_widget( 'Newspaper_Lite_Posts_List' );
}

class Newspaper_Lite_Posts_List extends WP_widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'newspaper_lite_posts_list',
            'description' => esc_html__( 'Display latest or random posts in list view.', 'newspaper-lite' )
        );
        parent::__construct( 'newspaper_lite_posts_list', esc_html__( 'Posts Lists', 'newspaper-lite' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

    	$newspaper_lite_post_list_option = array(
    					'latest' => esc_html__( 'Latest Posts', 'newspaper-lite' ),
    					'random' => esc_html__( 'Random Posts', 'newspaper-lite' )
    					);

        $fields = array(

            'newspaper_lite_block_title' => array(
                'newspaper_lite_widgets_name'         => 'newspaper_lite_block_title',
                'newspaper_lite_widgets_title'        => esc_html__( 'Widget Title', 'newspaper-lite' ),
                'newspaper_lite_widgets_field_type'   => 'text'
            ),

            'newspaper_lite_block_posts_count' => array(
                'newspaper_lite_widgets_name'         => 'newspaper_lite_block_posts_count',
                'newspaper_lite_widgets_title'        => esc_html__( 'No. of Posts', 'newspaper-lite' ),
                'newspaper_lite_widgets_default'      => 4,
                'newspaper_lite_widgets_field_type'   => 'number'
            ),

            'newspaper_lite_block_posts_type' => array(
                'newspaper_lite_widgets_name'         => 'newspaper_lite_block_posts_type',
                'newspaper_lite_widgets_title'        => esc_html__( 'Posts Type', 'newspaper-lite' ),
                'newspaper_lite_widgets_default'		 => 'latest',
                'newspaper_lite_widgets_field_options'=> $newspaper_lite_post_list_option,
                'newspaper_lite_widgets_field_type'   => 'radio'
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
        if( empty( $instance ) ) {
            return ;
        }

        $newspaper_lite_block_title      	= empty( $instance['newspaper_lite_block_title'] ) ? '' : $instance['newspaper_lite_block_title'];
        $newspaper_lite_block_posts_count    = intval( empty( $instance['newspaper_lite_block_posts_count'] ) ? 4 : $instance['newspaper_lite_block_posts_count'] );
        $newspaper_lite_block_posts_type     = empty( $instance['newspaper_lite_block_posts_type'] ) ? '' : $instance['newspaper_lite_block_posts_type'];
        echo $before_widget;
?>
			<div class="widget-block-wrapper">
                <?php if($newspaper_lite_block_title): ?>
				<div class="block-header">
	                <h3 class="block-title"><?php echo esc_html( $newspaper_lite_block_title ); ?></h3>
	            </div><!-- .block-header -->
                <?php endif; ?>
	            <div class="posts-list-wrapper list-posts-block">
	            	<?php
	            		$posts_list_args = newspaper_lite_query_args( $cat_id = null, $newspaper_lite_block_posts_count );
	            		if( $newspaper_lite_block_posts_type == 'random' ) {
	            			$posts_list_args['orderby'] = 'rand';
	            		}
	            		$posts_list_query = new WP_Query( $posts_list_args );
	            		if( $posts_list_query->have_posts() ) {
	            			while( $posts_list_query->have_posts() ) {
	            				$posts_list_query->the_post();
	                ?>
	                			<div class="single-post-wrapper clearfix">
                                    <div class="post-thumb-wrapper">
    	                                <a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>">
    	                                    <figure><?php the_post_thumbnail( 'newspaper-lite-block-thumb' ); ?></figure>
    	                                </a>
                                    </div>
                                    <div class="post-content-wrapper">
                                        <h3 class="post-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
    	                                <div class="post-meta-wrapper">
    	                                    <?php newspaper_lite_posted_on(); ?>
    	                                </div><!-- .post-meta-wrapper -->
                                    </div>
	                            </div><!-- .single-post-wrapper -->
	                <?php
	            			}
	            		}

	            	?>
	            </div><!-- .posts-list-wrapper -->
			</div><!-- .widget-block-wrapper -->
<?php
		echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
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
            $instance[$newspaper_lite_widgets_name] = newspaper_lite_widgets_updated_field_value( $widget_field, $new_instance[$newspaper_lite_widgets_name] );
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
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
            $newspaper_lite_widgets_field_value = !empty( $instance[$newspaper_lite_widgets_name] ) ? wp_kses_post( $instance[$newspaper_lite_widgets_name] ) : '';
            newspaper_lite_widgets_show_widget_field( $this, $widget_field, $newspaper_lite_widgets_field_value );
        }
    }
}
