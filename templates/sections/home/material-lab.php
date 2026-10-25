<?php /** Capabilities (admin: Homepage → capabilities_json). */ $capabilities = get_capabilities_data(); ?>
<section id="about" class="dark-sec on-dark" style="margin-top:72px">
  <div class="wrap">
    <div style="flex:1 1 320px;min-width:0;display:flex;flex-direction:column;gap:20px;align-self:flex-start">
      <span class="eyebrow on-dark">02 &mdash; CAPABILITIES</span>
      <h2 class="h-display h-lg" style="color:var(--paper)">Engineered around your technical pack</h2>
      <p style="margin:0;color:#A3A3A3;font-size:17px;max-width:380px">From hide grading to export packing, the work is organised so your spec survives every handoff.</p>
    </div>
    <div class="caps">
      <?php foreach ($capabilities as $i => $c): ?>
        <div>
          <span class="k">C-<?= e(str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT)) ?></span>
          <h3><?= e($c['title'] ?? '') ?></h3>
          <p><?= e($c['desc'] ?? '') ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
