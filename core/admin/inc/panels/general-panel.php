<?php
/**
 * Customizer settings for General purpose
 *
 * @package Mirrorgrid Store
 * @subpackage Newspaper Lite
 * @since 1.0.0
 */

add_action( 'customize_register', 'newspaper_lite_general_settings_register' );

function newspaper_lite_general_settings_register( $wp_customize ) {

	$wp_customize->get_section( 'title_tagline' )->panel        = 'newspaper_lite_general_settings_panel';
	$wp_customize->get_section( 'title_tagline' )->priority     = '3';
	$wp_customize->get_section( 'colors' )->panel               = 'newspaper_lite_general_settings_panel';
	$wp_customize->get_section( 'colors' )->priority            = '4';
	$wp_customize->get_section( 'background_image' )->panel     = 'newspaper_lite_general_settings_panel';
	$wp_customize->get_section( 'background_image' )->priority  = '5';
	$wp_customize->get_section( 'static_front_page' )->panel    = 'newspaper_lite_general_settings_panel';
	$wp_customize->get_section( 'static_front_page' )->priority = '6';

	/**
	 * Add General Settings Panel
	 */
	$wp_customize->add_panel(
		'newspaper_lite_general_settings_panel',
		array(
			'priority'       => 3,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'General Settings', 'newspaper-lite' ),
		)
	);

	/*-----------------------------------------------*/
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
				/*'description'   => esc_html__( 'Choose color to make different your website.', 'newspaper-lite' ),*/
				'section'  => 'colors',
				'priority' => 5
			)
		)
	);

	/*---------------------------------------------------------------------------------------------------------------*/
	/**
	 * Website layout
	 */
	$wp_customize->add_section(
		'newspaper_lite_site_layout',
		array(
			'title'       => esc_html__( 'Website Layout', 'newspaper-lite' ),
			'description' => esc_html__( 'Choose a site to display your website more effectively.', 'newspaper-lite' ),
			'priority'    => 5,
			'panel'       => 'newspaper_lite_general_settings_panel',
		)
	);

	$wp_customize->add_setting(
		'site_layout_option',
		array(
			'default'           => 'fullwidth_layout',
			'sanitize_callback' => 'newspaper_lite_sanitize_site_layout',
		)
	);
	$wp_customize->add_control(
		'site_layout_option',
		array(
			'type'     => 'radio',
			'priority' => 10,
			'label'    => esc_html__( 'Site Layout', 'newspaper-lite' ),
			'section'  => 'newspaper_lite_site_layout',
			'choices'  => array(
				'fullwidth_layout' => esc_html__( 'Full Width Layout', 'newspaper-lite' ),
				'boxed_layout'     => esc_html__( 'Boxed Layout', 'newspaper-lite' )
			),
		)
	);
}
