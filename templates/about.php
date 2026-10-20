<?php
/**
 * About Us — Company Heritage & Sialkot Atelier Credentials (Stagfield Sports Caliber)
 * High-contrast editorial hero, verified production statistics, and core manufacturing pillars.
 * 100% Admin-Controlled Content via /admin/pages.php.
 */
$siteName = get_setting('site_name', SITE_NAME);
$page_title = 'About ' . e($siteName) . ' — Direct Sialkot Leather & Technical Garments Manufacturer';
$page_description = 'Learn about ' . e($siteName) . ', a direct B2B private-label manufacturer and exporter of luxury leather outerwear, racing suits, and technical gear in Sialkot, Pakistan.';

$heroTitle = get_setting('about_hero_title', 'Commercial communication on one side. Production capability on the other.');
$heroLead = get_setting('about_hero_lead', 'Faraan Impex is a direct B2B leather and technical textile garments manufacturer based in Sialkot, Pakistan. We connect international fashion houses, motorcycle clubs, and volume distributors with master-grade contract manufacturing.');
$story1 = get_setting('about_story_1', 'Founded in Sialkot, Pakistan — the global epicentre of sporting leathercraft and precision technical tailoring — Faraan Impex was established to solve the uncertainty between overseas buyers and factory floors.');
$story2 = get_setting('about_story_2', 'We operate as your direct production partner. From selecting raw hides directly through certified local tanneries to drafting digital CAD grading templates and stitching with heavy-duty bonded nylon, every garment is managed under stringent tolerance standards.');

$stat1Num = get_setting('about_stat_1_num', '200+');
$stat1Label = get_setting('about_stat_1_label', 'Live Specifications');
$stat2Num = get_setting('about_stat_2_num', '4');
$stat2Label = get_setting('about_stat_2_label', 'Focused Divisions');
$stat3Num = get_setting('about_stat_3_num', '7–10');
$stat3Label = get_setting('about_stat_3_label', 'Days Prototype Lead');
$stat4Num = get_setting('about_stat_4_num', '100%');
$stat4Label = get_setting('about_stat_4_label', 'Dual Station QC');
?>

<!-- About Hero Section -->
<section class="bg-[#070709] text-white border-b border-white/10 py-16 sm:py-24 relative overflow-hidden">
  <div class="absolute -right-32 -top-32 w-80 h-80 bg-crimson/10 rounded-full blur-[140px] pointer-events-none"></div>

  <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div class="max-w-3xl">
      <span class="font-mono text-crimson text-[11px] uppercase tracking-[0.18em] font-bold block mb-3">
        SIALKOT FACTORY &amp; OEM MANUFACTURING
      </span>
      <h1 class="font-serif text-3xl sm:text-5xl lg:text-6xl font-normal text-white tracking-tight leading-[1.12]">
        <?= e($heroTitle) ?>
      </h1>
      <p class="text-[#AEB9C4] text-base sm:text-lg leading-relaxed mt-6 font-body">
        <?= e($heroLead) ?>
      </p>
    </div>
  </div>
</section>

