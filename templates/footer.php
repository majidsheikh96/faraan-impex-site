</main>

<!-- 8. FOOTER (Rich espresso dark background #2B1D16, exact blurb, exact contact details) -->
<footer class="bg-primary-container text-surface border-t border-outline mt-16" id="contact-us">
  <div class="w-full px-6 lg:px-12 py-16 mx-auto max-w-[1440px]">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8 mb-12">
      <!-- Left Column: Wordmark & Blurb -->
      <div class="lg:col-span-4">
        <a class="font-headline text-2xl uppercase font-extrabold tracking-tight text-surface block mb-4" href="/">
          FARAAN <span class="text-secondary">IMPEX</span>
        </a>
        <p class="font-body text-surface-variant leading-relaxed text-sm mb-6 max-w-sm">
          Standing on the grounds of quality, Faraan Impex offers stylish leather and textile wears from Sialkot, Pakistan to international markets worldwide.
        </p>
        <a class="inline-flex items-center gap-2 bg-[#25D366] text-white px-5 py-3 font-mono font-bold uppercase tracking-wider text-[13px] rounded-DEFAULT shadow-sm hover:brightness-105 transition-all" href="<?= whatsapp_link("Assalam-o-Alaikum, I would like to inquire about Faraan Impex products.") ?>" rel="noopener noreferrer" target="_blank">
          <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
            <path d="M12.031 2C6.494 2 2 6.494 2 12.031c0 1.956.564 3.782 1.542 5.334L2 22l4.789-1.517c1.498.907 3.242 1.428 5.109 1.428 5.537 0 10.031-4.494 10.031-10.031S17.568 2 12.031 2zm5.727 14.195c-.241.677-1.391 1.296-1.928 1.341-.536.046-1.196.195-3.874-.912-3.238-1.339-5.321-4.664-5.483-4.88-.16-.217-1.309-1.745-1.309-3.328 0-1.583.829-2.361 1.123-2.684.294-.323.643-.404.858-.404.214 0 .429.003.616.012.198.01.463-.075.724.551.268.643.91 2.224.991 2.385.08.161.134.349.027.563-.107.215-.16.349-.321.536-.161.188-.338.419-.482.563-.161.16-.329.335-.141.658.188.322.836 1.378 1.794 2.231 1.233 1.096 2.274 1.436 2.595 1.597.321.161.509.134.696-.08.188-.215.804-.938 1.018-1.26.214-.322.429-.268.723-.161.295.107 1.874.884 2.196 1.045.321.161.536.241.616.375.08.134.08.777-.161 1.454z"></path>
          </svg>
          <span>Quick WhatsApp Chat</span>
        </a>
      </div>

      <!-- Middle Column 1: Manufacturing Divisions -->
      <div class="lg:col-span-2">
        <h4 class="font-headline font-bold text-surface mb-4 uppercase tracking-wider text-sm">
          Divisions
        </h4>
        <ul class="space-y-2.5 font-body text-surface-variant text-[14px]">
          <?php foreach (get_top_categories() as $cat): ?>
            <li><a class="hover:text-secondary-fixed transition-colors" href="/<?= e($cat['slug']) ?>/"><?= e($cat['name']) ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- Middle Column 2: B2B Services -->
      <div class="lg:col-span-2">
        <h4 class="font-headline font-bold text-surface mb-4 uppercase tracking-wider text-sm">
          Operations
        </h4>
        <ul class="space-y-2.5 font-body text-surface-variant text-[14px]">
          <li><a class="hover:text-secondary-fixed transition-colors" href="/about-us">Company Profile</a></li>
          <li><a class="hover:text-secondary-fixed transition-colors" href="/about-us#oem">OEM Services</a></li>
          <li><a class="hover:text-secondary-fixed transition-colors" href="/#process">4-Step Process</a></li>
          <li><a class="hover:text-secondary-fixed transition-colors" href="/contact-us">Inquiry &amp; Quotes</a></li>
        </ul>
      </div>

      <!-- Right Column: Contact Information -->
      <div class="lg:col-span-4" id="about-us-info">
        <h4 class="font-headline font-bold text-surface mb-4 uppercase tracking-wider text-sm">
          Contact Information
        </h4>
        <div class="space-y-3 font-body text-surface-variant text-[14px]">
          <div class="flex items-start gap-3">
            <span class="material-symbols-outlined text-secondary-container text-[20px] mt-0.5">location_on</span>
            <span><?= e(CONTACT_ADDRESS) ?></span>
          </div>
          <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-secondary-container text-[20px]">mail</span>
            <div class="flex flex-col">
              <a class="hover:text-secondary-fixed transition-colors" href="mailto:<?= e(CONTACT_EMAIL) ?>"><?= e(CONTACT_EMAIL) ?></a>
              <?php if (defined('CONTACT_EMAIL_2') && CONTACT_EMAIL_2): ?>
                <a class="hover:text-secondary-fixed transition-colors text-xs text-surface-variant/80" href="mailto:<?= e(CONTACT_EMAIL_2) ?>"><?= e(CONTACT_EMAIL_2) ?></a>
              <?php endif; ?>
            </div>
          </div>
          <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-secondary-container text-[20px]">call</span>
            <div class="flex flex-col">
              <a class="hover:text-secondary-fixed transition-colors" href="tel:<?= e(str_replace(' ', '', CONTACT_PHONE)) ?>"><?= e(CONTACT_PHONE) ?></a>
              <a class="hover:text-secondary-fixed transition-colors" href="tel:<?= e(str_replace(' ', '', CONTACT_PHONE_2)) ?>"><?= e(CONTACT_PHONE_2) ?></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bottom Bar -->
    <div class="pt-8 border-t border-on-primary-fixed-variant/30 flex flex-col md:flex-row items-center justify-between text-xs font-mono text-surface-variant gap-4">
      <div>
        &copy; <?= date('Y') ?> FARAAN IMPEX. All Rights Reserved. Sialkot, Pakistan.
      </div>
      <div class="flex items-center gap-6 uppercase tracking-wider text-[11px]">
        <span>Direct OEM Sialkot Factory</span>
        <span>B2B Export Only</span>
      </div>
    </div>
  </div>
</footer>

<?php if (IMAGE_PROTECTION): ?>
<script src="/assets/js/protect.js"></script>
<?php endif; ?>
</body>
</html>
