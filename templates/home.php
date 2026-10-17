<?php
/** Homepage — Google Stitch "Red & Black v2" Design System. */
$page_title = 'FARAAN IMPEX — Leather & Textile Garments Manufacturer | Sialkot, Pakistan';
$topCats = get_top_categories();
$featured = get_featured_products(4);

// Map top categories by slug for specific images & descriptions
$catMeta = [
    'leather-wears' => [
        'image' => '/assets/images/stitch/cat-leather-wears.jpg',
        'desc'  => 'Biker, Cafe Racer, Bomber & Fashion Leather Outerwear'
    ],
    'textile-wears' => [
        'image' => '/assets/images/stitch/cat-textile-wears.jpg',
        'desc'  => 'Cordura, Softshell, Fleece & Waxed Cotton Apparel'
    ],
    'western-wears' => [
        'image' => '/assets/images/stitch/cat-western-wears.jpg',
        'desc'  => 'Fringed Leather, Western Vests & Heritage Chaps'
    ],
    'leather-products' => [
        'image' => '/assets/images/stitch/cat-leather-products.jpg',
        'desc'  => 'Riding Gloves, Tool Aprons, Belts & Small Goods'
    ]
];
?>

<!-- 3. HERO SECTION (Red & Black: Master artisan cutting racing leather in Sialkot atelier) -->
<section class="relative bg-[#0A0A0A] text-white overflow-hidden min-h-[560px] sm:min-h-[640px] flex items-center border-b border-[#262626]">
  <!-- Image Background with Dark Gradient Overlay -->
  <div class="absolute inset-0 z-0">
    <img class="w-full h-full object-cover object-center filter brightness-[0.42] contrast-110" 
         src="/assets/images/stitch/hero-craftsman-red-black.jpg" 
         alt="Young master leather craftsman dynamically cutting and assembling racing jacket in Sialkot atelier" />
    <div class="absolute inset-0 bg-gradient-to-r from-[#0A0A0A] via-[#0A0A0A]/85 to-transparent"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-[#0A0A0A] via-transparent to-transparent opacity-90"></div>
  </div>

  <!-- Hero Content Container -->
  <div class="relative z-10 max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 py-16 sm:py-20 lg:py-28 w-full">
    <div class="max-w-3xl">
      <!-- Badge Tag -->
      <div class="inline-flex items-center gap-2 px-3 py-1 bg-black/80 border border-[#E10600]/40 rounded mb-6 backdrop-blur-sm max-w-full">
        <span class="w-2 h-2 rounded-full bg-[#E10600] animate-pulse shrink-0"></span>
        <span class="text-[#FFB4A8] font-mono text-[10px] sm:text-[12px] tracking-wider uppercase font-semibold">
          SIALKOT, PAKISTAN — B2B GARMENT CONTRACTORS
        </span>
      </div>

      <!-- Headline -->
      <h1 class="font-headline text-3xl sm:text-5xl lg:text-6xl text-white tracking-tight mb-6 font-extrabold leading-[1.12]">
        Premium Leather Garments, <span class="text-[#E10600]">Crafted in Sialkot.</span> Shipped Worldwide.
      </h1>

      <!-- Subheading -->
      <p class="font-body text-base sm:text-lg text-[#D1D1D1] font-normal leading-relaxed mb-8 sm:mb-10 max-w-2xl">
        Direct manufacturer and OEM/ODM private-label supplier of precision-crafted leather outerwear, motorcycle jackets, technical textile apparel, and bespoke leather goods for global fashion brands.
      </p>

      <!-- CTA Cluster -->
      <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3.5 sm:gap-4">
        <a class="inline-flex items-center justify-center bg-[#E10600] hover:bg-[#b80500] text-white font-headline font-bold uppercase tracking-wider text-[13px] sm:text-[14px] px-8 py-3.5 sm:py-4 rounded shadow-md transition-all active:scale-[0.98]" href="#categories">
          Browse Catalog
        </a>
        <a class="inline-flex items-center justify-center gap-2.5 bg-[#25D366] hover:bg-[#20ba5a] text-white font-headline font-bold uppercase tracking-wider text-[13px] sm:text-[14px] px-8 py-3.5 sm:py-4 rounded shadow-md transition-colors" href="<?= whatsapp_link("Assalam-o-Alaikum, I'd like to enquire about contract manufacturing with Faraan Impex.") ?>" rel="noopener noreferrer" target="_blank">
          <svg class="w-5 h-5 fill-current shrink-0" viewBox="0 0 24 24">
            <path d="M12.031 2C6.494 2 2 6.494 2 12.031c0 1.956.564 3.782 1.542 5.334L2 22l4.789-1.517c1.498.907 3.242 1.428 5.109 1.428 5.537 0 10.031-4.494 10.031-10.031S17.568 2 12.031 2zm5.727 14.195c-.241.677-1.391 1.296-1.928 1.341-.536.046-1.196.195-3.874-.912-3.238-1.339-5.321-4.664-5.483-4.88-.16-.217-1.309-1.745-1.309-3.328 0-1.583.829-2.361 1.123-2.684.294-.323.643-.404.858-.404.214 0 .429.003.616.012.198.01.463-.075.724.551.268.643.91 2.224.991 2.385.08.161.134.349.027.563-.107.215-.16.349-.321.536-.161.188-.338.419-.482.563-.161.16-.329.335-.141.658.188.322.836 1.378 1.794 2.231 1.233 1.096 2.274 1.436 2.595 1.597.321.161.509.134.696-.08.188-.215.804-.938 1.018-1.26.214-.322.429-.268.723-.161.295.107 1.874.884 2.196 1.045.321.161.536.241.616.375.08.134.08.777-.161 1.454z"></path>
          </svg>
          <span>Chat on WhatsApp</span>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Quick Manufacturing Stats Strip -->
<div class="bg-[#141414] border-b border-[#262626] py-4 px-4 sm:px-6 lg:px-12">
  <div class="max-w-[1440px] mx-auto grid grid-cols-1 md:grid-cols-3 gap-3 md:gap-6 text-center divide-y md:divide-y-0 md:divide-x divide-[#262626]">
    <div class="flex items-center justify-center gap-3 py-2">
      <span class="material-symbols-outlined text-[#E10600]" style="font-variation-settings: 'FILL' 1;">inventory_2</span>
      <span class="font-headline font-bold text-[#E5E2E1] uppercase text-[12px] sm:text-[13px] tracking-wider">50 Pcs Minimum OEM Order</span>
    </div>
    <div class="flex items-center justify-center gap-3 py-2">
      <span class="material-symbols-outlined text-[#E10600]" style="font-variation-settings: 'FILL' 1;">speed</span>
      <span class="font-headline font-bold text-[#E5E2E1] uppercase text-[12px] sm:text-[13px] tracking-wider">15-20 Days Sample Turnaround</span>
    </div>
    <div class="flex items-center justify-center gap-3 py-2">
      <span class="material-symbols-outlined text-[#E10600]" style="font-variation-settings: 'FILL' 1;">tune</span>
      <span class="font-headline font-bold text-[#E5E2E1] uppercase text-[12px] sm:text-[13px] tracking-wider">Full Custom Labeling &amp; Hardware</span>
    </div>
  </div>
</div>

<!-- 4. CATEGORIES SECTION (Strictly 4 Cards in 4-column layout) -->
<section class="py-16 sm:py-20 px-4 sm:px-6 lg:px-12 max-w-[1440px] mx-auto" id="categories">
  <!-- Header -->
  <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 sm:mb-12 border-b border-outline-variant pb-6">
    <div>
      <span class="font-mono text-[#E10600] text-[12px] uppercase tracking-widest block mb-2 font-bold">
        MANUFACTURING DIVISIONS
      </span>
      <h2 class="font-headline text-2xl sm:text-3xl md:text-4xl font-extrabold text-primary tracking-tight">
        Core Product Categories
      </h2>
    </div>
    <p class="font-body text-on-surface-variant max-w-md mt-4 md:mt-0 text-sm">
      Engineered for fashion retailers, boutique brands, and volume distributors seeking certified export-grade manufacturing.
    </p>
  </div>

  <!-- 4-Column Grid -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <?php foreach ($topCats as $cat): ?>
      <?php 
        $slug = $cat['slug'];
        if ($slug === 'uncategorized') continue;
        $meta = $catMeta[$slug] ?? [
            'image' => '/assets/images/stitch/cat-leather-wears.jpg',
            'desc'  => 'Export-grade manufacturing crafted in Sialkot.'
        ];
      ?>
      <div class="group bg-surface-container-low border border-outline-variant rounded overflow-hidden flex flex-col hover:border-[#E10600] transition-all duration-200 hover:shadow-lg">
        <div class="relative aspect-square overflow-hidden bg-surface-container">
          <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" 
               src="<?= e($meta['image']) ?>" 
               alt="<?= e($cat['name']) ?>" />
          <span class="absolute top-3 right-3 bg-[#E10600] text-white font-mono text-[11px] px-2.5 py-1 rounded uppercase font-bold shadow-sm">
            <?= (int)$cat['live_count'] ?> Products
          </span>
        </div>
        <div class="p-5 flex flex-col flex-grow justify-between border-t border-outline-variant">
          <div>
            <h3 class="font-headline font-bold text-lg text-primary mb-1 uppercase tracking-wide">
              <?= e($cat['name']) ?>
            </h3>
            <p class="font-body text-on-surface-variant text-[13px] mb-4">
              <?= e($meta['desc']) ?>
            </p>
          </div>
          <a class="font-headline font-bold text-[#E10600] text-[13px] uppercase tracking-wider flex items-center gap-1 group-hover:translate-x-1 transition-transform" 
             href="/<?= e($cat['slug']) ?>/">
            <span>Explore Line</span>
            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
          </a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- 5. FEATURED PRODUCTS SECTION (Strictly 4 Cards, NO prices, SKU details, WhatsApp CTA) -->
<?php if (!empty($featured)): ?>
<section class="py-16 sm:py-20 px-4 sm:px-6 lg:px-12 bg-surface-container border-y border-outline-variant">
  <div class="max-w-[1440px] mx-auto">
    <!-- Section Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 sm:mb-12">
      <div>
        <span class="font-mono text-[#E10600] text-[12px] uppercase tracking-widest block mb-2 font-bold">
          FEATURED EXPORT STYLES
        </span>
        <h2 class="font-headline text-2xl sm:text-3xl md:text-4xl font-extrabold text-primary tracking-tight">
          B2B Catalog Highlights
        </h2>
      </div>
      <div class="mt-4 md:mt-0 font-mono text-on-surface-variant text-[11px] sm:text-[12px] font-semibold">
        [MIN. ORDER QUANTITY: 50 PCS / STYLE]
      </div>
    </div>

    <!-- 4-Column Product Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php foreach ($featured as $p): ?>
      <div class="bg-surface border border-outline-variant rounded flex flex-col overflow-hidden hover:border-[#E10600] transition-all shadow-sm hover:shadow-md">
        <a href="/<?= e($p['category_slug']) ?>/<?= e($p['slug']) ?>/" class="relative aspect-[4/5] bg-surface-container-high overflow-hidden block group">
          <?php if (!empty($p['image'])): ?>
            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" 
                 src="/<?= e($p['image']) ?>" 
                 alt="<?= e($p['name']) ?>" loading="lazy" />
          <?php else: ?>
            <div class="w-full h-full flex items-center justify-center text-on-surface-variant font-mono text-xs">NO IMAGE</div>
          <?php endif; ?>
        </a>
        <div class="p-5 flex flex-col flex-grow justify-between">
          <div>
            <span class="font-mono text-[11px] text-[#E10600] font-bold tracking-wider block mb-1">
              SKU: <?= e($p['sku']) ?>
            </span>
            <a href="/<?= e($p['category_slug']) ?>/<?= e($p['slug']) ?>/" class="block">
              <h3 class="font-headline font-bold text-base text-primary mb-3 hover:text-[#E10600] transition-colors line-clamp-1">
                <?= e($p['name']) ?>
              </h3>
            </a>
          </div>
          <a class="w-full inline-flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#20ba5a] text-white py-2.5 px-4 font-headline font-bold uppercase tracking-wider text-[12px] rounded transition-all active:scale-[0.98]" 
             href="<?= whatsapp_link("Assalam-o-Alaikum, I am inquiring about product: " . $p['name'] . " (SKU: " . $p['sku'] . "). Please share wholesale quotation.") ?>" 
             rel="noopener noreferrer" target="_blank">
            <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 24 24">
              <path d="M12.031 2C6.494 2 2 6.494 2 12.031c0 1.956.564 3.782 1.542 5.334L2 22l4.789-1.517c1.498.907 3.242 1.428 5.109 1.428 5.537 0 10.031-4.494 10.031-10.031S17.568 2 12.031 2zm5.727 14.195c-.241.677-1.391 1.296-1.928 1.341-.536.046-1.196.195-3.874-.912-3.238-1.339-5.321-4.664-5.483-4.88-.16-.217-1.309-1.745-1.309-3.328 0-1.583.829-2.361 1.123-2.684.294-.323.643-.404.858-.404.214 0 .429.003.616.012.198.01.463-.075.724.551.268.643.91 2.224.991 2.385.08.161.134.349.027.563-.107.215-.16.349-.321.536-.161.188-.338.419-.482.563-.161.16-.329.335-.141.658.188.322.836 1.378 1.794 2.231 1.233 1.096 2.274 1.436 2.595 1.597.321.161.509.134.696-.08.188-.215.804-.938 1.018-1.26.214-.322.429-.268.723-.161.295.107 1.874.884 2.196 1.045.321.161.536.241.616.375.08.134.08.777-.161 1.454z"></path>
            </svg>
            <span>Enquire on WhatsApp</span>
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- 6. TRUST BAND (Dark #0A0A0A background, Red #E10600 accents, strictly 4 pillars) -->
<section class="bg-[#0A0A0A] text-white py-12 sm:py-16 px-4 sm:px-6 lg:px-12 border-y border-[#262626]">
  <div class="max-w-[1440px] mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
    <div class="border-l-2 border-[#E10600] pl-4 sm:pl-5">
      <h3 class="font-headline font-bold text-base sm:text-lg text-white mb-2">
        Sialkot-Based Manufacturing
      </h3>
      <p class="font-body text-[#A0A0A0] text-[13px] leading-relaxed">
        Decades of heritage leather tailoring and generational artisan stitching passed down in Pakistan’s leather capital.
      </p>
    </div>
    <div class="border-l-2 border-[#E10600] pl-4 sm:pl-5">
      <h3 class="font-headline font-bold text-base sm:text-lg text-white mb-2">
        Direct Factory Pricing
      </h3>
      <p class="font-body text-[#A0A0A0] text-[13px] leading-relaxed">
        Cut out middlemen with direct-from-source wholesale manufacturer rates, maximizing your retail margin.
      </p>
    </div>
    <div class="border-l-2 border-[#E10600] pl-4 sm:pl-5">
      <h3 class="font-headline font-bold text-base sm:text-lg text-white mb-2">
        Custom OEM Orders Welcome
      </h3>
      <p class="font-body text-[#A0A0A0] text-[13px] leading-relaxed">
        Bespoke hardware, custom embossing, private woven labels, custom hangtags, and tailored sizing specs.
      </p>
    </div>
    <div class="border-l-2 border-[#E10600] pl-4 sm:pl-5">
      <h3 class="font-headline font-bold text-base sm:text-lg text-white mb-2">
        Worldwide Shipping
      </h3>
      <p class="font-body text-[#A0A0A0] text-[13px] leading-relaxed">
        Air &amp; sea freight logistics with complete export documentation and door-to-door delivery across USA, UK &amp; Europe.
      </p>
    </div>
  </div>
</section>

<!-- 7. OEM / CUSTOM MANUFACTURING CAPABILITIES BANNER (4-step B2B process) -->
<section class="py-16 sm:py-20 px-4 sm:px-6 lg:px-12 max-w-[1440px] mx-auto" id="process">
  <div class="text-center max-w-2xl mx-auto mb-12 sm:mb-16">
    <span class="font-mono text-[#E10600] text-[12px] uppercase tracking-widest block mb-2 font-bold">
      CONTRACT PRODUCTION WORKFLOW
    </span>
    <h2 class="font-headline text-2xl sm:text-3xl md:text-4xl font-extrabold text-primary tracking-tight">
      4-Step OEM Manufacturing Process
    </h2>
    <p class="font-body text-on-surface-variant mt-3 text-sm">
      From initial tech pack review to overseas container clearance, we maintain exacting tolerance thresholds at every milestone.
    </p>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Step 1 -->
    <div class="bg-surface-container-low border border-outline-variant p-6 rounded flex flex-col justify-between hover:border-[#E10600] transition-colors">
      <div>
        <div class="font-mono text-[#E10600] font-bold text-xl mb-4">01.</div>
        <h4 class="font-headline font-bold text-base text-primary mb-2">
          Sample Development
        </h4>
        <p class="font-body text-on-surface-variant text-[13px]">
          Rapid prototyping from your CAD drawings or physical references. Master pattern drafting and initial prototype iteration within 15–20 days.
        </p>
      </div>
      <div class="mt-6 pt-4 border-t border-outline-variant/60 font-mono text-[11px] text-[#E10600] font-bold">
        PHASE: PATTERNING &amp; FIT
      </div>
    </div>

    <!-- Step 2 -->
    <div class="bg-surface-container-low border border-outline-variant p-6 rounded flex flex-col justify-between hover:border-[#E10600] transition-colors">
      <div>
        <div class="font-mono text-[#E10600] font-bold text-xl mb-4">02.</div>
        <h4 class="font-headline font-bold text-base text-primary mb-2">
          Material Selection
        </h4>
        <p class="font-body text-on-surface-variant text-[13px]">
          Hand-selecting full grain cowhide, drum-dyed sheep nappa, goat suede, and high-tensile Cordura fabrics calibrated to exact gauge &amp; temper.
        </p>
      </div>
      <div class="mt-6 pt-4 border-t border-outline-variant/60 font-mono text-[11px] text-[#E10600] font-bold">
        PHASE: HIDE &amp; YARN SOURCING
      </div>
    </div>

    <!-- Step 3 -->
    <div class="bg-surface-container-low border border-outline-variant p-6 rounded flex flex-col justify-between hover:border-[#E10600] transition-colors">
      <div>
        <div class="font-mono text-[#E10600] font-bold text-xl mb-4">03.</div>
        <h4 class="font-headline font-bold text-base text-primary mb-2">
          Production &amp; QA
        </h4>
        <p class="font-body text-on-surface-variant text-[13px]">
          In-line precision assembly, triple-point stress reinforcement, YKK hardware integration, and 100% individual piece quality audits.
        </p>
      </div>
      <div class="mt-6 pt-4 border-t border-outline-variant/60 font-mono text-[11px] text-[#E10600] font-bold">
        PHASE: ASSEMBLY &amp; AUDIT
      </div>
    </div>

    <!-- Step 4 -->
    <div class="bg-surface-container-low border border-outline-variant p-6 rounded flex flex-col justify-between hover:border-[#E10600] transition-colors">
      <div>
        <div class="font-mono text-[#E10600] font-bold text-xl mb-4">04.</div>
        <h4 class="font-headline font-bold text-base text-primary mb-2">
          Global Export
        </h4>
        <p class="font-body text-on-surface-variant text-[13px]">
          Secure moisture-barrier packaging, export palletizing, customs clearance documentation, and reliable air or ocean freight consignment.
        </p>
      </div>
      <div class="mt-6 pt-4 border-t border-outline-variant/60 font-mono text-[11px] text-[#E10600] font-bold">
        PHASE: LOGISTICS &amp; DISPATCH
      </div>
    </div>
  </div>

  <!-- Request Sample CTA Block -->
  <div class="mt-12 bg-[#0A0A0A] border border-[#262626] p-6 sm:p-8 rounded flex flex-col md:flex-row items-start md:items-center justify-between gap-6 shadow-xl">
    <div>
      <h3 class="font-headline font-bold text-lg sm:text-xl text-white mb-1">
        Have a Tech Pack or Specification Ready?
      </h3>
      <p class="font-body text-[#A0A0A0] text-sm max-w-xl">
        Send us your measurements, sketch files, or benchmark sample requirements for an immediate B2B quotation.
      </p>
    </div>
    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4 shrink-0 w-full sm:w-auto">
      <a class="bg-[#E10600] hover:bg-[#b80500] text-white px-6 py-3 font-headline font-bold uppercase tracking-wider text-[13px] rounded transition-all active:scale-[0.98] text-center" href="/contact-us">
        Send Tech Pack
      </a>
      <a class="bg-[#25D366] hover:bg-[#20ba5a] text-white px-6 py-3 font-headline font-bold uppercase tracking-wider text-[13px] rounded transition-colors flex items-center justify-center gap-2 font-bold text-center" href="<?= whatsapp_link("Assalam-o-Alaikum, I have a tech pack and would like an OEM quotation.") ?>" rel="noopener noreferrer" target="_blank">
        <span>Inquire via WhatsApp</span>
      </a>
    </div>
  </div>
</section>
