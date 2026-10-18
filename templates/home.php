<?php
/**
 * Homepage — FARAAN IMPEX Industrial Luxury Atelier Design System.
 * Editorial B2B Contract Manufacturing Showcase.
 */
$page_title = 'FARAAN IMPEX — Luxury Leather & Technical Garments Manufacturer | Sialkot, Pakistan';
$page_description = 'Direct OEM/ODM private-label manufacturer of export-grade leather outerwear, racing suits, textile apparel, and bespoke leather goods from Sialkot, Pakistan.';

$topCats = get_top_categories();
$featured = get_featured_products(8);

// Division metadata with rich craftsmanship attributes
$divisionMeta = [
    'leather-wears' => [
        'image'       => '/assets/images/stitch/cat-leather-wears.jpg',
        'tagline'     => 'Flagship Atelier Division',
        'hides'       => '1.2mm Cowhide · Sheep Nappa · Buffalo',
        'lead'        => 'Bespoke motorcycle racing suits, cafe racers, aviator bombers, and luxury runway outerwear tailored to exacting millimeter tolerance.',
        'subs'        => ['Biker Jackets', 'Motorbike Suits', 'Leather Vests', 'Shearling Bombers'],
        'badge'       => 'CE Level 1 & 2 Ready'
    ],
    'textile-wears' => [
        'image'       => '/assets/images/stitch/cat-textile-wears.jpg',
        'tagline'     => 'Technical Apparel',
        'hides'       => 'Cordura® 1000D · Softshell · Waxed Canvas',
        'lead'        => 'High-tenacity all-weather touring garments, waterproof adventure shells, insulated tactical gear, and reinforced fleece apparel.',
        'subs'        => ['Cordura Jackets', 'Denim Outerwear', 'Flannel Shirts', 'Softshell Vests'],
        'badge'       => 'Water-Repellent DWR'
    ],
    'western-wears' => [
        'image'       => '/assets/images/stitch/cat-western-wears.jpg',
        'tagline'     => 'Heritage & Frontier',
        'hides'       => 'Roughout Suede · Split Hide · Suede Goat',
        'lead'        => 'Authentic hand-fringed leather coats, rugged frontier vests, heavy riding chaps, and traditional hand-blocked leather hats.',
        'subs'        => ['Fringed Jackets', 'Cowboy Hats', 'Western Vests', 'Riding Chaps'],
        'badge'       => 'Hand-Cut Fringes'
    ],
    'leather-products' => [
        'image'       => '/assets/images/stitch/cat-leather-products.jpg',
        'tagline'     => 'Artisan Goods & Trims',
        'hides'       => 'Heavy Veg-Tan · Biker Harness Leather',
        'lead'        => 'Heavyweight workshop aprons, fortified motorcycle gloves, vintage biker chain wallets, and custom embossed leather accessories.',
        'subs'        => ['Artisan Aprons', 'Riding Gloves', 'Biker Wallets', 'Leather Skins'],
        'badge'       => 'Full-Grain Veg Tan'
    ]
];
?>

