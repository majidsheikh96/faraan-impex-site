</main>

<?php
$footerAbout = get_setting('footer_about', 'Precision private-label leather and technical textile garments manufacturer based in Sialkot, Pakistan. Supplying motorcycle racing apparel, heritage suede outerwear, and bespoke leather goods to international distributors worldwide.');
$footerDisclaimer = get_setting('footer_disclaimer', 'Direct Sialkot Factory | B2B Contract Export Only | CE & REACH Compliant');
$disclaimerPills = array_filter(array_map('trim', explode('|', $footerDisclaimer)));
$siteName = get_setting('site_name', SITE_NAME);
$contactEmail = get_setting('contact_email', CONTACT_EMAIL);
$contactEmail2 = get_setting('contact_email_2', defined('CONTACT_EMAIL_2') ? CONTACT_EMAIL_2 : '');
$contactPhone = get_setting('contact_phone', CONTACT_PHONE);
$contactPhone2 = get_setting('contact_phone_2', defined('CONTACT_PHONE_2') ? CONTACT_PHONE_2 : '');
$contactAddress = get_setting('contact_address', CONTACT_ADDRESS);
?>

<!-- 8. FOOTER — SIALKOT ATELIER & B2B EXPORT DESK (Stagfield Sports Luxury Caliber) -->
<footer class="bg-[#070709] text-white border-t border-white/10" id="contact-us">
  <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
    
    <!-- Top Grid: 4 Strategic Columns -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-12 mb-16">
      
      <!-- Column 1: Atelier Heritage & Mission (4 cols) -->
      <div class="lg:col-span-4">
        <a class="flex items-center shrink-0 mb-6 group" href="/" aria-label="<?= e($siteName) ?> Home">
          <img src="/assets/images/logo.png" alt="<?= e($siteName) ?>" class="h-10 sm:h-11 w-auto object-contain transition-transform group-hover:scale-[1.02]">
        </a>
        
        <p class="font-body text-[#AEB9C4] leading-relaxed text-sm mb-6 max-w-sm">
          <?= e($footerAbout) ?>
        </p>

        <!-- Direct WhatsApp Concierge Link -->
        <a class="inline-flex items-center gap-2 text-white font-mono text-xs font-bold uppercase tracking-wider hover:text-crimson transition-colors" 
           href="<?= whatsapp_link("Assalam-o-Alaikum, I would like to inquire about contract manufacturing with " . $siteName . ".") ?>" 
           rel="noopener noreferrer" target="_blank">
          <span>Factory WhatsApp Desk</span>
          <span class="text-crimson font-bold">→</span>
        </a>
      </div>

      <!-- Column 2: Manufacturing Divisions (2 cols) -->
      <div class="lg:col-span-2">
        <div class="font-mono text-crimson text-[11px] uppercase tracking-[0.16em] font-bold mb-5">
          DIVISIONS
        </div>
        <ul class="space-y-3 font-body text-[#AEB9C4] text-sm">
          <?php foreach (get_top_categories() as $cat): ?>
            <li>
              <a class="hover:text-white transition-colors" href="/<?= e($cat['slug']) ?>/">
                <?= e($cat['name']) ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- Column 3: B2B Services & Operations (2 cols) -->
      <div class="lg:col-span-2">
        <div class="font-mono text-crimson text-[11px] uppercase tracking-[0.16em] font-bold mb-5">
          OPERATIONS
        </div>
        <ul class="space-y-3 font-body text-[#AEB9C4] text-sm">
          <li><a class="hover:text-white transition-colors" href="/about-us">Heritage &amp; Factory</a></li>
          <li><a class="hover:text-white transition-colors" href="/about-us#certifications">CE &amp; Technical Specs</a></li>
          <li><a class="hover:text-white transition-colors" href="/contact-us">Counter-Sample Request</a></li>
          <li><a class="hover:text-white transition-colors" href="/contact-us#inquiry-form">OEM / ODM Quotation</a></li>
          <li><a class="hover:text-white transition-colors" href="/contact-us">Global Air/Sea Freight</a></li>
        </ul>
      </div>

      <!-- Column 4: Factory Coordinates & Hours (4 cols) -->
      <div class="lg:col-span-4">
        <div class="font-mono text-crimson text-[11px] uppercase tracking-[0.16em] font-bold mb-5">
          SIALKOT PRODUCTION FACILITY
        </div>
        <div class="space-y-3 font-body text-sm text-[#AEB9C4]">
          <div class="flex items-start gap-2.5">
            <span class="text-crimson font-mono text-xs font-bold shrink-0 mt-0.5">ADDR</span>
            <span><?= e($contactAddress) ?></span>
          </div>
          <div class="flex items-center gap-2.5">
            <span class="text-crimson font-mono text-xs font-bold shrink-0">EMAIL</span>
            <div class="flex flex-col">
              <a class="hover:text-white transition-colors font-mono text-xs text-white" href="mailto:<?= e($contactEmail) ?>">
                <?= e($contactEmail) ?>
              </a>
              <?php if ($contactEmail2): ?>
                <a class="hover:text-white transition-colors font-mono text-xs text-[#AEB9C4]" href="mailto:<?= e($contactEmail2) ?>">
                  <?= e($contactEmail2) ?>
                </a>
              <?php endif; ?>
            </div>
          </div>
          <div class="flex items-center gap-2.5">
            <span class="text-crimson font-mono text-xs font-bold shrink-0">PHONE</span>
            <div class="flex items-center gap-2 font-mono text-xs text-white">
              <a class="hover:text-white transition-colors" href="tel:<?= e($contactPhone) ?>"><?= e($contactPhone) ?></a>
              <?php if ($contactPhone2): ?>
                <span class="text-white/30">/</span>
                <a class="hover:text-white transition-colors" href="tel:<?= e($contactPhone2) ?>"><?= e($contactPhone2) ?></a>
              <?php endif; ?>
            </div>
          </div>
          <div class="flex items-center gap-2.5 pt-2">
            <span class="inline-block w-2 h-2 rounded-full bg-emerald-400"></span>
            <span class="font-mono text-xs text-white/80">Factory Floor Operational: Mon – Sat (08:00 – 18:00 PKT)</span>
          </div>
        </div>
      </div>

    </div>

    <!-- Bottom Bar -->
    <div class="pt-8 border-t border-white/10 flex flex-col md:flex-row items-center justify-between text-xs font-mono text-[#AEB9C4] gap-4">
      <div>
        &copy; <?= date('Y') ?> <?= e(strtoupper($siteName)) ?>. All Rights Reserved. Sialkot, Pakistan.
      </div>
      <div class="flex flex-wrap items-center gap-3 sm:gap-6 uppercase tracking-wider text-[10px]">
        <?php foreach ($disclaimerPills as $idx => $pill): ?>
          <?php if ($idx > 0): ?>
            <span class="text-white/20">|</span>
          <?php endif; ?>
          <span class="<?= $idx === 0 ? 'text-crimson font-bold' : '' ?>"><?= e($pill) ?></span>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</footer>

<?php if (function_exists('is_preview_active') && is_preview_active()): ?>
<!-- Floating Preview Mode Lock Indicator -->
<div class="fixed bottom-5 right-5 z-[9999] flex items-center gap-3 bg-[#0B0C0E]/95 backdrop-blur-md border border-white/20 text-white px-4 py-2.5 rounded-full shadow-2xl text-xs font-mono">
  <span class="relative flex h-2 w-2">
    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
  </span>
  <span class="text-white/90 uppercase tracking-wider font-bold">Preview Active</span>
  <a href="/?lock=1" class="ml-1 px-2.5 py-1 rounded-full bg-white/10 hover:bg-[#C51E28] text-white/90 hover:text-white transition-colors text-[11px] font-bold" title="Exit preview and lock site back to Coming Soon">
    Lock Site 🔒
  </a>
</div>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const btn = document.getElementById('mobile-menu-toggle');
  const menu = document.getElementById('mobile-menu');
  if (btn && menu) {
    btn.addEventListener('click', function() {
      menu.classList.toggle('hidden');
    });
  }
});
</script>
<?php if (IMAGE_PROTECTION): ?>
<script src="/assets/js/protect.js"></script>
<?php endif; ?>
</body>
</html>
