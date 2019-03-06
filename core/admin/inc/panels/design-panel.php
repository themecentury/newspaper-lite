<?php
/**
 * Customizer option for Design Settings
 *
 * @package Mirrorgrid Store
 * @subpackage Newspaper Lite
 * @since 1.0.0
 */

add_action( 'customize_register', 'newspaper_lite_design_settings_register' );

function newspaper_lite_design_settings_register( $wp_customize ) {

	/**
	 * Add Design Panel
	 */
	$wp_customize->add_panel(
		'newspaper_lite_design_settings_panel',
		array(
			'priority'       => 6,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Design Settings', 'newspaper-lite' ),
		)
	);

	/*--------------------------------------------------------------------------------*/
	/**
	 * Archive page Settings
	 */
	$wp_customize->add_section(
		'newspaper_lite_archive_section',
		array(
			'title'    => esc_html__( 'Archive Settings', 'newspaper-lite' ),
			'priority' => 10,
			'panel'    => 'newspaper_lite_design_settings_panel'
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
			'priority'    => 5
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
			'priority' => 15,
			'panel'    => 'newspaper_lite_design_settings_panel'
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
				'priority'    => 5,
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
				'priority'    => 7,
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
			'priority' => 20,
			'panel'    => 'newspaper_lite_design_settings_panel'
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

	/*--------------------------------------------------------------------------------------------------------*/
	/**
	 * Footer widget area
	 */
	$wp_customize->add_section(
		'newspaper_lite_footer_widget_section',
		array(
			'title'    => esc_html__( 'Footer Settings', 'newspaper-lite' ),
			'priority' => 25,
			'panel'    => 'newspaper_lite_design_settings_panel'
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
			'priority'    => 4,
			'label'       => esc_html__( 'Footer Widget Area', 'newspaper-lite' ),
			'description' => esc_html__( 'Choose option to display number of columns in footer area.', 'newspaper-lite' ),
			'section'     => 'newspaper_lite_footer_widget_section',
			'choices'     => array(
				'column1' => esc_html__( 'One Column', 'newspaper-lite' ),
				'column2' => esc_html__( 'Two Columns', 'newspaper-lite' ),
				'column3' => esc_html__( 'Three Columns', 'newspaper-lite' ),
				'column4' => esc_html__( 'Four Columns', 'newspaper-lite' ),
			),
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
			'section'  => 'newspaper_lite_footer_widget_section',
			'priority' => 5
		)
	);

	//Website Skin
	$wp_customize->add_section(
		'newspaper_lite_website_skin_section',
		array(
			'title'    => esc_html__( 'Website Skin', 'newspaper-lite' ),
			'priority' => 26,
			'panel'    => 'newspaper_lite_design_settings_panel'
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
    /* --------------------------------------------------------------------------------------------------------------- */
    /**
     * Title Style
     */
    $wp_customize->add_section(
        'newspaper_lite_site_title_design', array(
            'title'       => __( 'Title Style', 'newspaper-lite' ),
            'description' => __( 'Design option of title style', 'newspaper-lite'),
            'priority'    => 26,
            'panel'       => 'newspaper_lite_design_settings_panel',
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
            'title'       => __( 'Title font case', 'newspaper-lite' ),
            'description' => __( 'Design of font case style', 'newspaper-lite'),
            'priority'    => 27,
            'panel'       => 'newspaper_lite_design_settings_panel',
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
            'label'    => __( 'Title font case styles', 'newspaper-lite' ),
            'section'  => 'newspaper_lite_site_title_design',
            'choices'  => newspaper_lite_site_title_design_case(),
        )
    );


}
