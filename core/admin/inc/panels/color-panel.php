<?php
/**
 * Customizer settings for General purpose
 *
 * @package Themecentury
 * @subpackage Newspaper Lite
 * @since 1.0.0
 */

add_action( 'customize_register', 'newspaper_lite_general_settings_register' );

function newspaper_lite_general_settings_register( $wp_customize ) {

	/**
	 * Add Color Settings Panel
	 */
	$wp_customize->add_panel(
		'newspaper_lite_color_settings_panel',
		array(
			'priority'       => 60,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Color Settings', 'newspaper-lite' ),
		)
	);

	$wp_customize->get_section( 'colors' )->panel               = 'newspaper_lite_color_settings_panel';
	$wp_customize->get_section( 'colors' )->priority            = '10';
	$wp_customize->get_section( 'colors' )->title 				= esc_html__( 'Global Color', 'newspaper-lite' );
	
	/*---------------------------------------------------------------------------------------------------------------*/

	//Theme color
	$wp_customize->add_setting(
		'newspaper_lite_theme_color',
		array(
			'default'           => '#008987',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'newspaper_lite_theme_color',
			array(
				'label'    => esc_html__( 'Theme color', 'newspaper-lite' ),
				'description'   => esc_html__( 'Choose color to make different your website.', 'newspaper-lite' ),
				'section'  => 'colors',
				'priority' => 10
			)
		)
	);

	/*--------------------------------------------------------------------------------------------*/
	// Category Color Section
    $wp_customize->add_section(
        'newspaper_lite_categories_color_section',
        array(
            'title'         => esc_html__( 'Categories Color', 'newspaper-lite' ),
            'priority'      => 20,
            'panel'         => 'newspaper_lite_color_settings_panel',
        )
    );

	$priority = 10;
	$categories = get_terms( 'category' ); // Get all Categories
	$wp_category_list = array();

	foreach ( $categories as $category_list ) {

		$wp_customize->add_setting(
			'newspaper_lite_category_color_'.esc_html( strtolower( $category_list->name ) ),
			array(
				'default'              => '#008987',
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'sanitize_hex_color'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'newspaper_lite_category_color_'.esc_html( strtolower($category_list->name) ),
				array(
					/* translators: %s: category namet */
					'label'    => sprintf( esc_html__( ' %s', 'newspaper-lite' ), esc_html( $category_list->name ) ),
					'section'  => 'newspaper_lite_categories_color_section',
					'priority' => absint($priority)
				)
			)
		);
		$priority+=10;
	}
	
}
