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
        <div class="rich-text mt-20">
            <?= $fields['text'] ?>
        </div>
    <?php } ?>
    <?php if(count($fields['images']) > 0) { ?>
        <div class="row">
            <?php foreach($fields['images'] as $image) { ?>
                <figure class="col-6 col-md-3 col-lg-2 mt-20">
                    <?= \FastImg\FastImg::getType('slider-text', $image) ?>
                    <?php if($image['caption'] !== "") { ?>
                        <figcaption class="mt-20"><?= $image['caption'] ?></figcaption>
                    <?php } ?>
                </figure>
            <?php } ?>
        </div>
    <?php } ?>
</div>
