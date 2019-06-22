<?php
/**
 * Define function about sanitation for customizer option
 *
 * @package themecentury
 * @subpackage Newspaper Lite
 * @since 1.0.0
 */

//Text
function newspaper_lite_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

//Check box
function newspaper_lite_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return 0;
	}
}

// Number
function newspaper_lite_sanitize_number( $input ) {
	$output = intval( $input );

	return $output;
}

// site layout
function newspaper_lite_sanitize_site_layout( $input ) {
	$valid_keys = array(
		'fullwidth_layout' => esc_html__( 'Fullwidth Layout', 'newspaper-lite' ),
		'boxed_layout'     => esc_html__( 'Boxed Layout', 'newspaper-lite' )
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

// site layout
function newspaper_lite_sanitize_site_skin( $input ) {
	$valid_keys = array(
		'default' => esc_html__( 'Default Skin', 'newspaper-lite' ),
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

// Switch option (enable/disable)
function newspaper_lite_enable_switch_sanitize( $input ) {
	$valid_keys = array(
		'enable'  => esc_html__( 'Enable', 'newspaper-lite' ),
		'disable' => esc_html__( 'Disable', 'newspaper-lite' )
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

// Switch option for ticker all (enable/disable)
function newspaper_lite_all_page_ticker_enable_switch_sanitize( $input ) {
	$valid_keys = array(
		'yes' => esc_html__( 'Yes', 'newspaper-lite' ),
		'no'  => esc_html__( 'No', 'newspaper-lite' )
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

//switch option (show/hide)
function newspaper_lite_show_switch_sanitize( $input ) {
	$valid_keys = array(
		'show' => esc_html__( 'Show', 'newspaper-lite' ),
		'hide' => esc_html__( 'Hide', 'newspaper-lite' )
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

//Archive page layout
function newspaper_lite_sanitize_archive_layout( $input ) {
	$valid_keys = array(
		'classic' => esc_html__( 'Classic Layout', 'newspaper-lite' ),
		'columns' => esc_html__( 'Columns Layout', 'newspaper-lite' )
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

//Post/Page sidebar layout
function newspaper_lite_page_layout_sanitize( $input ) {
	$valid_keys = array(
		'right_sidebar'     => get_template_directory_uri() . '/core/admin/assets/images/right-sidebar.png',
		'left_sidebar'      => get_template_directory_uri() . '/core/admin/assets/images/left-sidebar.png',
		'no_sidebar'        => get_template_directory_uri() . '/core/admin/assets/images/no-sidebar.png',
		'no_sidebar_center' => get_template_directory_uri() . '/core/admin/assets/images/no-sidebar-center.png'
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

//Footer widget columns
function newspaper_lite_footer_widget_sanitize( $input ) {
	$valid_keys = array(
		'column1' => esc_html__( 'One Column', 'newspaper-lite' ),
		'column2' => esc_html__( 'Two Columns', 'newspaper-lite' ),
		'column3' => esc_html__( 'Three Columns', 'newspaper-lite' ),
		'column4' => esc_html__( 'Four Columns', 'newspaper-lite' )
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

//Related posts type
function newspaper_lite_sanitize_related_type( $input ) {
	$valid_keys = array(
		'category' => esc_html__( 'by Category', 'newspaper-lite' ),
		'tag'      => esc_html__( 'by Tags', 'newspaper-lite' )
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

//Website Skin Sanatize
function newspaper_lite_website_skin_sanitize( $input ) {
	$valid_keys = array(
		'default_skin' => esc_html__( 'Default', 'newspaper-lite' ),
		'dark_skin'    => esc_html__( 'Dark Skin', 'newspaper-lite' ),
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}
//site date format design
function newspaper_lite_sanitize_date_format( $input){
    $valid_keys = array(
        'l, F d, Y' => esc_html__( 'Format 1 (default)', 'newspaper-lite' ),
        'l, Y, F d' => esc_html__( 'Format 2', 'newspaper-lite' ),
        'Y, F d, l' => esc_html__( 'Format 3', 'newspaper-lite' ),
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}
// sanitization of links
function newspaper_lite_links_sanitize() {
	return false;
}

// site title design
function newspaper_lite_sanitize_title_design( $input ) {
    $valid_keys = newspaper_lite_site_title_design();
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

// site title design
function newspaper_lite_sanitize_title_case_design( $input ) {
    $valid_keys = newspaper_lite_site_title_design_case();
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}