<?php
/*
Block Name: Wohnungen – Wohnung
Block Description: Akkordeon-Element zur Ansicht einer einzelnen Wohnung.
Post Types: post, page, custom-type
Block Mode: edit
*/

use bbase\HTMLHelper;

$fields = $args['fields'] ?? get_fields();

?>
<div class="container-fluid apartment-accordion">
    <div class="row">
        <div class="col-lg-2 d-flex flex-column">
            <div class="accordion-opener">
                <img src="<?= HTMLHelper::getImage('accordion-arrow.svg') ?>" alt=""><?= $fields['label'] ?>
            </div>
            <div class="accordion-content pt-15" style="display: none;">
                <?php if($fields['text'] !== "") { ?>
                    <div class="rich-text">
                        <?= $fields['text'] ?>
                    </div>
                <?php } ?>
                <?php if($fields['house_visual']) { ?>
                    <img src="<?= $fields['house_visual']['url'] ?>" alt="<?= $fields['house_visual']['alt'] ?>" class="mt-15">
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="accordion-content mt-15 mt-md-0" style="display: none;">
                <?php if($fields['layout']['image_desktop']) { ?>
                    <?= HTMLHelper::renderPicturetag('image-right', $fields['layout']); ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
