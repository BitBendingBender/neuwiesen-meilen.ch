<?php
/*
Block Name: Kontakt
Block Description: Kontaktelement am Ende der Seite.
Post Types: post, page, custom-type
Block Mode: edit
*/

use bbase\HTMLHelper;

$fields = $args['fields'] ?? get_fields();

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <?php if($fields['title'] !== "") { ?>
                <?= HTMLHelper::getTitle($fields['title'], ['class' => 'h2']) ?>
            <?php } ?>
            <?php if($fields['text'] !== "") { ?>
                <div class="rich-text pt-20">
                    <?= $fields['text'] ?>
                </div>
            <?php } ?>
        </div>
        <div class="col-md-4">
            <?= do_shortcode($fields['form_shortcode']) ?>
        </div>
    </div>
</div>
