<?php
/* @var array $args*/
/* @var string $args['url']     Url of button */
/* @var string $args['target']  Target of button */
/* @var string $args['title']   Title  of button */
/* @var string $args['type']    Type  of button. Basically just an additional class */
/* @var string $args['before']  Inject content infront of title */
?>
<a href="<?= $args['url'] ?? '' ?>" target="<?= $args['target'] ?? '' ?>" title="<?= $args['title'] ?? '' ?>" class="button <?= $args['type'] ?? '' ?>">
    <?= $args['before'] ?? '' ?><?= $args['title'] ?? '' ?>
</a>
