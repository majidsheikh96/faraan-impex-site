<?php
/** Homepage — dynamic categories + featured products. */
$page_title = 'Faraan Impex — Premium Leather Garments Manufacturer & Exporter, Sialkot';
$topCats = get_top_categories();
$featured = get_featured_products(8);
?>

<!-- Hero -->
<section class="bg-[#0A0A0A] text-[#FAF7F2]">
  <div class="max-w-7xl mx-auto px-4 py-20 md:py-28">
    <h1 class="text-4xl md:text-6xl font-extrabold leading-tight max-w-3xl">
      Premium Leather Garments,<br>Crafted in Sialkot. <span class="text-[#E10600]">Shipped Worldwide.</span>
    </h1>
    <p class="mt-6 text-lg text-[#FAF7F2]/70 max-w-2xl">B2B manufacturer &amp; exporter of leather wears, textile wears, western wears and leather products. Custom OEM orders welcome.</p>
    <div class="mt-8 flex flex-wrap gap-4">
      <a href="#categories" class="bg-[#E10600] text-white px-6 py-3 rounded font-semibold hover:brightness-110 transition">Browse Catalog</a>
      <a href="<?= whatsapp_link("Assalam-o-Alaikum, I'd like to enquire about your products.") ?>" target="_blank" rel="noopener" class="bg-[#25D366] text-white px-6 py-3 rounded font-semibold hover:brightness-95 transition">Chat on WhatsApp</a>
    </div>
  </div>
</section>

<!-- Categories -->
<section id="categories" class="max-w-7xl mx-auto px-4 py-16">
  <h2 class="text-3xl font-extrabold mb-8">Shop by Category</h2>
  <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <?php foreach ($topCats as $cat): ?>
    <a href="/<?= e($cat['slug']) ?>/" class="group bg-white rounded-xl border border-[#0A0A0A]/10 overflow-hidden hover:shadow-lg transition">
      <div class="aspect-[4/3] bg-[#0A0A0A]/5 flex items-center justify-center text-[#E10600] text-5xl font-extrabold">
        <?= e(strtoupper(substr($cat['name'], 0, 1))) ?>
      </div>
      <div class="p-5">
        <h3 class="font-bold text-lg group-hover:text-[#E10600]"><?= e($cat['name']) ?></h3>
        <p class="text-sm text-[#0A0A0A]/60 mt-1"><?= (int)$cat['live_count'] ?> products</p>
      </div>
    </a>
    <?php endforeach; ?>
  </div>
</section>

<!-- Featured products -->
<?php if ($featured): ?>
<section class="max-w-7xl mx-auto px-4 py-8">
  <h2 class="text-3xl font-extrabold mb-8">Featured Products</h2>
  <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
    <?php foreach ($featured as $p): ?>
      <?php $pcat = db()->prepare('SELECT slug FROM categories WHERE id = ?'); $pcat->execute([$p['category_id']]); $pslug = $pcat->fetchColumn(); ?>
      <a href="/<?= e($pslug) ?>/<?= e($p['slug']) ?>/" class="group bg-white rounded-xl border border-[#0A0A0A]/10 overflow-hidden hover:shadow-lg transition">
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
</section>
<?php endif; ?>

<!-- Trust band -->
<section class="bg-[#0A0A0A] text-[#FAF7F2] mt-16">
  <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-2 lg:grid-cols-4 gap-6 text-center">
    <div><div class="font-bold text-lg">Sialkot-Based</div><div class="text-sm text-[#FAF7F2]/60">Manufacturing</div></div>
    <div><div class="font-bold text-lg">Direct Factory</div><div class="text-sm text-[#FAF7F2]/60">Pricing</div></div>
    <div><div class="font-bold text-lg">Custom OEM</div><div class="text-sm text-[#FAF7F2]/60">Orders Welcome</div></div>
    <div><div class="font-bold text-lg">Worldwide</div><div class="text-sm text-[#FAF7F2]/60">Shipping</div></div>
  </div>
</section>
