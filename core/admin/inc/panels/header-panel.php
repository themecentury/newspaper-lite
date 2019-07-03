<?php
/**
 * Customizer option for Header sections
 *
 * @package themecentury
 * @subpackage Newspaper Lite
 * @since 1.0.0
 */

add_action('customize_register', 'newspaper_lite_header_settings_register');

function newspaper_lite_header_settings_register($wp_customize)
{
    /**
     * Add header panels
     */
    $wp_customize->add_panel(
        'newspaper_lite_header_settings_panel',
        array(
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__('Header Settings', 'newspaper-lite'),
        )
    );

    /*----------------------------------------------------------------------------------------------------*/

    $wp_customize->get_section( 'header_image' )->panel     = 'newspaper_lite_header_settings_panel';
    $wp_customize->get_section( 'header_image' )->priority  = '10';

    /*----------------------------------------------------------------------------------------------------*/
    /**
     * Top Header Section
     */
    $wp_customize->add_section(
        'newspaper_lite_ticker_header_section',
        array(
            'title'    => esc_html__( 'Ticker Options', 'newspaper-lite' ),
            'priority' => 20,
            'panel'    => 'newspaper_lite_header_settings_panel'
        )
    );

    //Ticker display option
    $wp_customize->add_setting(
        'newspaper_lite_ticker_option',
        array(
            'default' => 'enable',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
            'sanitize_callback' => 'newspaper_lite_enable_switch_sanitize'
        )
    );
    $wp_customize->add_control(new Newspaper_Lite_Customize_Switch_Control(
            $wp_customize,
            'newspaper_lite_ticker_option',
            array(
                'type' => 'switch',
                'label' => esc_html__('News Ticker Option', 'newspaper-lite'),
                'description' => esc_html__('Enable/disable news ticker at header.', 'newspaper-lite'),
                'priority' => 10,
                'section' => 'newspaper_lite_ticker_header_section',
                'choices' => array(
                    'enable' => esc_html__('Enable', 'newspaper-lite'),
                    'disable' => esc_html__('Disable', 'newspaper-lite')
                )
            )
        )
    );


    //Ticker Caption
    $wp_customize->add_setting(
        'newspaper_lite_ticker_caption',
        array(
            'default' => esc_html__('Latest', 'newspaper-lite'),
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
            'sanitize_callback' => 'newspaper_lite_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'newspaper_lite_ticker_caption',
        array(
            'type' => 'text',
            'label' => esc_html__('News Ticker Caption', 'newspaper-lite'),
            'section' => 'newspaper_lite_ticker_header_section',
            'priority' => 20
        )
    );
    // Show ticker in all page or only front page /*
    $wp_customize->add_setting(
        'all_page_newspaper_lite_ticker_option',
        array(
            'default' => 'no',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
            'sanitize_callback' => 'newspaper_lite_all_page_ticker_enable_switch_sanitize'
        )
    );
    $wp_customize->add_control(new Newspaper_Lite_Customize_Switch_Control(
            $wp_customize,
            'all_page_newspaper_lite_ticker_option',
            array(
                'type' => 'switch',
                'label' => esc_html__('Show on all page', 'newspaper-lite'),
                'description' => esc_html__('Select yes, if you want to show ticker on all page.', 'newspaper-lite'),
                'priority' => 30,
                'section' => 'newspaper_lite_ticker_header_section',
                'choices' => array(
                    'yes' => esc_html__('Yes', 'newspaper-lite'),
                    'no' => esc_html__('No', 'newspaper-lite')
                )
            )
        )
    );

    /*----------------------------------------------------------------------------------------------------*/
    /**
     * Top Header Section
     */
    $wp_customize->add_section(
        'newspaper_lite_top_header_section',
        array(
            'title' => esc_html__('Top Header Section', 'newspaper-lite'),
            'priority' => 30,
            'panel' => 'newspaper_lite_header_settings_panel'
        )
    );

    
    // Display Current Date
    $wp_customize->add_setting(
        'newspaper_lite_header_date',
        array(
            'default' => 'enable',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
            'sanitize_callback' => 'newspaper_lite_enable_switch_sanitize'
        )
    );
    $wp_customize->add_control(new Newspaper_Lite_Customize_Switch_Control(
            $wp_customize,
            'newspaper_lite_header_date',
            array(
                'type' => 'switch',
                'label' => esc_html__('Current Date Option', 'newspaper-lite'),
                'description' => esc_html__('Enable/disable current date from top header.', 'newspaper-lite'),
                'priority' => 40,
                'section' => 'newspaper_lite_top_header_section',
                'choices' => array(
                    'enable' => esc_html__('Enable', 'newspaper-lite'),
                    'disable' => esc_html__('Disable', 'newspaper-lite')
                )
            )
        )
    );

    //Date Format
    $wp_customize->add_setting(
        'newspaper_lite_date_format_option', array(
            'default' => 'l, F d, Y',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'newspaper_lite_sanitize_date_format',
        )
    );
    $wp_customize->add_control(
        'newspaper_lite_date_format_option', array(
            'type'        => 'radio',

            'label'       =>esc_html__( 'Current Date Format Style Options', 'newspaper-lite' ),
            'description' => esc_html__( 'Choose available format for date format style. (functions only if current date option is enabled)', 'newspaper-lite' ),
            'section'     => 'newspaper_lite_top_header_section',
            'choices'     => array(
                'l, F d, Y' => esc_html__( 'Format 1 (dd,mm,yy)', 'newspaper-lite' ),
                'l, Y, F d' => esc_html__( 'Format 2 (dd,yy,mm)', 'newspaper-lite' ),
                'Y, F d, l' => esc_html__( 'Format 3 (yy,mm,dd)', 'newspaper-lite' ),
            ),
            'priority'    => 50
        )
    );


    // Option about top header social icons
    $wp_customize->add_setting(
        'newspaper_lite_header_social_option',
        array(
            'default' => 'enable',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
            'sanitize_callback' => 'newspaper_lite_enable_switch_sanitize'
        )
    );
    $wp_customize->add_control(new Newspaper_Lite_Customize_Switch_Control(
            $wp_customize,
            'newspaper_lite_header_social_option',
            array(
                'type' => 'switch',
                'label' => esc_html__('Social Icon Option', 'newspaper-lite'),
                'description' => esc_html__('Enable/disable social icons from top header (right).', 'newspaper-lite'),
                'priority' => 60,
                'section' => 'newspaper_lite_top_header_section',
                'choices' => array(
                    'enable' => esc_html__('Enable', 'newspaper-lite'),
                    'disable' => esc_html__('Disable', 'newspaper-lite')
                )
            )
        )
    );

    /*----------------------------------------------------------------------------------------------------*/

    $wp_customize->get_section( 'title_tagline' )->panel        = 'newspaper_lite_header_settings_panel';
    $wp_customize->get_section( 'title_tagline' )->priority     = '40';

    /*----------------------------------------------------------------------------------------------------*/
    
    /**
     * Main Navigation Header
     */
    $wp_customize->add_section(
        'newspaper_lite_navigation_header_section',
        array(
            'title' => esc_html__('Main Navigation', 'newspaper-lite'),
            'priority' => 50,
            'panel' => 'newspaper_lite_header_settings_panel'
        )
    );

    //Sticky header option
    $wp_customize->add_setting(
        'newspaper_lite_sticky_option',
        array(
            'default' => 'enable',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'newspaper_lite_enable_switch_sanitize'
        )
    );
    $wp_customize->add_control(new Newspaper_Lite_Customize_Switch_Control(
            $wp_customize,
            'newspaper_lite_sticky_option',
            array(
                'type' => 'switch',
                'label' => esc_html__('Menu Sticky', 'newspaper-lite'),
                'description' => esc_html__('Enable/disable option for Menu Sticky', 'newspaper-lite'),
                'priority' => 10,
                'section' => 'newspaper_lite_navigation_header_section',
                'choices' => array(
                    'enable' => esc_html__('Enable', 'newspaper-lite'),
                    'disable' => esc_html__('Disable', 'newspaper-lite')
                )
            )
        )
    );

    /*----------------------------------------------------------------------------------------------------*/
    /**
     * Banner Ad settings
     */
    $wp_customize->add_section(
        'newspaper_lite_banner_ads_section',
        array(
            'title' => esc_html__('Banner Ads Section', 'newspaper-lite'),
            'priority' => 60,
            'panel' => 'newspaper_lite_header_settings_panel'
        )
    );

    //Adsence Option
    $wp_customize->add_setting(
        'newspaper_lite_google_ad_option',
        array(
            'default' => 'disable',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'newspaper_lite_enable_switch_sanitize'
        )
    );
    $wp_customize->add_control(new Newspaper_Lite_Customize_Switch_Control(
            $wp_customize,
            'newspaper_lite_google_ad_option',
            array(
                'type' => 'switch',
                'label' => esc_html__('Google Ads', 'newspaper-lite'),
                'description' => esc_html__('Enable/disable responsive google ad (adsence) on banner. Please enable only if you want to show responsive google ad on banner ads section.', 'newspaper-lite'),
                'priority' => 10,
                'section' => 'newspaper_lite_banner_ads_section',
                'choices' => array(
                    'enable' => esc_html__('Enable', 'newspaper-lite'),
                    'disable' => esc_html__('Disable', 'newspaper-lite')
                )
            )
        )
    );

    /*----------------------------------------------------------------------------------------------------*/

}