<!-- 1. HERO STAGE — ASYMMETRIC ATELIER BLUEPRINT -->
<section class="relative bg-obsidian text-slate-100 overflow-hidden border-b border-white/[0.08] bg-grid-pattern">
  <!-- Subtle ambient radial lights -->
  <div class="absolute top-0 left-1/4 w-[600px] h-[600px] bg-carmine/10 rounded-full blur-[140px] pointer-events-none"></div>
  <div class="absolute bottom-0 right-10 w-[500px] h-[500px] bg-amber-900/10 rounded-full blur-[140px] pointer-events-none"></div>

  <div class="relative max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 py-12 sm:py-16 lg:py-24 w-full">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center">
      
      <!-- Left Column: Editorial Statement & Direct B2B Access -->
      <div class="lg:col-span-7 flex flex-col justify-center">
        <!-- Origin & Certification Tag -->
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-surface-card border border-white/[0.08] mb-6 max-w-full min-w-0">
          <span class="w-2 h-2 rounded-full bg-carmine animate-pulse shrink-0"></span>
          <span class="font-mono text-[10px] sm:text-[12px] uppercase tracking-wider text-slate-300 font-medium truncate">
            <span class="sm:hidden">Sialkot Atelier · OEM/ODM · Est. 1998</span>
            <span class="hidden sm:inline">Sialkot Atelier · Direct OEM/ODM Contractor · Est. 1998</span>
          </span>
        </div>

        <!-- Master Headline -->
        <h1 class="font-headline text-2xl sm:text-4xl lg:text-5xl xl:text-6xl font-extrabold text-white tracking-tight leading-[1.12] mb-6">
          Precision Leather Garments. Engineered for Global Runway &amp; Moto Brands.
        </h1>

        <!-- Plain, authoritative description -->
        <p class="font-body text-sm sm:text-base lg:text-lg text-slate-300 font-normal leading-relaxed mb-8 max-w-2xl">
          Direct private-label manufacturing from the world’s leather craftsmanship capital. We engineer bespoke leather jackets, technical racing suits, and heritage goods with millimeter tolerance, drum-dyed tannery control, and certified international export standards.
        </p>

        <!-- Primary Action Cluster -->
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3.5 sm:gap-4 mb-8 sm:mb-10">
          <a href="#divisions" class="inline-flex items-center justify-center bg-carmine hover:bg-carmine-hover text-white font-headline font-bold uppercase tracking-wider text-xs sm:text-[13px] px-7 py-3.5 sm:py-4 rounded transition-all active:scale-[0.98] shadow-lg shadow-carmine/20 text-center">
            <span>Explore Manufacturing Divisions</span>
          </a>
          <a href="<?= whatsapp_link("Assalam-o-Alaikum Faraan Impex, I am reaching out to discuss private-label OEM manufacturing for our brand.") ?>" 
             target="_blank" rel="noopener noreferrer" 
             class="inline-flex items-center justify-center gap-2.5 bg-[#25D366] hover:bg-[#20ba5a] text-white font-headline font-bold uppercase tracking-wider text-xs sm:text-[13px] px-6 py-3.5 sm:py-4 rounded transition-colors shadow-md text-center">
            <svg class="w-5 h-5 fill-current shrink-0" viewBox="0 0 24 24">
              <path d="M12.031 2C6.494 2 2 6.494 2 12.031c0 1.956.564 3.782 1.542 5.334L2 22l4.789-1.517c1.498.907 3.242 1.428 5.109 1.428 5.537 0 10.031-4.494 10.031-10.031S17.568 2 12.031 2zm5.727 14.195c-.241.677-1.391 1.296-1.928 1.341-.536.046-1.196.195-3.874-.912-3.238-1.339-5.321-4.664-5.483-4.88-.16-.217-1.309-1.745-1.309-3.328 0-1.583.829-2.361 1.123-2.684.294-.323.643-.404.858-.404.214 0 .429.003.616.012.198.01.463-.075.724.551.268.643.91 2.224.991 2.385.08.161.134.349.027.563-.107.215-.16.349-.321.536-.161.188-.338.419-.482.563-.161.16-.329.335-.141.658.188.322.836 1.378 1.794 2.231 1.233 1.096 2.274 1.436 2.595 1.597.321.161.509.134.696-.08.188-.215.804-.938 1.018-1.26.214-.322.429-.268.723-.161.295.107 1.874.884 2.196 1.045.321.161.536.241.616.375.08.134.08.777-.161 1.454z"></path>
            </svg>
            <span>B2B WhatsApp Concierge</span>
          </a>
        </div>

        <!-- Factory Specifications Bar -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-6 border-t border-white/[0.08] text-left">
          <div>
            <div class="font-mono text-[11px] text-text-muted">MOQ / STYLE</div>
            <div class="font-headline font-bold text-white text-sm sm:text-base mt-0.5">50 Pieces</div>
          </div>
          <div>
            <div class="font-mono text-[11px] text-text-muted">SAMPLE TURNAROUND</div>
            <div class="font-headline font-bold text-white text-sm sm:text-base mt-0.5">15–20 Days</div>
          </div>
          <div>
            <div class="font-mono text-[11px] text-text-muted">MONTHLY CAPACITY</div>
            <div class="font-headline font-bold text-white text-sm sm:text-base mt-0.5">8,500 Units</div>
          </div>
          <div>
            <div class="font-mono text-[11px] text-text-muted">CERTIFICATION</div>
            <div class="font-headline font-bold text-white text-sm sm:text-base mt-0.5">CE &amp; REACH</div>
          </div>
        </div>
      </div>

      <!-- Right Column: Interactive Annotated Atelier Blueprint Card -->
      <div class="lg:col-span-5">
        <div class="relative glass-card rounded-xl p-3 sm:p-4 border border-white/[0.12] shadow-2xl">
          <!-- Card Header Bar -->
          <div class="flex items-center justify-between pb-3 mb-3 border-b border-white/[0.08] font-mono text-[11px] text-text-muted">
            <div class="flex items-center gap-2">
              <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
              <span class="text-slate-200 uppercase font-semibold text-[10px] sm:text-[11px]">PRODUCTION BENCHMARK</span>
            </div>
            <span class="text-[10px] sm:text-[11px]">SPEC: PK-SLK-2026</span>
          </div>

          <!-- Hero Image with Annotation Hotspots -->
          <div class="relative rounded-lg overflow-hidden aspect-[4/5] bg-surface-dark group">
            <img src="/assets/images/stitch/hero-craftsman-red-black.jpg" 
                 alt="Master leather tailor cutting racing garment in Sialkot atelier" 
                 class="w-full h-full object-cover object-center filter brightness-[0.85] contrast-[1.1] group-hover:scale-105 transition-transform duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-obsidian via-transparent to-transparent opacity-80"></div>

            <!-- Hotspot 1: Collar / Hide -->
            <div class="absolute top-[28%] left-[20%] group/hotspot">
              <div class="relative flex items-center justify-center">
                <span class="animate-ping absolute inline-flex h-5 w-5 sm:h-6 sm:w-6 rounded-full bg-carmine opacity-75"></span>
                <span class="relative inline-flex rounded-full h-4 w-4 bg-carmine text-[9px] font-bold text-white items-center justify-center shadow-lg cursor-pointer">1</span>
                <!-- Desktop hover popover -->
                <div class="hidden sm:block absolute left-6 top-1/2 -translate-y-1/2 w-48 p-2.5 rounded bg-obsidian/95 border border-white/20 backdrop-blur-md text-left shadow-2xl pointer-events-none transition-all opacity-0 group-hover/hotspot:opacity-100 z-20">
                  <div class="font-mono text-[10px] text-carmine font-bold">GRAIN CALIBRATION</div>
                  <div class="text-[12px] font-semibold text-white">1.2mm Drum Cowhide</div>
                  <div class="text-[10px] text-text-muted">Top grain, supple hand-feel</div>
                </div>
              </div>
            </div>

            <!-- Hotspot 2: Stitching / Seams -->
            <div class="absolute top-[52%] right-[22%] group/hotspot">
              <div class="relative flex items-center justify-center">
                <span class="animate-ping absolute inline-flex h-5 w-5 sm:h-6 sm:w-6 rounded-full bg-carmine opacity-75"></span>
                <span class="relative inline-flex rounded-full h-4 w-4 bg-carmine text-[9px] font-bold text-white items-center justify-center shadow-lg cursor-pointer">2</span>
                <!-- Desktop hover popover -->
                <div class="hidden sm:block absolute right-6 top-1/2 -translate-y-1/2 w-48 p-2.5 rounded bg-obsidian/95 border border-white/20 backdrop-blur-md text-left shadow-2xl pointer-events-none transition-all opacity-0 group-hover/hotspot:opacity-100 z-20">
                  <div class="font-mono text-[10px] text-carmine font-bold">STRUCTURAL SEAMS</div>
                  <div class="text-[12px] font-semibold text-white">Triple Kevlar® Seams</div>
                  <div class="text-[10px] text-text-muted">400N tensile bar-tack rating</div>
                </div>
              </div>
            </div>

            <!-- Hotspot 3: Hardware -->
            <div class="absolute bottom-[28%] left-[25%] group/hotspot">
              <div class="relative flex items-center justify-center">
                <span class="animate-ping absolute inline-flex h-5 w-5 sm:h-6 sm:w-6 rounded-full bg-carmine opacity-75"></span>
                <span class="relative inline-flex rounded-full h-4 w-4 bg-carmine text-[9px] font-bold text-white items-center justify-center shadow-lg cursor-pointer">3</span>
                <!-- Desktop hover popover -->
                <div class="hidden sm:block absolute left-6 top-1/2 -translate-y-1/2 w-48 p-2.5 rounded bg-obsidian/95 border border-white/20 backdrop-blur-md text-left shadow-2xl pointer-events-none transition-all opacity-0 group-hover/hotspot:opacity-100 z-20">
                  <div class="font-mono text-[10px] text-carmine font-bold">HARDWARE SYSTEM</div>
                  <div class="text-[12px] font-semibold text-white">Heavy-Gauge YKK Zips</div>
                  <div class="text-[10px] text-text-muted">Antique brass &amp; gunmetal</div>
                </div>
              </div>
            </div>

            <!-- Card Bottom Specs Overlay -->
            <div class="absolute bottom-2.5 inset-x-2.5 sm:bottom-3 sm:inset-x-3 p-2.5 sm:p-3 bg-surface-card/90 backdrop-blur-md rounded border border-white/[0.08] flex items-center justify-between">
              <div>
                <div class="text-xs sm:text-[13px] font-headline font-bold text-white">Sialkot Leather Cutting Atelier</div>
                <div class="text-[10px] sm:text-[11px] text-text-muted">Pattern Drafting · Master Stitching · Custom Emboss</div>
              </div>
              <span class="text-[9px] sm:text-[10px] font-mono px-2 py-0.5 rounded bg-carmine/20 text-carmine border border-carmine/30 font-semibold shrink-0">
                ACTIVE LINE
              </span>
            </div>
          </div>

          <!-- Mobile Specific Spec Points (Visible < sm) -->
          <div class="sm:hidden mt-3 pt-3 border-t border-white/[0.08] space-y-1.5 font-mono text-[11px]">
            <div class="flex items-center gap-2 text-slate-300">
              <span class="w-4 h-4 rounded-full bg-carmine/30 text-carmine flex items-center justify-center font-bold text-[9px]">1</span>
              <span>1.2mm Drum-Dyed Cowhide (Top Grain)</span>
            </div>
            <div class="flex items-center gap-2 text-slate-300">
              <span class="w-4 h-4 rounded-full bg-carmine/30 text-carmine flex items-center justify-center font-bold text-[9px]">2</span>
              <span>Triple Kevlar® Seams (400N Tensile)</span>
            </div>
            <div class="flex items-center gap-2 text-slate-300">
              <span class="w-4 h-4 rounded-full bg-carmine/30 text-carmine flex items-center justify-center font-bold text-[9px]">3</span>
              <span>Heavy-Gauge YKK Antique Zippers</span>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- 2. HIGH-DENSITY CAPABILITY & METRICS STRIP -->
