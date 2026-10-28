<?php /** Four-phase process (admin: Homepage → process_steps_json). */ $steps = get_process_steps_data(); ?>
<section class="wrap sec" style="padding-bottom:24px">
  <div style="display:flex;flex-direction:column;gap:14px;margin-bottom:48px">
    <span class="eyebrow">03 &mdash; HOW IT WORKS</span>
    <h2 class="h-display h-lg" style="max-width:760px"><?= e(get_setting('process_heading', 'From CAD tech pack to export dock in 4 disciplined phases.')) ?></h2>
    <?php $processSub = get_setting('process_subheading', 'Direct factory transparency with dedicated line supervisors at each stage.'); if ($processSub): ?><p style="margin:0;max-width:560px;color:var(--muted)"><?= e($processSub) ?></p><?php endif; ?>
  </div>
  <div class="steps">
    <?php foreach ($steps as $i => $s): ?>
      <div>
        <span class="n"><?= e($s['num'] ?? str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT)) ?></span>
        <h3><?= e($s['title'] ?? '') ?></h3>
        <p><?= e($s['desc'] ?? '') ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</section>
