<?php

$post = get_post();

if (get_post_type() === 'post' && get_field('has_detail') !== true) {
    // stolen from https://wordpress.stackexchange.com/questions/24891/redirect-restricted-page-to-404
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
    get_template_part(404);
    exit();
}

get_header('single');

?>
<div class="container-fluid backlink-outer-container">
    <div class="backlink-container">
        <a title="<?= __('Zurück zur Startseite', 'west') ?>" class="backlink no-color" href="<?= get_field('team_overview', 'options')['url'] ?>">←</a>
    </div>
</div>
<main>
    <section class="block-post-detail-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between posts-header">
                <div class="posts-header-info d-flex align-items-start">
                    <span class="date"><?= date_i18n('j. F Y', get_post_timestamp($post)) ?></span>
                    <?php if ($author = get_field('author', $post)) { ?>
                        &nbsp;&nbsp;&nbsp;<?= \bbase\HTMLHelper::renderButton([
                            'url' => get_permalink($author),
                            'title' => $author->post_title,
                            'type' => 'with-arrow'
                        ]) ?>
                    <?php } ?>
                </div>
            </div>
            <?= \bbase\HTMLHelper::getTitle($post->post_title, ['class' => 'h1']) ?>
        </div>
    </section>
    <?= bbase\HTMLHelper::renderBlockLoop() ?>
</main>

<?php get_footer(); ?>
