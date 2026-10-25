<?php
/** Product cards for category / all-styles. Needs $products and $category. Also served on its own for AJAX load-more. */
?>
<?php foreach ($products as $p): $url = '/' . ($p['category_slug'] ?? $category['slug']) . '/' . $p['slug'] . '/'; ?>
        <div class="card prod">
          <a class="thumb card-photo" href="<?= e($url) ?>">
            <?php if (!empty($p['image'])): ?><img src="/<?= e($p['image']) ?>" alt="<?= e($p['name']) ?>" loading="lazy"><?php else: ?><div class="noimg"><?= e($p['sku']) ?></div><?php endif; ?>
          </a>
          <div class="body">
            <span class="tag"><?= e($p['sku']) ?></span>
            <h3><a href="<?= e($url) ?>"><?= e($p['name']) ?></a></h3>
            <span class="specline">EXPORT GRADE &middot; SIALKOT FACTORY</span>
            <div class="links">
              <a href="<?= e($url) ?>">View specifications</a>
              <a href="<?= e(product_whatsapp_link($p['name'], $p['sku'])) ?>" target="_blank" rel="noopener">WhatsApp inquiry</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
