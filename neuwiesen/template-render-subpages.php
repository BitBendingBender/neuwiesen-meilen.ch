<?php
/*
Template Name: Subseiten Als Akkordeon
*/

use bbase\HTMLHelper;

get_header();

$post = get_post();

// get all subpages
$args = array(
    'post_type'      => 'page',
    'posts_per_page' => -1,
    'post_parent'    => $post->ID,
    'order'          => 'ASC',
    'orderby'        => 'menu_order'
);

$pageChildren = (new WP_Query( $args ))->posts;

// bail if no children found
if($pageChildren <= 0) return;

HTMLHelper::$IN_PAGE_LOOP = true;

?>

<main>
    <?php foreach($pageChildren as $key => $child) { ?>
        <section class="page-section" id="page-section-<?= $child->post_name ?>">
            <div class="section-title">
                <?php if($key === 0) { ?>
                    <h1><?= str_replace(" ", "<br>", $child->post_title) ?></h1>
                <?php } else { ?>
                    <h1><?= $child->post_title ?></h1>
                <?php } ?>
            </div>
            <div class="outer-section-content">
                <?= HTMLHelper::renderBlockLoop($child) ?>
            </div>
        </section>
    <?php } ?>
</main>

<?php get_footer(); ?>