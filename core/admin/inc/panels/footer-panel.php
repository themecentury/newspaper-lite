<?php
/**
 * Customizer option for Footer Panel Settings
 *
 * @package themecentury
 * @subpackage Newspaper Lite
 * @since 1.0.0
 */

add_action( 'customize_register', 'newspaper_lite_footer_settings_register' );

function newspaper_lite_footer_settings_register( $wp_customize ) {

	/**
	 * Add Footer Panel
	 */
	$wp_customize->add_panel(
		'newspaper_lite_footer_settings_panel',
		array(
			'priority'       => 70,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Footer Options', 'newspaper-lite' ),
		)
	);

	/*----------------------------------------------------------------------------------------------------*/

	/**
	 * Top Footer widget area
	 */
	$wp_customize->add_section(
		'newspaper_lite_top_footer_widget_section',
		array(
			'title'    => esc_html__( 'Top Footer Settings', 'newspaper-lite' ),
			'priority' => 10,
			'panel'    => 'newspaper_lite_footer_settings_panel'
		)
	);

	// Footer widget area
	$wp_customize->add_setting(
		'footer_widget_option',
		array(
			'default'           => 'column3',
			'sanitize_callback' => 'newspaper_lite_footer_widget_sanitize',
		)
	);
	$wp_customize->add_control(
		'footer_widget_option',
		array(
			'type'        => 'radio',
			'priority'    => 10,
			'label'       => esc_html__( 'Top Footer Widget Area', 'newspaper-lite' ),
			'description' => esc_html__( 'Choose option to display number of columns in top footer area.', 'newspaper-lite' ),
			'section'     => 'newspaper_lite_top_footer_widget_section',
			'choices'     => array(
				'column1' => esc_html__( 'One Column', 'newspaper-lite' ),
				'column2' => esc_html__( 'Two Columns', 'newspaper-lite' ),
				'column3' => esc_html__( 'Three Columns', 'newspaper-lite' ),
				'column4' => esc_html__( 'Four Columns', 'newspaper-lite' ),
			),
		)
	);

	/*----------------------------------------------------------------------------------------------------*/

	/**
	 * Footer widget area
	 */
	$wp_customize->add_section(
		'newspaper_lite_bottom_footer_widget_section',
		array(
			'title'    => esc_html__( 'Bottom Footer Settings', 'newspaper-lite' ),
			'priority' => 30,
			'panel'    => 'newspaper_lite_footer_settings_panel'
		)
	);
	

	//Copyright text
	$wp_customize->add_setting(
		'newspaper_lite_copyright_text',
		array(
			'default'           => esc_html__( '2018 newspaper-lite', 'newspaper-lite' ),
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'newspaper_lite_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'newspaper_lite_copyright_text',
		array(
			'type'     => 'text',
			'label'    => esc_html__( 'Copyright Info', 'newspaper-lite' ),
			'section'  => 'newspaper_lite_bottom_footer_widget_section',
			'priority' => 10
		)
	);

	/*----------------------------------------------------------------------------------------------------*/

}