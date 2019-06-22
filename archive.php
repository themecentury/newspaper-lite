<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package themecentury
 * @subpackage Newspaper Lite
 * @since 1.0.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			$mgs_cat_id = get_query_var( 'cat' );
			if ( have_posts() ) : ?>

				<header class="page-header mgs-cat-<?php echo esc_attr( $mgs_cat_id ); ?>">
					<h1 class="page-title mgs-archive-title"><?php the_archive_title(); ?></h1>
				</header><!-- .page-header -->
				<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>

				<div class="archive-content-wrapper clearfix">
					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();
						/*
						* Include the Post-Format-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Format name) and that will be used instead.
						*/
						get_template_part( 'template-parts/content', get_post_format() );

					endwhile;

					the_posts_pagination();
					?>
				</div><!-- .archive-content-wrapper -->
				<?php
			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
newspaper_lite_sidebar();
get_footer();
