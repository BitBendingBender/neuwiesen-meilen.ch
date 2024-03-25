<?php
/*
Block Name: Bild-Raster
Block Description: Element mit Text und dreispaltigem Raster-Element.
Post Types: post, page, custom-type
Block Mode: edit
*/

use bbase\HTMLHelper;

$fields = $args['fields'] ?? get_fields();

?>
<div class="container-fluid">
    <?php if($fields['title'] !== "") { ?>
        <?= HTMLHelper::getTitle($fields['title'], ['class' => 'h2']) ?>
    <?php } ?>
    <?php if($fields['text'] !== "") { ?>
        <div class="rich-text mt-15">
            <?= $fields['text'] ?>
        </div>
    <?php } ?>
    <?php if(count($fields['images']) > 0) { ?>
        <div class="swiper mt-15">
            <div class="swiper-wrapper">
                <?php foreach($fields['images'] as $image) { ?>
                    <figure class="col-6 col-md-3 col-lg-2 swiper-slide">
                        <?= \FastImg\FastImg::getType('slider-text', $image) ?>
                        <?php if($image['caption'] !== "") { ?>
                            <figcaption class="mt-15"><?= $image['caption'] ?></figcaption>
                        <?php } ?>
                    </figure>
                <?php } ?>
                <?php foreach($fields['images'] as $image) { ?>
                    <figure class="col-6 col-md-3 col-lg-2 swiper-slide d-block d-lg-none">
                        <?= \FastImg\FastImg::getType('slider-text', $image) ?>
                        <?php if($image['caption'] !== "") { ?>
                            <figcaption class="mt-15"><?= $image['caption'] ?></figcaption>
                        <?php } ?>
                    </figure>
                <?php } ?>
            </div>
        </div>
        <div class="d-flex d-lg-none align-items-center swiper-navigation mt-15 mt-md-20">
            <div class="swiper-button-prev"><img src="<?= HTMLHelper::getImage('accordion-arrow-left.svg') ?>" alt="Vorherhiges Bild anzeigen"></div>
            <div class="swiper-button-next"><img src="<?= HTMLHelper::getImage('accordion-arrow.svg') ?>" alt="Nächstes Bild anzeigen"></div>
        </div>
    <?php } ?>
</div>
