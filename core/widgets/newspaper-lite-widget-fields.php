<?php
/**
 * Define custom fields for widgets
 *
 * @package themecentury
 * @subpackage Newspaper Lite
 * @since 1.0.0
 */

function newspaper_lite_widgets_show_widget_field( $instance = '', $widget_field = '', $mgs_field_value = '' ) {

	extract( $widget_field );

	switch ( $newspaper_lite_widgets_field_type ) {

		// Standard text field
		case 'text' :
			?>
			<p>
				<label
					for="<?php echo esc_attr( $instance->get_field_id( $newspaper_lite_widgets_name ) ); ?>"><?php echo esc_html( $newspaper_lite_widgets_title ); ?>
					:</label>
				<input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $newspaper_lite_widgets_name ) ); ?>"
                           name="<?php echo esc_attr( $instance->get_field_name( $newspaper_lite_widgets_name ) ); ?>" type="text"
				       value="<?php echo esc_html( $mgs_field_value ); ?>"/>

				<?php if ( isset( $newspaper_lite_widgets_description ) ) { ?>
					<br/>
					<small><?php echo esc_html( $newspaper_lite_widgets_description ); ?></small>
				<?php } ?>
			</p>
			<?php
			break;

		// Standard url field
		case 'url' :
			?>
			<p>
				<label
					for="<?php echo esc_attr( $instance->get_field_id( $newspaper_lite_widgets_name ) ); ?>"><?php echo esc_html( $newspaper_lite_widgets_title ); ?>
					:</label>
				<input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $newspaper_lite_widgets_name ) ); ?>"
				       name="<?php echo esc_attr( $instance->get_field_name( $newspaper_lite_widgets_name ) ); ?>" type="text"
				       value="<?php echo esc_html( $mgs_field_value ); ?>"/>

				<?php if ( isset( $newspaper_lite_widgets_description ) ) { ?>
					<br/>
					<small><?php echo esc_html( $newspaper_lite_widgets_description ); ?></small>
				<?php } ?>
			</p>
			<?php
			break;

		// Checkbox field
		case 'checkbox' :
			?>
			<p>
				<input id="<?php echo esc_attr( $instance->get_field_id( $newspaper_lite_widgets_name ) ); ?>"
				       name="<?php echo esc_attr( $instance->get_field_name( $newspaper_lite_widgets_name ) ); ?>"
				       type="checkbox" value="1" <?php checked( '1', $mgs_field_value ); ?>/>
				<label
					for="<?php echo esc_attr( $instance->get_field_id( $newspaper_lite_widgets_name ) ); ?>"><?php echo esc_html( $newspaper_lite_widgets_title ); ?></label>

				<?php if ( isset( $newspaper_lite_widgets_description ) ) { ?>
					<br/>
					<small><?php echo wp_kses_post( $newspaper_lite_widgets_description ); ?></small>
				<?php } ?>
			</p>
			<?php
			break;

		// Textarea field
		case 'textarea' :
			?>
			<p>
				<label
					for="<?php echo esc_attr( $instance->get_field_id( $newspaper_lite_widgets_name ) ); ?>"><?php echo esc_html( $newspaper_lite_widgets_title ); ?>
					:</label>
				<textarea class="widefat" rows="<?php echo intval( $newspaper_lite_widgets_row ); ?>"
				          id="<?php echo esc_attr( $instance->get_field_id( $newspaper_lite_widgets_name ) ); ?>"
				          name="<?php echo esc_attr( $instance->get_field_name( $newspaper_lite_widgets_name ) ); ?>"><?php echo esc_html( $mgs_field_value ); ?></textarea>
			</p>
			<?php
			break;

		// Radio fields
		case 'radio' :
			if ( empty( $mgs_field_value ) ) {
				$mgs_field_value = $newspaper_lite_widgets_default;
			}
			?>
			<p>
				<label
					for="<?php echo esc_attr( $instance->get_field_id( $newspaper_lite_widgets_name ) ); ?>"><?php echo esc_html( $newspaper_lite_widgets_title ); ?>
					:</label>
			<div class="radio-wrapper">
				<?php
				foreach ( $newspaper_lite_widgets_field_options as $athm_option_name => $athm_option_title ) {
					?>
					<input id="<?php echo esc_attr( $instance->get_field_id( $athm_option_name ) ); ?>"
					       name="<?php echo esc_attr( $instance->get_field_name( $newspaper_lite_widgets_name ) ); ?>"
					       type="radio"
					       value="<?php echo esc_html( $athm_option_name ); ?>" <?php checked( $athm_option_name, $mgs_field_value ); ?> />
					<label
						for="<?php echo esc_attr( $instance->get_field_id( $athm_option_name ) ); ?>"><?php echo esc_html( $athm_option_title ); ?>
						:</label>
				<?php } ?>
			</div>

			<?php if ( isset( $newspaper_lite_widgets_description ) ) { ?>
			<small><?php echo esc_html( $newspaper_lite_widgets_description ); ?></small>
		<?php } ?>
			</p>
			<?php
			break;

		// Select field
		case 'select' :
			if ( empty( $mgs_field_value ) ) {
				$mgs_field_value = $newspaper_lite_widgets_default;
			}
			$is_multiple = isset( $newspaper_lite_widgets_field_multiple ) && $newspaper_lite_widgets_field_multiple ? true : false;
			?>
			<p>
				<label
					for="<?php echo esc_attr( $instance->get_field_id( $newspaper_lite_widgets_name ) ); ?>"><?php echo esc_html( $newspaper_lite_widgets_title ); ?>
					:</label>
				<select name="<?php echo esc_attr( $instance->get_field_name( $newspaper_lite_widgets_name ) );
				if ( $is_multiple ) {
					echo '[]';
				} ?>"
				        id="<?php echo esc_attr( $instance->get_field_id( $newspaper_lite_widgets_name ) ); ?>"
				        class="widefat" <?php echo $is_multiple ? 'multiple="multiple"' : ''; ?>>
					<?php foreach ( $newspaper_lite_widgets_field_options as $athm_option_name => $athm_option_title ) {
						$mgs_field_value_selected = is_array($mgs_field_value) ? in_array($athm_option_name, $mgs_field_value) ? $athm_option_name : -1 : $mgs_field_value;
						?>
						<option value="<?php echo esc_attr( $athm_option_name ); ?>"
						        id="<?php echo esc_attr( $instance->get_field_id( $athm_option_name ) ); ?>" <?php selected( $athm_option_name, $mgs_field_value_selected); ?>><?php echo esc_html( $athm_option_title ); ?></option>
					<?php } ?>
				</select>

				<?php if ( isset( $newspaper_lite_widgets_description ) ) { ?>
					<br/>
					<small><?php echo esc_html( $newspaper_lite_widgets_description ); ?></small>
				<?php } ?>
			</p>
			<?php
			break;

		case 'number' :
			if ( empty( $mgs_field_value ) ) {
				$mgs_field_value = $newspaper_lite_widgets_default;
			}
			?>
			<p>
				<label
					for="<?php echo esc_attr( $instance->get_field_id( $newspaper_lite_widgets_name ) ); ?>"><?php echo esc_html( $newspaper_lite_widgets_title ); ?>
					:</label><br/>
				<input name="<?php echo esc_attr( $instance->get_field_name( $newspaper_lite_widgets_name ) ); ?>"
				       type="number" step="1" min="1"
				       id="<?php echo esc_attr( $instance->get_field_id( $newspaper_lite_widgets_name ) ); ?>"
				       value="<?php echo esc_html( $mgs_field_value ); ?>"/>

				<?php if ( isset( $newspaper_lite_widgets_description ) ) { ?>
					<br/>
					<small><?php echo esc_html( $newspaper_lite_widgets_description ); ?></small>
				<?php } ?>
			</p>
			<?php
			break;

		case 'widget_section_header':
			?>
			<span class="section-header"><?php echo esc_html( $newspaper_lite_widgets_title ); ?></span>
			<?php
			break;

		case 'widget_layout_image':
			?>
			<div class="layout-image-wrapper">
				<span class="image-title"><?php echo esc_html( $newspaper_lite_widgets_title ); ?></span>
				<img src="<?php echo esc_url( $newspaper_lite_widgets_layout_img ); ?>"
				     title="<?php echo esc_attr__( 'Widget Layout', 'newspaper-lite' ); ?>"/>
			</div>
			<?php
			break;

		/**
		 * Selector field
		 */
		case 'selector':

			if( empty( $mgs_field_value ) ) {
				$mgs_field_value = $newspaper_lite_widgets_default;
			}
			?>
			<p><span class="field-label"><label class="field-title"><?php echo esc_html( $newspaper_lite_widgets_title ); ?></label></span></p>
			<?php
			echo '<div class="selector-labels">';
			foreach ( $newspaper_lite_widgets_field_options as $option => $val ){
				$class = ( $mgs_field_value == $option ) ? 'selector-selected': '';
				echo '<label class="'. esc_attr( $class ).'" data-val="'.esc_attr( $option ).'">';
				echo '<img src="'.esc_url( $val ).'"/>';
				echo '</label>';
			}
			echo '</div>';
			echo '<input id="'.esc_attr( $instance->get_field_id( $newspaper_lite_widgets_name ) ).'" data-default="'.esc_attr( $mgs_field_value ).'" type="hidden" value="'.esc_attr( $mgs_field_value ).'" name="'.esc_attr( $instance->get_field_name( $newspaper_lite_widgets_name ) ).'"/>';
			break;
		case 'upload' :

			$output = '';
			$id     = esc_attr( $instance->get_field_id( $newspaper_lite_widgets_name ) );
			$class  = '';
			$int    = '';
			$value  = $mgs_field_value;
			$name   = esc_attr( $instance->get_field_name( $newspaper_lite_widgets_name ) );

			if ( $value ) {
				$class = ' has-file';
				$value = explode( 'wp-content', $value );
				$value = content_url() . $value[1];
			}
			$output .= '<div class="sub-option widget-upload">';
			$output .= '<label for="' . esc_attr( $instance->get_field_id( $newspaper_lite_widgets_name ) ) . '">' . esc_html( $newspaper_lite_widgets_title ) . '</label><br/>';
			$output .= '<input id="' . $id . '" class="upload' . $class . '" type="text" name="' . $name . '" value="' . $value . '" placeholder="' . esc_html__( 'No file chosen', 'newspaper-lite' ) . '" />' . "\n";
			if ( function_exists( 'wp_enqueue_media' ) ) {
				if ( ( $value == '' ) ) {
					$output .= '<input id="upload-' . $id . '" class="wid-upload-button button" type="button" value="' . esc_html__( 'Upload', 'newspaper-lite' ) . '" />' . "\n";
				} else {
					$output .= '<input id="remove-' . $id . '" class="wid-remove-file button" type="button" value="' . esc_html__( 'Remove', 'newspaper-lite' ) . '" />' . "\n";
				}
			} else {
				$output .= '<p><i>' . esc_html__( 'Upgrade your version of WordPress for full media support.', 'newspaper-lite' ) . '</i></p>';
			}

			$output .= '<div class="screenshot upload-thumb" id="' . $id . '-image">' . "\n";

			if ( $value != '' ) {
				$remove = '<a class="remove-image">' . esc_html__( 'Remove', 'newspaper-lite' ) . '</a>';
				$image  = preg_match( '/(^.*\.jpg|jpeg|png|gif|ico*)/i', $value );
				if ( $image ) {
					$output .= '<img src="' . esc_url( $value ) . '" alt="' . esc_attr__( 'Upload image', 'newspaper-lite' ) . '" />';
				} else {
					$parts = explode( "/", $value );
					for ( $i = 0; $i < sizeof( $parts ); ++ $i ) {
						$title = $parts[ $i ];
					}

					// No output preview if it's not an image.
					$output .= '';

					// Standard generic output if it's not an image.
					$title = esc_html__( 'View File', 'newspaper-lite' );
					$output .= '<div class="no-image"><span class="file_link"><a href="' . $value . '" target="_blank" rel="external">' . $title . '</a></span></div>';
				}
			}
			$output .= '</div></div>' . "\n";
			echo $output;
			break;
	}
}

