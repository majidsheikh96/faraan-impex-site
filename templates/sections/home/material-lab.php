<?php
/**
 * Section 4: Manufacturing Capabilities (Stagfield Sports Minimalist Caliber)
 * Clean architectural dark grid with zero clutter — only number, title, and concise lead.
 */

$capabilities = [
    [
        'no'    => '01',
        'title' => 'Tannery Grading & Hide Selection',
        'lead'  => 'Calibrated gauges from 0.7mm silk-soft sheep nappa to 1.3mm drum-dyed race-grade cowhide. Inspected for tensile strength and full REACH chemical compliance.'
    ],
    [
        'no'    => '02',
        'title' => 'Cordura® 1000D & Technical Shells',
        'lead'  => 'High-tenacity ballistic nylon weaves, DWR water-repellent barriers, breathable PU membranes, and DuPont™ Kevlar® abrasion-resistant linings.'
    ],
    [
        'no'    => '03',
        'title' => 'Custom Embroidery & Badging',
        'lead'  => 'Multi-head computerized embroidery, 3D puff stitching, Chenille varsity emblems, laser-cut leather appliqué, and authentic motorcycle back-patches.'
    ],
    [
        'no'    => '04',
        'title' => 'Heavy Brass & YKK® Fasteners',
        'lead'  => 'Solid antiqued brass hardware, genuine YKK® heavy-gauge zippers, custom debossed leather waist patches, and custom-moulded metal snap closures.'
    ],
    [
        'no'    => '05',
        'title' => 'Prototyping & CAD Patterning',
        'lead'  => 'Digital 2D CAD pattern grading from your sketches or reference garment. First physical production counter-sample delivered to your desk in 7–10 days.'
    ],
    [
        'no'    => '06',
        'title' => 'Rigorous In-Line & Final QC',
        'lead'  => 'Pre-cutting hide defect scanning, tensile seam stress checks, millimeter dimensional audit against tech pack, and moisture-barrier export crating.'
    ]
];
?>

<!-- 4. MANUFACTURING CAPABILITIES (Minimalist Dark Architectural Grid) -->
<section class="py-24 sm:py-28 bg-[#070709] text-white relative overflow-hidden border-b border-white/10" id="capabilities">
  <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    
    <!-- Section Heading -->
    <div class="max-w-[790px] mb-14 sm:mb-16">
      <p class="font-mono text-crimson text-[11px] sm:text-[12px] font-bold uppercase tracking-[0.18em] mb-3">
        MANUFACTURING CAPABILITIES
      </p>
      <h2 class="font-serif text-3xl sm:text-4xl lg:text-[44px] font-normal text-white tracking-tight leading-[1.16]">
        Built around your specification, not a fixed catalogue.
      </h2>
      <p class="text-[#AEB9C4] text-[15px] sm:text-[17px] leading-relaxed mt-4">
        Our contract atelier operates as your direct offshore production line. Capabilities are confirmed against the exact product, hide selection, quantity, and customization requirement before quotation.
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
