<?php /** RFQ — posts to /contact-us, which owns the handler. */ ?>
<section id="rfq" class="rfq-sec">
  <div class="wrap">
    <div style="flex:1 1 360px;min-width:0;display:flex;flex-direction:column;gap:24px">
      <span class="eyebrow">05 &mdash; REQUEST A QUOTE</span>
      <h2 class="h-display h-lg"><?= e(get_setting('inquiry_heading', 'Direct factory production desk.')) ?></h2>
      <p class="lede" style="margin:0;max-width:420px"><?= e(get_setting('inquiry_subheading', 'Connect directly with our master pattern cutters and export merchandisers. Fast-track custom sampling, leather lab dips, and wholesale FOB/CIF quotations.')) ?></p>
      <div class="checklist">
        <span class="mono" style="font-size:12px;letter-spacing:.1em;font-weight:500">HELPFUL TO INCLUDE</span>
        <div class="row"><b>&mdash;</b><span>Tech pack, sketch or reference images</span></div>
        <div class="row"><b>&mdash;</b><span>Target quantity per style</span></div>
        <div class="row"><b>&mdash;</b><span>Material, hide or fabric preferences</span></div>
        <div class="row"><b>&mdash;</b><span>Branding, labels and packaging needs</span></div>
      </div>
    </div>
    <?php $rfqId = 'f'; require __DIR__ . '/../rfq-form.php'; ?>
  </div>
</section>
