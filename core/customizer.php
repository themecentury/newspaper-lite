<?php
/**
 * Newspaper Lite Theme Customizer.
 *
 * @package themecentury
 * @subpackage Newspaper Lite
 * @since 1.0.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function newspaper_lite_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'newspaper_lite_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function newspaper_lite_customize_preview_js() {
	global $newspaper_lite_version;
	wp_enqueue_script( 'newspaper_lite_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), esc_attr( $newspaper_lite_version ), true );
}
add_action( 'customize_preview_init', 'newspaper_lite_customize_preview_js' );

/**
 * Customizer Callback functions
 */
function newspaper_lite_related_articles_option_callback( $control ) {
    if ( $control->manager->get_setting( 'newspaper_lite_related_articles_option' )->value() != 'disable' ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Load customizer panels
 */
require get_template_directory() . '/core/admin/inc/upsell/upsell-section.php'; //header settings panel
require get_template_directory() . '/core/admin/inc/panels/header-panel.php'; //header settings panel
require get_template_directory() . '/core/admin/inc/panels/template-panel.php'; //Template settings panel
require get_template_directory() . '/core/admin/inc/panels/options-panel.php'; //Options settings panel
require get_template_directory() . '/core/admin/inc/panels/additional-panel.php'; //Additional settings panel
require get_template_directory() . '/core/admin/inc/panels/color-panel.php'; //Color settings panel
require get_template_directory() . '/core/admin/inc/panels/footer-panel.php'; //Footer Settings panel