<div class="bg-[#0D0D10] border-b border-white/[0.08] py-6 px-4 sm:px-6 lg:px-12">
  <div class="max-w-[1440px] mx-auto grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 text-center">
    <div class="p-3.5 sm:p-5 rounded-lg bg-white/[0.02] border border-white/[0.06]">
      <div class="font-headline text-xl sm:text-2xl lg:text-3xl font-extrabold text-white">50 PCS</div>
      <div class="font-mono text-[10px] sm:text-[11px] uppercase tracking-wider text-text-muted mt-1">Minimum Order Quantity</div>
    </div>
    <div class="p-3.5 sm:p-5 rounded-lg bg-white/[0.02] border border-white/[0.06]">
      <div class="font-headline text-xl sm:text-2xl lg:text-3xl font-extrabold text-white">15–20 DAYS</div>
      <div class="font-mono text-[10px] sm:text-[11px] uppercase tracking-wider text-text-muted mt-1">Sample Turnaround</div>
    </div>
    <div class="p-3.5 sm:p-5 rounded-lg bg-white/[0.02] border border-white/[0.06]">
      <div class="font-headline text-xl sm:text-2xl lg:text-3xl font-extrabold text-white">212+ STYLES</div>
      <div class="font-mono text-[10px] sm:text-[11px] uppercase tracking-wider text-text-muted mt-1">Active Tooling Archive</div>
    </div>
    <div class="p-3.5 sm:p-5 rounded-lg bg-white/[0.02] border border-white/[0.06]">
      <div class="font-headline text-xl sm:text-2xl lg:text-3xl font-extrabold text-white">GLOBAL EXPORT</div>
      <div class="font-mono text-[10px] sm:text-[11px] uppercase tracking-wider text-text-muted mt-1">Air &amp; Ocean Freight</div>
    </div>
  </div>
</div>

