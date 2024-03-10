<?php

/**
 * The main template file
 */

get_header();

?>

<main>
    <?= bbase\HTMLHelper::renderBlockLoop() ?>
</main>

<?php get_footer(); ?>
