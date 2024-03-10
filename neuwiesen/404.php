<?php

get_header(); ?>

<main>
    <section id="page-404" class="block-standard-inhalt" data-is_centered="1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="dateline"><?= __('Fehler 404 – Nicht gefunden', 'west') ?></h1>
                    <div class="rich-text">
                        <p><?= __('Die angeforderte Ressource existiert nicht.', 'west') ?></p>
                        <a class="button with-arrow" style="font-size: 2rem; padding-top: .8rem;" href="<?= get_home_url() ?>">Zur Startseite</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
