<?php
/**
 * Boot
 *
 * @author     Laurin Waller
 * @package    bbase
 * @version    1.0
 */

namespace bbase;

use FastImg\Breakpoint;
use FastImg\FastImg;

require_once "class.BaseCPT.php";
require_once "class.HTMLHelper.php";

class Boot
{

    const ACF_PATH = "/inc/acf-json";

    public static function init()
    {

        self::removeWPJunk();

        add_action('after_setup_theme', [__CLASS__, 'initOptionsPage']);

        add_action('acf/init', [__CLASS__, 'ACFInit']);
        add_filter('acf/settings/save_json', [__CLASS__, 'acf_json_save_point']);
        add_filter('acf/settings/load_json', [__CLASS__, 'acf_json_load_point']);
        add_filter('acf/pre_save_block', [__CLASS__, 'acf_set_block_id']);

        BaseCPT::registerPostTypes();

        self::setupImageSizes();

    }

    /**
     * @return void
     */
    public static function setupImageSizes()
    {

        Breakpoint::setDefaults([
            'mobile' => new Breakpoint('mobile', '(max-width: 414px)'),
            'tablet' => new Breakpoint('tablet', '(min-width: 415px) and (max-width: 1024px)'),
            'desktop_small' => new Breakpoint('desktop_small', '(min-width: 1025px) and (max-width: 1440px)'),
            'desktop' => new Breakpoint('desktop', '(min-width: 1441px)'),
        ]);

        FastImg::registerType('image-text')->setSizes([
            [374, -1],
            [983, -1],
            [1400, -1],
            [1880, -1],
        ]);

        FastImg::registerType('image-right')->setSizes([
            [374, -1],
            [983, -1],
            [930, -1],
            [1247, -1],
        ]);

        FastImg::registerType('slider-text')->setSizes([
            [414, 300],
            [650, 468],
            [930, 670],
            [1250, 900],
        ]);

        FastImg::registerType('image-raster')->setSizes([
            [384, 276],
            [482, 447],
            [690, 498],
            [614, 442],
        ]);

    }


    /**
     * Autoregister blocks according to their phpdoc
     * TODO: rebuild this to https://www.advancedcustomfields.com/resources/whats-new-with-acf-blocks-in-acf-6/
     */
    public static function ACFInit()
    {
        // Get an array of theme PHP templates
        $theme = wp_get_theme();
        $files = $theme->get_files('php', 2, false);

        // register custom block category
        add_filter('block_categories_all', function ($categories) {

            // Adding a new category.
            array_unshift($categories, [
                'slug' => 'neuwiesen',
                'title' => 'Neuwiesen Meilen ❤️'
            ]);

            return $categories;
        });

        // Iterate over and ignore non-block templates
        foreach ($files as $filename => $filepath) {
            if (preg_match('#^template-parts/(block|container)s?/#', $filename, $matches) !== 1) {
                continue;
            }

            // Read the PHP comment meta data for the block
            $meta = get_file_data($filepath, array(
                'name' => 'Block Name',
                'description' => 'Block Description',
                'post_types' => 'Post Types',
                'mode' => 'Block Mode',
                'align' => 'Block Align'
            ));

            // Skip template if a name is not provided
            if (empty($meta['name'])) {
                continue;
            }

            // Convert the post types to an array (or use defaults)
            $post_types = array_filter(
                array_map('trim', explode(',', $meta['post_types']))
            );

            if (empty($post_types)) {
                $post_types = array('page', 'post');
            }

            // if mode empty set auto as default
            $mode = (empty($meta['mode'])) ? 'auto' : $meta['mode'];

            // Register the ACF block using the meta data
            acf_register_block_type(array(
                'name' => "{$matches[1]}_" . sanitize_title($meta['name']),
                'title' => $meta['name'],
                'description' => $meta['description'],
                'category' => "advokatur-west",
                'post_types' => $post_types,
                'mode' => $mode,
                'render_template' => $filepath,
                'supports' => array(
                    'align' => boolval($meta['align']),
                    'mode' => false,
                    'customClassName' => false
                ),
            ));
        }
    }


    /**
     * init
     */
    public static function initOptionsPage()
    {
        // All theme initialization code goes here...
        load_theme_textdomain('west', get_template_directory() . '/languages');

        if (function_exists('acf_add_options_page')) {

            acf_add_options_page(array(
                'page_title' => __('Globale Einstellungen', 'west'),
                'menu_title' => __('Globale Einstellungen', 'west'),
                'menu_slug' => $menu_slug = 'acf-global-settings',
                'update_button' => __('Aktualisieren', 'west'),
                'updated_message' => __("Globale Einstellungen wurden aktualisiert.", 'west'),
            ));
        }

    }

    /**
     * acf_json_save_point
     */
    public static function acf_json_save_point($path)
    {

        // create folder if it doesn't already exist
        if (!file_exists(get_stylesheet_directory() . self::ACF_PATH)) {
            mkdir(get_stylesheet_directory() . self::ACF_PATH, 0777, true);
        }

        // update path
        $path = get_stylesheet_directory() . self::ACF_PATH;

        return $path;

    }

    /**
     * acf_json_load_point
     */
    public static function acf_json_load_point($paths): array
    {

        // append path
        $paths[0] = get_stylesheet_directory() . self::ACF_PATH;

        // return
        return $paths;

    }

    /**
     * Adds a default Block ID
     */
    public static function acf_set_block_id($attributes): array
    {

        if (!isset($attributes['blockId']) || empty($attributes['anchor'])) $attributes['blockId'] = 'block-' . uniqid();

        return $attributes;
    }

    /**
     * removes all the junk and comment stuff from worpdress
     * @return void
     */
    public static function removeWPJunk()
    {

        // Remove WP-Junk
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'feed_links', 2);
        remove_action('wp_head', 'index_rel_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'feed_links_extra', 3);
        remove_action('wp_head', 'start_post_rel_link', 10);
        remove_action('wp_head', 'parent_post_rel_link', 10);
        remove_action('wp_head', 'adjacent_posts_rel_link', 10);
        remove_action('wp_head', 'wp_shortlink_wp_head', 10);
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

        add_action('admin_init', function () {
            // Redirect any user trying to access comments page
            global $pagenow;

            if ($pagenow === 'edit-comments.php') {
                wp_safe_redirect(admin_url());
                exit;
            }

            // Remove comments metabox from dashboard
            remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

            // Disable support for comments and trackbacks in post types
            foreach (get_post_types() as $post_type) {
                if (post_type_supports($post_type, 'comments')) {
                    remove_post_type_support($post_type, 'comments');
                    remove_post_type_support($post_type, 'trackbacks');
                }
            }
        });

        // Close comments on the front-end
        add_filter('comments_open', '__return_false', 20, 2);
        add_filter('pings_open', '__return_false', 20, 2);

        // Hide existing comments
        add_filter('comments_array', '__return_empty_array', 10, 2);

        // Remove comments page in menu
        add_action('admin_menu', function () {
            remove_menu_page('edit-comments.php');
        });

        // Remove comments links from admin bar
        add_action('init', function () {
            if (is_admin_bar_showing()) {
                remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
            }
        });
    }
}
