<?php
/** Hero slider — slides from site_settings.hero_slides_json (admin: Slider). 7 s auto-advance, stops on interaction. */
$slides = get_hero_slides_data();
?>
<section class="hero" id="top" aria-roledescription="carousel" aria-label="Manufacturing divisions">
  <?php foreach ($slides as $i => $s): ?>
    <div class="hero-slide<?= $i === 0 ? ' is-active' : '' ?>" data-slide>
      <?php if (!empty($s['image'])): ?>
        <img src="<?= e($s['image']) ?>" alt="" <?= $i === 0 ? 'fetchpriority="high"' : 'loading="lazy"' ?>>
      <?php endif; ?>
      <div class="hero-shade"></div>
    </div>
  <?php endforeach; ?>

  <div class="wrap hero-stage">
    <?php foreach ($slides as $i => $s): ?>
      <div class="hero-copy<?= $i === 0 ? ' is-active' : '' ?>" data-copy>
        <div>
          <span class="eyebrow on-dark"><?= e($s['kicker'] ?? '') ?></span>
          <?= $i === 0 ? '<h1' : '<h2' ?> class="h-display" style="font-size:clamp(44px,5.4vw,80px);line-height:.94"><?= e($s['title'] ?? '') ?><?= $i === 0 ? '</h1>' : '</h2>' ?>
          <p><?= e($s['lead'] ?? '') ?></p>
          <div class="hero-ctas">
            <a class="btn btn-primary" href="<?= e($s['primary_cta_url'] ?? '/contact-us') ?>"><?= e($s['primary_cta_text'] ?? 'Explore') ?></a>
            <a class="btn btn-light" href="<?= e($s['secondary_cta_url'] ?? '#rfq') ?>"><?= e($s['secondary_cta_text'] ?? 'Start an RFQ') ?></a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="wrap hero-bar">
    <div class="hero-tabs">
      <?php foreach ($slides as $i => $s): ?>
        <button type="button" class="hero-tab<?= $i === 0 ? ' is-active' : '' ?>" data-tab="<?= $i ?>" aria-label="Go to slide <?= $i + 1 ?>: <?= e($s['tab_label'] ?? '') ?>">
          <span><?= e($s['number'] ?? str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT)) ?></span>
          <span><?= e($s['tab_label'] ?? '') ?></span>
        </button>
      <?php endforeach; ?>
    </div>
    <div class="hero-arrows">
      <button type="button" class="hero-arrow" data-dir="-1" aria-label="Previous slide"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M20 12H4M10 6l-6 6 6 6"/></svg></button>
      <button type="button" class="hero-arrow next" data-dir="1" aria-label="Next slide"><?= icon_arrow(20) ?></button>
    </div>
  </div>
</section>

<script>
(function () {
  var root = document.getElementById('top');
  if (!root) return;
  var layers = root.querySelectorAll('[data-slide]'), copies = root.querySelectorAll('[data-copy]'), tabs = root.querySelectorAll('[data-tab]');
  var n = layers.length, cur = 0, stopped = false;
  function show(i) {
    var next = (i + n) % n;
    if (next === cur) return;
    var prev = layers[cur];
    prev.classList.add('was-active');          // keep the old image fully opaque underneath...
    setTimeout(function () { if (prev !== layers[cur]) prev.classList.remove('was-active'); }, 1000); // ...until the new one has landed
    cur = next;
    [layers, copies, tabs].forEach(function (list) {
      list.forEach(function (el, k) { el.classList.toggle('is-active', k === cur); });
    });
    layers[cur].classList.remove('was-active');
  }
  function stop() { stopped = true; root.classList.add('is-stopped'); }
  // autoplay is driven by the tab progress bar: when it finishes filling, move to the next slide
  root.addEventListener('animationend', function (e) { if (e.animationName === 'heroFill' && !stopped) show(cur + 1); });
  if (n < 2 || (window.matchMedia && matchMedia('(prefers-reduced-motion: reduce)').matches)) stop();
  var x0 = null;
  root.addEventListener('touchstart', function (e) { x0 = e.touches[0].clientX; }, { passive: true });
  root.addEventListener('touchend', function (e) { if (x0 === null) return; var dx = e.changedTouches[0].clientX - x0; x0 = null; if (Math.abs(dx) > 50) { stop(); show(cur + (dx < 0 ? 1 : -1)); } }, { passive: true });
  tabs.forEach(function (t) { t.addEventListener('click', function () { stop(); show(+t.dataset.tab); }); });
  root.querySelectorAll('[data-dir]').forEach(function (b) { b.addEventListener('click', function () { stop(); show(cur + (+b.dataset.dir)); }); });
})();
</script>
