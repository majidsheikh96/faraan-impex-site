<?php
/**
 * Section 5: Curated Export Styles (Stagfield Sports Luxury Caliber)
 * Studio white cards with pure unobstructed photography (zero floating badges), Georgia serif titles, and clean B2B quotation triggers.
 * 60fps/120fps hardware-accelerated micro-interactions.
 */
?>
<?php if (!empty($featured)): ?>
<section class="py-24 sm:py-28 bg-paper border-b border-[#E6E4DD]" id="featured-styles">
  <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Section Heading -->
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 sm:mb-16 border-b border-[#E6E4DD] pb-8 gap-6">
      <div class="max-w-2xl">
        <p class="font-mono text-crimson text-[11px] sm:text-[12px] font-bold uppercase tracking-[0.18em] mb-3">
          FACTORY HIGHLIGHTS
        </p>
        <h2 class="font-serif text-3xl sm:text-4xl lg:text-[44px] font-normal text-[#070709] tracking-tight leading-[1.16]">
          Curated styles ready for sampling.
        </h2>
        <p class="text-[#5A6472] text-[15px] sm:text-[16px] leading-relaxed mt-3">
          Benchmark specifications spanning motorbike suits, fortified racing gloves, technical flannels, cowboy hats, denim outerwear, vests, and artisan aprons.
        </p>
      </div>
      <div class="font-mono text-xs text-[#5A6472] border border-[#E6E4DD] bg-white rounded-full px-4 py-2 self-start md:self-end shrink-0 shadow-sm">
        <span class="text-crimson font-bold">MOQ:</span> 50 Pcs / Style · Custom Branding Available
      </div>
    </div>

    <!-- Product Showcase Grid (Pure Unobstructed Product Photography) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-7">
      <?php foreach (array_slice($featured, 0, 8) as $p): ?>
        <div class="bg-white rounded-[22px] overflow-hidden border border-[#E6E4DD] shadow-[0_4px_16px_rgba(0,0,0,0.03)] hover:shadow-[0_16px_36px_rgba(7,7,9,0.08)] hover:-translate-y-1.5 gpu-card flex flex-col justify-between group">
          
          <!-- Image Container (Hardware-Accelerated Isolated Blending Frame) -->
          <a href="/<?= e($p['category_slug']) ?>/<?= e($p['slug']) ?>/" class="product-image-frame aspect-[4/5] block flex items-center justify-center p-3">
            <?php if (!empty($p['image'])): ?>
              <img src="/<?= e($p['image']) ?>" 
                   alt="<?= e($p['name']) ?>" 
                   class="w-full h-full object-contain mix-blend-multiply gpu-zoom-img" 
                   loading="lazy">
            <?php else: ?>
              <div class="w-full h-full flex items-center justify-center text-[#94A3B8] font-mono text-xs">NO SPEC IMAGE</div>
            <?php endif; ?>
          </a>

          <!-- Content & Action -->
          <div class="p-5 sm:p-6 flex flex-col flex-grow justify-between">
            <div>
              <a href="/<?= e($p['category_slug']) ?>/<?= e($p['slug']) ?>/" class="block">
                <h3 class="font-serif text-lg text-[#070709] group-hover:text-crimson transition-colors line-clamp-1 mb-1 font-normal">
                  <?= e($p['name']) ?>
                </h3>
              </a>
              <p class="font-mono text-[11px] text-[#6B7580] uppercase tracking-wider mb-5">
                Export Grade · Sialkot Factory
              </p>
            </div>

            <div class="pt-4 border-t border-[#E6E4DD] flex items-center justify-between">
              <a href="/<?= e($p['category_slug']) ?>/<?= e($p['slug']) ?>/" 
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

  </div>
</section>
<?php endif; ?>
