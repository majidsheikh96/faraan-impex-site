<?php
/** Product detail — gallery, specs, WhatsApp CTA. No prices (B2B). Expects $product, $related. */
$page_title = e($product['name']) . ' (' . e($product['sku']) . ') — Faraan Impex';
$page_description = e($product['meta_description'] ?: $product['name'] . ' — wholesale enquiry from Faraan Impex, Sialkot.');
$specs = $product['specs'] ? json_decode($product['specs'], true) : [];
$gallery = $product['gallery'] ? json_decode($product['gallery'], true) : [];
?>
<div class="max-w-7xl mx-auto px-4 py-10">
  <nav class="text-sm text-[#0A0A0A]/60 mb-6">
    <a href="/" class="hover:text-[#E10600]">Home</a> /
    <a href="/<?= e($product['category_slug']) ?>/" class="hover:text-[#E10600]"><?= e($product['category_name']) ?></a> /
    <span><?= e($product['name']) ?></span>
  </nav>

  <div class="grid md:grid-cols-2 gap-10">
    <!-- Gallery -->
    <div>
      <?php if ($product['image']): ?>
      <div class="aspect-square rounded-xl overflow-hidden bg-[#0A0A0A]/5"><img src="/<?= e($product['image']) ?>" alt="<?= e($product['name']) ?>" class="w-full h-full object-cover"></div>
      <?php else: ?>
      <div class="aspect-square bg-[#0A0A0A]/5 rounded-xl flex items-center justify-center text-[#0A0A0A]/30">Main product image</div>
      <?php endif; ?>
      <?php if ($gallery): ?>
      <div class="grid grid-cols-4 gap-3 mt-3">
        <?php foreach (array_slice($gallery, 0, 4) as $g): ?>
          <div class="aspect-square bg-[#0A0A0A]/5 rounded-lg"></div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>

    <!-- Info -->
    <div>
      <h1 class="text-3xl font-extrabold"><?= e($product['name']) ?></h1>
      <p class="text-sm text-[#0A0A0A]/50 mt-2">SKU: <?= e($product['sku']) ?> &nbsp;|&nbsp; Category: <?= e($product['category_name']) ?></p>
      <?php if ($product['description']): ?>
        <p class="mt-5 leading-relaxed"><?= e($product['description']) ?></p>
      <?php endif; ?>
      <?php if ($specs): ?>
        <h3 class="font-bold mt-6 mb-3">Specifications</h3>
        <dl class="text-sm divide-y divide-[#0A0A0A]/10">
          <?php foreach ($specs as $k => $v): ?>
            <div class="flex py-2"><dt class="w-32 font-medium text-[#0A0A0A]/60"><?= e((string)$k) ?></dt><dd><?= e((string)$v) ?></dd></div>
          <?php endforeach; ?>
        </dl>
      <?php endif; ?>
      <div class="mt-8 flex flex-wrap gap-4">
        <a href="<?= product_whatsapp_link($product['name'], $product['sku']) ?>" target="_blank" rel="noopener" class="bg-[#25D366] text-white px-6 py-3 rounded font-semibold hover:brightness-95 transition">Enquire on WhatsApp</a>
        <a href="/contact-us" class="border border-[#0A0A0A] px-6 py-3 rounded font-semibold hover:bg-[#0A0A0A] hover:text-white transition">Request Full Catalog</a>
      </div>
      <p class="text-xs text-[#0A0A0A]/50 mt-4">B2B wholesale only — no retail prices listed. Contact us for quotations.</p>
    </div>
  </div>

  <!-- Related -->
  <?php if ($related): ?>
  <section class="mt-16">
    <h2 class="text-2xl font-extrabold mb-6">Related Products</h2>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
      <?php foreach ($related as $r): ?>
        <a href="/<?= e($product['category_slug']) ?>/<?= e($r['slug']) ?>/" class="group bg-white rounded-xl border border-[#0A0A0A]/10 overflow-hidden hover:shadow-lg transition">
          <?php if ($r['image']): ?>
            <div class="aspect-square overflow-hidden bg-[#0A0A0A]/5"><img src="/<?= e($r['image']) ?>" alt="<?= e($r['name']) ?>" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition"></div>
          <?php else: ?>
            <div class="aspect-square bg-[#0A0A0A]/5"></div>
          <?php endif; ?>
          <div class="p-4">
            <h3 class="font-semibold group-hover:text-[#E10600]"><?= e($r['name']) ?></h3>
            <p class="text-xs text-[#0A0A0A]/50 mt-1">SKU: <?= e($r['sku']) ?></p>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </section>
  <?php endif; ?>
</div>
