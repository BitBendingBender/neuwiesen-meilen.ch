<?php

namespace bbase;

require_once "vendor/CPT.php";

class BaseCPT extends \CPT
{

    /**
     * new self() bla bla
     */
    public static function registerPostTypes()
    {



    }

    /**
     * Returns a WP_Query Object with all Posts by Type.
     * Optionally an array of options can be provided.
     * @param string $slug
     * @param array $options
     * @return \WP_Query
     */
    public static function getAllBySlug(string $slug, array $options = []) : \WP_Query {

        $options = array_merge_recursive([
            'post_type' => $slug,
            'posts_per_page' => -1,
        ], $options);

        $query = new \WP_Query($options);

        return $query;

    }
}
