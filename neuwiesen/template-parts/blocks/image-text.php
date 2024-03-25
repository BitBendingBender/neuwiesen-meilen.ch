<?php
/*
Block Name: Bild-Text
Block Description: Bild-Text element in zwei Varianten.
Post Types: post, page, custom-type
Block Mode: edit
*/

use bbase\HTMLHelper;

$fields = $args['fields'] ?? get_fields();

?>
<div class="container-fluid">
    <?php if(($fields['layout'] ?? '') === 'image-top') { ?>
        <?php if($fields['image_clone']['image_desktop']) { ?>
            <?= HTMLHelper::renderPicturetag('image-text', $fields['image_clone']) ?>
        <?php } ?>
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
    <?php } ?>

    <?php if(($fields['layout'] ?? '') === 'image-right') { ?>
        <div class="row">
            <div class="col-md-2 order-2 order-md-1 mt-15 mt-md-0">
                <?php if($fields['title'] !== "") { ?>
                    <?= HTMLHelper::getTitle($fields['title'], ['class' => 'h2 mb-15 mb-md-0']) ?>
                <?php } ?>
                <?php if($fields['text'] !== "") { ?>
                    <div class="rich-text mt-15">
                        <?= $fields['text'] ?>
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-4 order-1 order-md-2">
                <?php if($fields['image_clone']['image_desktop']) { ?>
                    <?= HTMLHelper::renderPicturetag('image-right', $fields['image_clone']) ?>
                <?php } ?>
            </div>
        </div>
    <?php } ?>

</div>
