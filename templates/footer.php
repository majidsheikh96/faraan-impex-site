</main>

<!-- 8. FOOTER — SIALKOT ATELIER & B2B EXPORT DESK (Stagfield Sports Luxury Caliber) -->
<footer class="bg-[#070709] text-white border-t border-white/10" id="contact-us">
  <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
    
    <!-- Top Grid: 4 Strategic Columns -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-12 mb-16">
      
      <!-- Column 1: Atelier Heritage & Mission (4 cols) -->
      <div class="lg:col-span-4">
        <a class="flex items-center shrink-0 mb-6 group" href="/" aria-label="Faraan Impex Home">
          <img src="/assets/images/logo.png" alt="FARAAN IMPEX" class="h-10 sm:h-11 w-auto object-contain transition-transform group-hover:scale-[1.02]">
        </a>
        
        <p class="font-body text-[#AEB9C4] leading-relaxed text-sm mb-6 max-w-sm">
          Precision private-label leather and technical textile garments manufacturer based in Sialkot, Pakistan. Supplying motorcycle racing apparel, heritage suede outerwear, and bespoke leather goods to international distributors worldwide.
        </p>

        <!-- Direct WhatsApp Concierge Link -->
        <a class="inline-flex items-center gap-2 text-white font-mono text-xs font-bold uppercase tracking-wider hover:text-crimson transition-colors" 
           href="<?= whatsapp_link("Assalam-o-Alaikum, I would like to inquire about contract manufacturing with Faraan Impex.") ?>" 
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
          <li><a class="hover:text-white transition-colors" href="/about-us">Company Profile</a></li>
          <li><a class="hover:text-white transition-colors" href="/#divisions">Manufacturing Divisions</a></li>
          <li><a class="hover:text-white transition-colors" href="/#capabilities">Material Lab</a></li>
          <li><a class="hover:text-white transition-colors" href="/#process">How It Works</a></li>
          <li><a class="hover:text-white transition-colors" href="/contact-us">Request Quotation</a></li>
        </ul>
      </div>

      <!-- Column 4: Sialkot Export Desk Contacts (4 cols) -->
      <div class="lg:col-span-4" id="about-us-info">
        <div class="font-mono text-crimson text-[11px] uppercase tracking-[0.16em] font-bold mb-5">
          EXPORT DESK &amp; ATELIER
        </div>
        <div class="space-y-3.5 font-body text-[#AEB9C4] text-sm">
          <div class="flex items-start gap-3">
            <span class="material-symbols-outlined text-crimson text-[18px] mt-0.5 shrink-0">location_on</span>
            <span class="leading-snug"><?= e(CONTACT_ADDRESS) ?></span>
          </div>
          <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-crimson text-[18px] shrink-0">mail</span>
            <div class="flex flex-col">
              <a class="hover:text-white transition-colors" href="mailto:<?= e(CONTACT_EMAIL) ?>"><?= e(CONTACT_EMAIL) ?></a>
              <?php if (defined('CONTACT_EMAIL_2') && CONTACT_EMAIL_2): ?>
                <a class="hover:text-white transition-colors text-xs text-white/50" href="mailto:<?= e(CONTACT_EMAIL_2) ?>"><?= e(CONTACT_EMAIL_2) ?></a>
              <?php endif; ?>
            </div>
          </div>
          <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-crimson text-[18px] shrink-0">call</span>
            <div class="flex flex-col">
              <a class="hover:text-white transition-colors" href="tel:<?= e(str_replace(' ', '', CONTACT_PHONE)) ?>"><?= e(CONTACT_PHONE) ?></a>
              <a class="hover:text-white transition-colors" href="tel:<?= e(str_replace(' ', '', CONTACT_PHONE_2)) ?>"><?= e(CONTACT_PHONE_2) ?></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bottom Bar -->
    <div class="pt-8 border-t border-white/10 flex flex-col md:flex-row items-center justify-between text-xs font-mono text-[#AEB9C4] gap-4">
      <div>
        &copy; <?= date('Y') ?> FARAAN IMPEX. All Rights Reserved. Sialkot, Pakistan.
      </div>
      <div class="flex items-center gap-6 uppercase tracking-wider text-[10px]">
        <span class="text-crimson font-bold">Direct Sialkot Factory</span>
        <span class="text-white/20">|</span>
        <span>B2B Contract Export Only</span>
        <span class="text-white/20">|</span>
        <span>CE &amp; REACH Compliant</span>
      </div>
    </div>
  </div>
</footer>

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
