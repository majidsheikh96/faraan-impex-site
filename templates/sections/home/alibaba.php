<?php /** Alibaba storefronts band (links come from alibaba_links()). */ $ali = alibaba_links(); ?>
<?php if ($ali): ?>
<section class="ali-band">
  <div class="wrap">
    <div>
      <span class="eyebrow">ALSO ON ALIBABA</span>
      <h2 class="h-display h-md">Gold Supplier on Alibaba</h2>
      <p>Prefer to order or send an inquiry through Alibaba? Visit either of our verified storefronts.</p>
    </div>
    <div class="ali-links">
      <?php foreach ($ali as $a): ?>
        <a class="btn btn-ghost" href="<?= e($a['url']) ?>" target="_blank" rel="noopener"><?= e($a['label']) ?> on Alibaba <?= icon_arrow(18) ?></a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>