<!-- 3. CORE MANUFACTURING DIVISIONS (Asymmetric Architectural Layout) -->
<section class="py-20 sm:py-28 px-4 sm:px-6 lg:px-12 max-w-[1440px] mx-auto" id="divisions">
  <!-- Section Heading -->
  <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 sm:mb-16 border-b border-white/[0.08] pb-8">
    <div>
      <div class="font-mono text-carmine text-[12px] uppercase tracking-widest font-semibold mb-2">
        MANUFACTURING DISCIPLINES
      </div>
      <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight">
        Core Production Divisions
      </h2>
    </div>
    <p class="font-body text-slate-300 max-w-lg mt-4 md:mt-0 text-sm sm:text-base leading-relaxed">
      Engineered for fashion retailers, boutique brands, and volume distributors seeking certified export-grade manufacturing.
    </p>
  </div>

  <!-- Asymmetric Showcase Grid: 1 Dominant Flagship Hero + 3 Modular Cards -->
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    
    <!-- Flagship Division: Leather Wears (Spans 6 cols, full height presentation) -->
    <?php 
      $leatherCat = null;
      foreach ($topCats as $c) {
          if ($c['slug'] === 'leather-wears') { $leatherCat = $c; break; }
      }
      $metaLeather = $divisionMeta['leather-wears'];
    ?>
    <div class="lg:col-span-6 glass-card rounded-xl overflow-hidden flex flex-col justify-between group border border-white/[0.08] hover:border-carmine/50 transition-all duration-300">
      <div class="relative aspect-[16/11] overflow-hidden bg-surface-dark">
        <img src="<?= e($metaLeather['image']) ?>" 
             alt="Leather Wears Manufacturing Division" 
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        <div class="absolute inset-0 bg-gradient-to-t from-[#121215] via-transparent to-transparent opacity-90"></div>
        <div class="absolute top-4 left-4 flex gap-2">
          <span class="bg-carmine text-white font-mono text-[11px] font-bold px-3 py-1 rounded">
            <?= (int)($leatherCat['live_count'] ?? 62) ?> Live Styles
          </span>
          <span class="bg-surface-card/90 text-slate-200 border border-white/20 font-mono text-[11px] px-2.5 py-1 rounded">
            <?= e($metaLeather['badge']) ?>
          </span>
        </div>
      </div>
      
      <div class="p-6 sm:p-8 flex flex-col flex-grow justify-between">
        <div>
          <div class="font-mono text-[11px] text-carmine uppercase tracking-wider font-semibold mb-1">
            <?= e($metaLeather['tagline']) ?>
          </div>
          <h3 class="font-headline font-extrabold text-2xl sm:text-3xl text-white mb-3">
            Leather Outerwear &amp; Moto Racing
          </h3>
          <p class="font-body text-slate-300 text-sm leading-relaxed mb-6">
            <?= e($metaLeather['lead']) ?>
          </p>
          
          <!-- Technical Specs Pill -->
          <div class="p-3 rounded bg-surface-dark border border-white/[0.06] mb-6">
            <div class="font-mono text-[10px] text-text-muted uppercase">CALIBRATED HIDES</div>
            <div class="font-mono text-xs text-slate-200 font-semibold mt-0.5"><?= e($metaLeather['hides']) ?></div>
          </div>

          <!-- Subcategory Quick Tags -->
          <div class="flex flex-wrap gap-2 mb-8">
            <?php foreach ($metaLeather['subs'] as $sub): ?>
              <span class="text-xs px-2.5 py-1 rounded bg-white/[0.04] border border-white/[0.06] text-slate-300">
                <?= e($sub) ?>
              </span>
            <?php endforeach; ?>
          </div>
        </div>

        <a href="/leather-wears/" class="inline-flex items-center justify-between w-full py-3.5 px-5 rounded bg-surface-dark hover:bg-carmine text-white font-headline font-bold text-xs uppercase tracking-wider transition-colors border border-white/[0.08]">
          <span>Explore Leather Wears Line</span>
          <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </a>
      </div>
    </div>

    <!-- Right Side 3 Divisions (Stacked 6 cols) -->
    <div class="lg:col-span-6 flex flex-col gap-6">
      
      <!-- Division 2: Textile Wears -->
      <?php 
        $textileCat = null;
        foreach ($topCats as $c) { if ($c['slug'] === 'textile-wears') { $textileCat = $c; break; } }
        $metaTextile = $divisionMeta['textile-wears'];
      ?>
      <div class="glass-card rounded-xl p-5 sm:p-6 border border-white/[0.08] hover:border-carmine/50 transition-all flex flex-col sm:flex-row gap-5 items-center group">
        <div class="relative w-full sm:w-44 h-44 shrink-0 rounded-lg overflow-hidden bg-surface-dark">
          <img src="<?= e($metaTextile['image']) ?>" alt="Textile Wears" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
          <span class="absolute top-2 left-2 bg-carmine text-white font-mono text-[10px] font-bold px-2 py-0.5 rounded">
            <?= (int)($textileCat['live_count'] ?? 85) ?> Styles
          </span>
        </div>
        <div class="flex flex-col justify-between flex-grow w-full">
          <div>
            <div class="font-mono text-[10px] text-carmine uppercase tracking-wider font-semibold">
              <?= e($metaTextile['tagline']) ?>
            </div>
            <h4 class="font-headline font-bold text-lg sm:text-xl text-white mt-1 mb-2">
              Technical Textile Apparel
            </h4>
            <p class="font-body text-slate-300 text-xs sm:text-sm line-clamp-2 mb-3">
              <?= e($metaTextile['lead']) ?>
            </p>
          </div>
          <div class="flex items-center justify-between pt-2 border-t border-white/[0.06]">
            <span class="font-mono text-[11px] text-text-muted"><?= e($metaTextile['badge']) ?></span>
            <a href="/textile-wears/" class="font-headline font-bold text-carmine text-xs uppercase tracking-wider flex items-center gap-1 group-hover:translate-x-1 transition-transform">
              <span>View Division</span>
              <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
          </div>
        </div>
      </div>

      <!-- Division 3: Western Wears -->
      <?php 
        $westernCat = null;
        foreach ($topCats as $c) { if ($c['slug'] === 'western-wears') { $westernCat = $c; break; } }
        $metaWestern = $divisionMeta['western-wears'];
      ?>
      <div class="glass-card rounded-xl p-5 sm:p-6 border border-white/[0.08] hover:border-carmine/50 transition-all flex flex-col sm:flex-row gap-5 items-center group">
        <div class="relative w-full sm:w-44 h-44 shrink-0 rounded-lg overflow-hidden bg-surface-dark">
          <img src="<?= e($metaWestern['image']) ?>" alt="Western Wears" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
          <span class="absolute top-2 left-2 bg-carmine text-white font-mono text-[10px] font-bold px-2 py-0.5 rounded">
            <?= (int)($westernCat['live_count'] ?? 34) ?> Styles
          </span>
        </div>
        <div class="flex flex-col justify-between flex-grow w-full">
          <div>
            <div class="font-mono text-[10px] text-carmine uppercase tracking-wider font-semibold">
              <?= e($metaWestern['tagline']) ?>
            </div>
            <h4 class="font-headline font-bold text-lg sm:text-xl text-white mt-1 mb-2">
              Western Heritage &amp; Fringes
            </h4>
            <p class="font-body text-slate-300 text-xs sm:text-sm line-clamp-2 mb-3">
              <?= e($metaWestern['lead']) ?>
            </p>
          </div>
          <div class="flex items-center justify-between pt-2 border-t border-white/[0.06]">
            <span class="font-mono text-[11px] text-text-muted"><?= e($metaWestern['badge']) ?></span>
            <a href="/western-wears/" class="font-headline font-bold text-carmine text-xs uppercase tracking-wider flex items-center gap-1 group-hover:translate-x-1 transition-transform">
              <span>View Division</span>
              <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
          </div>
        </div>
      </div>

      <!-- Division 4: Leather Products & Aprons -->
      <?php 
        $prodCat = null;
        foreach ($topCats as $c) { if ($c['slug'] === 'leather-products') { $prodCat = $c; break; } }
        $metaProd = $divisionMeta['leather-products'];
      ?>
      <div class="glass-card rounded-xl p-5 sm:p-6 border border-white/[0.08] hover:border-carmine/50 transition-all flex flex-col sm:flex-row gap-5 items-center group">
        <div class="relative w-full sm:w-44 h-44 shrink-0 rounded-lg overflow-hidden bg-surface-dark">
          <img src="<?= e($metaProd['image']) ?>" alt="Leather Products" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
          <span class="absolute top-2 left-2 bg-carmine text-white font-mono text-[10px] font-bold px-2 py-0.5 rounded">
            <?= (int)($prodCat['live_count'] ?? 12) ?> Styles
          </span>
        </div>
        <div class="flex flex-col justify-between flex-grow w-full">
          <div>
            <div class="font-mono text-[10px] text-carmine uppercase tracking-wider font-semibold">
              <?= e($metaProd['tagline']) ?>
            </div>
            <h4 class="font-headline font-bold text-lg sm:text-xl text-white mt-1 mb-2">
              Artisan Goods &amp; Workshop Gear
            </h4>
            <p class="font-body text-slate-300 text-xs sm:text-sm line-clamp-2 mb-3">
              <?= e($metaProd['lead']) ?>
            </p>
          </div>
          <div class="flex items-center justify-between pt-2 border-t border-white/[0.06]">
            <span class="font-mono text-[11px] text-text-muted"><?= e($metaProd['badge']) ?></span>
            <a href="/leather-products/" class="font-headline font-bold text-carmine text-xs uppercase tracking-wider flex items-center gap-1 group-hover:translate-x-1 transition-transform">
              <span>View Division</span>
              <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
          </div>
        </div>
      </div>

    </div>

  </div>
