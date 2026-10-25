<?php
/** Category listing (design: Category.dc.html). Vars from router: $category, $products, $subcategories, $total, $page, $perPage. */
$parent = !empty($category['parent_id']) ? get_category_by_id((int)$category['parent_id']) : null;
$root = $parent ?: $category;
$chips = $parent ? get_subcategories((int)$parent['id']) : $subcategories;
$kicker = !empty($category['kicker']) ? $category['kicker'] : 'DIRECT SIALKOT FACTORY CONTRACT PRODUCTION';
$lead = !empty($category['lead_text']) ? $category['lead_text'] : 'Made to your pattern from graded materials, with custom branding on every line. Send a tech pack and the factory desk quotes within two hours.';
$moq = !empty($category['custom_moq']) ? $category['custom_moq'] : '';
$statCount = $subcategories ? count($subcategories) : $total;
$statLabel = $category['stat_label'] ?? ($subcategories ? 'Product lines' : 'Styles');
$shown = count($products);
?>
<section class="page-hero">
  <div class="wrap">
    <nav class="crumbs" aria-label="Breadcrumb">
      <a href="/">Home</a> <span aria-hidden="true">/</span>
      <?php if ($parent): ?><a href="/<?= e($parent['slug']) ?>/"><?= e(display_name($parent['name'])) ?></a> <span aria-hidden="true">/</span><?php endif; ?>
      <span><?= e(display_name($category['name'])) ?></span>
    </nav>
    <div class="hero-split">
      <div class="l">
        <span class="eyebrow on-dark"><?= e($kicker) ?></span>
        <h1 class="h-display h-xl"><?= e(display_name($category['name'])) ?></h1>
        <p><?= e($lead) ?></p>
      </div>
      <div class="hero-stats">
        <div><div class="v"><?= (int)$statCount ?></div><div class="c"><?= e($statLabel) ?></div></div>
        <?php if ($moq !== ''): ?><div><div class="v"><?= e($moq) ?></div><div class="c">MOQ</div></div><?php else: ?><div><div class="v">&lt; 2 hrs</div><div class="c">Formal FOB quote</div></div><?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php if ($chips): ?>
<section class="wrap" style="padding-top:40px">
  <div class="chips" aria-label="Product lines">
    <a class="chip<?= $parent ? '' : ' is-on' ?>" href="/<?= e($root['slug']) ?>/">All</a>
    <?php foreach ($chips as $c): ?>
      <a class="chip<?= $c['id'] == $category['id'] ? ' is-on' : '' ?>" href="/<?= e($c['slug']) ?>/"><?= e(display_name($c['name'])) ?></a>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>

<section class="wrap" style="padding-top:40px;padding-bottom:88px">
  <?php if (!$products): ?>
    <div class="card" style="padding:48px;text-align:center">
      <h3 style="font-size:32px;margin-bottom:8px">No live styles in this line yet</h3>
      <p style="flex:none">Contact the factory desk to develop bespoke items in this category.</p>
    </div>
  <?php else: ?>
    <div class="grid-4" data-grid>
      <?php require __DIR__ . '/partials/product-cards.php'; ?>
    </div>
    <?php if ($shown < $total): ?>
      <div style="text-align:center;margin-top:48px" data-more-wrap>
        <a class="btn btn-ghost" data-load-more href="/<?= e($category['slug']) ?>/?page=<?= (int)$page + 1 ?>">Load more styles <span class="mono" style="font-size:13px;font-weight:400" data-count><?= $shown ?> / <?= $total ?></span></a>
      </div>
    <?php endif; ?>
  <?php endif; ?>
</section>

<section class="cta-band">
  <div class="wrap">
    <div><h2>Don&rsquo;t see your style?</h2><p>Send a tech pack or reference photos. The factory desk replies with a formal FOB quotation within two hours.</p></div>
    <a class="btn btn-primary" href="/contact-us">Send your tech pack</a>
  </div>
</section>
