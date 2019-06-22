<?php
/**
 * Customizer settings for Additional Settings
 *
 * @package themecentury
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
            'priority'       => 40,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => esc_html__( 'Additional Settings', 'newspaper-lite' ),
        )
    );

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
            'priority' => 10,
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
            'priority' => 20,
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
            'priority' => 30,
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
            'priority' => 40,
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
            'priority' => 50,
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
            'priority' => 60,
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
            'priority' => 70,
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
            'priority' => 80,
            'label' => esc_html__( 'Instagram', 'newspaper-lite' ),
            'description' => esc_html__( 'Your Instagram Account URL', 'newspaper-lite' ),
            'section' => 'newspaper_lite_social_media_section'
        )
    );

}
