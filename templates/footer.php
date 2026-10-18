</main>

<!-- 8. FOOTER — SIALKOT ATELIER & B2B EXPORT DESK -->
<footer class="bg-[#050507] text-white border-t border-white/[0.08] mt-20" id="contact-us">
  <div class="w-full px-4 sm:px-6 lg:px-12 py-16 lg:py-20 mx-auto max-w-[1440px]">
    
    <!-- Top Grid: 4 Strategic Columns -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8 mb-16">
      
      <!-- Column 1: Atelier Heritage & Mission (4 cols) -->
      <div class="lg:col-span-4">
        <a class="flex flex-col group shrink-0 mb-4" href="/">
          <div class="font-headline text-2xl uppercase font-extrabold tracking-tight text-white flex items-center gap-1.5">
            <span>FARAAN</span>
            <span class="text-carmine group-hover:brightness-125 transition-all">IMPEX</span>
          </div>
          <span class="font-mono text-[10px] uppercase tracking-[0.22em] text-text-muted -mt-0.5 font-semibold">
            Sialkot Leatherworks · Est. 1998
          </span>
        </a>
        
        <p class="font-body text-slate-300 leading-relaxed text-sm mb-6 max-w-sm">
          Precision private-label leather and technical textile garments manufacturer based in Sialkot, Pakistan. Supplying premier motorcycle gear, runway outerwear, and bespoke leather goods to international brands worldwide.
        </p>

        <!-- Direct WhatsApp Support Button -->
        <a class="inline-flex items-center gap-2.5 bg-[#25D366] hover:bg-[#20ba5a] text-white px-5 py-3 font-headline font-bold uppercase tracking-wider text-xs rounded shadow-md transition-colors" 
           href="<?= whatsapp_link("Assalam-o-Alaikum, I would like to inquire about contract manufacturing with Faraan Impex.") ?>" 
           rel="noopener noreferrer" target="_blank">
          <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 24 24">
            <path d="M12.031 2C6.494 2 2 6.494 2 12.031c0 1.956.564 3.782 1.542 5.334L2 22l4.789-1.517c1.498.907 3.242 1.428 5.109 1.428 5.537 0 10.031-4.494 10.031-10.031S17.568 2 12.031 2zm5.727 14.195c-.241.677-1.391 1.296-1.928 1.341-.536.046-1.196.195-3.874-.912-3.238-1.339-5.321-4.664-5.483-4.88-.16-.217-1.309-1.745-1.309-3.328 0-1.583.829-2.361 1.123-2.684.294-.323.643-.404.858-.404.214 0 .429.003.616.012.198.01.463-.075.724.551.268.643.91 2.224.991 2.385.08.161.134.349.027.563-.107.215-.16.349-.321.536-.161.188-.338.419-.482.563-.161.16-.329.335-.141.658.188.322.836 1.378 1.794 2.231 1.233 1.096 2.274 1.436 2.595 1.597.321.161.509.134.696-.08.188-.215.804-.938 1.018-1.26.214-.322.429-.268.723-.161.295.107 1.874.884 2.196 1.045.321.161.536.241.616.375.08.134.08.777-.161 1.454z"></path>
          </svg>
          <span>Factory WhatsApp Concierge</span>
        </a>
      </div>

      <!-- Column 2: Manufacturing Divisions (2 cols) -->
      <div class="lg:col-span-2">
        <div class="font-mono text-carmine text-[11px] uppercase tracking-wider font-bold mb-4">
          DIVISIONS
        </div>
        <ul class="space-y-2.5 font-body text-slate-300 text-sm">
          <?php foreach (get_top_categories() as $cat): ?>
            <li>
              <a class="hover:text-white hover:underline transition-colors" href="/<?= e($cat['slug']) ?>/">
                <?= e($cat['name']) ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- Column 3: B2B Services & Operations (2 cols) -->
      <div class="lg:col-span-2">
        <div class="font-mono text-carmine text-[11px] uppercase tracking-wider font-bold mb-4">
          OPERATIONS
        </div>
        <ul class="space-y-2.5 font-body text-slate-300 text-sm">
          <li><a class="hover:text-white transition-colors" href="/about-us">Company Profile</a></li>
          <li><a class="hover:text-white transition-colors" href="/about-us#oem">OEM / ODM Services</a></li>
          <li><a class="hover:text-white transition-colors" href="/#process">4-Stage Pipeline</a></li>
          <li><a class="hover:text-white transition-colors" href="/#tannery-lab">Material Lab</a></li>
          <li><a class="hover:text-white transition-colors" href="/contact-us">Request Tech Pack Quote</a></li>
        </ul>
      </div>

      <!-- Column 4: Sialkot Export Desk Contacts (4 cols) -->
      <div class="lg:col-span-4" id="about-us-info">
        <div class="font-mono text-carmine text-[11px] uppercase tracking-wider font-bold mb-4">
          EXPORT DESK &amp; ATELIER
        </div>
        <div class="space-y-3.5 font-body text-slate-300 text-sm">
          <div class="flex items-start gap-3">
            <span class="material-symbols-outlined text-carmine text-[20px] mt-0.5 shrink-0">location_on</span>
            <span class="text-slate-300 leading-snug"><?= e(CONTACT_ADDRESS) ?></span>
          </div>
          <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-carmine text-[20px] shrink-0">mail</span>
            <div class="flex flex-col">
              <a class="hover:text-white transition-colors" href="mailto:<?= e(CONTACT_EMAIL) ?>"><?= e(CONTACT_EMAIL) ?></a>
              <?php if (defined('CONTACT_EMAIL_2') && CONTACT_EMAIL_2): ?>
                <a class="hover:text-white transition-colors text-xs text-text-muted" href="mailto:<?= e(CONTACT_EMAIL_2) ?>"><?= e(CONTACT_EMAIL_2) ?></a>
              <?php endif; ?>
            </div>
          </div>
          <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-carmine text-[20px] shrink-0">call</span>
            <div class="flex flex-col">
              <a class="hover:text-white transition-colors" href="tel:<?= e(str_replace(' ', '', CONTACT_PHONE)) ?>"><?= e(CONTACT_PHONE) ?></a>
              <a class="hover:text-white transition-colors" href="tel:<?= e(str_replace(' ', '', CONTACT_PHONE_2)) ?>"><?= e(CONTACT_PHONE_2) ?></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bottom Bar -->
    <div class="pt-8 border-t border-white/[0.08] flex flex-col md:flex-row items-center justify-between text-xs font-mono text-text-muted gap-4">
      <div>
        &copy; <?= date('Y') ?> FARAAN IMPEX. All Rights Reserved. Sialkot, Pakistan.
      </div>
      <div class="flex items-center gap-6 uppercase tracking-wider text-[11px]">
        <span class="text-carmine font-semibold">Direct Sialkot Atelier</span>
        <span class="text-white/20">|</span>
        <span>B2B Export Only</span>
        <span class="text-white/20">|</span>
        <span>ISO &amp; CE Compliant</span>
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
