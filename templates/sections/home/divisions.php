<?php /** Four manufacturing divisions (admin: Homepage → divisions_json). */ $divisions = get_divisions_data(); ?>
<section id="divisions" class="wrap sec">
  <div class="sec-head">
    <div>
      <span class="eyebrow">01 &mdash; MANUFACTURING DIVISIONS</span>
      <h2 class="h-display h-lg"><?= nl2br(e(get_setting('divisions_heading', 'Four dedicated production divisions.'))) ?></h2>
    </div>
    <div style="max-width:400px">
      <p style="margin:0;color:#333;font-size:17px"><?= e(get_setting('divisions_subheading', 'Our Sialkot facility is equipped with dedicated cutting lines, heavy-stitch machinery, and finishing units across four specialized sectors — ensuring every order meets international export standards.')) ?></p>
      <div class="cat-stats"><?= (int)count_all_products() ?> STYLES &middot; <?= (int)count_product_lines() ?> PRODUCT LINES &middot; <?= count($divisions) ?> DIVISIONS</div>
    </div>
  </div>
  <div class="grid-div">
    <?php foreach ($divisions as $i => $d): ?>
      <a class="card" href="<?= e($d['href'] ?? '#') ?>">
        <div class="thumb" style="aspect-ratio:4/3">
          <?php if (!empty($d['image'])): ?><img src="<?= e($d['image']) ?>" alt="<?= e($d['title'] ?? '') ?>" loading="lazy"><?php else: ?><div class="noimg"><?= e($d['kicker'] ?? '') ?></div><?php endif; ?>
        </div>
        <div class="body">
          <span class="tag">D-<?= e(str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT)) ?></span>
          <h3><?= e($d['title'] ?? '') ?></h3>
          <p><?= e($d['lead'] ?? '') ?></p>
          <?php if (!empty($d['specs'])): ?><div class="specline"><?= e(implode(' · ', $d['specs'])) ?></div><?php endif; ?>
          <span class="go"><?= e($d['cta'] ?? 'Explore') ?> <?= icon_arrow(18, 'card-arrow') ?></span>
        </div>
      </a>
    <?php endforeach; ?>
  </div>
</section>
