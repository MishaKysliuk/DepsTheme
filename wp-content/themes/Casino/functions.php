<?php
if (!function_exists('theme_setup')):

    function theme_setup()
{

        load_theme_textdomain('casino', get_template_directory() . '/languages');

        add_theme_support('title-tag');

        add_theme_support('post-thumbnails');
        add_image_size('blog', 320, 210, true);

        register_nav_menus(array(
            'main-menu'               => esc_html__('Primary', 'casino'),
            'footer-menu'             => esc_html__('Footer menu', 'casino'),
            'footer-menu-aditional-1' => esc_html__('Aditional footer menu 1', 'casino'),
            'footer-menu-aditional-2' => esc_html__('Aditional footer menu 2', 'casino'),
            'footer-menu-aditional-3' => esc_html__('Aditional footer menu 3', 'casino'),
        ));

    }
endif;
add_action('after_setup_theme', 'theme_setup');

add_filter('malinky_load_js', '__return_false');
add_filter('malinky_load_css', '__return_false');

/**
 * Enqueue scripts and styles.
 */
function sites_scripts_and_styles()
{
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('main-style', get_template_directory_uri() . '/build/static/css/style.css');

    wp_deregister_script( 'jquery' );

    wp_enqueue_script('manifest', get_template_directory_uri() . '/build/static/js/manifest.js', array(), '', true );
    wp_enqueue_script('vendor', get_template_directory_uri() . '/build/static/js/vendor.js', array('manifest'), '', true);
    wp_enqueue_script('main-js', get_template_directory_uri() . '/build/static/js/main.js', array('vendor'), '', true);

    if (is_post_type_archive('blog')) {
        global $malinky_ajax_pagination;
        $malinky_ajax_pagination->malinky_ajax_pagination_styles();
        $malinky_ajax_pagination->malinky_ajax_pagination_scripts();
    }

}
add_action('wp_enqueue_scripts', 'sites_scripts_and_styles');

add_action('wp_enqueue_scripts', 'register_javascript', 100);

function register_javascript()
{
    wp_register_script('mediaelement', plugins_url('wp-mediaelement.min.js', __FILE__), array('jquery'), '4.8.2', true);
    wp_enqueue_script('mediaelement');
}

function admin_favicon()
{
    echo '<link rel="Shortcut Icon" type="image/x-icon" href="' . get_template_directory_uri() . '/favicon.png" />';
}
add_action('admin_head', 'admin_favicon');

function admin_stylesheet_and_js()
{
    wp_enqueue_style('admin-css', get_template_directory_uri() . '/build/static/css/admin.css');

    wp_enqueue_script('admin-assets', get_template_directory_uri() . '/admin-assets/add-list-id-to-relationship.js', array('jquery'), '');
    wp_enqueue_script('brands-settings-admin-page', get_template_directory_uri() . '/admin-assets/update-settings-admin-page.js', array('jquery'), '');
    wp_enqueue_script('q-tag-btn', get_template_directory_uri() . '/admin-assets/shortcodes/add-shortcode-btn.js', array(), '');
}
add_action('admin_head', 'admin_stylesheet_and_js');

/**
 * Enqueue all template functions.
 */
require_once get_template_directory() . '/inc/register-custom-post-type.php';
require_once get_template_directory() . '/inc/register-custom-taxonomy.php';
require_once get_template_directory() . '/inc/template-functions.php';
require_once get_template_directory() . '/inc/quiz-api.php';
require_once get_template_directory() . '/inc/ajax-search.php';
require_once get_template_directory() . '/inc/rating.php';
require_once get_template_directory() . '/inc/subscribe.php';
require_once get_template_directory() . '/inc/breadcrumbs.php';
require_once get_template_directory() . '/inc/get-brands.php';
require_once get_template_directory() . '/inc/get-bonuses.php';
require_once get_template_directory() . '/inc/get-blog.php';

// Admin page settings
require_once get_template_directory() . '/inc/admin/brands-settings-admin-page.php';
require_once get_template_directory() . '/inc/admin/bonuses-settings-admin-page.php';
require_once get_template_directory() . '/inc/admin/update-settings-admin-page.php';

// shortcodes
require_once get_template_directory() . '/inc/shortcodes/sites-list.php';
require_once get_template_directory() . '/inc/shortcodes/features.php';
require_once get_template_directory() . '/inc/shortcodes/worst-casinos.php';
require_once get_template_directory() . '/inc/shortcodes/button.php';
require_once get_template_directory() . '/inc/shortcodes/year-and-month.php';
require_once get_template_directory() . '/inc/shortcodes/bonuses.php';
require_once get_template_directory() . '/inc/shortcodes/register-shortcodes-in-text-editor.php';

//Add EXIF metadata to images
require_once get_template_directory() . '/inc/add-exif-on-upload.php';
