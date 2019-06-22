<?php
/**
 * Customizer theme options panel
 *
 * @package themecentury
 * @subpackage Newspaper Lite
 * @since 1.0.0
 */

add_action('customize_register', 'newspaper_lite_theme_options_settings_register');

function newspaper_lite_theme_options_settings_register($wp_customize)
{
    /**
     * Add header panels
     */
    $wp_customize->add_panel(
        'newspaper_lite_themeoptions_settings_panel',
        array(
            'priority' => 40,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__('Theme Options', 'newspaper-lite'),
        )
    );

    /*----------------------------------------------------------------------------------------------------*/

    $wp_customize->get_section( 'background_image' )->panel     = 'newspaper_lite_themeoptions_settings_panel';
	$wp_customize->get_section( 'background_image' )->priority  = '10';

	/*---------------------------------------------------------------------------------------------------------------*/
	/**
	 * Website layout
	 */
	$wp_customize->add_section(
		'newspaper_lite_site_layout',
		array(
			'title'       => esc_html__( 'Website Layout', 'newspaper-lite' ),
			'description' => esc_html__( 'Choose a site to display your website more effectively.', 'newspaper-lite' ),
			'priority'    => 20,
			'panel'       => 'newspaper_lite_themeoptions_settings_panel',
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


	//Website Skin
	$wp_customize->add_section(
		'newspaper_lite_website_skin_section',
		array(
			'title'    => esc_html__( 'Website Skin', 'newspaper-lite' ),
			'priority' => 30,
			'panel'    => 'newspaper_lite_themeoptions_settings_panel'
		)
	);
	// Website Skin Setting
	$wp_customize->add_setting(
		'website_skin_option',
		array(
			'default'           => 'default_skin',
			'sanitize_callback' => 'newspaper_lite_website_skin_sanitize',
		)
	);
	$wp_customize->add_control(
		'website_skin_option',
		array(
			'type'        => 'radio',
			'priority'    => 4,
			'label'       => esc_html__( 'Choose Website Skin', 'newspaper-lite' ),
			'description' => esc_html__( 'Choose the  skin color for your site.', 'newspaper-lite' ),
			'section'     => 'newspaper_lite_website_skin_section',
			'choices'     => array(
				'default_skin'   => esc_html__( 'Default', 'newspaper-lite' ),
				'dark_skin' => esc_html__( 'Dark Skin', 'newspaper-lite' ),
			),
		)
	);

    /*--------------------------------------------------------------------------------------------------------*/

    /**
     * Title Style
     */
    $wp_customize->add_section(
        'newspaper_lite_site_title_design', array(
            'title'       => __( 'Title Style', 'newspaper-lite' ),
            'description' => __( 'Design option of title style', 'newspaper-lite'),
            'priority'    => 40,
            'panel'       => 'newspaper_lite_themeoptions_settings_panel',
        )
    );
    $wp_customize->add_setting(
        'site_title_design_options', array(
            'default'           => 'plain',
            'sanitize_callback' => 'newspaper_lite_sanitize_title_design',
        )
    );
    $wp_customize->add_control(
        'site_title_design_options', array(
            'type'     => 'radio',
            'priority' => 10,
            'label'    => __( 'Title design styles', 'newspaper-lite' ),
            'section'  => 'newspaper_lite_site_title_design',
            'choices'  => newspaper_lite_site_title_design(),
        )
    );

    // Title case design
    /**
     */
    $wp_customize->add_section(
        'newspaper_lite_site_title_case_design', array(
            'title'       => esc_html__( 'Title font case', 'newspaper-lite' ),
            'description' => esc_html__( 'Design of font case style', 'newspaper-lite'),
            'priority'    => 20,
            'panel'       => 'newspaper_lite_themeoptions_settings_panel',
        )
    );
    $wp_customize->add_setting(
        'site_title_case_design_options', array(
            'default'           => 'default',
            'sanitize_callback' => 'newspaper_lite_sanitize_title_case_design',
        )
    );
    $wp_customize->add_control(
        'site_title_case_design_options', array(
            'type'     => 'radio',
            'priority' => 10,
            'label'    => esc_html__( 'Title font case styles', 'newspaper-lite' ),
            'section'  => 'newspaper_lite_site_title_design',
            'choices'  => newspaper_lite_site_title_design_case(),
        )
    );

}