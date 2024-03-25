<?php
/*
Block Name: Wohnungen – Text
Block Description: Akkordeon-Element zur Ansicht einer einzelnen Wohnung.
Post Types: post, page, custom-type
Block Mode: edit
*/

use bbase\HTMLHelper;

$fields = $args['fields'] ?? get_fields();

if(!$fields['text_elements'] || count($fields['text_elements']) <= 0) return;

?>
<div class="container-fluid apartment-accordion">
    <div class="accordion-opener">
        <img src="<?= HTMLHelper::getImage('accordion-arrow.svg') ?>" alt=""><?= $fields['label'] ?>
    </div>
    <div class="accordion-content" style="display: none;">
        <?php foreach($fields['text_elements'] as $k => $element) { ?>
            <?php if($k > 0) { ?>
                <div class="d-block d-md-none mt-15 separator"></div>
            <?php } ?>
            <div class="row mt-15 pt-lg-0">
                <div class="col-md-1 offset-md-1 mb-15 mb-md-0 text-md-end d-md-flex justify-content-end">
                    <?= $element['title'] ?>
                </div>
                <div class="col-md-4">
                    <div class="rich-text">
                        <?= $element['text'] ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
