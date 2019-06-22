<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package themecentury
 * @subpackage Newspaper Lite
 * @since 1.0.0
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php do_action( 'newspaper_lite_before_sidebar' ); ?>
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<?php do_action( 'newspaper_lite_before_sidebar' ); ?>
</aside><!-- #secondary -->
