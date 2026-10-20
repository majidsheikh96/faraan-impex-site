<?php
/**
 * Section 4: Manufacturing Capabilities (Stagfield Sports Minimalist Caliber)
 * Clean architectural dark grid with zero clutter — showcasing the full multi-category production scope.
 */

$capabilities = [
    [
        'no'    => '01',
        'title' => 'Multi-Hide Tanning & Grading',
        'lead'  => 'Calibrated gauges from 0.7mm silky sheep nappa to 1.3mm drum-dyed race-grade cowhide, roughout split suede, and vegetable-tanned harness hides.'
    ],
    [
        'no'    => '02',
        'title' => 'Heavy Flannels & Cordura® 1000D',
        'lead'  => 'Heavyweight yarn-dyed 280 GSM cotton flannels, Cordura® 1000D ballistic shells, DuPont™ Kevlar® abrasion linings, and DWR water-repellent barriers.'
    ],
    [
        'no'    => '03',
        'title' => 'CE Armor & Carbon Shielding',
        'lead'  => 'CE Level 1 & Level 2 viscoelastic impact protectors, aerodynamic track humps, titanium elbow sliders, and carbon fiber motorcycle glove knuckles.'
    ],
    [
        'no'    => '04',
        'title' => 'Conchos, Heavy Brass & YKK® Fasteners',
        'lead'  => 'Solid antiqued brass hardware, biker vest concho chains, heavy-gauge YKK® zippers, debossed leather patches, and custom cast hardware.'
    ],
    [
        'no'    => '05',
        'title' => 'Hand-Blocked Hats & Artisan Craft',
        'lead'  => 'Traditional wooden block molding for leather top hats and western cowboy headwear, precision edge burnishing, and heavy-duty workshop aprons.'
    ],
    [
        'no'    => '06',
        'title' => 'Digital CAD Patterning & Rapid Sampling',
        'lead'  => 'Digital 2D CAD grading from your sketches or reference garment. First physical production counter-sample delivered to your desk in 7–10 days.'
    ]
];
?>

<!-- 4. MANUFACTURING CAPABILITIES (Minimalist Dark Architectural Grid) -->
<section class="py-24 sm:py-28 bg-[#070709] text-white relative overflow-hidden border-b border-white/10" id="capabilities">
  <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    
    <!-- Section Heading -->
    <div class="max-w-[820px] mb-14 sm:mb-16">
      <p class="font-mono text-crimson text-[11px] sm:text-[12px] font-bold uppercase tracking-[0.18em] mb-3">
        MANUFACTURING CAPABILITIES
      </p>
      <h2 class="font-serif text-3xl sm:text-4xl lg:text-[44px] font-normal text-white tracking-tight leading-[1.16]">
        Engineered around your technical pack.
      </h2>
      <p class="text-[#AEB9C4] text-[15px] sm:text-[17px] leading-relaxed mt-4">
        Our Sialkot manufacturing plant operates as your direct offshore production line. Capabilities span racing suits, technical flannels, western headwear, and bespoke leathercraft — each calibrated to your exact tolerances.
      </p>
    </div>

    <!-- 6 Capabilities Architectural Grid with 1px Hairlines (Zero Clutter) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 border-t border-l border-white/10">
      <?php foreach ($capabilities as $cap): ?>
        <div class="p-8 sm:p-10 border-r border-b border-white/10 flex flex-col justify-between hover:bg-white/[0.02] transition-colors">
          <div>
            <!-- Number in Logo Crimson -->
            <span class="font-serif text-3xl sm:text-4xl text-crimson font-normal block mb-6">
              <?= e($cap['no']) ?>
            </span>

            <!-- Title -->
            <h3 class="font-serif text-2xl font-normal text-white mb-3">
              <?= e($cap['title']) ?>
            </h3>

            <!-- Description -->
            <p class="text-[#AEB9C4] text-[14px] leading-relaxed font-body">
              <?= e($cap['lead']) ?>
            </p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>