<?php

require_once "inc/bbase/class.Boot.php";

\bbase\Boot::init();

/**
 * Theme Support
 */
add_action('after_setup_theme', function (){

    // Theme support
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');

    // Post Thumbnails
    add_theme_support('post-thumbnails');

    // Get the theme version & make it a named constant
    define('THEME_VERSION', wp_get_theme()->Version);

});


/**
 * Register and Enqueue Styles.
 */
add_action( 'wp_enqueue_scripts', function() {

    if(!is_admin()) {
        wp_deregister_style('wp-block-library');
        wp_deregister_style('jquery-core-js');
        wp_deregister_style('wp-embed');
        wp_deregister_style('classic-theme-styles');
        wp_deregister_style('global-styles');
    }

    wp_enqueue_style('style', get_theme_file_uri('/dist/main.css'), '', "1.56");
});

/**
 * Register and Enqueue Scripts.
 */
add_action( 'wp_enqueue_scripts', function() {

    if(!is_admin()) {
        wp_deregister_script('wp-embed');
    }

    wp_enqueue_script('global', get_theme_file_uri( '/dist/main.js' ), [], "1.38", true );

});



/**
 * Register navigation menus uses wp_nav_menu
 */
add_action( 'init', function() {

    $locations = array(
        'main'  => __( 'Main Menu', 'west' ),
        'footer'   => __( 'Footer Menu', 'west' ),
    );

    register_nav_menus( $locations );

});

add_filter('upload_mimes', function($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['vcf'] = 'text/vcard';
    return $mimes;
});

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
add_filter( 'frontpage_template', function($template) {
    return is_home() ? '' : $template;
});

add_filter( 'wpseo_sitemap_urlimages', function($seoImages, $postID) {

    \bbase\HTMLHelper::renderBlockLoop(get_post($postID));

    $seoImages = array_merge($seoImages, \bbase\HTMLHelper::$RENDERED_IMAGES);

    \bbase\HTMLHelper::$RENDERED_IMAGES = [];
    
    return $seoImages;

}, 10, 2 );