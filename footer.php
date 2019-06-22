<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package themecentury
 * @subpackage Newspaper Lite
 * @since 1.0.0
 */

?>
		</div><!--.mgs-container-->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
			<?php get_sidebar( 'footer' ); ?>
			<div id="bottom-footer" class="sub-footer-wrapper clearfix">
				<div class="mgs-container">
					<div class="site-info">
						<span class="copy-info"><?php echo esc_html( get_theme_mod( 'newspaper_lite_copyright_text', esc_html__( '2018 newspaper-lite', 'newspaper-lite' ) ) ); ?></span>
						<span class="sep"> | </span>
						<?php
							$newspaper_lite_theme_author = esc_url( 'http://themecentury.com/' );
						/* translators: %s: theme author */
							printf( esc_html__( 'Newspaper Lite by %1$s.', 'newspaper-lite' ), '<a href="'.$newspaper_lite_theme_author.'" >themecentury</a>' );
						?>
					</div><!-- .site-info -->
					<nav id="footer-navigation" class="sub-footer-navigation" >
						<?php wp_nav_menu( array( 'theme_location' => 'footer', 'container_class' => 'footer-menu', 'fallback_cb' => false, 'items_wrap' => '<ul>%3$s</ul>' ) ); ?>
					</nav>
				</div>
			</div><!-- .sub-footer-wrapper -->
	</footer><!-- #colophon -->
	<div id="mgs-scrollup" class="animated arrow-hide"><i class="fa fa-chevron-up"></i></div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
