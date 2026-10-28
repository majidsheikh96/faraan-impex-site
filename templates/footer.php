</main>

<?php
$siteName = get_setting('site_name', SITE_NAME);
$footerAbout = get_setting('footer_about', 'OEM / ODM manufacturer and exporter of leather garments, motorcycle apparel, technical textiles and western wear from Sialkot, Pakistan.');
$contactEmail = get_setting('contact_email', CONTACT_EMAIL);
$contactPhone = phone_display(get_setting('contact_phone', CONTACT_PHONE));
$contactPhone2 = phone_display(get_setting('contact_phone_2', CONTACT_PHONE_2));
$contactAddress = get_setting('contact_address', CONTACT_ADDRESS);
?>
<footer class="site-footer">
  <div class="wrap top">
    <div class="col" style="flex:1 1 300px;max-width:380px;gap:14px">
      <img src="/assets/images/logo-wordmark.png" alt="<?= e($siteName) ?>" width="1306" height="330" style="height:56px;width:auto;align-self:flex-start">
      <p style="margin:0;font-size:15px;color:#A3A3A3"><?= e($footerAbout) ?></p>
    </div>
    <div class="col">
      <span class="h">DIVISIONS</span>
      <?php try { $footerCats = get_top_categories(); } catch (Throwable $e) { $footerCats = []; }
      foreach ($footerCats as $cat): ?>
        <a href="/<?= e($cat['slug']) ?>/"><?= e(display_name($cat['name'])) ?></a>
      <?php endforeach; ?>
    </div>
    <div class="col">
      <span class="h">COMPANY</span>
      <a href="/about-us">About</a>
      <a href="/contact-us">Contact &amp; RFQ</a>
      <a href="<?= e(whatsapp_link('Hello, I would like to inquire about contract manufacturing with ' . $siteName . '.')) ?>" target="_blank" rel="noopener">WhatsApp desk</a>
    </div>
    <?php $ali = alibaba_links(); $soc = social_links(); ?>
    <?php if ($ali || $soc): ?>
    <div class="col">
      <?php if ($ali): ?>
        <span class="h">GOLD SUPPLIER ON ALIBABA</span>
        <?php foreach ($ali as $a): ?><a href="<?= e($a['url']) ?>" target="_blank" rel="noopener"><?= e($a['label']) ?> &#8599;</a><?php endforeach; ?>
      <?php endif; ?>
      <?php if ($soc): ?>
        <span class="h" style="margin-top:10px">FOLLOW US</span>
        <?php foreach ($soc as $s): ?>
          <a class="soc-link" href="<?= e($s['url']) ?>" target="_blank" rel="noopener me">
            <?= social_icon($s['key']) ?>
            <span><?= e($s['label']) ?></span>
          </a>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
    <?php endif; ?>
    <div class="col">
      <span class="h">EXPORT DESK</span>
      <a href="mailto:<?= e($contactEmail) ?>"><?= e($contactEmail) ?></a>
      <a href="<?= e(phone_href($contactPhone)) ?>"><?= e($contactPhone) ?></a>
      <?php if ($contactPhone2): ?><a href="<?= e(phone_href($contactPhone2)) ?>"><?= e($contactPhone2) ?></a><?php endif; ?>
      <span style="color:#A3A3A3;max-width:240px"><?= e($contactAddress) ?></span>
    </div>
  </div>
  <div class="wrap bottom">
    <span>&copy; <?= date('Y') ?> <?= e(strtoupper($siteName)) ?></span>
    <span>CE LEVEL 2 &middot; CE &amp; REACH COMPLIANT</span>
  </div>
</footer>

<a class="wa-float" href="<?= e(whatsapp_link('Hello, I would like to inquire about contract manufacturing with ' . $siteName . '.')) ?>" target="_blank" rel="noopener" aria-label="Chat on WhatsApp">
  <svg width="26" height="26" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12.03 2C6.5 2 2 6.49 2 12.03c0 1.96.56 3.78 1.54 5.33L2 22l4.79-1.52a10 10 0 0 0 5.11 1.43C17.44 21.91 22 17.42 22 11.88 22 6.49 17.57 2 12.03 2Zm5.73 14.2c-.24.68-1.39 1.3-1.93 1.34-.54.05-1.2.2-3.87-.91-3.24-1.34-5.32-4.66-5.48-4.88-.16-.22-1.31-1.75-1.31-3.33s.83-2.36 1.12-2.68c.3-.32.64-.4.86-.4h.62c.2.01.46-.07.72.55.27.64.91 2.22.99 2.38.08.16.14.35.03.56-.1.22-.16.35-.32.54-.16.19-.34.42-.48.56-.16.16-.33.34-.14.66.19.32.84 1.38 1.8 2.23 1.23 1.1 2.27 1.44 2.59 1.6.32.16.51.13.7-.08.19-.22.8-.94 1.02-1.26.21-.32.43-.27.72-.16.3.11 1.87.88 2.2 1.04.32.16.54.24.62.38.08.13.08.78-.16 1.46Z"/></svg>
  <span>WhatsApp us</span>
</a>

<?php if (function_exists('is_preview_active') && is_preview_active()): ?>
<div class="preview-pill"><span>PREVIEW ACTIVE</span><a href="/?lock=1" title="Exit preview and lock the site again">Lock site</a></div>
<?php endif; ?>

<script>
// Scroll reveal: only blocks that start below the fold are hidden, then eased in as they scroll into view.
(function () {
  if (!('IntersectionObserver' in window) || (window.matchMedia && matchMedia('(prefers-reduced-motion: reduce)').matches)) return;
  var sel = '.sec-head, .grid-div > *, .grid-4 > *, .steps > *, .caps > *, .proof .cell, .rfq-sec .wrap > *, .cta-band .wrap, .feat-grid > *';
  var items = [].slice.call(document.querySelectorAll(sel)).filter(function (el) { return el.getBoundingClientRect().top > innerHeight * 0.92; });
  if (!items.length) return;
  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (en) {
      if (!en.isIntersecting) return;
      var el = en.target; io.unobserve(el);
      el.classList.add('is-in');
      setTimeout(function () { el.classList.remove('reveal', 'is-in'); el.style.removeProperty('--d'); }, 1100);
    });
  }, { rootMargin: '0px 0px -8% 0px', threshold: 0.05 });
  items.forEach(function (el, i) {
    var k = [].indexOf.call(el.parentNode.children, el);
    el.style.setProperty('--d', (k % 4) * 0.08 + 's');
    el.classList.add('reveal');
    io.observe(el);
  });
})();
</script>
<script src="/assets/js/site.js?v=<?= (int)@filemtime(__DIR__ . '/../assets/js/site.js') ?>" defer></script>
<?php if (IMAGE_PROTECTION): ?>
<script src="/assets/js/protect.js"></script>
<?php endif; ?>
</body>
</html>
