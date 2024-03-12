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
        <div class="row">
            <div class="col-md-4 offset-md-1">
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
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if($fields['title'] !== "" || $fields['text'] !== "") { ?>
        <div class="row mt-20">
            <div class="col-2 text-right">
                <?php if($fields['title'] !== "") { ?>
                    <?= HTMLHelper::getTitle($fields['title'], ['class' => 'h2']) ?>
                <?php } ?>
            </div>
            <div class="col-4">
                <?php if($fields['text'] !== "") { ?>
                    <div class="rich-text">
                        <?= $fields['text'] ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>
