<?php
/**
 * Category Listing — Luxury B2B Wholesale & OEM Catalog (Stagfield Caliber)
 * High-contrast editorial hero and spacious full-width 4-column product grid with zero sidebar clutter.
 */
$page_title = e($category['name']) . ' — OEM/ODM Private-Label Manufacturing | FARAAN IMPEX';
$page_description = e($category['meta_description'] ?: $category['name'] . ' — export-grade wholesale B2B contract manufacturing catalog from Sialkot, Pakistan.');
?>

<!-- Category Editorial Header -->
<section class="bg-[#070709] text-white border-b border-white/10 py-16 sm:py-20 relative overflow-hidden">
  <div class="absolute -right-32 -top-32 w-80 h-80 bg-crimson/10 rounded-full blur-[120px] pointer-events-none"></div>

  <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <nav class="font-mono text-xs text-[#AEB9C4] uppercase tracking-wider mb-4 flex items-center gap-2">
      <a href="/" class="hover:text-white transition-colors">Home</a>
      <span class="text-white/30">/</span>
      <span class="text-crimson font-semibold"><?= e($category['name']) ?></span>
    </nav>

    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
      <div>
        <span class="font-mono text-crimson text-[11px] uppercase tracking-[0.18em] font-bold block mb-2">
          MANUFACTURING DIVISION
        </span>
        <h1 class="font-serif text-3xl sm:text-5xl font-normal text-white tracking-tight leading-tight">
          <?= e($category['name']) ?>
        </h1>
        <p class="text-[#AEB9C4] text-sm sm:text-base mt-3 max-w-xl font-body">
          <?= count($products) ?> Verified Export Specifications · Direct Sialkot Atelier Contract Production
        </p>
      </div>

      <div class="font-mono text-xs text-slate-300 border border-white/15 bg-white/5 rounded-full px-4 py-2 self-start md:self-end shrink-0">
        <span class="text-crimson font-bold">MOQ:</span> 50 Pcs / Style · Custom Branding
      </div>
    </div>
  </div>
</section>

<!-- Main Catalog Area (Full-Width 4-Column Grid — Zero Sidebar Clutter) -->
<div class="bg-paper py-14 sm:py-16 border-b border-[#E6E4DD]">
  <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Product Grid (Spacious 4-Column Studio Showcase) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-7">
      <?php foreach ($products as $p): ?>
        <div class="bg-white rounded-[22px] overflow-hidden border border-[#E6E4DD] shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_20px_45px_rgba(7,7,9,0.08)] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
          
          <!-- Image Anchor (Clean Photography — No Floating Badges, Seamless White Background) -->
          <a href="/<?= e($category['slug']) ?>/<?= e($p['slug']) ?>/" class="relative aspect-[4/5] bg-white overflow-hidden block flex items-center justify-center p-3">
            <?php if (!empty($p['image'])): ?>
              <img src="/<?= e($p['image']) ?>" 
                   alt="<?= e($p['name']) ?>" 
                   loading="lazy" 
                   class="w-full h-full object-contain mix-blend-multiply group-hover:scale-105 transition-transform duration-700 ease-out">
            <?php else: ?>
              <div class="aspect-square bg-white flex items-center justify-center text-[#94A3B8] font-mono text-xs">
                NO SPEC IMAGE
              </div>
            <?php endif; ?>
          </a>

          <!-- Card Content & Action -->
          <div class="p-5 sm:p-6 flex flex-col flex-grow justify-between">
            <div>
              <a href="/<?= e($category['slug']) ?>/<?= e($p['slug']) ?>/" class="block">
                <h3 class="font-serif text-lg text-[#070709] group-hover:text-crimson transition-colors line-clamp-1 mb-1 font-normal">
                  <?= e($p['name']) ?>
                </h3>
              </a>
              <p class="font-mono text-[11px] text-[#6B7580] uppercase tracking-wider mb-4">
                Export Grade · Sialkot Atelier
              </p>
            </div>

            <div class="pt-4 border-t border-[#E6E4DD] flex items-center justify-between">
              <a href="/<?= e($category['slug']) ?>/<?= e($p['slug']) ?>/" 
                 class="font-mono text-[11px] font-bold uppercase tracking-[0.09em] text-[#070709] group-hover:text-crimson transition-colors flex items-center gap-1.5">
                <span>View Specifications</span>
                <span class="text-crimson font-bold transition-transform group-hover:translate-x-1">→</span>
              </a>

              <a href="<?= whatsapp_link("Assalam-o-Alaikum Faraan Impex, I would like to request wholesale quotation for product: " . $p['name'] . " (SKU: " . $p['sku'] . ").") ?>" 
                 target="_blank" rel="noopener noreferrer" 
                 class="w-7 h-7 rounded-full bg-[#FCFBF8] border border-[#E6E4DD] hover:border-crimson hover:bg-crimson hover:text-white flex items-center justify-center text-[#5A6472] transition-colors"
                 title="Fast Inquiry on WhatsApp"
                 aria-label="Inquire on WhatsApp">
                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                  <path d="M12.031 2C6.494 2 2 6.494 2 12.031c0 1.956.564 3.782 1.542 5.334L2 22l4.789-1.517c1.498.907 3.242 1.428 5.109 1.428 5.537 0 10.031-4.494 10.031-10.031S17.568 2 12.031 2zm5.727 14.195c-.241.677-1.391 1.296-1.928 1.341-.536.046-1.196.195-3.874-.912-3.238-1.339-5.321-4.664-5.483-4.88-.16-.217-1.309-1.745-1.309-3.328 0-1.583.829-2.361 1.123-2.684.294-.323.643-.404.858-.404.214 0 .429.003.616.012.198.01.463-.075.724.551.268.643.91 2.224.991 2.385.08.161.134.349.027.563-.107.215-.16.349-.321.536-.161.188-.338.419-.482.563-.161.16-.329.335-.141.658.188.322.836 1.378 1.794 2.231 1.233 1.096 2.274 1.436 2.595 1.597.321.161.509.134.696-.08.188-.215.804-.938 1.018-1.26.214-.322.429-.268.723-.161.295.107 1.874.884 2.196 1.045.321.161.536.241.616.375.08.134.08.777-.161 1.454z"></path>
                </svg>
              </a>
            </div>

          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <?php if (!count($products)): ?>
      <div class="bg-white rounded-[22px] border border-[#E6E4DD] p-12 text-center text-[#5A6472]">
        <p class="font-serif text-xl mb-2 text-[#070709]">No live styles in this division yet.</p>
        <p class="text-sm">Contact our production desk directly to develop bespoke items in this category.</p>
      </div>
    <?php else: ?>
      <!-- Secondary Custom Tech Pack Strip -->
      <div class="mt-12 p-6 sm:p-7 rounded-[20px] bg-white border border-[#E6E4DD] text-[#5A6472] text-[13px] sm:text-[14px] leading-relaxed flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-[0_2px_8px_rgba(0,0,0,0.03)]">
        <div class="max-w-4xl">
          <strong class="text-[#070709] font-semibold">Bespoke Specifications?</strong> We engineer custom patterns, leather gauges, and hardware from your vector CAD tech pack or physical counter-sample. Direct factory quotations within 2 hours.
        </div>
        <a href="/contact-us" class="inline-flex items-center gap-1.5 text-crimson font-mono text-[11px] font-bold tracking-[0.1em] uppercase hover:underline whitespace-nowrap shrink-0">
          <span>Submit Tech Pack</span>
          <span class="font-bold">→</span>
        </a>
      </div>
    <?php endif; ?>

  </div>
</div>
