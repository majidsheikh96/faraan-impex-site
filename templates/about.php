<?php
/** About (design: About.dc.html). Narrative copy comes from admin settings; sections hide until it is supplied. */
$page_title = 'About Us — OEM / ODM Leather & Textile Manufacturer, Sialkot | FARAAN IMPEX';
$page_description = 'OEM and ODM contract manufacturing of leather garments, motorcycle apparel, technical textiles and western wear for brands worldwide.';
$story1 = get_setting('about_story_1', '');
$story2 = get_setting('about_story_2', '');
$heroImg    = get_setting('about_hero_image', '');
$aboutTitle = get_setting('about_hero_title', 'Sialkot manufacturing authority.');
$aboutLead  = get_setting('about_hero_lead', 'Faraan Impex is a direct B2B contract manufacturer specializing in high-performance motorcycle apparel, technical flannels, western outerwear, and bespoke artisan leather goods.');
?>
<section class="page-hero">
  <div class="wrap">
    <nav class="crumbs" aria-label="Breadcrumb"><a href="/">Home</a> <span aria-hidden="true">/</span> <span>About Us</span></nav>
    <div class="hero-split">
      <div class="l">
        <span class="eyebrow on-dark">ABOUT FARAAN IMPEX</span>
        <h1 class="h-display h-xl"><?= e($aboutTitle) ?></h1>
      </div>
      <p style="max-width:440px"><?= e($aboutLead) ?></p>
    </div>
    <?php if ($heroImg): ?><div class="photo" style="height:clamp(220px,32vw,420px)"><img src="<?= e($heroImg) ?>" alt="Faraan Impex factory floor, Sialkot"></div><?php endif; ?>
  </div>
</section>

<?php if ($story1 !== '' || $story2 !== ''): ?>
<section class="wrap sec">
  <div class="sec-head" style="margin-bottom:32px"><div><span class="eyebrow">FACTORY HERITAGE</span><h2 class="h-display h-lg">Made where leather is a trade</h2></div></div>
  <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(min(360px,100%),1fr));gap:32px 64px;font-size:18px;color:#333">
    <?php if ($story1 !== ''): ?><p style="margin:0"><?= nl2br(e($story1)) ?></p><?php endif; ?>
    <?php if ($story2 !== ''): ?><p style="margin:0"><?= nl2br(e($story2)) ?></p><?php endif; ?>
  </div>
</section>
<?php endif; ?>

<?php
$stats = [];
for ($i = 1; $i <= 4; $i++) {
    $n = get_setting("about_stat_{$i}_num", '');
    $l = get_setting("about_stat_{$i}_label", '');
    if ($n !== '') $stats[] = ['num' => $n, 'label' => $l];
}
if ($stats):
?>
<section class="wrap" style="padding-top:0;padding-bottom:64px">
  <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:1px;background:var(--line);border:1px solid var(--line);border-radius:8px;overflow:hidden">
    <?php foreach ($stats as $s): ?>
      <div style="background:var(--bg);padding:24px 20px;display:flex;flex-direction:column;gap:6px">
        <span style="font-family:'Barlow Condensed',sans-serif;font-size:36px;font-weight:700;line-height:1;color:var(--ink)"><?= e($s['num']) ?></span>
        <span style="font-size:12px;letter-spacing:.07em;text-transform:uppercase;color:var(--muted);font-weight:500"><?= e($s['label']) ?></span>
      </div>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>

<section class="wrap sec">
  <div class="feat-grid">
    <div><span class="n">01</span><h3>Direct factory pricing</h3><p>You deal with the Sialkot factory, not a trading layer.</p></div>
    <div><span class="n">02</span><h3>Sample sign-off guarantee</h3><p>Nothing goes into production until you approve the counter-sample.</p></div>
    <div><span class="n">03</span><h3>Door-to-door freight</h3><p>Air and ocean shipping handled from our dock to yours.</p></div>
    <div><span class="n">04</span><h3>CE &amp; REACH compliant</h3><p>CE Level 2 armor and compliant materials, documented.</p></div>
  </div>
</section>

<section class="wrap sec" style="padding-bottom:88px">
  <div class="sec-head" style="margin-bottom:32px"><div><span class="eyebrow">INSIDE THE FACTORY</span><h2 class="h-display h-lg">From cutting room to QC</h2></div></div>
  <div class="steps" style="border-top-color:var(--line)">
    <div><span class="n" style="font-size:40px">01</span><h3>Cutting &amp; grading</h3><p>Hides and fabrics graded against your pack before the first cut.</p></div>
    <div><span class="n" style="font-size:40px">02</span><h3>Assembly</h3><p>Batches sewn to the approved counter-sample, style by style.</p></div>
    <div><span class="n" style="font-size:40px">03</span><h3>Dual-station QC</h3><p>Two inspection stations before anything is packed for export.</p></div>
  </div>
</section>

<section class="cta-band">
  <div class="wrap">
    <div><h2>Build your next collection with us</h2><p>Tell us what you want to manufacture. Quoted in under two hours.</p></div>
    <a class="btn btn-primary" href="/contact-us">Request a quote</a>
  </div>
</section>
