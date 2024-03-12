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
    <?php } ?>

    <?php if(($fields['layout'] ?? '') === 'image-right') { ?>
        <div class="row">
            <div class="col-2">
                <?php if($fields['title'] !== "") { ?>
                    <?= HTMLHelper::getTitle($fields['title'], ['class' => 'h2']) ?>
                <?php } ?>
                <?php if($fields['text'] !== "") { ?>
                    <div class="rich-text mt-20">
                        <?= $fields['text'] ?>
                    </div>
                <?php } ?>
            </div>
            <div class="col-4">
                <?php if($fields['image_clone']['image_desktop']) { ?>
                    <?= HTMLHelper::renderPicturetag('image-right', $fields['image_clone']) ?>
                <?php } ?>
            </div>
        </div>
    <?php } ?>

</div>