function newspaper_lite_widgets_updated_field_value( $widget_field, $new_field_value ) {


	$newspaper_lite_widgets_field_type = '';

	extract( $widget_field );

	switch ( $newspaper_lite_widgets_field_type ) {
		// Allow only integers in number fields
		case 'number':
			return newspaper_lite_sanitize_number( $new_field_value );
			break;
		// Allow some tags in textareas
		case 'textarea':
			$newspaper_lite_widgets_allowed_tags = array(
				'p'      => array(),
				'em'     => array(),
				'strong' => array(),
				'a'      => array(
					'href' => array(),
				),
			);

			return wp_kses( $new_field_value, $newspaper_lite_widgets_allowed_tags );
			break;
		// No allowed tags for all other fields
		case 'url':
			return esc_url_raw( $new_field_value );
			break;
		case 'select':
			$is_multiple = isset( $newspaper_lite_widgets_field_multiple ) && $newspaper_lite_widgets_field_multiple ? true : false;
			if ( $is_multiple ) {
				$array = array_map( 'sanitize_text_field', wp_unslash( $new_field_value ) );
				return array_map( 'wp_kses_post', $array );
			} else {
				return wp_kses_post( sanitize_text_field( $new_field_value ) );
			}
			break;
		default:
			return wp_kses_post( sanitize_text_field( $new_field_value ) );

	}
}