</section>

<!-- 4. THE TANNERY & MATERIAL LAB (Tactile Authority for Procurement Managers) -->
<section class="py-20 sm:py-24 px-4 sm:px-6 lg:px-12 bg-surface-dark border-y border-white/[0.08]" id="tannery-lab">
  <div class="max-w-[1440px] mx-auto">
    <!-- Header -->
    <div class="max-w-3xl mb-12 sm:mb-16">
      <div class="font-mono text-carmine text-[12px] uppercase tracking-widest font-semibold mb-2">
        RAW MATERIAL SELECTION
      </div>
      <h2 class="font-headline text-3xl sm:text-4xl font-extrabold text-white tracking-tight mb-4">
        The Tannery &amp; Material Lab
      </h2>
      <p class="font-body text-slate-300 text-sm sm:text-base leading-relaxed">
        We calibrate raw hide thickness, temper, and grain finish directly through local tanneries in Sialkot. All hides are tested for tensile tear resistance, colorfastness, and full REACH compliance before cutting.
      </p>
    </div>

    <!-- 4 Material Specification Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <!-- Material 1: Cowhide -->
      <div class="glass-card rounded-lg p-6 border border-white/[0.08] flex flex-col justify-between">
        <div>
          <div class="flex items-center justify-between mb-4">
            <span class="font-mono text-[11px] text-carmine font-bold uppercase">GRADE A HIDE</span>
            <span class="material-symbols-outlined text-text-muted text-[20px]">shield</span>
          </div>
          <h3 class="font-headline font-bold text-lg text-white mb-2">
            Milled Cowhide
          </h3>
          <p class="font-body text-text-muted text-xs leading-relaxed mb-6">
            Heavy-duty, drum-dyed top grain leather engineered for abrasion resistance and lasting durability in racing and outdoor garments.
          </p>
        </div>
        <div class="pt-4 border-t border-white/[0.08] space-y-2 font-mono text-[11px]">
          <div class="flex justify-between text-slate-300">
            <span class="text-text-muted">Gauge:</span>
            <span class="font-bold">1.1 – 1.3 mm</span>
          </div>
          <div class="flex justify-between text-slate-300">
            <span class="text-text-muted">Temper:</span>
            <span>Medium Firm</span>
          </div>
          <div class="flex justify-between text-slate-300">
            <span class="text-text-muted">Best For:</span>
            <span class="text-slate-200">Moto &amp; Cafe Racers</span>
          </div>
        </div>
      </div>

      <!-- Material 2: Sheep Nappa -->
      <div class="glass-card rounded-lg p-6 border border-white/[0.08] flex flex-col justify-between">
        <div>
          <div class="flex items-center justify-between mb-4">
            <span class="font-mono text-[11px] text-carmine font-bold uppercase">LUXURY HAND</span>
            <span class="material-symbols-outlined text-text-muted text-[20px]">diamond</span>
          </div>
          <h3 class="font-headline font-bold text-lg text-white mb-2">
            Sheep Nappa
          </h3>
          <p class="font-body text-text-muted text-xs leading-relaxed mb-6">
            Silky soft, lightweight lambskin and sheep leather offering fluid drape, exquisite comfort, and refined fashion finishes.
          </p>
        </div>
        <div class="pt-4 border-t border-white/[0.08] space-y-2 font-mono text-[11px]">
          <div class="flex justify-between text-slate-300">
            <span class="text-text-muted">Gauge:</span>
            <span class="font-bold">0.7 – 0.9 mm</span>
          </div>
          <div class="flex justify-between text-slate-300">
            <span class="text-text-muted">Temper:</span>
            <span>Ultra Supple</span>
          </div>
          <div class="flex justify-between text-slate-300">
            <span class="text-text-muted">Best For:</span>
            <span class="text-slate-200">Runway &amp; Bombers</span>
          </div>
        </div>
      </div>

      <!-- Material 3: Suede & Roughout -->
      <div class="glass-card rounded-lg p-6 border border-white/[0.08] flex flex-col justify-between">
        <div>
          <div class="flex items-center justify-between mb-4">
            <span class="font-mono text-[11px] text-carmine font-bold uppercase">HERITAGE NAP</span>
            <span class="material-symbols-outlined text-text-muted text-[20px]">layers</span>
          </div>
          <h3 class="font-headline font-bold text-lg text-white mb-2">
            Velour Goat Suede
          </h3>
          <p class="font-body text-text-muted text-xs leading-relaxed mb-6">
            Fine-buffed velvety suede nap with natural breathability and rustic character. Treated with hydrophobic weather coating on demand.
          </p>
        </div>
        <div class="pt-4 border-t border-white/[0.08] space-y-2 font-mono text-[11px]">
          <div class="flex justify-between text-slate-300">
            <span class="text-text-muted">Gauge:</span>
            <span class="font-bold">0.9 – 1.1 mm</span>
          </div>
          <div class="flex justify-between text-slate-300">
            <span class="text-text-muted">Temper:</span>
            <span>Soft Drape</span>
          </div>
          <div class="flex justify-between text-slate-300">
            <span class="text-text-muted">Best For:</span>
            <span class="text-slate-200">Western Vests &amp; Chaps</span>
          </div>
        </div>
      </div>

      <!-- Material 4: Cordura & Technical -->
      <div class="glass-card rounded-lg p-6 border border-white/[0.08] flex flex-col justify-between">
        <div>
          <div class="flex items-center justify-between mb-4">
            <span class="font-mono text-[11px] text-carmine font-bold uppercase">BALLISTIC WEAVE</span>
            <span class="material-symbols-outlined text-text-muted text-[20px]">hardware</span>
          </div>
          <h3 class="font-headline font-bold text-lg text-white mb-2">
            Cordura® 1000D
          </h3>
          <p class="font-body text-text-muted text-xs leading-relaxed mb-6">
            Military-spec high-tenacity nylon with polyurethane coating for complete weatherproofing, tear resistance, and armor reinforcement.
          </p>
        </div>
        <div class="pt-4 border-t border-white/[0.08] space-y-2 font-mono text-[11px]">
          <div class="flex justify-between text-slate-300">
            <span class="text-text-muted">Weight:</span>
            <span class="font-bold">500D – 1000D</span>
          </div>
          <div class="flex justify-between text-slate-300">
            <span class="text-text-muted">Coating:</span>
            <span>PU Membrane DWR</span>
          </div>
          <div class="flex justify-between text-slate-300">
            <span class="text-text-muted">Best For:</span>
            <span class="text-slate-200">Adventure Touring Gear</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 5. CURATED EXPORT STYLES (Dynamic Catalog Highlights) -->
