<section id="<?= $args['block']['attrs']['id'] ?? $args['block']['attrs']['blockId'] ?? '' ?>" class="<?= explode('/', $args['block']['blockName'])[1] ?>" <?= implode(" ", $args['attributes'] ?? []) ?>>
  <?php if(str_contains($args['block']['blockName'], 'core/')) { ?>
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-6">
  <?php } ?>
  <?= $args['content'] ?>
  <?php if(str_contains($args['block']['blockName'], 'core/')) { ?>
              </div>
          </div>
      </div>
  <?php } ?>
</section>