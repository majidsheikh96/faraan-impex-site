<?php
/**
 * Product Specification Sheet — Luxury B2B Contract Manufacturing Detail (Stagfield Caliber)
 * High-precision photographic gallery, technical hide and hardware table, and direct quotation triggers.
 */
$page_title = e($product['name']) . ' (' . e($product['sku']) . ') — Private Label Manufacturing | FARAAN IMPEX';
$page_description = e($product['meta_description'] ?: $product['name'] . ' — export-grade OEM/ODM specification sheet from Faraan Impex, Sialkot, Pakistan.');
$specs = !empty($product['specs']) ? json_decode($product['specs'], true) : [];
$gallery = !empty($product['gallery']) ? json_decode($product['gallery'], true) : [];

// Clean legacy scraped script fragments if present
$desc = $product['description'] ?? '';
$desc = preg_replace('/\(window\.matchMedia.*?\)\s*/si', '', $desc);
$desc = preg_replace('/.*location\.replace\(.*?\)\s*;\s*/si', '', $desc);
$desc = trim($desc);
?>

<div class="bg-paper py-10 sm:py-14 border-b border-[#E6E4DD]">
  <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Breadcrumbs -->
    <nav class="font-mono text-xs text-[#5A6472] uppercase tracking-wider mb-8 flex items-center gap-2">
      <a href="/" class="hover:text-[#070709] transition-colors">Home</a>
      <span class="text-[#E6E4DD]">/</span>
      <a href="/<?= e($product['category_slug']) ?>/" class="hover:text-[#070709] transition-colors"><?= e($product['category_name']) ?></a>
      <span class="text-[#E6E4DD]">/</span>
      <span class="text-crimson font-semibold truncate"><?= e($product['name']) ?></span>
    </nav>

    <!-- Main Specification Showcase -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
      
      <!-- Left Column: High-Res Spec Gallery (7 cols) -->
      <div class="lg:col-span-7">
        <div class="bg-white rounded-[24px] border border-[#E6E4DD] overflow-hidden shadow-[0_4px_24px_rgba(0,0,0,0.03)] p-4 sm:p-6">
          <div class="relative aspect-square sm:aspect-[4/3] rounded-[18px] overflow-hidden bg-white flex items-center justify-center">
            <?php if (!empty($product['image'])): ?>
              <img src="/<?= e($product['image']) ?>" 
                   alt="<?= e($product['name']) ?>" 
                   class="w-full h-full object-contain p-4 mix-blend-multiply">
            <?php else: ?>
              <div class="w-full h-full flex items-center justify-center text-[#94A3B8] font-mono text-sm">
                SPECIFICATION PROTOTYPE IMAGE
              </div>
            <?php endif; ?>
          </div>

          <?php if (!empty($gallery)): ?>
            <div class="grid grid-cols-4 gap-3 sm:gap-4 mt-4">
              <?php foreach (array_slice($gallery, 0, 4) as $g): ?>
                <div class="aspect-square bg-white rounded-xl overflow-hidden border border-[#E6E4DD] p-1 flex items-center justify-center">
                  <img src="/<?= e($g) ?>" alt="" class="w-full h-full object-cover mix-blend-multiply rounded-lg">
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>

        <!-- Factory Quality Notice -->
        <div class="mt-6 p-5 rounded-[18px] bg-white border border-[#E6E4DD] flex items-center justify-between text-xs font-mono text-[#5A6472]">
          <span class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            Direct Factory Production Line
          </span>
          <span>100% In-Line Dual Station QC</span>
          <span>Sialkot Export FOB/CIF</span>
        </div>
      </div>

      <!-- Right Column: Commercial Dossier & Customization (5 cols) -->
      <div class="lg:col-span-5 space-y-7">
        <div>
          <span class="font-mono text-crimson text-[11px] uppercase tracking-[0.18em] font-bold block mb-2">
            <?= e(strtoupper($product['category_name'])) ?> · OEM/ODM SPEC
          </span>
          <h1 class="font-serif text-3xl sm:text-4xl text-[#070709] font-normal leading-tight">
            <?= e($product['name']) ?>
          </h1>
          <p class="font-mono text-xs text-[#5A6472] mt-2">
            Product SKU: <span class="text-[#070709] font-semibold"><?= e($product['sku']) ?></span> · Direct Sialkot Atelier
          </p>
        </div>

        <?php if (!empty($desc)): ?>
          <div class="p-6 rounded-[20px] bg-white border border-[#E6E4DD] shadow-sm">
            <h3 class="font-mono text-xs text-[#070709] uppercase tracking-wider font-bold mb-2">
              Construction Overview
            </h3>
            <p class="text-[#5A6472] text-sm leading-relaxed font-body">
              <?= e($desc) ?>
            </p>
          </div>
        <?php endif; ?>

        <!-- Technical Specification Sheet -->
        <div class="bg-white rounded-[20px] border border-[#E6E4DD] p-6 shadow-sm">
          <h3 class="font-mono text-xs text-[#070709] uppercase tracking-wider font-bold mb-4 pb-3 border-b border-[#E6E4DD]">
            Technical Parameters
          </h3>
          <dl class="text-xs sm:text-sm divide-y divide-[#E6E4DD]">
            <div class="flex justify-between py-2.5">
              <dt class="font-mono text-[#5A6472] uppercase">Minimum Order Quantity</dt>
              <dd class="font-mono font-bold text-[#070709]">50 Pcs / Style</dd>
            </div>
            <div class="flex justify-between py-2.5">
              <dt class="font-mono text-[#5A6472] uppercase">Sample Turnaround</dt>
              <dd class="font-mono text-[#070709]">7–10 Business Days</dd>
            </div>
            <div class="flex justify-between py-2.5">
              <dt class="font-mono text-[#5A6472] uppercase">Private Labeling</dt>
              <dd class="font-mono text-[#070709]">Custom Woven &amp; Leather Tags</dd>
            </div>
            <?php if (!empty($specs)): ?>
              <?php foreach ($specs as $k => $v): ?>
                <div class="flex justify-between py-2.5">
                  <dt class="font-mono text-[#5A6472] uppercase"><?= e((string)$k) ?></dt>
                  <dd class="font-mono text-[#070709]"><?= e((string)$v) ?></dd>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </dl>
        </div>

        <!-- B2B Call to Actions (Inline Buttons) -->
        <div class="flex flex-col sm:flex-row gap-3 pt-2">
          <a href="<?= product_whatsapp_link($product['name'], $product['sku']) ?>" 
             target="_blank" rel="noopener noreferrer" 
             class="flex-1 inline-flex items-center justify-center gap-2 bg-crimson hover:bg-crimson-hover text-white py-3.5 px-4 rounded-xl font-mono text-xs font-bold uppercase tracking-wider transition-colors shadow-md text-center">
            <span>Request Price &amp; Samples</span>
            <span>→</span>
          </a>

          <a href="/contact-us" 
             class="flex-1 inline-flex items-center justify-center gap-2 bg-[#070709] hover:bg-black text-white py-3.5 px-4 rounded-xl font-mono text-xs font-bold uppercase tracking-wider transition-colors text-center">
            <span>Submit Tech Pack</span>
            <span>→</span>
          </a>
        </div>

        <p class="text-[11px] font-mono text-[#5A6472] leading-relaxed">
          * Faraan Impex operates strictly as a wholesale B2B manufacturer. Retail pricing is not listed. Formal commercial quotations provided against approved bill of materials.
        </p>
      </div>

    </div>

    <!-- Related Products -->
    <?php if (!empty($related)): ?>
      <div class="mt-20 pt-14 border-t border-[#E6E4DD]">
        <div class="max-w-2xl mb-10">
          <p class="font-mono text-crimson text-xs uppercase tracking-widest font-bold mb-2">
            SIMILAR SPECIFICATIONS
          </p>
          <h2 class="font-serif text-2xl sm:text-3xl text-[#070709] font-normal">
            Related styles in <?= e($product['category_name']) ?>
          </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          <?php foreach ($related as $r): ?>
            <div class="bg-white rounded-[22px] overflow-hidden border border-[#E6E4DD] shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all flex flex-col justify-between group">
              <a href="/<?= e($product['category_slug']) ?>/<?= e($r['slug']) ?>/" class="relative aspect-[4/5] bg-white overflow-hidden block">
                <?php if (!empty($r['image'])): ?>
                  <img src="/<?= e($r['image']) ?>" alt="<?= e($r['name']) ?>" loading="lazy" class="w-full h-full object-cover mix-blend-multiply group-hover:scale-105 transition-transform duration-700">
                <?php else: ?>
                  <div class="w-full h-full flex items-center justify-center text-[#94A3B8] font-mono text-xs">SPEC IMAGE</div>
                <?php endif; ?>
              </a>
              <div class="p-5">
                <a href="/<?= e($product['category_slug']) ?>/<?= e($r['slug']) ?>/" class="block">
                  <h3 class="font-serif text-base text-[#070709] group-hover:text-crimson transition-colors line-clamp-1 mb-1 font-normal">
                    <?= e($r['name']) ?>
                  </h3>
                </a>
                <span class="text-xs font-mono text-crimson font-bold uppercase tracking-wider">View Spec Sheet →</span>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>

  </div>
</div>
