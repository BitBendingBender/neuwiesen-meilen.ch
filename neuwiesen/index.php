<?php

/**
 * The main template file
 */

get_header();

// if the parent page is of template render subpages, redirect to parent
$parentPage = get_post(get_post()->post_parent);

if($parentPage !== null && $parentPage instanceof WP_Post && $parentPage->page_template === "template-render-subpages.php") {

    wp_redirect(get_permalink($parentPage) . '#page-section-' . get_post()->post_name);

}

?>

<main>
    <?= bbase\HTMLHelper::renderBlockLoop() ?>
</main>

<?php get_footer(); ?>
