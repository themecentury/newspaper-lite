<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package themecentury
 * @subpackage Newspaper Lite
 * @since 1.0.0
 */

get_header(); ?>
	<div id="primary404" class="content-area">
		<main id="main" class="site-main" role="main">
			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'newspaper-lite' ); ?></h1>
				</header><!-- .page-header -->
				<div class="error-num"> <?php esc_html_e( '404', 'newspaper-lite' ); ?>
					<span><?php esc_html_e( 'error', 'newspaper-lite' ); ?></span></div>
				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'newspaper-lite' ); ?></p>
				</div><!-- .page-content -->
				<?php get_search_form(); ?>
			</section><!-- .error-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
<?php
get_footer();