<!-- Main Story & Factory Credentials -->
<div class="bg-paper py-16 sm:py-24 border-b border-[#E6E4DD]">
  <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- 2-Column Editorial Story -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start mb-20">
      <div class="lg:col-span-5">
        <p class="font-mono text-crimson text-xs uppercase tracking-widest font-bold mb-3">
          OUR SIALKOT FACILITY
        </p>
        <h2 class="font-serif text-3xl sm:text-4xl text-[#070709] font-normal tracking-tight leading-tight">
          Decades of hand-tailoring refined for modern contract production.
        </h2>
      </div>

      <div class="lg:col-span-7 space-y-6 text-[#5A6472] text-[15px] sm:text-[16px] leading-relaxed font-body">
        <p>
          <?= e($story1) ?>
        </p>
        <p>
          <?= e($story2) ?>
        </p>
        <p>
          Whether developing a boutique cafe racer collection for a US startup or fulfilling recurring 1,000-unit distributor orders for European safety wear programs, our commercial desk ensures clear milestone communication and zero broker markups.
        </p>
      </div>
    </div>

    <!-- 4 Factory Performance Metrics -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8 mb-20">
      <div class="bg-white rounded-[22px] border border-[#E6E4DD] p-7 shadow-sm">
        <div class="font-serif text-3xl sm:text-4xl text-crimson font-normal"><?= e($stat1Num) ?></div>
        <div class="font-mono text-xs text-[#070709] uppercase tracking-wider font-bold mt-2"><?= e($stat1Label) ?></div>
        <div class="text-xs text-[#5A6472] mt-1 font-body">Ready for sampling or private label</div>
      </div>
      <div class="bg-white rounded-[22px] border border-[#E6E4DD] p-7 shadow-sm">
        <div class="font-serif text-3xl sm:text-4xl text-crimson font-normal"><?= e($stat2Num) ?></div>
        <div class="font-mono text-xs text-[#070709] uppercase tracking-wider font-bold mt-2"><?= e($stat2Label) ?></div>
        <div class="text-xs text-[#5A6472] mt-1 font-body">Leather, Textile, Western &amp; Goods</div>
      </div>
      <div class="bg-white rounded-[22px] border border-[#E6E4DD] p-7 shadow-sm">
        <div class="font-serif text-3xl sm:text-4xl text-crimson font-normal"><?= e($stat3Num) ?></div>
        <div class="font-mono text-xs text-[#070709] uppercase tracking-wider font-bold mt-2"><?= e($stat3Label) ?></div>
        <div class="text-xs text-[#5A6472] mt-1 font-body">Fast physical counter-sample sign-off</div>
      </div>
      <div class="bg-white rounded-[22px] border border-[#E6E4DD] p-7 shadow-sm">
        <div class="font-serif text-3xl sm:text-4xl text-crimson font-normal"><?= e($stat4Num) ?></div>
        <div class="font-mono text-xs text-[#070709] uppercase tracking-wider font-bold mt-2"><?= e($stat4Label) ?></div>
        <div class="text-xs text-[#5A6472] mt-1 font-body">Pre-cutting &amp; final export crating</div>
      </div>
    </div>

    <!-- 3 Core Manufacturing Pillars -->
    <div class="mb-20">
      <div class="max-w-2xl mb-10">
        <p class="font-mono text-crimson text-xs uppercase tracking-widest font-bold mb-2">
          WHY PARTNER WITH US
        </p>
        <h2 class="font-serif text-3xl text-[#070709] font-normal">
          Disciplined contract execution from day one.
        </h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white rounded-[22px] border border-[#E6E4DD] p-8 shadow-sm">
          <div class="font-mono text-xs text-crimson font-bold uppercase tracking-wider mb-3">01 · TANNERY INTEGRATION</div>
          <h3 class="font-serif text-xl text-[#070709] font-normal mb-3">Direct Raw Hide Calibration</h3>
          <p class="text-sm text-[#5A6472] leading-relaxed">
            Direct access to Sialkot tanneries allows us to calibrate hide gauges, drum-dye pantone colors, and ensure full REACH chemical compliance without third-party delay.
          </p>
        </div>

        <div class="bg-white rounded-[22px] border border-[#E6E4DD] p-8 shadow-sm">
          <div class="font-mono text-xs text-crimson font-bold uppercase tracking-wider mb-3">02 · PRIVATE LABEL</div>
          <h3 class="font-serif text-xl text-[#070709] font-normal mb-3">Bespoke Brand Engineering</h3>
          <p class="text-sm text-[#5A6472] leading-relaxed">
            From debossed full-grain waist patches and branded YKK zipper pulls to custom woven neck labels and hangtags, we deliver retail-ready packaging.
          </p>
        </div>

        <div class="bg-white rounded-[22px] border border-[#E6E4DD] p-8 shadow-sm">
          <div class="font-mono text-xs text-crimson font-bold uppercase tracking-wider mb-3">03 · TRANSPARENT PRICING</div>
          <h3 class="font-serif text-xl text-[#070709] font-normal mb-3">Direct Factory Economics</h3>
          <p class="text-sm text-[#5A6472] leading-relaxed">
            Eliminate commission agents and trading house intermediaries. Work directly with the factory floor with itemized FOB/CIF commercial quotes.
          </p>
        </div>
      </div>
    </div>

    <!-- Bottom Contact Callout -->
    <div class="rounded-[24px] bg-[#070709] text-white p-8 sm:p-12 lg:p-14 relative overflow-hidden flex flex-col md:flex-row md:items-center justify-between gap-8">
      <div class="max-w-2xl relative z-10">
        <span class="font-mono text-crimson text-[11px] uppercase tracking-[0.18em] font-bold block mb-2">
          START A CONTRACT INQUIRY
        </span>
        <h3 class="font-serif text-2xl sm:text-3xl font-normal leading-tight">
          Ready to review tech packs or request sample swatches?
        </h3>
        <p class="text-[#AEB9C4] text-sm mt-3">
          Our engineering team reviews designs and calculates material consumption within <?= e(get_setting('quote_turnaround', '2 hours')) ?>.
        </p>
      </div>

      <div class="flex flex-col sm:flex-row gap-3.5 relative z-10 shrink-0">
        <a href="/contact-us" class="bg-crimson hover:bg-crimson-hover text-white px-7 py-3.5 rounded-full font-mono text-xs font-bold uppercase tracking-wider transition-colors text-center shadow-md">
          Submit Tech Pack →
        </a>
        <a href="<?= whatsapp_link("Assalam-o-Alaikum, I'd like to discuss contract manufacturing with " . $siteName . ".") ?>" target="_blank" rel="noopener noreferrer" class="bg-white/10 hover:bg-white/15 text-white border border-white/20 px-6 py-3.5 rounded-full font-mono text-xs font-bold uppercase tracking-wider transition-colors text-center">
          Chat on WhatsApp
        </a>
      </div>
    </div>

  </div>
</div>