<?php if (!empty($featured)): ?>
<section class="py-20 sm:py-28 px-4 sm:px-6 lg:px-12 max-w-[1440px] mx-auto" id="featured-styles">
  <!-- Header -->
  <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 sm:mb-16 border-b border-white/[0.08] pb-8">
    <div>
      <div class="font-mono text-carmine text-[12px] uppercase tracking-widest font-semibold mb-2">
        ATELIER HIGHLIGHTS
      </div>
      <h2 class="font-headline text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
        Featured Export Styles
      </h2>
    </div>
    <div class="font-mono text-text-muted text-xs sm:text-sm mt-4 md:mt-0">
      Private-Label OEM Samples · MOQ: 50 Pcs / Style
    </div>
  </div>

  <!-- Product Showcase Grid -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
    <?php foreach (array_slice($featured, 0, 8) as $p): ?>
      <div class="glass-card rounded-xl overflow-hidden border border-white/[0.08] hover:border-carmine/50 flex flex-col justify-between group transition-all duration-300">
        <!-- Image Anchor -->
        <a href="/<?= e($p['category_slug']) ?>/<?= e($p['slug']) ?>/" class="relative aspect-[4/5] bg-surface-dark overflow-hidden block">
          <?php if (!empty($p['image'])): ?>
            <img src="/<?= e($p['image']) ?>" 
                 alt="<?= e($p['name']) ?>" 
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                 loading="lazy">
          <?php else: ?>
            <div class="w-full h-full flex items-center justify-center text-text-muted font-mono text-xs">NO SPEC IMAGE</div>
          <?php endif; ?>
          
          <div class="absolute top-3 left-3 bg-obsidian/85 backdrop-blur-md border border-white/10 px-2 py-0.5 rounded text-[10px] font-mono text-slate-300 font-semibold">
            SKU: <?= e($p['sku']) ?>
          </div>
        </a>

        <!-- Content & Action -->
        <div class="p-5 flex flex-col flex-grow justify-between border-t border-white/[0.06]">
          <div>
            <a href="/<?= e($p['category_slug']) ?>/<?= e($p['slug']) ?>/" class="block">
              <h3 class="font-headline font-bold text-base text-white hover:text-carmine transition-colors line-clamp-1 mb-2">
                <?= e($p['name']) ?>
              </h3>
            </a>
            <div class="font-mono text-[11px] text-text-muted uppercase tracking-wider mb-4">
              Export Grade · Custom Fit
            </div>
          </div>

          <div class="space-y-2 pt-2 border-t border-white/[0.06]">
            <!-- WhatsApp Quote Trigger with prefilled product details -->
            <a href="<?= whatsapp_link("Assalam-o-Alaikum Faraan Impex, I would like to request wholesale OEM pricing and tech specs for product: " . $p['name'] . " (SKU: " . $p['sku'] . ").") ?>" 
               target="_blank" rel="noopener noreferrer" 
               class="w-full inline-flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#20ba5a] text-white py-2.5 px-3 font-headline font-bold text-xs uppercase tracking-wider rounded transition-colors shadow-sm">
              <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 24 24">
                <path d="M12.031 2C6.494 2 2 6.494 2 12.031c0 1.956.564 3.782 1.542 5.334L2 22l4.789-1.517c1.498.907 3.242 1.428 5.109 1.428 5.537 0 10.031-4.494 10.031-10.031S17.568 2 12.031 2zm5.727 14.195c-.241.677-1.391 1.296-1.928 1.341-.536.046-1.196.195-3.874-.912-3.238-1.339-5.321-4.664-5.483-4.88-.16-.217-1.309-1.745-1.309-3.328 0-1.583.829-2.361 1.123-2.684.294-.323.643-.404.858-.404.214 0 .429.003.616.012.198.01.463-.075.724.551.268.643.91 2.224.991 2.385.08.161.134.349.027.563-.107.215-.16.349-.321.536-.161.188-.338.419-.482.563-.161.16-.329.335-.141.658.188.322.836 1.378 1.794 2.231 1.233 1.096 2.274 1.436 2.595 1.597.321.161.509.134.696-.08.188-.215.804-.938 1.018-1.26.214-.322.429-.268.723-.161.295.107 1.874.884 2.196 1.045.321.161.536.241.616.375.08.134.08.777-.161 1.454z"></path>
              </svg>
              <span>Instant Quote on WhatsApp</span>
            </a>
            <!-- View Spec Sheet -->
            <a href="/<?= e($p['category_slug']) ?>/<?= e($p['slug']) ?>/" 
               class="w-full inline-flex items-center justify-center py-2 px-3 bg-surface-dark hover:bg-white/[0.08] text-slate-300 font-headline font-semibold text-xs uppercase tracking-wider rounded border border-white/[0.08] transition-colors">
              <span>View Specifications</span>
            </a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>

