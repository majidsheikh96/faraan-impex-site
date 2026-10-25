<?php
/** Product detail (design: Product.dc.html). Vars from router: $product, $related. */
$specs = !empty($product['specs']) ? (json_decode($product['specs'], true) ?: []) : [];
$gallery = !empty($product['gallery']) ? (json_decode($product['gallery'], true) ?: []) : [];
$images = array_values(array_filter(array_merge([$product['image'] ?? ''], $gallery)));
$productMoq = !empty($product['moq']) ? $product['moq'] : (!empty($product['custom_moq']) ? $product['custom_moq'] : '');
$sampleTurnaround = get_setting('sample_turnaround', '7–10 days');
$quoteTurnaround = get_setting('quote_turnaround', 'Under 2 hours') ;

$desc = clean_description($product['description'] ?? '');
if ($desc === '') {
    $desc = $product['name'] . ' made to your pattern. Send your tech pack and the factory desk replies with a formal FOB quotation within two hours.';
}

$cat = get_category_by_id((int)$product['category_id']);
$parent = $cat && !empty($cat['parent_id']) ? get_category_by_id((int)$cat['parent_id']) : null;
$catUrl = '/' . $product['category_slug'] . '/';
?>
<section class="wrap" style="padding-top:28px">
  <nav class="crumbs" aria-label="Breadcrumb" style="color:var(--muted)">
    <a href="/">Home</a> <span aria-hidden="true">/</span>
    <?php if ($parent): ?><a href="/<?= e($parent['slug']) ?>/"><?= e(display_name($parent['name'])) ?></a> <span aria-hidden="true">/</span><?php endif; ?>
    <a href="<?= e($catUrl) ?>"><?= e(display_name($product['category_name'])) ?></a> <span aria-hidden="true">/</span>
    <span style="color:var(--ink);font-weight:500"><?= e($product['sku']) ?></span>
  </nav>
</section>

<section class="wrap" style="padding-top:28px;padding-bottom:72px">
  <div class="pdp">
    <div>
      <div class="pdp-main">
        <?php if ($images): ?><img id="pdp-img" src="/<?= e($images[0]) ?>" alt="<?= e($product['name']) ?>"><?php else: ?><div class="noimg"><?= e($product['sku']) ?></div><?php endif; ?>
      </div>
      <?php if (count($images) > 1): ?>
        <div class="pdp-thumbs">
          <?php foreach (array_slice($images, 0, 5) as $k => $im): ?>
            <button type="button" class="<?= $k === 0 ? 'is-on' : '' ?>" data-src="/<?= e($im) ?>" aria-label="View image <?= $k + 1 ?>"><img src="/<?= e($im) ?>" alt="" loading="lazy"></button>
          <?php endforeach; ?>
        </div>
        <script>
        document.querySelectorAll('.pdp-thumbs button').forEach(function (b) {
          b.addEventListener('click', function () {
            document.getElementById('pdp-img').src = b.dataset.src;
            document.querySelectorAll('.pdp-thumbs button').forEach(function (x) { x.classList.toggle('is-on', x === b); });
          });
        });
        </script>
      <?php endif; ?>
    </div>

    <div style="display:flex;flex-direction:column;gap:24px">
      <span class="eyebrow">SKU <?= e($product['sku']) ?> &middot; EXPORT GRADE &middot; SIALKOT FACTORY</span>
      <h1 class="h-display h-lg"><?= e($product['name']) ?></h1>
      <p class="lede" style="margin:0"><?= nl2br(e($desc)) ?></p>
      <div class="facts">
        <div><div class="k">MOQ</div><div class="v"><?= $productMoq !== '' ? e($productMoq) : '<a href="/contact-us" style="text-decoration:underline;text-underline-offset:3px">On request &mdash; contact us</a>' ?></div></div>
        <div><div class="k">First counter-sample</div><div class="v"><?= e($sampleTurnaround) ?></div></div>
        <div><div class="k">Branding</div><div class="v">Custom labels &amp; hardware</div></div>
        <div><div class="k">Quotation</div><div class="v"><?= e($quoteTurnaround) ?>, FOB</div></div>
      </div>
      <div class="pdp-cta" style="display:flex;flex-wrap:wrap;gap:14px">
        <a class="btn btn-primary" href="/contact-us">Request a quote</a>
        <a class="btn btn-ghost" href="<?= e(product_whatsapp_link($product['name'], $product['sku'])) ?>" target="_blank" rel="noopener">WhatsApp inquiry</a>
      </div>
    </div>
  </div>
</section>

<?php if ($specs): ?>
<section style="background:#fff;border-top:1px solid var(--line);border-bottom:1px solid var(--line)">
  <div class="wrap" style="padding-top:64px;padding-bottom:64px;display:flex;flex-direction:column;gap:32px">
    <div style="display:flex;flex-direction:column;gap:12px">
      <span class="eyebrow">SPECIFICATIONS</span>
      <h2 class="h-display h-md">Product specs</h2>
      <p style="margin:0;color:#333;max-width:520px">Final specs are confirmed on your counter-sample.</p>
    </div>
    <div class="specs">
      <?php foreach ($specs as $k => $v): ?>
        <div><span class="k"><?= e(ucfirst((string)$k)) ?></span><span class="v"><?= e(is_array($v) ? implode(', ', $v) : (string)$v) ?></span></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if (!empty($related)): ?>
<section class="wrap sec-tight">
  <div style="display:flex;flex-direction:column;gap:14px;margin-bottom:40px">
    <span class="eyebrow">MORE FROM <?= e(strtoupper(display_name($product['category_name']))) ?></span>
    <h2 class="h-display h-md">Related styles</h2>
  </div>
  <div class="grid-4">
    <?php foreach ($related as $r): $url = $catUrl . $r['slug'] . '/'; ?>
      <div class="card prod">
        <a class="thumb card-photo" href="<?= e($url) ?>">
          <?php if (!empty($r['image'])): ?><img src="/<?= e($r['image']) ?>" alt="<?= e($r['name']) ?>" loading="lazy"><?php else: ?><div class="noimg"><?= e($r['sku']) ?></div><?php endif; ?>
        </a>
        <div class="body">
          <span class="tag"><?= e($r['sku']) ?></span>
          <h3><a href="<?= e($url) ?>"><?= e($r['name']) ?></a></h3>
          <span class="specline">EXPORT GRADE &middot; SIALKOT FACTORY</span>
          <div class="links">
            <a href="<?= e($url) ?>">View specifications</a>
            <a href="<?= e(product_whatsapp_link($r['name'], $r['sku'])) ?>" target="_blank" rel="noopener">WhatsApp inquiry</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>
