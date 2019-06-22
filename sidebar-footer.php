<?php
/**
 * The Sidebar containing the footer widget areas.
 *
 * @package themecentury
 * @subpackage Newspaper Lite
 * @since 1.0.0
 */

/**
 * The footer widget area is triggered if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */
 
if( !is_active_sidebar( 'newspaper_lite_footer_one' ) &&
	!is_active_sidebar( 'newspaper_lite_footer_two' ) &&
    !is_active_sidebar( 'newspaper_lite_footer_three' ) &&
    !is_active_sidebar( 'newspaper_lite_footer_four' ) ) {
	return;
}
$newspaper_lite_footer_layout = get_theme_mod( 'footer_widget_option', 'column3' );
?>
<div id="top-footer" class="footer-widgets-wrapper clearfix  <?php echo esc_attr( $newspaper_lite_footer_layout ); ?>">
	<div class="mgs-container">
		<div class="footer-widgets-area clearfix">
            <div class="mgs-footer-widget-wrapper clearfix">
            		<div class="mgs-first-footer-widget mgs-footer-widget">
            			<?php
                			if ( !dynamic_sidebar( 'newspaper_lite_footer_one' ) ):
                			endif;
            			?>
            		</div>
        		<?php if( $newspaper_lite_footer_layout != 'column1' ){ ?>
                    <div class="mgs-second-footer-widget mgs-footer-widget">
            			<?php
                			if ( !dynamic_sidebar( 'newspaper_lite_footer_two' ) ):
                			endif;
            			?>
            		</div>
                <?php } ?>
                <?php if( $newspaper_lite_footer_layout == 'column3' || $newspaper_lite_footer_layout == 'column4' ){ ?>
                    <div class="mgs-third-footer-widget mgs-footer-widget">
                       <?php
                           if ( !dynamic_sidebar( 'newspaper_lite_footer_three' ) ):
                           endif;
                       ?>
                    </div>
                <?php } ?>
                <?php if( $newspaper_lite_footer_layout == 'column4' ){ ?>
                    <div class="mgs-fourth-footer-widget mgs-footer-widget">
                       <?php
                           if ( !dynamic_sidebar( 'newspaper_lite_footer_four' ) ):
                           endif;
                       ?>
                    </div>
                <?php } ?>
            </div><!-- .mgs-footer-widget-wrapper -->
		</div><!-- .footer-widgets-area -->
	</div><!-- .nt-container -->
</div><!-- #top-footer -->