<?php
/**
 * Customizer settings for Additional Settings
 *
 * @package Mirrorgrid Store
 * @subpackage Newspaper Lite
 * @since 1.0.0
 */

add_action( 'customize_register', 'newspaper_lite_additional_settings_register' );

function newspaper_lite_additional_settings_register( $wp_customize ) {

	/**
     * Add Additional Settings Panel
     */
    $wp_customize->add_panel(
        'newspaper_lite_additional_settings_panel',
        array(
            'priority'       => 7,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => esc_html__( 'Additional Settings', 'newspaper-lite' ),
        )
    );
/*--------------------------------------------------------------------------------------------*/
	// Category Color Section
    $wp_customize->add_section(
        'newspaper_lite_categories_color_section',
        array(
            'title'         => esc_html__( 'Categories Color', 'newspaper-lite' ),
            'priority'      => 5,
            'panel'         => 'newspaper_lite_additional_settings_panel',
        )
    );

	$priority = 3;
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
		$priority++;
	}
/*--------------------------------------------------------------------------------------------*/
	//Social icons
	$wp_customize->add_section(
        'newspaper_lite_social_media_section',
        array(
            'title'         => esc_html__( 'Social Media', 'newspaper-lite' ),
            'priority'      => 10,
            'panel'         => 'newspaper_lite_additional_settings_panel',
        )
    );

	//Add Facebook Link
    $wp_customize->add_setting(
        'social_fb_link',
        array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'social_fb_link',
        array(
            'type' => 'text',
            'priority' => 5,
            'label' => esc_html__( 'Facebook', 'newspaper-lite' ),
            'description' => esc_html__( 'Your Facebook Account URL', 'newspaper-lite' ),
            'section' => 'newspaper_lite_social_media_section'
        )
    );

    //Add twitter Link
    $wp_customize->add_setting(
        'social_tw_link',
        array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'social_tw_link',
        array(
            'type' => 'text',
            'priority' => 6,
            'label' => esc_html__( 'Twitter', 'newspaper-lite' ),
            'description' => esc_html__( 'Your Twitter Account URL', 'newspaper-lite' ),
            'section' => 'newspaper_lite_social_media_section'
       )
    );

    //Add Google plus Link
    $wp_customize->add_setting(
        'social_gp_link',
        array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'social_gp_link',
        array(
            'type' => 'text',
            'priority' => 7,
            'label' => esc_html__( 'Google Plus', 'newspaper-lite' ),
            'description' => esc_html__( 'Your Google Plus Account URL', 'newspaper-lite' ),
            'section' => 'newspaper_lite_social_media_section'
        )
    );

    //Add LinkedIn Link
    $wp_customize->add_setting(
        'social_lnk_link',
        array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'social_lnk_link',
        array(
            'type' => 'text',
            'priority' => 8,
            'label' => esc_html__( 'LinkedIn', 'newspaper-lite' ),
            'description' => esc_html__( 'Your LinkedIn Account URL', 'newspaper-lite' ),
            'section' => 'newspaper_lite_social_media_section'
        )
    );

    //Add youtube Link
    $wp_customize->add_setting(
        'social_yt_link',
        array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'social_yt_link',
        array(
            'type' => 'text',
            'priority' => 9,
            'label' => esc_html__( 'YouTube', 'newspaper-lite' ),
            'description' => esc_html__( 'Your YouTube Account URL', 'newspaper-lite' ),
            'section' => 'newspaper_lite_social_media_section'
        )
    );

    //Add vimeo Link
    $wp_customize->add_setting(
        'social_vm_link',
        array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'social_vm_link',
        array(
            'type' => 'text',
            'priority' => 10,
            'label' => esc_html__( 'Vimeo', 'newspaper-lite' ),
            'description' => esc_html__( 'Your Vimeo Account URL', 'newspaper-lite' ),
            'section' => 'newspaper_lite_social_media_section'
        )
    );

    //Add Pinterest link
    $wp_customize->add_setting(
        'social_pin_link',
        array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'social_pin_link',
        array(
            'type' => 'text',
            'priority' => 11,
            'label' => esc_html__( 'Pinterest', 'newspaper-lite' ),
            'description' => esc_html__( 'Your Pinterest Account URL', 'newspaper-lite' ),
            'section' => 'newspaper_lite_social_media_section'
        )
    );

    //Add Instagram link
    $wp_customize->add_setting(
        'social_insta_link',
        array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'social_insta_link',
        array(
            'type' => 'text',
            'priority' => 12,
            'label' => esc_html__( 'Instagram', 'newspaper-lite' ),
            'description' => esc_html__( 'Your Instagram Account URL', 'newspaper-lite' ),
            'section' => 'newspaper_lite_social_media_section'
        )
    );

}
