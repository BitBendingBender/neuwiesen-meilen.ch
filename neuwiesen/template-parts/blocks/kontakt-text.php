<?php
/*
Block Name: Kontakt - Text
Block Description: Kontaktelement am Ende der Seite mit Ansprechpartner.
Post Types: post, page, custom-type
Block Mode: edit
*/

use bbase\HTMLHelper;

$fields = $args['fields'] ?? get_fields();

?>
<div class="container-fluid mt-n20">
    <?php foreach($fields['elements'] as $element) { ?>
        <div class="row mt-15">
            <div class="col-md-2 text-md-end">
                <?php if($element['title'] !== "") { ?>
                    <?= HTMLHelper::getTitle($element['title'], ['class' => 'h2']) ?>
                <?php } ?>
            </div>
            <div class="col-md-4">
                <?php if($element['text'] !== "") { ?>
                    <div class="rich-text">
                        <?= $element['text'] ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>