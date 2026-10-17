<?php
/** Category listing — filters sidebar + product grid. Expects $category, $products, $subcategories. */
$page_title = e($category['name']) . ' — Faraan Impex';
$page_description = e($category['meta_description'] ?: $category['name'] . ' — wholesale B2B catalog from Faraan Impex, Sialkot.');
?>

<!-- Category hero -->
<section class="bg-[#0A0A0A] text-[#FAF7F2]">
  <div class="max-w-7xl mx-auto px-4 py-12">
    <nav class="text-sm text-[#FAF7F2]/60 mb-3">
      <a href="/" class="hover:text-[#E10600]">Home</a> / <span><?= e($category['name']) ?></span>
    </nav>
    <h1 class="text-4xl font-extrabold"><?= e(strtoupper($category['name'])) ?></h1>
    <p class="mt-2 text-[#FAF7F2]/70"><?= count($products) ?> products — Sialkot-crafted for wholesale</p>
  </div>
</section>

<div class="max-w-7xl mx-auto px-4 py-10 flex flex-col lg:flex-row gap-8">
  <!-- Sidebar filters -->
  <aside class="lg:w-64 shrink-0">
    <div class="bg-white rounded-xl border border-[#0A0A0A]/10 p-5 sticky top-24">
      <h3 class="font-bold mb-4">Subcategories</h3>
      <?php if ($subcategories): ?>
        <ul class="space-y-2 text-sm">
          <?php foreach ($subcategories as $sub): ?>
            <li>
              <label class="flex items-center gap-2 cursor-pointer hover:text-[#E10600]">
                <input type="checkbox" class="accent-[#E10600]" data-subcat="<?= e($sub['slug']) ?>">
                <?= e($sub['name']) ?>
              </label>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <p class="text-sm text-[#0A0A0A]/50">No subcategories.</p>
      <?php endif; ?>
    </div>
  </aside>

  <!-- Product grid -->
  <div class="flex-1">
    <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
      <?php foreach ($products as $p): ?>
        <a href="/<?= e($category['slug']) ?>/<?= e($p['slug']) ?>/" class="group bg-white rounded-xl border border-[#0A0A0A]/10 overflow-hidden hover:shadow-lg transition">
          <?php if ($p['image']): ?>
          <div class="aspect-square overflow-hidden bg-[#0A0A0A]/5"><img src="/<?= e($p['image']) ?>" alt="<?= e($p['name']) ?>" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition"></div>
        <?php else: ?>
          <div class="aspect-square bg-[#0A0A0A]/5 flex items-center justify-center text-[#0A0A0A]/30 text-sm">Product image</div>
        <?php endif; ?>
          <div class="p-4">
            <h3 class="font-semibold group-hover:text-[#E10600]"><?= e($p['name']) ?></h3>
            <p class="text-xs text-[#0A0A0A]/50 mt-1">SKU: <?= e($p['sku']) ?></p>
            <span class="inline-block mt-3 text-sm font-medium text-[#25D366]">Enquire on WhatsApp →</span>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
    <?php if (!count($products)): ?>
      <p class="text-[#0A0A0A]/60 py-12 text-center">No products in this category yet.</p>
    <?php endif; ?>
  </div>
</div>
