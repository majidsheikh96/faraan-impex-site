<?php
/**
 * Section 7: Procurement & Tech Pack Inquiry Desk (Stagfield Sports Luxury Caliber)
 * High-contrast dark quote section with verified project requirements on left and crisp white RFQ form on right.
 * 100% Admin-Controlled Content & Dynamic MOQ.
 */

$heading = get_setting('inquiry_heading', 'Tell us what you want to manufacture.');
$subheading = get_setting('inquiry_subheading', 'Share your sketches, CAD tech packs, or reference images. Our commercial engineering team will review feasibility and calculate hide consumption for a formal FOB quotation within 2 hours.');
$email1 = get_setting('contact_email', CONTACT_EMAIL);
$email2 = get_setting('contact_email_2', defined('CONTACT_EMAIL_2') ? CONTACT_EMAIL_2 : '');
$phone = get_setting('contact_phone', CONTACT_PHONE);
$moq = get_site_moq();
?>

<!-- 7. START A PROJECT / RFQ DESK -->
<section class="py-24 sm:py-28 bg-[#070709] text-white relative overflow-hidden" id="inquiry">
  <!-- Atmospheric amber/crimson glow -->
  <div class="absolute -left-32 -bottom-32 w-96 h-96 bg-crimson/10 rounded-full blur-[140px] pointer-events-none"></div>

  <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
      
      <!-- Left Column: Commercial Briefing & Requirements -->
      <div class="lg:col-span-5">
        <p class="font-mono text-crimson text-[11px] sm:text-[12px] font-bold uppercase tracking-[0.18em] mb-3">
          START A PROJECT
        </p>
        <h2 class="font-serif text-3xl sm:text-4xl lg:text-[44px] font-normal text-white tracking-tight leading-[1.16]">
          <?= e($heading) ?>
        </h2>
        <p class="text-[#B9C4CD] text-[15px] sm:text-[17px] leading-relaxed mt-4">
          <?= e($subheading) ?>
        </p>

        <!-- Requirements Checklist (Stagfield Style) -->
        <div class="mt-8 space-y-3.5 text-sm text-[#D3DAE0]">
          <div class="flex items-start gap-3">
            <span class="text-crimson font-bold text-base mt-0.5">✓</span>
            <span>Product category and estimated order quantity (MOQ: <?= e($moq) ?>)</span>
          </div>
          <div class="flex items-start gap-3">
            <span class="text-crimson font-bold text-base mt-0.5">✓</span>
            <span>Design sketch, reference photo, or vector CAD tech pack</span>
          </div>
          <div class="flex items-start gap-3">
            <span class="text-crimson font-bold text-base mt-0.5">✓</span>
            <span>Leather gauge, fabric preferences, and custom hardware requirements</span>
          </div>
          <div class="flex items-start gap-3">
            <span class="text-crimson font-bold text-base mt-0.5">✓</span>
            <span>Destination country and required delivery in-hands date</span>
          </div>
        </div>

        <!-- Contact Links -->
        <div class="mt-10 pt-8 border-t border-white/10 space-y-3 font-mono text-xs text-[#AEB9C4]">
          <p>
            Direct factory email: 
            <a href="mailto:<?= e($email1) ?>" class="text-crimson hover:underline font-bold"><?= e($email1) ?></a>
            <?php if ($email2): ?>
              <span class="text-white/40 block sm:inline sm:ml-2 text-[11px]">Alt: <?= e($email2) ?></span>
            <?php endif; ?>
          </p>
          <p>
            Instant WhatsApp desk? 
            <a href="<?= whatsapp_link("Assalam-o-Alaikum, I'd like to submit an OEM tech pack inquiry.") ?>" target="_blank" rel="noopener noreferrer" class="text-white hover:text-crimson font-bold"><?= e($phone) ?></a>
          </p>
        </div>
      </div>

      <!-- Right Column: Studio White RFQ Form Card -->
      <div class="lg:col-span-7">
        <div class="bg-white rounded-[24px] p-8 sm:p-10 shadow-[0_25px_60px_rgba(0,0,0,0.35)] text-[#070709]">
          <h3 class="font-serif text-2xl sm:text-3xl font-normal text-[#070709] mb-1.5">
            Submit Specifications
          </h3>
          <p class="text-[#5A6472] text-sm mb-7">
            Direct factory access. No middleman broker markup.
          </p>

          <form action="/contact-us" method="post" class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label class="block text-xs font-mono font-bold uppercase tracking-wider text-[#070709] mb-1.5">Your Name *</label>
                <input type="text" name="name" required placeholder="e.g. Marcus Vance" class="w-full bg-[#FCFBF8] border border-[#E6E4DD] rounded-xl px-4 py-3 text-sm text-[#070709] focus:outline-none focus:border-crimson">
              </div>
              <div>
                <label class="block text-xs font-mono font-bold uppercase tracking-wider text-[#070709] mb-1.5">Business Email *</label>
                <input type="email" name="email" required placeholder="name@brand.com" class="w-full bg-[#FCFBF8] border border-[#E6E4DD] rounded-xl px-4 py-3 text-sm text-[#070709] focus:outline-none focus:border-crimson">
              </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label class="block text-xs font-mono font-bold uppercase tracking-wider text-[#070709] mb-1.5">Company / Brand</label>
                <input type="text" name="company" placeholder="e.g. Vance Moto Supply" class="w-full bg-[#FCFBF8] border border-[#E6E4DD] rounded-xl px-4 py-3 text-sm text-[#070709] focus:outline-none focus:border-crimson">
              </div>
              <div>
                <label class="block text-xs font-mono font-bold uppercase tracking-wider text-[#070709] mb-1.5">Manufacturing Division *</label>
                <select name="interest" class="w-full bg-[#FCFBF8] border border-[#E6E4DD] rounded-xl px-4 py-3 text-sm text-[#070709] focus:outline-none focus:border-crimson">
                  <option value="Leather Wears">Leather Outerwear &amp; Moto Racing</option>
                  <option value="Textile Wears">Technical Textile &amp; All-Weather Gear</option>
                  <option value="Western Wears">Western Heritage &amp; Suede</option>
                  <option value="Leather Products">Artisan Aprons &amp; Leather Goods</option>
                  <option value="Custom OEM">Custom Contract Development</option>
                </select>
              </div>
            </div>

            <div>
              <label class="block text-xs font-mono font-bold uppercase tracking-wider text-[#070709] mb-1.5">Project Scope &amp; Target Quantity (MOQ: <?= e($moq) ?>) *</label>
              <textarea name="message" rows="4" required placeholder="Describe target models, leather or fabric specifications, estimated units per style, and in-hands delivery timeline..." class="w-full bg-[#FCFBF8] border border-[#E6E4DD] rounded-xl p-4 text-sm text-[#070709] focus:outline-none focus:border-crimson leading-relaxed"></textarea>
            </div>

            <button type="submit" class="w-full bg-crimson hover:bg-crimson-hover text-white py-4 rounded-xl font-mono text-xs font-bold uppercase tracking-wider transition-colors shadow-md flex items-center justify-center gap-2">
              <span>Send Specifications to Factory Desk</span>
              <span>→</span>
            </button>
            <p class="text-[11px] text-[#5A6472] text-center font-mono">
              Direct factory response from our engineering team within 2 hours.
            </p>
          </form>
        </div>
      </div>

    </div>
  </div>
</section>
