<?php
/**
 * Section 6: How It Works / Manufacturing Pipeline (Stagfield Sports Luxury Caliber)
 * Balanced symmetrical 3x2 editorial grid with centered header and zero visual clutter.
 */

$steps = [
    [
        'no'    => '01',
        'title' => 'Send your requirements',
        'lead'  => 'Share your CAD sketches, reference photos, tech pack, sizing breakdown, target quantities, and target in-hands delivery date.'
    ],
    [
        'no'    => '02',
        'title' => 'Specification review & quotation',
        'lead'  => 'Our master tailors review hide consumption, hardware requirements, and pattern complexity. A formal commercial FOB quotation is provided within 24 hours.'
    ],
    [
        'no'    => '03',
        'title' => 'Rapid prototype development',
        'lead'  => 'A first physical pre-production sample is developed, photographed, and dispatched to your office for fit validation, leather hand-feel, and hardware sign-off.'
    ],
    [
        'no'    => '04',
        'title' => 'Tannery lot & hide calibration',
        'lead'  => 'Raw hides are drum-dyed to your pantone specifications, calibrated for uniform thickness (gauge), and tested for tensile tear resistance.'
    ],
    [
        'no'    => '05',
        'title' => 'Bulk assembly & in-line QC',
        'lead'  => 'Precision pattern cutting followed by skilled hand-assembly using heavy-duty bonded threads. Every garment undergoes dual-station quality inspection.'
    ],
    [
        'no'    => '06',
        'title' => 'Custom packaging & export dispatch',
        'lead'  => 'Branded woven labeling, moisture-barrier poly packaging, barcoding, master cartons, and direct air or ocean cargo dispatch to US and European ports.'
    ]
];
?>

<!-- 6. HOW IT WORKS (Balanced Symmetrical 3x2 Editorial Grid) -->
<section class="py-24 sm:py-28 bg-paper border-b border-[#E6E4DD]" id="process">
  <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Centered Editorial Header -->
    <div class="max-w-2xl mx-auto text-center mb-14 sm:mb-16">
      <p class="font-mono text-crimson text-[11px] sm:text-[12px] font-bold uppercase tracking-[0.18em] mb-3">
        HOW IT WORKS
      </p>
      <h2 class="font-serif text-3xl sm:text-4xl lg:text-[44px] font-normal text-[#070709] tracking-tight leading-[1.16]">
        From brief to finished export order.
      </h2>
      <p class="text-[#5A6472] text-[15px] sm:text-[17px] leading-relaxed mt-4">
        A disciplined 6-stage contract manufacturing pipeline keeping technical specifications, counter-samples, and export milestones completely transparent.
      </p>
    </div>

    <!-- Symmetrical 3x2 Studio Card Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
      <?php foreach ($steps as $step): ?>
        <div class="bg-white rounded-[22px] border border-[#E6E4DD] p-8 sm:p-9 shadow-[0_4px_20px_rgba(0,0,0,0.02)] hover:shadow-[0_12px_32px_rgba(0,0,0,0.06)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group">
          <div>
            <!-- Number in Logo Crimson -->
            <span class="font-serif text-3xl sm:text-4xl text-crimson font-normal leading-none block mb-6">
              <?= e($step['no']) ?>
            </span>
            
            <!-- Step Title -->
            <h3 class="font-serif text-xl sm:text-[22px] text-[#070709] font-normal mb-3 group-hover:text-crimson transition-colors">
              <?= e($step['title']) ?>
            </h3>
            
            <!-- Concise Editorial Lead -->
            <p class="text-[#5A6472] text-[14px] sm:text-[15px] leading-relaxed font-body">
              <?= e($step['lead']) ?>
            </p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Centered Credentials & RFQ Action Bar -->
    <div class="mt-12 sm:mt-16 p-6 sm:p-8 rounded-[22px] bg-white border border-[#E6E4DD] shadow-[0_2px_12px_rgba(0,0,0,0.02)] flex flex-col lg:flex-row items-center justify-between gap-6">
      <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 sm:gap-6 text-xs font-mono text-[#070709]">
        <div class="flex items-center gap-2.5">
          <span class="w-2 h-2 rounded-full bg-crimson shrink-0"></span>
          <span>Direct Sialkot Atelier · No Broker Markups</span>
        </div>
        <div class="flex items-center gap-2.5">
          <span class="w-2 h-2 rounded-full bg-crimson shrink-0"></span>
          <span>Pre-Production Sample Sign-Off Guarantee</span>
        </div>
        <div class="flex items-center gap-2.5">
          <span class="w-2 h-2 rounded-full bg-crimson shrink-0"></span>
          <span>Door-to-Door Global Air &amp; Ocean Freight</span>
        </div>
      </div>

      <a href="#inquiry" class="inline-flex items-center gap-2 bg-[#070709] hover:bg-crimson text-white px-7 py-3.5 rounded-full font-mono text-xs font-bold uppercase tracking-wider transition-colors shadow-sm whitespace-nowrap shrink-0">
        <span>Start an RFQ Today</span>
        <span class="transition-transform group-hover:translate-x-1">→</span>
      </a>
    </div>

  </div>
</section>
