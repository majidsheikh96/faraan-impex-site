<?php
/**
 * Core Manufacturing Divisions Section (Stagfield Sports Luxury Caliber)
 * 2x2 Spacious Editorial Grid featuring Authentic Production Lines:
 * Race Suits, Technical Flannels, Western Headwear & Biker Vests.
 * Using razor-sharp 2K+ master assets with 60fps/120fps hardware-accelerated transitions.
 */

$divisions = [
    [
        'slug'        => 'leather-wears',
        'href'        => '/leather-wears/',
        'number'      => '01',
        'kicker'      => 'MOTORCYCLE RACING',
        'title'       => 'Motorcycle Racing Suits & Track Gear',
        'image'       => '/assets/images/showcase/motorcycle-gear-showroom-hires.jpg',
        'lead'        => 'Bespoke 1.3mm cowhide race suits, aerodynamic speed humps, fortified knuckle gloves, and CE Level 2 track armor built for severe slide resistance.',
        'specs'       => ['1.3mm Race Cowhide', 'CE Level 2 Armor', 'Speed Hump Fit', 'Carbon Knuckles'],
        'cta'         => 'Explore Racing Division'
    ],
    [
        'slug'        => 'textile-wears',
        'href'        => '/textile-wears/',
        'number'      => '02',
        'kicker'      => 'TECHNICAL TEXTILES',
        'title'       => 'Technical Textiles & Plaid Flannels',
        'image'       => '/assets/images/showcase/flannel-textile-shirt-hires.jpg',
        'lead'        => 'Heavy yarn-dyed cotton flannels, Cordura® 1000D adventure shells, ballistic denim jackets, and all-weather touring apparel built for durability.',
        'specs'       => ['Heavy Flannel 280 GSM', 'Cordura® 1000D', 'DWR Weatherproof', 'Ballistic Denim'],
        'cta'         => 'Explore Textile Division'
    ],
    [
        'slug'        => 'western-wears',
        'href'        => '/western-wears/',
        'number'      => '03',
        'kicker'      => 'WESTERN WEAR',
        'title'       => 'Western Heritage & Custom Headwear',
        'image'       => '/assets/images/showcase/custom-leather-hat-hires.jpg',
        'lead'        => 'Traditional hand-blocked leather top hats, custom cowboy headwear, fringed roughout suede jackets, and rugged rancher riding chaps.',
        'specs'       => ['Hand-Blocked Hats', 'Roughout Suede', 'Hand-Cut Fringes', 'Riding Chaps'],
        'cta'         => 'Explore Western Division'
    ],
    [
        'slug'        => 'leather-products',
        'href'        => '/leather-products/',
        'number'      => '04',
        'kicker'      => 'LEATHER GOODS & VESTS',
        'title'       => 'Biker Vests & Artisan Leather Goods',
        'image'       => '/assets/images/showcase/leather-biker-vest-hires.jpg',
        'lead'        => 'Heavyweight full-grain biker club vests with concho chain closures, heavy leather workshop aprons, fortified riding gloves, and leather goods.',
        'specs'       => ['Concho Chain Vests', 'Side-Laced Cuts', 'Workshop Aprons', 'Full-Grain Veg-Tan'],
        'cta'         => 'Explore Leather Goods'
    ]
];
?>

<!-- 3. CORE MANUFACTURING DIVISIONS -->
<section class="py-24 sm:py-28 bg-paper border-b border-[#E6E4DD]" id="divisions">
  <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Section Heading (High Contrast Editorial) -->
    <div class="max-w-[820px] mb-12 sm:mb-16">
      <p class="font-mono text-crimson text-[11px] sm:text-[12px] font-bold uppercase tracking-[0.18em] mb-3">
        MANUFACTURING DIVISIONS
      </p>
      <h2 class="font-serif text-3xl sm:text-4xl lg:text-[44px] font-normal text-[#070709] tracking-tight leading-[1.16]">
        Four dedicated production divisions.
      </h2>
      <p class="text-[#5A6472] text-[15px] sm:text-[17px] leading-relaxed mt-4">
        Our Sialkot facility is equipped with dedicated cutting lines, heavy-stitch machinery, and finishing units across four specialized sectors — ensuring every order meets international export standards.
      </p>
    </div>

    <!-- 2x2 Spacious Editorial Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10">
      <?php foreach ($divisions as $div): ?>
        <a href="<?= e($div['href']) ?>" 
           class="group relative overflow-hidden rounded-[24px] bg-[#070709] min-h-[520px] sm:min-h-[560px] shadow-[0_16px_40px_rgba(7,7,9,0.08)] border border-black/[0.06] flex flex-col justify-end p-8 sm:p-10 block gpu-card hover:-translate-y-1.5 hover:shadow-[0_24px_50px_rgba(7,7,9,0.18)]">
          
          <!-- Full Card Photographic Background (Hardware-Accelerated 60fps/120fps Zoom) -->
          <img src="<?= e($div['image']) ?>" 
               alt="<?= e($div['title']) ?>" 
               class="absolute inset-0 w-full h-full object-cover object-center gpu-zoom-img"
               loading="lazy">
          
          <!-- Subtle Chiaroscuro Atmospheric Overlay -->
          <div class="absolute inset-0 bg-gradient-to-t from-[#070709] via-[#070709]/80 via-40% to-transparent pointer-events-none"></div>

          <!-- Card Content -->
          <div class="relative z-10 text-white flex flex-col justify-end">
            
            <!-- Category Kicker in Brand Crimson -->
            <div class="font-mono text-[11px] text-crimson uppercase tracking-[0.18em] font-bold mb-2.5">
              <?= e($div['number']) ?> · <?= e($div['kicker']) ?>
            </div>

            <!-- Division Title -->
            <h3 class="font-serif text-[26px] sm:text-[30px] font-normal text-white leading-tight mb-3 group-hover:text-white/95">
              <?= e($div['title']) ?>
            </h3>

            <!-- Editorial Lead -->
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

  </div>
</section>
