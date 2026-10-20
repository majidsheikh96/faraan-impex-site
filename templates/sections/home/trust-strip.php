<?php
/**
 * 2. STAGFIELD-CALIBER SPECIFICATION & TRUST STRIP
 * 100% Admin-Controlled Trust Points.
 */
$trust_points = get_trust_points_data();
?>
<!-- 2. SPECIFICATION & TRUST STRIP -->
<section class="bg-white border-b border-[#10243B]/10 select-none">
  <div class="max-w-[1440px] mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
    <?php foreach ($trust_points as $i => $pt): ?>
      <div class="px-6 sm:px-8 py-6 sm:py-7 border-b sm:border-b-0 <?= $i < 3 ? 'sm:border-r border-[#10243B]/10' : '' ?> flex flex-col justify-center">
        <div class="flex items-center gap-2 mb-1">
          <span class="w-1.5 h-1.5 rounded-full bg-crimson"></span>
          <b class="text-[#0B1623] font-sans font-bold text-[13.5px] tracking-tight"><?= e($pt['title'] ?? '') ?></b>
        </div>
        <span class="text-[#64748B] font-sans text-[12.5px] leading-relaxed"><?= e($pt['desc'] ?? '') ?></span>
      </div>
    <?php endforeach; ?>
  </div>
</section>
