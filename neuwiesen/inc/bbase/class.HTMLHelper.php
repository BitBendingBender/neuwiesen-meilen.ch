<?php

namespace bbase;

use FastImg\FastImg;
use FastImg\Type;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

/**
 * HTMLHelper
 *
 * @author     Laurin Waller
 * @package    bbase
 * @version    1.0
 */

class HTMLHelper
{

    public static $IMAGE_ASSETS = '/assets/images/';
    public static $H1_USED = false;

    public static $RENDERED_IMAGES = [];

    /**
     * include title template
     * first call is allways h1, except heading is set
     *
     * @param string        $title string
     * @param array         $attributes array add classes to heading
     * @param null|string   $heading string define heading size
     * @return false|string
     */
    public static function getTitle($title, $attributes = [], $heading = null) {

        if($heading === null) {
            $heading = self::$H1_USED ? "2" : "1";
            self::$H1_USED = true;
        }

        $attributesString = "";
        $attributesArray = [];
        if(count((array) $attributes) > 0) {

            foreach($attributes as $prop => $val) {
                $attributesArray[] = "$prop=\"$val\"";
            }

            $attributesString = implode(" ", $attributesArray);
        }

        $title = do_shortcode($title);

        ob_start();

        get_template_part('template-parts/title', null, [
            'heading' => $heading,
            'title' => $title,
            'attributesString' => $attributesString
        ]);

        return ob_get_clean();

    }


    /**
     * Loops Blocks of current Post
     *
     * @param object|null $special_post
     *
     * @return string
     */
    public static function renderBlockLoop( object $special_post = null): string {

        if ($special_post !== null) {
            $post = $special_post;
        } else {
            global $post;
        }

        $loopContent = "";

        //get all blocks of requested type
        $blocks = parse_blocks( $post->post_content );
        
        $blocks = array_filter($blocks, function($b) {
            return $b['blockName'] !== null ? $b : null;
        });

        foreach($blocks as $block) {
            $loopContent .= HTMLHelper::wrapBlockContent($block);
        }

        return $loopContent;

    }

    /**
     * Wraps given block into block-wrap.php
     * @param $block
     * @return false|string
     */
    public static function wrapBlockContent($block) {

        // resolves reusable blocks.
        if($block['blockName'] === "core/block" && (int) $block['attrs']['ref'] > 0) {
            $block = parse_blocks(get_post($block['attrs']['ref'])->post_content)[0];
        }

        $blockContent = render_block($block);

        //TODO: needs to be implemented
        $blockAttributes = [];

        // get settings prefixed by block_settings_
        if(isset($block['attrs']['data'])) {
            foreach($block['attrs']['data'] as $key => $value) {

                if(strpos($key, 'block-config_') !== false && substr($key, 0, 1) !== "_") {

                    $strippedKey = str_replace('block-config_', '', $key);

                    if($strippedKey === "block_id" && (string) $value !== "") {
                        $block['attrs']['blockId'] = $value;
                        continue;
                    }

                    if ($value !== '') {
                        $blockAttributes[] = "data-$strippedKey=\"$value\"";
                    }
                }
            }
        }

        ob_start();

        get_template_part('template-parts/block-wrap', null, [
            'block' => $block,
            'content' => $blockContent,
            'attributes' => $blockAttributes,
        ]);

        return ob_get_clean();

    }


    /**
     * Returns default button by given ACF Link-Array.
     * @param array   $button
     *                string $url         URL of button
     *                string $target      Target of button
     *                string $title       Titel / Text of button
     *                string $classes     Additional classes for button
     *                string $before      Content before title
     *                string $after       Content after title
     *                string $tag         Defines the tag being used
     * @return string
     */
    public static function renderButton(array $button) : string {

        // flatten the array
        $button = iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($button)));

        ob_start();

        get_template_part('template-parts/button', null, $button);

        return ob_get_clean();

    }

    /**
     * @param string $classes
     * @param mixed ...$buttons
     * @return string
     */
    public static function renderButtonGroup(string $classes = "", ...$buttons) : string {

        
        if(count($buttons) === 0) return "";

        $singleButtonsHTML = "";

        foreach($buttons as $button) {

            if(!is_array($button)) continue;

            $singleButtonsHTML .= self::renderButton($button);
        }

        if($singleButtonsHTML === "") return "";

        ob_start();

        get_template_part('template-parts/button-group', null, [
            'classes' => $classes,
            'buttons' => $singleButtonsHTML,
        ]);

        return ob_get_clean();

    }

    /**
     * Renders $images['image_desktop'] and $images['image_mobile'] with Slicr
     */
    public static function renderPicturetag(array $images, string $type) : ?Type {

        if(!isset($images['image_desktop']) || !$images['image_desktop']) return null;

        $ID = (is_array($images['image_desktop']) && is_int($images['image_desktop']['id'])) ? $images['image_desktop']['id'] : $images['image_desktop'];

        $wpObject = \WP_Post::get_instance($ID);
        
        static::$RENDERED_IMAGES[] = ['src' => wp_get_attachment_url($ID), 'title' => $wpObject->post_title];

        $fastImgType = FastImg::getType($type, $images['image_desktop']);

        if(isset($images['image_mobile']) && $images['image_mobile'] !== false) $fastImgType->setImages(['mobile' => $images['image_mobile']]);

        return $fastImgType;

    }

}
