<?php
/*
Block Name: Wohnungen – Visualisierung
Block Description: Akkordeon-Element zur Ansicht einer Visualisierung.
Post Types: post, page, custom-type
Block Mode: edit
*/

use bbase\HTMLHelper;

$fields = $args['fields'] ?? get_fields();

?>
<div class="container-fluid apartment-accordion">
    <div class="row">
        <div class="col-md-2 d-flex flex-column">
            <div class="accordion-opener">
                <img src="<?= HTMLHelper::getImage('accordion-arrow.svg') ?>" alt=""><?= $fields['label'] ?>
            </div>
        </div>
        <div class="col-md-4 d-flex align-items-center">
            <div class="accordion-content pt-15 pt-md-0" style="display: none;">
                <?php if($fields['visual']['image_desktop']) { ?>
                    <div class="rich-text"><?= $fields['visual']['image_desktop']['caption'] ?></div>
                <?php } ?>
            </div>
        </div>
        <div class="accordion-content pt-15" style="display: none;">
            <?php if($fields['visual']['image_desktop']) { ?>
                <?= HTMLHelper::renderPicturetag('image-text', $fields['visual']) ?>
            <?php } ?>
        </div>
    </div>
</div>
