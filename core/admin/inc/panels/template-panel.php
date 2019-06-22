<?php
/**
 * Customizer settings for Templates settings purpose
 *
 * @package Themecentury
 * @subpackage Newspaper Lite
 * @since 1.0.0
 */

add_action( 'customize_register', 'newspaper_lite_template_settings_register' );

function newspaper_lite_template_settings_register( $wp_customize ) {

	/**
	 * Add Template Panel
	 */
	$wp_customize->add_panel(
		'newspaper_lite_templates_settings_panel',
		array(
			'priority'       => 30,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Template Options', 'newspaper-lite' ),
		)
	);

	$wp_customize->get_section( 'static_front_page' )->panel        = 'newspaper_lite_templates_settings_panel';
	$wp_customize->get_section( 'static_front_page' )->priority     = '10';

	/*--------------------------------------------------------------------------------*/

	/**
	 * Archive page Settings
	 */
	$wp_customize->add_section(
		'newspaper_lite_archive_section',
		array(
			'title'    => esc_html__( 'Archive Settings', 'newspaper-lite' ),
			'priority' => 20,
			'panel'    => 'newspaper_lite_templates_settings_panel'
		)
	);

	// Archive page sidebar
	$wp_customize->add_setting(
		'newspaper_lite_archive_sidebar',
		array(
			'default'           => 'right_sidebar',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'newspaper_lite_page_layout_sanitize',
		)
	);

	$wp_customize->add_control( new Newspaper_Lite_Image_Radio_Control(
			$wp_customize,
			'newspaper_lite_archive_sidebar',
			array(
				'type'        => 'radio',
				'label'       => esc_html__( 'Available Sidebars', 'newspaper-lite' ),
				'description' => esc_html__( 'Select sidebar for whole site archives, categories, search page etc.', 'newspaper-lite' ),
				'section'     => 'newspaper_lite_archive_section',
				'priority'    => 10,
				'choices'     => array(
					'right_sidebar'     => get_template_directory_uri() . '/core/admin/assets/images/right-sidebar.png',
					'left_sidebar'      => get_template_directory_uri() . '/core/admin/assets/images/left-sidebar.png',
					'no_sidebar'        => get_template_directory_uri() . '/core/admin/assets/images/no-sidebar.png',
					'no_sidebar_center' => get_template_directory_uri() . '/core/admin/assets/images/no-sidebar-center.png'
				)
			)
		)
	);

	//Archive page layouts
	$wp_customize->add_setting(
		'newspaper_lite_archive_layout',
		array(
			'default'           => 'classic',
			'sanitize_callback' => 'newspaper_lite_sanitize_archive_layout',
		)
	);
	$wp_customize->add_control(
		'newspaper_lite_archive_layout',
		array(
			'type'        => 'radio',
			'label'       => esc_html__( 'Archive Page Layout', 'newspaper-lite' ),
			'description' => esc_html__( 'Choose available layout for all archive pages.', 'newspaper-lite' ),
			'section'     => 'newspaper_lite_archive_section',
			'choices'     => array(
				'classic' => esc_html__( 'Classic Layout', 'newspaper-lite' ),
				'columns' => esc_html__( 'Columns Layout', 'newspaper-lite' )
			),
			'priority'    => 20
		)
	);

	/*--------------------------------------------------------------------------------*/
	/**
	 * Single post Settings
	 */
	$wp_customize->add_section(
		'newspaper_lite_single_post_section',
		array(
			'title'    => esc_html__( 'Post Settings', 'newspaper-lite' ),
			'priority' => 30,
			'panel'    => 'newspaper_lite_templates_settings_panel'
		)
	);

	// Archive page sidebar
	$wp_customize->add_setting(
		'newspaper_lite_default_post_sidebar',
		array(
			'default'           => 'right_sidebar',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'newspaper_lite_page_layout_sanitize',
		)
	);

	$wp_customize->add_control( new Newspaper_Lite_Image_Radio_Control(
			$wp_customize,
			'newspaper_lite_default_post_sidebar',
			array(
				'type'        => 'radio',
				'label'       => esc_html__( 'Available Sidebars', 'newspaper-lite' ),
				'description' => esc_html__( 'Select sidebar for whole single post page.', 'newspaper-lite' ),
				'section'     => 'newspaper_lite_single_post_section',
				'priority'    => 10,
				'choices'     => array(
					'right_sidebar'     => get_template_directory_uri() . '/core/admin/assets/images/right-sidebar.png',
					'left_sidebar'      => get_template_directory_uri() . '/core/admin/assets/images/left-sidebar.png',
					'no_sidebar'        => get_template_directory_uri() . '/core/admin/assets/images/no-sidebar.png',
					'no_sidebar_center' => get_template_directory_uri() . '/core/admin/assets/images/no-sidebar-center.png'
				)
			)
		)
	);

	//Author box
	$wp_customize->add_setting(
		'newspaper_lite_author_box_option',
		array(
			'default'           => 'show',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'newspaper_lite_show_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Newspaper_Lite_Customize_Switch_Control(
			$wp_customize,
			'newspaper_lite_author_box_option',
			array(
				'type'        => 'switch',
				'label'       => esc_html__( 'Author Option', 'newspaper-lite' ),
				'description' => esc_html__( 'Enable/disable author information at single post page.', 'newspaper-lite' ),
				'priority'    => 20,
				'section'     => 'newspaper_lite_single_post_section',
				'choices'     => array(
					'show' => esc_html__( 'Show', 'newspaper-lite' ),
					'hide' => esc_html__( 'Hide', 'newspaper-lite' )
				)
			)
		)
	);

	//Related Articles
	$wp_customize->add_setting(
		'newspaper_lite_related_articles_option',
		array(
			'default'           => 'enable',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'newspaper_lite_enable_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Newspaper_Lite_Customize_Switch_Control(
			$wp_customize,
			'newspaper_lite_related_articles_option',
			array(
				'type'        => 'switch',
				'label'       => esc_html__( 'Related Articles Option', 'newspaper-lite' ),
				'description' => esc_html__( 'Enable/disable related articles section at single post page.', 'newspaper-lite' ),
				'priority'    => 30,
				'section'     => 'newspaper_lite_single_post_section',
				'choices'     => array(
					'enable'  => esc_html__( 'Enable', 'newspaper-lite' ),
					'disable' => esc_html__( 'Disable', 'newspaper-lite' )
				)
			)
		)
	);



	//Related articles section title
	$wp_customize->add_setting(
		'newspaper_lite_related_articles_title',
		array(
			'default'           => esc_html__( 'Related Articles', 'newspaper-lite' ),
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'newspaper_lite_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'newspaper_lite_related_articles_title',
		array(
			'type'            => 'text',
			'label'           => esc_html__( 'Section Title', 'newspaper-lite' ),
			'section'         => 'newspaper_lite_single_post_section',
			'active_callback' => 'newspaper_lite_related_articles_option_callback',
			'priority'        => 8
		)
	);

	// Types of Related articles
	$wp_customize->add_setting(
		'newspaper_lite_related_articles_type',
		array(
			'default'           => 'category',
			'sanitize_callback' => 'newspaper_lite_sanitize_related_type',
		)
	);
	$wp_customize->add_control(
		'newspaper_lite_related_articles_type',
		array(
			'type'            => 'radio',
			'label'           => esc_html__( 'Types of Related Articles', 'newspaper-lite' ),
			'description'     => esc_html__( 'Option to display related articles from category/tags.', 'newspaper-lite' ),
			'section'         => 'newspaper_lite_single_post_section',
			'choices'         => array(
				'category' => esc_html__( 'by Category', 'newspaper-lite' ),
				'tag'      => esc_html__( 'by Tags', 'newspaper-lite' )
			),
			'active_callback' => 'newspaper_lite_related_articles_option_callback',
			'priority'        => 9
		)
	);
	/*--------------------------------------------------------------------------------*/

	/**
	 * Single page Settings
	 */
	$wp_customize->add_section(
		'newspaper_lite_single_page_section',
		array(
			'title'    => esc_html__( 'Page Settings', 'newspaper-lite' ),
			'priority' => 40,
			'panel'    => 'newspaper_lite_templates_settings_panel'
		)
	);

	// Archive page sidebar
	$wp_customize->add_setting(
		'newspaper_lite_default_page_sidebar',
		array(
			'default'           => 'right_sidebar',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'newspaper_lite_page_layout_sanitize',
		)
	);

	$wp_customize->add_control( new Newspaper_Lite_Image_Radio_Control(
			$wp_customize,
			'newspaper_lite_default_page_sidebar',
			array(
				'type'        => 'radio',
				'label'       => esc_html__( 'Available Sidebars', 'newspaper-lite' ),
				'description' => esc_html__( 'Select sidebar for whole single page.', 'newspaper-lite' ),
				'section'     => 'newspaper_lite_single_page_section',
				'priority'    => 4,
				'choices'     => array(
					'right_sidebar'     => get_template_directory_uri() . '/core/admin/assets/images/right-sidebar.png',
					'left_sidebar'      => get_template_directory_uri() . '/core/admin/assets/images/left-sidebar.png',
					'no_sidebar'        => get_template_directory_uri() . '/core/admin/assets/images/no-sidebar.png',
					'no_sidebar_center' => get_template_directory_uri() . '/core/admin/assets/images/no-sidebar-center.png'
				)
			)
		)
	);
}