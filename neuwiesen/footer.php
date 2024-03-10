<?php
$translations = [];
if(function_exists('pll_the_languages')) $translations = pll_the_languages(array( 'raw' => 1 ));
?>
<footer>
    <div class="container-fluid">
        <div class="row align-items-end">
            <div class="col-md-5">
                <?= wp_nav_menu([
                    'theme_location' => 'footer',
                    'fallback_cb' => false,
                    'container' => '',
                    'menu_clas' => 'footer-menu'
                ]) ?>
            </div>
            <?php if(count($translations) > 1) { ?>
                <div class="col-md-5">
                    <ul class="language-switch">
                        <?php foreach($translations as $translation) { ?>
                            <li><a href="<?= $translation['url'] ?>" class="<?= implode(' ', $translation['classes']) ?>"><?= $translation['slug'] ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
