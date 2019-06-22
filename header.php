<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package themecentury
 * @subpackage Newspaper Lite
 * @since 1.0.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action('newspaper_lite_before_page'); ?>
<div id="page" class="site">
    <?php do_action('newspaper_lite_before_header'); ?>
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'newspaper-lite'); ?></a>
    <header id="masthead" class="site-header">
        <?php get_template_part('template-parts/header/header', 'image'); ?>
        <?php do_action('newspaper_lite_news_ticker'); ?>
        <div class="top-header-section">
            <div class="mgs-container">
                <div class="top-left-header">
                    <?php do_action('newspaper_lite_current_date'); ?>
                    <nav id="top-header-navigation" class="top-navigation">
                        <?php wp_nav_menu(array('theme_location' => 'top-header',
                            'container_class' => 'top-menu',
                            'fallback_cb' => false,
                            'items_wrap' => '<ul>%3$s</ul>'
                        )); ?>
                    </nav>
                </div>
                <?php do_action('newspaper_lite_top_social_icons'); ?>
            </div> <!-- mgs-container end -->
        </div><!-- .top-header-section -->

        <div class="logo-ads-wrapper clearfix">
            <div class="mgs-container">
                <div class="site-branding">
                    <?php if (the_custom_logo()) { ?>
                        <div class="site-logo">
                            <?php the_custom_logo(); ?>
                        </div><!-- .site-logo -->
                    <?php } ?>
                    <?php
                    $site_title_option = get_theme_mod('header_textcolor');
                    if ($site_title_option != 'blank') {
                        ?>
                        <div class="site-title-wrapper">
                            <?php
                            if (is_front_page() && is_home()) : ?>
                                <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                                          rel="home"><?php bloginfo('name'); ?></a></h1>
                            <?php else : ?>
                                <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                                         rel="home"><?php bloginfo('name'); ?></a></p>
                            <?php
                            endif;

                            $description = get_bloginfo('description', 'display');
                            if ($description || is_customize_preview()) : ?>
                                <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                            <?php
                            endif; ?>
                        </div><!-- .site-title-wrapper -->
                        <?php
                    }
                    ?>
                </div><!-- .site-branding -->
                <?php
                $newspaper_lite_google_ad_option = get_theme_mod('newspaper_lite_google_ad_option', 'disable');
                ?>
                <div class="header-ads-wrapper <?php if ($newspaper_lite_google_ad_option === 'enable') {
                    echo 'google-adsence';
                } ?>">
                    <?php
                    if (is_active_sidebar('newspaper_lite_header_ads_area')) {
                        if (!dynamic_sidebar('newspaper_lite_header_ads_area')):
                        endif;
                    } ?>
                </div><!-- .header-ads-wrapper -->
            </div>
        </div><!-- .logo-ads-wrapper -->

        <div id="mgs-menu-wrap" class="bottom-header-wrapper clearfix">
            <div class="mgs-container">
                <div class="home-icon"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"> <i
                                class="fa fa-home"> </i> </a></div>
                <a href="javascript:void(0)" class="menu-toggle"> <i class="fa fa-navicon"> </i> </a>
                <nav id="site-navigation" class="main-navigation">
                    <?php wp_nav_menu(array('theme_location' => 'primary',
                        'container_class' => 'menu',
                        'items_wrap' => '<ul>%3$s</ul>'
                    )); ?>
                </nav><!-- #site-navigation -->
                <div class="header-search-wrapper">
                    <span class="search-main"><i class="fa fa-search"></i></span>
                    <div class="search-form-main clearfix">
                        <?php get_search_form(); ?>
                    </div>
                </div><!-- .header-search-wrapper -->
            </div><!-- .mgs-container -->
        </div><!-- #mgs-menu-wrap -->


    </header><!-- #masthead -->
    <?php do_action('newspaper_lite_after_header'); ?>
    <?php do_action('newspaper_lite_before_main'); ?>

    <div id="content" class="site-content">
        <div class="mgs-container">
