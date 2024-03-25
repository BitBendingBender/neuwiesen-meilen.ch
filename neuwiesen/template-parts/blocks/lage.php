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
        <div class="col-lg-2 d-flex flex-column justify-content-between">
            <?php if($fields['title'] !== "" || $fields['text'] !== "") { ?>
                <div class="row">
                    <div class="col-md-6">
                        <?php if($fields['title'] !== "") { ?>
                            <?= HTMLHelper::getTitle($fields['title'], ['class' => 'h2 mb-15']) ?>
                        <?php } ?>
                    </div>
                    <div class="col-md-6">
                        <?php if($fields['text'] !== "") { ?>
                            <div class="rich-text">
                                <?= $fields['text'] ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <?php if($fields['title_legend']) { ?>
                <div class="legend-container d-none d-lg-block">
                    <span><?= $fields['title_legend'] ?></span>
                    <?php if($fields['text_legend'] !== "") { ?>
                        <?php
                        $newLegend = preg_replace_callback('/<li>(\d+)(\s=\s)(.*)<\/li>/Ui', function($matches) {
                            return "<li><span class='tab'><span class='nr'>$matches[1]</span><span class='equal'>=&nbsp;</span></span>$matches[3]</li>";
                        }, $fields['text_legend']);
                        ?>
                        <div class="rich-text"><?= $newLegend ?></div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <div class="col-lg-4 mt-15 mt-lg-0">
            <?php if($fields['image_clone']['image_desktop']) { ?>
                <?= HTMLHelper::renderPicturetag('image-right', $fields['image_clone']) ?>
            <?php } ?>
            <?php if($fields['title_legend']) { ?>
                <div class="legend-container mt-15 d-block d-lg-none">
                    <span><?= $fields['title_legend'] ?></span>
                    <?php if($fields['text_legend'] !== "") { ?>
                        <?php
                        $newLegend = preg_replace_callback('/<li>(\d+)(\s=\s)(.*)<\/li>/Ui', function($matches) {
                           return "<li><span class='tab'><span class='nr'>$matches[1]</span><span class='equal'>=&nbsp;</span></span>$matches[3]</li>";
                        }, $fields['text_legend']);
                        ?>
                        <div class="rich-text"><?= $newLegend ?></div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
