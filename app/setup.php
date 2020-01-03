<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;


/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('main.css', asset_path('main.css'), false, null);
    wp_enqueue_script('main.js', asset_path('main.js'), ['jquery'], null, true);
}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage')
    ]);
    $new_menu_id = wp_create_nav_menu('Main Menu');
    if(!empty($locations)) {
        foreach($locations as $locationId => $menuValue) {
            switch($locationId) {
                case 'admin-menu-location': $menu = get_term_by('name', 'Admin Menu', 'nav_menu'); break;
                case 'author-menu-location': $menu = get_term_by('name', 'Author Menu', 'nav_menu'); break;
                case 'subscriber-menu-location': $menu = get_term_by('name', 'Default Menu', 'nav_menu'); break;
            }
            if(isset($menu)) {
                $locations[$locationId] = $menu->term_id;
            }
        }
        set_theme_mod('nav_menu_locations', $locations);
    }

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_theme_support('editor-styles');
    add_editor_style( asset_path('editor.css') );

    add_theme_support( 'editor-color-palette', array(
        array(
            'name'  => __( 'White', 'libarts2019' ),
            'slug'  => 'white',
            'color'	=> '#fff',
        ),
        array(
            'name'  => __( 'Maroon', 'libarts2019' ),
            'slug'  => 'maroon',
            'color' => '#550000',
        )
    ) );

    // -- Disable Custom Colors
    add_theme_support( 'disable-custom-colors' );
    add_theme_support( 'disable-custom-font-sizes' );

    add_theme_support( 'align-wide' );

    add_theme_support( 'responsive-embeds' );

    // wp_dequeue_style( 'wp-block-library' );

}, 20);

// /**
//  * Register sidebars
//  */
// add_action('widgets_init', function () {
//     $config = [
//         'before_widget' => '<section class="widget %1$s %2$s">',
//         'after_widget'  => '</section>',
//         'before_title'  => '<h3>',
//         'after_title'   => '</h3>'
//     ];
//     register_sidebar([
//         'name'          => __('Primary', 'sage'),
//         'id'            => 'sidebar-primary'
//     ] + $config);
//     register_sidebar([
//         'name'          => __('Footer', 'sage'),
//         'id'            => 'sidebar-footer'
//     ] + $config);
// });

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });
});
