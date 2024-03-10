<?php

$post = get_post();
$fields = get_fields();

$override = $fields['override_title'] ?? '';

get_header('single');

?>
<div class="container-fluid">
    <div class="backlink-container">
        <a title="<?= __('Zurück zur Startseite', 'west') ?>" class="backlink no-color" href="<?= get_field('team_overview', 'options')['url'] ?>">←</a>
    </div>
</div>
<main>
    <section class="block-employee-detail">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-2">
                    <?php if(isset($fields['other_image_detail']) && $fields['other_image_detail']) { ?>
                        <?= \bbase\HTMLHelper::renderPicturetag(['image_desktop' => $fields['other_image_detail']], 'team-teaser') ?>
                    <?php } else { ?>
                        <?= \bbase\HTMLHelper::renderPicturetag(['image_desktop' => get_post_thumbnail_id()], 'team-teaser') ?>
                    <?php } ?>
                </div>
                <div class="col-md-2">
                    <div class="employee-info">
                        <?= \bbase\HTMLHelper::getTitle($override && $override !== "" ? $override : $post->post_title) ?>
                        <div class="rich-text">
                            <p><?= nl2br($fields['position']) ?></p>
                            <p>
                                <?php if(isset($fields['phone']) && $fields['phone'] !== "") { ?>
                                    <a href="tel:<?= str_replace(['(0)', ' '], [''], $fields['phone']) ?>"><?= $fields['phone'] ?></a><br>
                                <?php } ?>
                                <?php if(isset($fields['mail']) && $fields['mail'] !== "") { ?>
                                    <a href="mailto:<?= antispambot($fields['mail']) ?>"><?= antispambot($fields['mail']) ?></a><br>
                                <?php } ?>
                                <?php if(isset($fields['vcard']) && $fields['vcard'] !== "") { ?>
                                    <a target="_blank" href="<?= $fields['vcard']['url'] ?>">vCard</a><br>
                                <?php } ?>
                                <?php if(isset($fields['linkedin']) && $fields['linkedin'] !== "") { ?>
                                    <a target="_blank" href="<?= $fields['linkedin']['url'] ?>">LinkedIn</a>
                                <?php } ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="offset-md-1 col-md-5">
                    <div class="employee-text">
                        <?php if(isset($fields['expertise']) && $fields['expertise'] !== "" && count($fields['expertise']) > 0) { ?>
                            <div class="expertise">
                                <?= \bbase\HTMLHelper::getTitle(__('Bevorzugte Fachgebiete', 'west'), ['class' => 'h2']) ?>
                                <div class="rich-text">
                                    <ul class="no-icon">
                                        <?php foreach($fields['expertise'] as $expertise) { ?>
                                            <li>
                                                <a target="<?= $expertise['link']['target'] ?>" href="<?= $expertise['link']['url'] ?>" class="button with-arrow"><span><?= $expertise['link']['title'] ?></span></a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if(isset($fields['cv_work']) && $fields['cv_work'] !== "") { ?>
                            <div class="cv_work">
                                <?= \bbase\HTMLHelper::getTitle(__('Ausbildung und Berufliches', 'west'), ['class' => 'h2']) ?>
                                <div class="rich-text">
                                    <ul class="no-icon">
                                        <?php foreach($fields['cv_work'] as $single) { ?>
                                            <li>
                                                <span class="year"><?= $single['year'] ?></span>
                                                <span class="work"><?= nl2br($single['work']) ?></span>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if(isset($fields['beside_work']) && $fields['beside_work'] !== "") { ?>
                            <?php
                            $fields['beside_work'] = explode(PHP_EOL, $fields['beside_work']);
                            ?>
                            <div class="beside_work">
                                <?= \bbase\HTMLHelper::getTitle(__('Mitgliedschaften und Nebentätigkeiten', 'west'), ['class' => 'h2']) ?>
                                <div class="rich-text">
                                    <ul>
                                        <?php foreach($fields['beside_work'] as $wok) { ?>
                                            <li><?= $wok ?></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if(isset($fields['publications']) && $fields['publications'] !== "") { ?>
                            <?php
                            $fields['publications'] = explode(PHP_EOL, $fields['publications']);
                            ?>
                            <div class="beside_work">
                                <?= \bbase\HTMLHelper::getTitle(__('Publikationen', 'west'), ['class' => 'h2']) ?>
                                <div class="rich-text">
                                    <ul>
                                        <?php foreach($fields['publications'] as $publication) { ?>
                                            <li><?= $publication ?></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if(isset($fields['languages']) && $fields['languages'] !== "") { ?>
                            <?php
                            $fields['languages'] = explode(PHP_EOL, $fields['languages']);
                            ?>
                            <div class="languages">
                                <?= \bbase\HTMLHelper::getTitle(__('Sprachen', 'west'), ['class' => 'h2']) ?>
                                <div class="rich-text">
                                    <ul>
                                        <?php foreach($fields['languages'] as $lang) { ?>
                                            <li><?= $lang ?></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