<!-- 6. THE 4-STAGE OEM MANUFACTURING PIPELINE -->
<section class="py-20 sm:py-28 px-4 sm:px-6 lg:px-12 bg-[#0C0C0F] border-y border-white/[0.08]" id="process">
  <div class="max-w-[1440px] mx-auto">
    <!-- Header -->
    <div class="max-w-3xl mb-14 sm:mb-20">
      <div class="font-mono text-carmine text-[12px] uppercase tracking-widest font-semibold mb-2">
        QUALITY-CONTROLLED PIPELINE
      </div>
      <h2 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight mb-4">
        4-Stage Private-Label Engineering
      </h2>
      <p class="font-body text-slate-300 text-sm sm:text-base leading-relaxed">
        From initial CAD drawings to final overseas customs clearance, every production batch goes through four disciplined quality gates.
      </p>
    </div>

    <!-- Stepped Pipeline Flow -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 relative">
      
      <!-- Stage 1 -->
      <div class="glass-card rounded-xl p-6 sm:p-7 border border-white/[0.08] flex flex-col justify-between hover:border-carmine/50 transition-all">
        <div>
          <div class="flex items-center justify-between mb-6">
            <span class="font-mono text-2xl font-extrabold text-carmine">01.</span>
            <span class="font-mono text-[10px] uppercase tracking-wider px-2 py-0.5 rounded bg-white/[0.05] text-text-muted border border-white/[0.06]">
              15–20 DAYS
            </span>
          </div>
          <h3 class="font-headline font-bold text-lg text-white mb-2">
            Tech Pack &amp; CAD Grading
          </h3>
          <p class="font-body text-slate-300 text-xs sm:text-sm leading-relaxed mb-6">
            We review your 2D sketches or physical benchmark samples. Master pattern makers draft digital CAD templates with millimeter fit tolerance and deliver counter-samples for approval.
          </p>
        </div>
        <div class="pt-4 border-t border-white/[0.08] font-mono text-[11px] text-carmine font-semibold">
          DELIVERABLE: PHYSICAL PROTOTYPE
        </div>
      </div>

      <!-- Stage 2 -->
      <div class="glass-card rounded-xl p-6 sm:p-7 border border-white/[0.08] flex flex-col justify-between hover:border-carmine/50 transition-all">
        <div>
          <div class="flex items-center justify-between mb-6">
            <span class="font-mono text-2xl font-extrabold text-carmine">02.</span>
            <span class="font-mono text-[10px] uppercase tracking-wider px-2 py-0.5 rounded bg-white/[0.05] text-text-muted border border-white/[0.06]">
              BATCH DYEING
            </span>
          </div>
          <h3 class="font-headline font-bold text-lg text-white mb-2">
            Tannery Hide Calibration
          </h3>
          <p class="font-body text-slate-300 text-xs sm:text-sm leading-relaxed mb-6">
            Hides are custom drum-dyed to match your Pantone palette. Every hide is inspected for uniform gauge, grain consistency, and certified free of restricted chemicals (REACH).
          </p>
        </div>
        <div class="pt-4 border-t border-white/[0.08] font-mono text-[11px] text-carmine font-semibold">
          DELIVERABLE: TESTED LEATHER LOT
        </div>
      </div>

      <!-- Stage 3 -->
      <div class="glass-card rounded-xl p-6 sm:p-7 border border-white/[0.08] flex flex-col justify-between hover:border-carmine/50 transition-all">
        <div>
          <div class="flex items-center justify-between mb-6">
            <span class="font-mono text-2xl font-extrabold text-carmine">03.</span>
            <span class="font-mono text-[10px] uppercase tracking-wider px-2 py-0.5 rounded bg-white/[0.05] text-text-muted border border-white/[0.06]">
              ASSEMBLY LINE
            </span>
          </div>
          <h3 class="font-headline font-bold text-lg text-white mb-2">
            Stitching &amp; Custom Trims
          </h3>
          <p class="font-body text-slate-300 text-xs sm:text-sm leading-relaxed mb-6">
            Garments are assembled by veteran leather tailors using heavy-duty bonded nylon thread. Custom branded woven labels, embossed pulls, and genuine YKK zippers are integrated.
          </p>
        </div>
        <div class="pt-4 border-t border-white/[0.08] font-mono text-[11px] text-carmine font-semibold">
          DELIVERABLE: COMPLETED RUN
        </div>
      </div>

      <!-- Stage 4 -->
      <div class="glass-card rounded-xl p-6 sm:p-7 border border-white/[0.08] flex flex-col justify-between hover:border-carmine/50 transition-all">
        <div>
          <div class="flex items-center justify-between mb-6">
            <span class="font-mono text-2xl font-extrabold text-carmine">04.</span>
            <span class="font-mono text-[10px] uppercase tracking-wider px-2 py-0.5 rounded bg-white/[0.05] text-text-muted border border-white/[0.06]">
              FINAL AUDIT
            </span>
          </div>
          <h3 class="font-headline font-bold text-lg text-white mb-2">
            Quality Audit &amp; Global Freight
          </h3>
          <p class="font-body text-slate-300 text-xs sm:text-sm leading-relaxed mb-6">
            100% individual garment inspection against approved master measurements. Moisture-barrier polybag packaging, export crating, and direct dispatch via DHL/FedEx or ocean freight.
          </p>
        </div>
        <div class="pt-4 border-t border-white/[0.08] font-mono text-[11px] text-carmine font-semibold">
          DELIVERABLE: DOOR-TO-DOOR DISPATCH
        </div>
      </div>

    </div>
  </div>
