<?php
/**
 * Core Manufacturing Divisions Section (Stagfield Sports Luxury Caliber)
 * 2x2 Spacious Editorial Grid — Generous breathing room, monumental typography, and uncompressed photography.
 */

$divisions = [
    [
        'slug'        => 'leather-wears',
        'href'        => '/leather-wears/',
        'number'      => '01',
        'kicker'      => 'FLAGSHIP ATELIER',
        'title'       => 'Leather Outerwear & Moto Racing',
        'image'       => '/assets/images/divisions/division-leather-wears.jpg',
        'lead'        => 'Bespoke motorcycle racing suits, cafe racers, aviator bombers, and luxury runway outerwear tailored to exacting millimeter tolerance.',
        'specs'       => ['1.2mm Cowhide', 'CE Level 2 Ready', 'Biker Cuts', 'YKK® Brass'],
        'cta'         => 'Explore Leatherwear Division'
    ],
    [
        'slug'        => 'textile-wears',
        'href'        => '/textile-wears/',
        'number'      => '02',
        'kicker'      => 'TECHNICAL APPAREL',
        'title'       => 'Technical All-Weather Outerwear',
        'image'       => '/assets/images/divisions/division-textile-wears.jpg',
        'lead'        => 'High-tenacity all-weather touring garments, waterproof adventure shells, insulated tactical gear, and reinforced fleece outerwear.',
        'specs'       => ['Cordura® 1000D', 'DWR Water-Repellent', 'Heavy Denim', 'Ballistic Nylon'],
        'cta'         => 'Explore Textile Division'
    ],
    [
        'slug'        => 'western-wears',
        'href'        => '/western-wears/',
        'number'      => '03',
        'kicker'      => 'HERITAGE CRAFT',
        'title'       => 'Western Heritage & Frontier Suede',
        'image'       => '/assets/images/divisions/division-western-wears.jpg',
        'lead'        => 'Authentic hand-fringed leather coats, rugged frontier vests, heavy riding chaps, and traditional hand-blocked leather headwear.',
        'specs'       => ['Roughout Suede', 'Hand-Cut Fringes', 'Riding Chaps', 'Cowboy Hats'],
        'cta'         => 'Explore Western Division'
    ],
    [
        'slug'        => 'leather-products',
        'href'        => '/leather-products/',
        'number'      => '04',
        'kicker'      => 'ARTISAN ATELIER',
        'title'       => 'Artisan Goods & Workshop Gear',
        'image'       => '/assets/images/divisions/division-leather-products.jpg',
        'lead'        => 'Heavyweight workshop aprons, fortified motorcycle gloves, vintage biker chain wallets, and custom embossed leather accessories.',
        'specs'       => ['Full-Grain Veg-Tan', 'Workshop Aprons', 'Riding Gloves', 'Biker Wallets'],
        'cta'         => 'Explore Leather Goods'
    ]
];
?>

