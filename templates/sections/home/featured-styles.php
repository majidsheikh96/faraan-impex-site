<?php /** Featured styles — products flagged is_featured in the catalogue (8). */ $featured = get_featured_products(8); ?>
<?php if ($featured): ?>
<section class="wrap sec-tight">
  <div class="sec-head" style="margin-bottom:40px">
    <div>
      <span class="eyebrow">04 &mdash; FACTORY HIGHLIGHTS</span>
      <h2 class="h-display h-lg">Styles ready for sampling</h2>
    </div>
    <p style="max-width:380px">Custom branding on every style. Contact us for MOQ and pricing.</p>
  </div>
  <div class="grid-4">
    <?php foreach ($featured as $p):
      $url = '/' . $p['category_slug'] . '/' . $p['slug'] . '/'; ?>
      <div class="card prod">
        <a class="thumb card-photo" href="<?= e($url) ?>">
          <?php if (!empty($p['image'])): ?><img src="/<?= e($p['image']) ?>" alt="<?= e($p['name']) ?>" loading="lazy"><?php else: ?><div class="noimg"><?= e($p['sku']) ?></div><?php endif; ?>
        </a>
        <div class="body">
          <span class="tag"><?= e($p['sku']) ?></span>
          <h3><a href="<?= e($url) ?>"><?= e($p['name']) ?></a></h3>
          <div class="links">
            <a href="<?= e($url) ?>">View specifications</a>
            <a href="<?= e(product_whatsapp_link($p['name'], $p['sku'])) ?>" target="_blank" rel="noopener">WhatsApp inquiry</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <div style="text-align:center;margin-top:48px">
    <a class="btn btn-ghost" href="/all-styles/">Browse all <?= (int)count_all_products() ?> styles <?= icon_arrow(18) ?></a>
  </div>
</section>
<?php endif; ?>
