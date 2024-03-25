<?php
/*
Block Name: Slider-Text
Block Description: Slider Element mit zusätzlichem Text
Post Types: post, page, custom-type
Block Mode: edit
*/

use bbase\HTMLHelper;

$fields = $args['fields'] ?? get_fields();

?>
<div class="container-fluid">
    <?php if(count($fields['images']) > 0) { ?>
        <div class="swiper">
            <div class="swiper-wrapper">
                <?php // too few slides ?>
                <?php foreach($fields['images'] as $image) { ?>
                    <?= \FastImg\FastImg::getType('slider-text', $image)->setAttributes(['class' => 'swiper-slide']) ?>
                <?php } ?>
                <?php if(count($fields['images']) <= 5) { ?>
                    <?php foreach($fields['images'] as $image) { ?>
                        <?= \FastImg\FastImg::getType('slider-text', $image)->setAttributes(['class' => 'swiper-slide']) ?>
                    <?php } ?>
                    <?php foreach($fields['images'] as $image) { ?>
                        <?= \FastImg\FastImg::getType('slider-text', $image)->setAttributes(['class' => 'swiper-slide']) ?>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>
<div class="container-fluid py-15 py-md-20 swiper-navigation-container">
    <div class="d-flex align-items-center swiper-navigation">
        <div class="swiper-button-prev"><img src="<?= HTMLHelper::getImage('accordion-arrow-left.svg') ?>" alt="Vorherhiges Bild anzeigen"></div>
        <div class="swiper-button-next"><img src="<?= HTMLHelper::getImage('accordion-arrow.svg') ?>" alt="Nächstes Bild anzeigen"></div>
    </div>
</div>
<div class="container-fluid">
    <?php if($fields['title'] !== "" || $fields['text'] !== "") { ?>
        <div class="row mt-15">
            <div class="col-md-2 text-md-right">
                <?php if($fields['title'] !== "") { ?>
                    <?= HTMLHelper::getTitle($fields['title'], ['class' => 'h2 mb-15 mb-md-0']) ?>
                <?php } ?>
            </div>
            <div class="col-md-4">
                <?php if($fields['text'] !== "") { ?>
                    <div class="rich-text">
                        <?= $fields['text'] ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>