</section>

<!-- 7. PROCUREMENT & TECH PACK INQUIRY DESK -->
<section class="py-20 sm:py-24 px-4 sm:px-6 lg:px-12 max-w-[1440px] mx-auto">
  <div class="relative glass-card rounded-2xl p-8 sm:p-12 lg:p-16 border border-white/[0.12] overflow-hidden">
    <!-- Subtle glow behind -->
    <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-carmine/15 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
      <div class="lg:col-span-8">
        <div class="font-mono text-carmine text-[12px] uppercase tracking-widest font-semibold mb-2">
          DIRECT FACTORY ACCESS
        </div>
        <h2 class="font-headline text-2xl sm:text-4xl font-extrabold text-white tracking-tight mb-4">
          Ready to Prototype or Scale Production?
        </h2>
        <p class="font-body text-slate-300 text-sm sm:text-base leading-relaxed max-w-2xl mb-8">
          Send your tech pack, specification sketches, or reference garment requirements directly to our production desk. We analyze patterns, calculate leather consumption, and provide formal FOB/CIF export quotations within 24 hours.
        </p>

        <!-- Direct Contact Badges -->
        <div class="flex flex-wrap gap-4 text-xs font-mono text-slate-300">
          <div class="flex items-center gap-2 px-3 py-1.5 rounded bg-surface-dark border border-white/[0.08]">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
            <span>Direct WhatsApp: <?= e(CONTACT_PHONE) ?></span>
          </div>
          <div class="flex items-center gap-2 px-3 py-1.5 rounded bg-surface-dark border border-white/[0.08]">
            <span class="material-symbols-outlined text-carmine text-[15px]">mail</span>
            <span><?= e(CONTACT_EMAIL) ?></span>
          </div>
          <div class="flex items-center gap-2 px-3 py-1.5 rounded bg-surface-dark border border-white/[0.08]">
            <span class="material-symbols-outlined text-carmine text-[15px]">location_on</span>
            <span>Sialkot, Pakistan</span>
          </div>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="lg:col-span-4 flex flex-col gap-3.5 w-full">
        <a href="<?= whatsapp_link("Assalam-o-Alaikum, I have a tech pack / production inquiry and would like an OEM quote from Faraan Impex.") ?>" 
           target="_blank" rel="noopener noreferrer" 
           class="inline-flex items-center justify-center gap-2.5 bg-[#25D366] hover:bg-[#20ba5a] text-white font-headline font-bold uppercase tracking-wider text-xs sm:text-[13px] py-4 px-6 rounded transition-colors shadow-lg shadow-emerald-900/20 text-center">
          <svg class="w-5 h-5 fill-current shrink-0" viewBox="0 0 24 24">
            <path d="M12.031 2C6.494 2 2 6.494 2 12.031c0 1.956.564 3.782 1.542 5.334L2 22l4.789-1.517c1.498.907 3.242 1.428 5.109 1.428 5.537 0 10.031-4.494 10.031-10.031S17.568 2 12.031 2zm5.727 14.195c-.241.677-1.391 1.296-1.928 1.341-.536.046-1.196.195-3.874-.912-3.238-1.339-5.321-4.664-5.483-4.88-.16-.217-1.309-1.745-1.309-3.328 0-1.583.829-2.361 1.123-2.684.294-.323.643-.404.858-.404.214 0 .429.003.616.012.198.01.463-.075.724.551.268.643.91 2.224.991 2.385.08.161.134.349.027.563-.107.215-.16.349-.321.536-.161.188-.338.419-.482.563-.161.16-.329.335-.141.658.188.322.836 1.378 1.794 2.231 1.233 1.096 2.274 1.436 2.595 1.597.321.161.509.134.696-.08.188-.215.804-.938 1.018-1.26.214-.322.429-.268.723-.161.295.107 1.874.884 2.196 1.045.321.161.536.241.616.375.08.134.08.777-.161 1.454z"></path>
          </svg>
          <span>Chat with Production Head</span>
        </a>

        <a href="mailto:<?= e(CONTACT_EMAIL) ?>?subject=<?= rawurlencode('OEM Manufacturing & Tech Pack Inquiry — Faraan Impex') ?>" 
           class="inline-flex items-center justify-center gap-2 bg-carmine hover:bg-carmine-hover text-white font-headline font-bold uppercase tracking-wider text-xs sm:text-[13px] py-4 px-6 rounded transition-colors text-center shadow-lg shadow-carmine/20">
          <span class="material-symbols-outlined text-[18px]">send</span>
          <span>Submit Tech Pack via Email</span>
        </a>

        <a href="/contact-us" 
           class="inline-flex items-center justify-center py-3.5 px-6 bg-surface-dark hover:bg-white/[0.08] text-slate-300 font-headline font-semibold uppercase tracking-wider text-xs rounded border border-white/[0.08] transition-colors text-center">
          <span>Complete B2B Contact Form</span>
        </a>
      </div>
    </div>
  </div>
</section>