<!-- 3. CORE MANUFACTURING DIVISIONS -->
<section class="py-24 sm:py-28 bg-paper border-b border-[#E6E4DD]" id="divisions">
  <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Section Heading (High Contrast Editorial) -->
    <div class="max-w-[790px] mb-12 sm:mb-16">
      <p class="font-mono text-crimson text-[11px] sm:text-[12px] font-bold uppercase tracking-[0.18em] mb-3">
        MANUFACTURING DIVISIONS
      </p>
      <h2 class="font-serif text-3xl sm:text-4xl lg:text-[44px] font-normal text-[#070709] tracking-tight leading-[1.16]">
        Four focused ways to manufacture with us.
      </h2>
      <p class="text-[#5A6472] text-[15px] sm:text-[17px] leading-relaxed mt-4">
        Our Sialkot atelier covers specialized contract leathercraft, technical outerwear, and heritage apparel. These are the core manufacturing divisions we prioritize for B2B buyer sampling, private-label lines, and repeat-order production.
      </p>
    </div>

    <!-- 2x2 Spacious Editorial Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10">
      <?php foreach ($divisions as $div): ?>
        <a href="<?= e($div['href']) ?>" 
           class="group relative overflow-hidden rounded-[24px] bg-[#070709] min-h-[520px] sm:min-h-[560px] shadow-[0_20px_50px_rgba(7,7,9,0.08)] border border-black/[0.06] flex flex-col justify-end p-8 sm:p-10 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_30px_70px_rgba(7,7,9,0.18)] block">
          
          <!-- Full Card Photographic Background (Unobscured Upper 65%) -->
          <img src="<?= e($div['image']) ?>" 
               alt="<?= e($div['title']) ?>" 
               class="absolute inset-0 w-full h-full object-cover object-center transition-all duration-700 ease-out group-hover:scale-105"
               loading="lazy">
          
          <!-- Subtle Chiaroscuro Atmospheric Overlay -->
          <div class="absolute inset-0 bg-gradient-to-t from-[#070709] via-[#070709]/75 via-35% to-transparent pointer-events-none"></div>

          <!-- Card Content (Generously Spaced & Uncluttered) -->
          <div class="relative z-10 text-white flex flex-col justify-end">
            
            <!-- Category Kicker in Brand Crimson -->
            <div class="font-mono text-[11px] text-crimson uppercase tracking-[0.18em] font-bold mb-2.5">
              <?= e($div['number']) ?> · <?= e($div['kicker']) ?>
            </div>

            <!-- Division Title -->
            <h3 class="font-serif text-[26px] sm:text-[30px] font-normal text-white leading-tight mb-3 group-hover:text-white/95">
              <?= e($div['title']) ?>
            </h3>

            <!-- Editorial Lead (Wide & Legible) -->
            <p class="text-[#D7DEE5] text-[14px] sm:text-[15px] leading-relaxed mb-5 max-w-xl line-clamp-2">
              <?= e($div['lead']) ?>
            </p>

            <!-- Technical Specification Badges & Arrow CTA in Single Clean Bar -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-4 border-t border-white/15">
              
              <!-- Specs List -->
              <div class="flex flex-wrap items-center gap-2">
                <?php foreach ($div['specs'] as $spec): ?>
                  <span class="px-3 py-1 rounded-full bg-white/10 backdrop-blur-sm border border-white/15 text-[11px] text-white/90 font-mono tracking-tight">
                    <?= e($spec) ?>
                  </span>
                <?php endforeach; ?>
              </div>

              <!-- CTA Arrow -->
              <div class="inline-flex items-center gap-2 text-white font-mono text-[11px] font-bold tracking-[0.1em] uppercase group-hover:text-crimson transition-colors shrink-0">
                <span><?= e($div['cta']) ?></span>
                <span class="text-crimson text-base font-bold transition-transform group-hover:translate-x-1.5">→</span>
              </div>

            </div>

          </div>
        </a>
      <?php endforeach; ?>
    </div>

    <!-- Secondary Capabilities Strip (Stagfield Caliber) -->
    <div class="mt-10 p-6 sm:p-7 rounded-[20px] bg-white border border-[#E6E4DD] text-[#5A6472] text-[13px] sm:text-[14px] leading-relaxed flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-[0_2px_8px_rgba(0,0,0,0.03)]">
      <div class="max-w-4xl">
        <strong class="text-[#070709] font-semibold">Need custom specifications or another division?</strong> We also engineer ballistic Cordura tactical vests, CE Level 2 armor integration, custom heavy brass hardware, and pantone-matched drum-dyed hides. Availability is confirmed against your exact technical pack.
      </div>
      <a href="#inquiry" class="inline-flex items-center gap-1.5 text-crimson font-mono text-[11px] font-bold tracking-[0.1em] uppercase hover:underline whitespace-nowrap shrink-0">
        <span>Submit Tech Pack</span>
        <span class="font-bold">→</span>
      </a>
    </div>

  </div>
</section>
