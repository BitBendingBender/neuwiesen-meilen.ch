<?php
/*
Template Name: Einzelne Seite
*/

use bbase\HTMLHelper;

get_header();

$post = get_post();

?>

<main>
    <section class="block-page-back">
        <div class="container-fluid">
            <div class="row">
                <div class="col-2">&nbsp;</div>
                <div class="col-4">
                    <a href="/">
                        ← Zurück zur Startseite
                    </a>
                </div>
            </div>
        </div>
    </section>
    <?= HTMLHelper::renderBlockLoop() ?>
</main>

<?php get_footer(); ?>