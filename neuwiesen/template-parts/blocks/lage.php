<?php
/*
Block Name: Lage
Block Description: Element zur Anzeige der Lage mit Situationsplan, Text und Legende.
Post Types: post, page, custom-type
Block Mode: edit
*/

use bbase\HTMLHelper;

$fields = $args['fields'] ?? get_fields();

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-2 d-flex flex-column justify-content-between">
            <?php if($fields['title'] !== "" || $fields['text'] !== "") { ?>
                <div class="row mt-20">
                    <div class="col-2 col-md-6">
                        <?php if($fields['title'] !== "") { ?>
                            <?= HTMLHelper::getTitle($fields['title'], ['class' => 'h2 mb-20']) ?>
                        <?php } ?>
                    </div>
                    <div class="col-4 col-md-6">
                        <?php if($fields['text'] !== "") { ?>
                            <div class="rich-text">
                                <?= $fields['text'] ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <?php if($fields['title_legend']) { ?>
                <div class="legend-container">
                    <span><?= $fields['title_legend'] ?></span>
                    <div class="rich-text"><?= $fields['text_legend'] ?></div>
                </div>
            <?php } ?>
        </div>
        <div class="col-4">
            <?php if($fields['image_clone']['image_desktop']) { ?>
                <?= HTMLHelper::renderPicturetag('image-right', $fields['image_clone']) ?>
            <?php } ?>
        </div>
    </div>
</div>
