<?php
/**
 * Section 4: Manufacturing Capabilities (Stagfield Sports Minimalist Caliber)
 * Clean architectural dark grid with zero clutter — showcasing the full multi-category production scope.
 * 100% Admin-Controlled Content.
 */

$capabilities = get_capabilities_data();
$heading = get_setting('capabilities_heading', 'Engineered around your technical pack.');
$subheading = get_setting('capabilities_subheading', 'Our Sialkot manufacturing plant operates as your direct offshore production line. Capabilities span racing suits, technical flannels, western headwear, and bespoke leathercraft — each calibrated to your exact tolerances.');
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
        <?= e($heading) ?>
      </h2>
      <p class="text-[#AEB9C4] text-[15px] sm:text-[17px] leading-relaxed mt-4">
        <?= e($subheading) ?>
      </p>
    </div>

    <!-- 6 Capabilities Architectural Grid with 1px Hairlines (Zero Clutter) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 border-t border-l border-white/10">
      <?php foreach ($capabilities as $cap): ?>
        <div class="p-8 sm:p-10 border-r border-b border-white/10 flex flex-col justify-between hover:bg-white/[0.02] transition-colors">
          <div>
            <!-- Number in Logo Crimson -->
            <span class="font-serif text-3xl sm:text-4xl text-crimson font-normal block mb-6">
              <?= e($cap['number'] ?? ($cap['no'] ?? '')) ?>
            </span>

            <!-- Title -->
            <h3 class="font-serif text-2xl font-normal text-white mb-3">
              <?= e($cap['title'] ?? '') ?>
            </h3>

            <!-- Description -->
            <p class="text-[#AEB9C4] text-[14px] leading-relaxed font-body">
              <?= e($cap['desc'] ?? ($cap['lead'] ?? '')) ?>
            </p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
