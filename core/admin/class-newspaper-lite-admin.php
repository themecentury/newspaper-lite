<?php
/**
 * Newspaper_Lite Admin Class.
 *
 * @author  themecentury
 * @package Newspaper_Lite
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Newspaper_Lite_Admin' ) ) :

	/**
	 * Newspaper_Lite_Admin Class.
	 */
	class Newspaper_Lite_Admin {

		/**
		 * Constructor.
		 */
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'admin_menu' ) );
			add_action( 'wp_loaded', array( __CLASS__, 'hide_notices' ) );
			add_action( 'load-themes.php', array( $this, 'admin_notice' ) );
		}

		/**
		 * Add admin menu.
		 */
		public function admin_menu() {
			$theme = wp_get_theme( get_stylesheet() );
			$page = add_theme_page( esc_html__( 'About', 'newspaper-lite' ) . ' ' . $theme->display( 'Name' ), esc_html__( 'About', 'newspaper-lite' ) . ' ' . $theme->display( 'Name' ), 'activate_plugins', 'newspaper-lite-welcome', array(
				$this,
				'welcome_screen'
			) );
			add_action( 'admin_print_styles-' . $page, array( $this, 'enqueue_styles' ) );
		}

		/**
		 * Enqueue styles.
		 */
		public function enqueue_styles() {
			global $newspaper_lite_version;

			wp_enqueue_style( 'newspaper-lite-welcome-admin', get_template_directory_uri() . '/core/admin/assets/css/welcome-admin.css', array(), $newspaper_lite_version );
		}

		/**
		 * Add admin notice.
		 */
		public function admin_notice() {
			global $newspaper_lite_version, $pagenow;
			wp_enqueue_style( 'newspaper-lite-message', get_template_directory_uri() . '/inc/admin/css/admin-notices.css', array(), $newspaper_lite_version );

			// Let's bail on theme activation.
			if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
				add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
				update_option( 'newspaper_lite_admin_notice_welcome', 1 );

				// No option? Let run the notice wizard again..
			} elseif ( ! get_option( 'newspaper_lite_admin_notice_welcome' ) ) {
				add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
			}
		}

		/**
		 * Hide a notice if the GET variable is set.
		 */
		public static function hide_notices() {
			if ( isset( $_GET['newspaper-lite-hide-notice'] ) && isset( $_GET['_newspaper_lite_notice_nonce'] ) ) {
				if ( ! wp_verify_nonce( wp_unslash( $_GET['_newspaper_lite_notice_nonce'] ), 'newspaper_lite_hide_notices_nonce' ) ) {
					wp_die( esc_html__( 'Action failed. Please refresh the page and retry.', 'newspaper-lite' ) );
				}

				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( esc_html__( 'Cheatin&#8217; huh?', 'newspaper-lite' ) );
				}

				$hide_notice = sanitize_text_field( wp_unslash( $_GET['newspaper-lite-hide-notice'] ) );
				update_option( 'newspaper_lite_admin_notice_' . $hide_notice, 1 );
			}
		}

		/**
		 * Show welcome notice.
		 */
		public function welcome_notice() {
			?>
			<div id="message" class="updated newspaper-lite-message">
				<a class="newspaper-lite-message-close notice-dismiss"
				   href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'newspaper-lite-hide-notice', 'welcome' ) ), 'newspaper_lite_hide_notices_nonce', '_newspaper_lite_notice_nonce' ) ); ?>"><?php esc_html_e( 'Dismiss', 'newspaper-lite' ); ?></a>
				<p><?php
					/* translators: 1: anchor tag start, 2: anchor tag end*/
					printf( esc_html__( 'Welcome! Thank you for choosing newspaper lite! To fully take advantage of the best our theme can offer please make sure you visit our %1$swelcome page%1$s.', 'newspaper-lite' ), '<a href="' . esc_url( admin_url( 'themes.php?page=newspaper-lite-welcome' ) ) . '">', '</a>' );
					?></p>
				<p class="submit">
					<a class="button-secondary"
					   href="<?php echo esc_url( admin_url( 'themes.php?page=newspaper-lite-welcome' ) ); ?>"><?php esc_html_e( 'Get started with Newspaper_Lite', 'newspaper-lite' ); ?></a>
				</p>
			</div>
			<?php
		}

		/**
		 * Intro text/links shown to all about pages.
		 *
		 * @access private
		 */
		private function intro() {
			global $newspaper_lite_version;
			$theme = wp_get_theme( get_stylesheet() );

			// Drop minor version if 0
			//$major_version = substr( $newspaper_lite_version, 0, 3 );
			?>
			<div class="newspaper-lite-theme-info">
				<h1>
					<?php esc_html_e( 'About', 'newspaper-lite' ); ?>
					<?php echo esc_html( $theme->display( 'Name' ) ); ?>
					<?php printf( esc_html__(' %s', 'newspaper-lite'), $newspaper_lite_version ); ?>
				</h1>

				<div class="welcome-description-wrap">
					<div class="about-text"><?php echo esc_html( $theme->display( 'Description' ) ); ?></div>

					<div class="newspaper-lite-screenshot">
						<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>"/>
					</div>
				</div>
			</div>

			<p class="newspaper-lite-actions">
				<a href="<?php echo esc_url( 'https://themecentury.com/downloads/newspaper-lite-free-wordpress-theme/' ); ?>"
				   class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Info', 'newspaper-lite' ); ?></a>
				<a href="<?php echo esc_url( apply_filters( 'newspaper_lite_theme_url', 'https://demo.themecentury.com/wpthemes/newspaper-lite/' ) ); ?>"
				   class="button button-secondary docs"
				   target="_blank"><?php esc_html_e( 'View Demo', 'newspaper-lite' ); ?></a>

				<a href="<?php echo esc_url( apply_filters( 'newspaper_lite_rate_url', 'https://wordpress.org/support/view/theme-reviews/newspaper-lite?filter=5#postform' ) ); ?>"
				   class="button button-secondary docs"
				   target="_blank"><?php esc_html_e( 'Rate this theme', 'newspaper-lite' ); ?></a>
				<a href="<?php echo esc_url( apply_filters( 'newspaper_plus_theme_url', 'https://themecentury.com/downloads/newspaper-plus-premium-wordpress-theme/' ) ); ?>"
				   class="button button-primary docs"
				   target="_blank"><?php esc_html_e( 'View Pro Version', 'newspaper-lite' ); ?></a>
			</p>

			<h2 class="nav-tab-wrapper">
				<a class="nav-tab <?php if ( empty( $_GET['tab'] ) && $_GET['page'] == 'newspaper-lite-welcome' ) {
					echo 'nav-tab-active';
				} ?>"
				   href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'newspaper-lite-welcome' ), 'themes.php' ) ) ); ?>">
					<?php echo $theme->display( 'Name' ); ?>
				</a>
				<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'changelog' ) {
					echo 'nav-tab-active';
				} ?>" href="<?php echo esc_url( admin_url( add_query_arg( array(
					'page' => 'newspaper-lite-welcome',
					'tab'  => 'changelog'
				), 'themes.php' ) ) ); ?>">
					<?php esc_html_e( 'Changelog', 'newspaper-lite' ); ?>
				</a>
				<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'freevspro' ) {
					echo 'nav-tab-active';
				} ?>" href="<?php echo esc_url( admin_url( add_query_arg( array(
					'page' => 'newspaper-lite-welcome',
					'tab'  => 'freevspro'
				), 'themes.php' ) ) ); ?>">
					<?php esc_html_e( 'Free Vs Pro', 'newspaper-lite' ); ?>
				</a>
			</h2>
			<?php
		}

		/**
		 * Welcome screen page.
		 */
		public function welcome_screen() {
			$current_tab = empty( $_GET['tab'] ) ? 'about' : sanitize_title( wp_unslash( $_GET['tab'] ) );

			// Look for a {$current_tab}_screen method.
			if ( is_callable( array( $this, $current_tab . '_screen' ) ) ) {
				return $this->{$current_tab . '_screen'}();
			}

			// Fallback to about screen.
			return $this->about_screen();
		}

		/**
		 * Output the about screen.
		 */
		public function about_screen() {
			$theme = wp_get_theme( get_template() );
			?>
			<div class="wrap about-wrap">

				<?php $this->intro(); ?>

				<div class="changelog point-releases">
					<div class="under-the-hood two-col">

						<div class="col">
							<h3><?php esc_html_e( 'Theme Customizer', 'newspaper-lite' ); ?></h3>
							<p><?php esc_html_e( 'All Theme Options are available via Customize screen.', 'newspaper-lite' ) ?></p>
							<p><a href="<?php echo admin_url( 'customize.php' ); ?>"
							      class="button button-secondary"><?php esc_html_e( 'Customize', 'newspaper-lite' ); ?></a>
							</p>
						</div>

						<div class="col">
							<h3><?php esc_html_e( 'Documentation', 'newspaper-lite' ); ?></h3>
							<p><?php esc_html_e( 'Please view our documentation page to setup the theme.', 'newspaper-lite' ) ?></p>
							<p><a href="<?php echo esc_url( 'https://docs.themecentury.com/products/newspaper-lite/' ); ?>"
							      class="button button-secondary"><?php esc_html_e( 'Documentation', 'newspaper-lite' ); ?></a>
							</p>
						</div>

						<div class="col">
							<h3><?php esc_html_e( 'Got theme support question?', 'newspaper-lite' ); ?></h3>
							<p><?php esc_html_e( 'Please put it in our dedicated support forum.', 'newspaper-lite' ) ?></p>
							<p><a href="<?php echo esc_url( 'https://themecentury.com/forums/forum/newspaper-lite-free-wordpress-theme/' ); ?>"
							      class="button button-secondary"><?php esc_html_e( 'Support', 'newspaper-lite' ); ?></a></p>
						</div>

						<div class="col">
							<h3><?php esc_html_e( 'Any question about this theme or us?', 'newspaper-lite' ); ?></h3>
							<p><?php esc_html_e( 'Please send it via our sales contact page.', 'newspaper-lite' ) ?></p>
							<p><a href="<?php echo esc_url( 'https://themecentury.com/contact/' ); ?>"
							      class="button button-secondary"><?php esc_html_e( 'Contact Page', 'newspaper-lite' ); ?></a>
							</p>
						</div>

						<div class="col">
							<h3>
								<?php
								esc_html_e( 'Translate', 'newspaper-lite' );
								echo ' ' . $theme->display( 'Name' );
								?>
							</h3>
							<p><?php esc_html_e( 'Click below to translate this theme into your own language.', 'newspaper-lite' ) ?></p>
							<p>
								<a href="<?php echo esc_url( 'https://translate.wordpress.org/projects/wp-themes/newspaper-lite' ); ?>"
								   class="button button-secondary">
									<?php
									esc_html_e( 'Translate', 'newspaper-lite' );
									echo ' ' . $theme->display( 'Name' );
									?>
								</a>
							</p>
						</div>
					</div>
				</div>

				<div class="return-to-dashboard newspaper-lite">
					<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
						<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
							<?php is_multisite() ? esc_html_e( 'Return to Updates', 'newspaper-lite' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'newspaper-lite' ); ?>
						</a> |
					<?php endif; ?>
					<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'newspaper-lite' ) : esc_html_e( 'Go to Dashboard', 'newspaper-lite' ); ?></a>
				</div>
			</div>
			<?php
		}

		/**
		 * Output the changelog screen.
		 */
		public function changelog_screen() {
			global $wp_filesystem;

			?>
			<div class="wrap about-wrap">

				<?php $this->intro(); ?>

				<p class="about-description"><?php esc_html_e( 'View changelog below:', 'newspaper-lite' ); ?></p>

				<?php
				$changelog_file = apply_filters( 'newspaper_lite_changelog_file', get_template_directory() . '/readme.txt' );

				// Check if the changelog file exists and is readable.
				if ( $changelog_file && is_readable( $changelog_file ) ) {
					WP_Filesystem();
					$changelog      = $wp_filesystem->get_contents( $changelog_file );
					$changelog_list = $this->parse_changelog( $changelog );

					echo wp_kses_post( $changelog_list );
				}
				?>
			</div>
			<?php
		}

		/**
		 * Output the changelog screen.
		 */
		public function freevspro_screen() {
			?>
			<div class="wrap about-wrap">

				<?php $this->intro(); ?>

				<p class="about-description"><?php esc_html_e( 'Upgrade to PRO version for more awesome features.', 'newspaper-lite' ); ?></p>

				<table>
					<thead>
					<tr>
						<th class="table-feature-title"><h3><?php esc_html_e( 'Features', 'newspaper-lite' ); ?></h3></th>
						<th><h3><?php esc_html_e( 'Newspaper Lite', 'newspaper-lite' ); ?></h3></th>
						<th><h3><?php esc_html_e( 'Newspaper Plus', 'newspaper-lite' ); ?></h3></th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td><h3><?php esc_html_e( 'Support', 'newspaper-lite' ); ?></h3></td>
						<td><?php esc_html_e( 'Forum', 'newspaper-lite' ); ?></td>
						<td><?php esc_html_e( 'Forum + Emails/Support Ticket', 'newspaper-lite' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Category color options', 'newspaper-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Additional color options', 'newspaper-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><?php esc_html_e( '15', 'newspaper-lite' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Primary color option', 'newspaper-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Font size options', 'newspaper-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Google fonts options', 'newspaper-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><?php esc_html_e( '500+', 'newspaper-lite' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Custom widgets', 'newspaper-lite' ); ?></h3></td>
						<td><?php esc_html_e( '7', 'newspaper-lite' ); ?></td>
						<td><?php esc_html_e( '16', 'newspaper-lite' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Social icons', 'newspaper-lite' ); ?></h3></td>
						<td><?php esc_html_e( '6', 'newspaper-lite' ); ?></td>
						<td><?php esc_html_e( '6', 'newspaper-lite' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Social sharing', 'newspaper-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Site layout option', 'newspaper-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Options in breaking news', 'newspaper-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Change read more text', 'newspaper-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Related posts', 'newspaper-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Author biography', 'newspaper-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Footer copyright editor', 'newspaper-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( '728x90 Advertisement', 'newspaper-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Featured category slider', 'newspaper-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Random posts widget', 'newspaper-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Tabbed widget', 'newspaper-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Videos', 'newspaper-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e( 'WooCommerce compatible', 'newspaper-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Multiple header options', 'newspaper-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Readmore flying card', 'newspaper-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Weather widget', 'newspaper-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Currency converter widget', 'newspaper-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Category enable/disable option', 'newspaper-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Reading indicator option', 'newspaper-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Lightbox support', 'newspaper-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Call to action widget', 'newspaper-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Contact us template', 'newspaper-lite' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td class="btn-wrapper">
							<a href="<?php echo esc_url( apply_filters( 'newspaper_pro_theme_url', 'https://themecentury.com/downloads/newspaper-plus-premium-wordpress-theme/' ) ); ?>"
							   class="button button-secondary docs"
							   target="_blank"><?php esc_html_e( 'View Pro', 'newspaper-lite' ); ?></a>
						</td>
					</tr>
					</tbody>
				</table>

			</div>
			<?php
		}

		/**
		 * Parse changelog from readme file.
		 *
		 * @param  string $content
		 *
		 * @return string
		 */
		private function parse_changelog( $content ) {
			$matches   = null;
			$regexp    = '~==\s*Changelog\s*==(.*)($)~Uis';
			$changelog = '';

			if ( preg_match( $regexp, $content, $matches ) ) {
				$changes = explode( '\r\n', trim( $matches[1] ) );

				$changelog .= '<pre class="changelog">';

				foreach ( $changes as $index => $line ) {
					$changelog .= wp_kses_post( preg_replace( '~(=\s*Version\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line ) );
				}

				$changelog .= '</pre>';
			}

			return wp_kses_post( $changelog );
		}


		/**
		 * Output the supported plugins screen.
		 */
		public function supported_plugins_screen() {
			?>
			<div class="wrap about-wrap">

				<?php $this->intro(); ?>

				<p class="about-description"><?php esc_html_e( 'This theme recommends following plugins:', 'newspaper-lite' ); ?></p>
				<ol>
					<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/social-icons/' ); ?>"
					       target="_blank"><?php esc_html_e( 'Social Icons', 'newspaper-lite' ); ?></a>
						<?php esc_html_e( ' by themecentury', 'newspaper-lite' ); ?>
					</li>
					<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/easy-social-sharing/' ); ?>"
					       target="_blank"><?php esc_html_e( 'Easy Social Sharing', 'newspaper-lite' ); ?></a>
						<?php esc_html_e( ' by themecentury', 'newspaper-lite' ); ?>
					</li>
					<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/contact-form-7/' ); ?>"
					       target="_blank"><?php esc_html_e( 'Contact Form 7', 'newspaper-lite' ); ?></a></li>
					<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/wp-pagenavi/' ); ?>"
					       target="_blank"><?php esc_html_e( 'WP-PageNavi', 'newspaper-lite' ); ?></a></li>
					<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/woocommerce/' ); ?>"
					       target="_blank"><?php esc_html_e( 'WooCommerce', 'newspaper-lite' ); ?></a></li>
					<li>
						<a href="<?php echo esc_url( 'https://wordpress.org/plugins/polylang/' ); ?>"
						   target="_blank"><?php esc_html_e( 'Polylang', 'newspaper-lite' ); ?></a>
						<?php esc_html_e( 'Fully Compatible in Pro Version', 'newspaper-lite' ); ?>
					</li>
					<li>
						<a href="<?php echo esc_url( 'https://wpml.org/' ); ?>"
						   target="_blank"><?php esc_html_e( 'WPML', 'newspaper-lite' ); ?></a>
						<?php esc_html_e( 'Fully Compatible in Pro Version', 'newspaper-lite' ); ?>
					</li>
				</ol>

			</div>
			<?php
		}

	}

endif;

return new Newspaper_Lite_Admin();
