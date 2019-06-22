<?php
/**
 * Newspaper Lite functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package themecentury
 * @subpackage Newspaper Lite
 * @since 1.0.0
 */

if (!function_exists('newspaper_lite_sass_darken')) :
    function newspaper_lite_sass_darken($hex, $percent)
    {
        preg_match('/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $hex, $primary_colors);
        str_replace('%', '', $percent);
        $color = "#";
        for ($i = 1; $i <= 3; $i++) {
            $rgb = hexdec($primary_colors[$i]);
            $calculated_color = round($rgb * (100 - ($percent * 2)) / 100);
            $calculated_color = $calculated_color < 0 ? 0 : $calculated_color;
            $color .= str_pad(dechex($calculated_color), 2, '0', STR_PAD_LEFT);
        }

        return $color;
    }
endif;
if (!function_exists('newspaper_lite_sass_lighten')) :
    function newspaper_lite_sass_lighten($hex, $percent)
    {
        if (!$hex) {
            return;
        }
        preg_match('/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $hex, $primary_colors);
        str_replace('%', '', $percent);
        $color = "#";
        for ($i = 1; $i <= 3; $i++) {
            $rgb = hexdec($primary_colors[$i]);
            $calculated_color = round((int)$rgb * (100 + (int)$percent) / 100);
            $calculated_color = $calculated_color > 254 ? 255 : $calculated_color;
            $color .= str_pad(dechex($calculated_color), 2, '0', STR_PAD_LEFT);
        }

        return $color;
    }

endif;
if (!function_exists('newspaper_lite_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function newspaper_lite_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Newspaper Lite, use a find and replace
         * to change 'newspaper-lite' to the name of your theme in all the template files.
         */
        load_theme_textdomain('newspaper-lite', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for custom logo.
         */
        add_theme_support('custom-logo', array(
            'height' => 175,
            'width' => 400,
            'flex-width' => true,
            'flex-height' => true
        ));

        add_image_size('newspaper-lite-slider-large', 1020, 741, true);
        add_image_size('newspaper-lite-featured-medium', 420, 307, true);
        add_image_size('newspaper-lite-featured-long', 300, 443, true);
        add_image_size('newspaper-lite-block-medium', 464, 290, true);
        add_image_size('newspaper-lite-carousel-image', 600, 500, true);
        add_image_size('newspaper-lite-block-thumb', 322, 230, true);
        add_image_size('newspaper-lite-single-large', 1210, 642, true);

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'newspaper-lite'),
            'top-header' => esc_html__('Top Header Menu', 'newspaper-lite'),
            'footer' => esc_html__('Footer Menu', 'newspaper-lite'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        /*
         * Enable support for Post Formats.
         * See https://developer.wordpress.org/themes/functionality/post-formats/
         */
        add_theme_support('post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('newspaper_lite_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        /*
         * This theme styles the visual editor to resemble the theme style,
         * specifically font, colors, and column width.
          */
        add_editor_style(get_template_directory_uri() . '/assets/css/editor-style.css');
    }
endif;
add_action('after_setup_theme', 'newspaper_lite_setup');

/**
 * Define Directory Location Constants
 */
define('NEWSPAPER_LITE_PARENT_DIR', get_template_directory());
define('NEWSPAPER_LITE_CHILD_DIR', get_stylesheet_directory());

define('NEWSPAPER_LITE_CORE_DIR', NEWSPAPER_LITE_PARENT_DIR . '/core');
define('NEWSPAPER_LITE_CSS_DIR', NEWSPAPER_LITE_PARENT_DIR . '/css');
define('NEWSPAPER_LITE_JS_DIR', NEWSPAPER_LITE_PARENT_DIR . '/js');
define('NEWSPAPER_LITE_LANGUAGES_DIR', NEWSPAPER_LITE_PARENT_DIR . '/languages');

define('NEWSPAPER_LITE_ADMIN_DIR', NEWSPAPER_LITE_CORE_DIR . '/admin');
define('NEWSPAPER_LITE_WIDGETS_DIR', NEWSPAPER_LITE_CORE_DIR . '/widgets');

define('NEWSPAPER_LITE_ADMIN_IMAGES_DIR', NEWSPAPER_LITE_ADMIN_DIR . '/images');

/**
 * Define URL Location Constants
 */
define('NEWSPAPER_LITE_PARENT_URL', get_template_directory_uri());
define('NEWSPAPER_LITE_CHILD_URL', get_stylesheet_directory_uri());

define('NEWSPAPER_LITE_INCLUDES_URL', NEWSPAPER_LITE_PARENT_URL . '/inc');
define('NEWSPAPER_LITE_CSS_URL', NEWSPAPER_LITE_PARENT_URL . '/css');
define('NEWSPAPER_LITE_JS_URL', NEWSPAPER_LITE_PARENT_URL . '/js');
define('NEWSPAPER_LITE_LANGUAGES_URL', NEWSPAPER_LITE_PARENT_URL . '/languages');

define('NEWSPAPER_LITE_ADMIN_URL', NEWSPAPER_LITE_INCLUDES_URL . '/admin');
define('NEWSPAPER_LITE_WIDGETS_URL', NEWSPAPER_LITE_INCLUDES_URL . '/widgets');

define('NEWSPAPER_LITE_ADMIN_IMAGES_URL', NEWSPAPER_LITE_ADMIN_URL . '/images');


/**
 * define theme version variable
 * @since 1.0.0
 */
function newspaper_lite_theme_version()
{
    $newspaper_lite_theme_info = wp_get_theme();
    $GLOBALS['newspaper_lite_version'] = $newspaper_lite_theme_info->get('Version');
}

add_action('after_setup_theme', 'newspaper_lite_theme_version', 0);
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function newspaper_lite_content_width()
{
    $GLOBALS['content_width'] = apply_filters('newspaper_lite_content_width', 640);
}

add_action('after_setup_theme', 'newspaper_lite_content_width', 0);

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/core/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/core/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/core/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/core/customizer.php';

/**
 * Newspaper Lite custom functions
 */
require get_template_directory() . '/core/newspaper-lite-functions.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/core/jetpack.php';

/**
 * Load widgets areas
 */
require get_template_directory() . '/core/widgets/newspaper-lite-widgets-area.php';

/**
 * Load metabox
 */
require get_template_directory() . '/core/admin/inc/metaboxes/newspaper-lite-post-metabox.php';

/**
 * Load customizer custom classes
 */
require get_template_directory() . '/core/admin/inc/newspaper-lite-custom-classes.php'; //custom classes

/**
 * Load customizer sanitize
 */
require get_template_directory() . '/core/admin/inc/newspaper-lite-sanitize.php'; //custom classes

/* Calling in the admin area for the Welcome Page */
if ( is_admin() ) {
    require get_template_directory() . '/core/admin/class-newspaper-lite-admin.php';
}

/**
 * Load TGMPA Configs.
 */
require_once(NEWSPAPER_LITE_CORE_DIR . '/lib/tgm-plugin-activation/class-tgm-plugin-activation.php');

require_once(NEWSPAPER_LITE_CORE_DIR . '/lib/tgm-plugin-activation/tgmpa-newspaper-lite.php');
