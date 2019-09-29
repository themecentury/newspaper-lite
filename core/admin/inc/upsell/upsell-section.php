<?php
/**
 * Define customizer Custom classes
 *
 * @package themecentury
 * @subpackage Newspaper Plus
 * @since 1.0.0
 */
if( ! function_exists( 'newspaper_lite_customizer_upsell_section' ) ):

	function newspaper_lite_customizer_upsell_section($wp_customize){

		require_once get_template_directory() . '/core/admin/inc/upsell/newspaper-lite-upsell-control.php'; //upsell section

		$wp_customize->register_section_type( 'Newspaper_Lite_Customize_Upsell_Section' );

		// Register sections.
		$wp_customize->add_section(
			new Newspaper_Lite_Customize_Upsell_Section(
				$wp_customize,
				'theme_upsell',
				array(
					'title'    => esc_html__( 'Newspaper Plus', 'newspaper-lite' ),
					'pro_text' => esc_html__( 'View Pro', 'newspaper-lite' ),
					'pro_url'  => 'https://themecentury.com/downloads/newspaper-plus-premium-wordpress-theme/?ref=newspaper-lite-upsell-button',
					'priority' => 10,
				)
			)
		);

	}

endif;

add_action( 'customize_register', 'newspaper_lite_customizer_upsell_section' );
