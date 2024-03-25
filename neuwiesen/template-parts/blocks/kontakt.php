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
                <div class="rich-text pt-15">
                    <?= $fields['text'] ?>
                </div>
            <?php } ?>
        </div>
        <div class="col-md-4 pt-15 pt-md-0">
            <?= do_shortcode($fields['form_shortcode']) ?>
        </div>
    </div>
</div>
<?php if($fields['download_text'] === "") return; ?>
<div class="download-container">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-2">
                <?= HTMLHelper::getTitle($fields['download_text'], ['class' => 'h2'], 3) ?>
            </div>
            <div class="col-md-4">
                <?= HTMLHelper::renderButtonGroup('pt-15 pt-md-0', $fields['download_link']) ?>
            </div>
        </div>
    </div>
</div>
