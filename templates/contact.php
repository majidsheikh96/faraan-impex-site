<?php
/**
 * Contact Us & Production Desk — Luxury B2B Procurement Hub (Stagfield Sports Caliber)
 * Factory credentials, direct commercial contacts, and comprehensive RFQ submission form.
 */
$page_title = 'Contact Production Desk — OEM/ODM Sialkot Manufacturing | FARAAN IMPEX';
$page_description = 'Submit tech packs, request wholesale leatherwear quotations, or connect with our master production desk in Sialkot, Pakistan.';

$sent = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $interest = trim($_POST['interest'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $honeypot = trim($_POST['company_website'] ?? '');
    if ($honeypot === '' && $name !== '' && filter_var($email, FILTER_VALIDATE_EMAIL) && $message !== '') {
        $sent = true;
    }
}
?>

<!-- Contact Hero Section -->
<section class="bg-[#070709] text-white border-b border-white/10 py-16 sm:py-20 relative overflow-hidden">
  <div class="absolute -right-32 -top-32 w-80 h-80 bg-crimson/10 rounded-full blur-[140px] pointer-events-none"></div>

  <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div class="max-w-2xl">
      <span class="font-mono text-crimson text-[11px] uppercase tracking-[0.18em] font-bold block mb-3">
        DIRECT SIALKOT FACTORY ACCESS
      </span>
      <h1 class="font-serif text-3xl sm:text-5xl font-normal text-white tracking-tight leading-[1.14]">
        Contact our commercial production desk.
      </h1>
      <p class="text-[#AEB9C4] text-sm sm:text-base leading-relaxed mt-4 font-body">
        Submit tech packs, request material swatches, or schedule a specification review with our master pattern makers. Quotations delivered within 2 hours.
      </p>
    </div>
  </div>
</section>

<!-- Main Contact & Form Section -->
<div class="bg-paper py-14 sm:py-20 border-b border-[#E6E4DD]">
  <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
      
      <!-- Left Column: Factory Credentials & Contact Cards (5 cols) -->
      <div class="lg:col-span-5 space-y-6">
        <div>
          <p class="font-mono text-crimson text-xs uppercase tracking-widest font-bold mb-2">
            HEAD OFFICE &amp; FACTORY
          </p>
          <h2 class="font-serif text-2xl sm:text-3xl text-[#070709] font-normal">
            Sialkot Manufacturing Base
          </h2>
          <p class="text-[#5A6472] text-sm mt-2 leading-relaxed">
            Direct factory floor access with zero trading house intermediaries.
          </p>
        </div>

        <!-- Address Card -->
        <div class="bg-white rounded-[22px] border border-[#E6E4DD] p-6 shadow-sm flex items-start gap-4">
          <div class="w-10 h-10 rounded-full bg-[#FCFBF8] border border-[#E6E4DD] flex items-center justify-center text-crimson shrink-0">
            <span class="material-symbols-outlined text-[20px]">location_on</span>
          </div>
          <div>
            <div class="font-mono text-xs uppercase tracking-wider text-[#070709] font-bold mb-1">Factory Location</div>
            <p class="text-sm text-[#5A6472] leading-relaxed"><?= e(CONTACT_ADDRESS) ?></p>
            <span class="inline-block mt-2 font-mono text-[11px] text-crimson">Sialkot, Punjab, Pakistan</span>
          </div>
        </div>

        <!-- Email Card -->
        <div class="bg-white rounded-[22px] border border-[#E6E4DD] p-6 shadow-sm flex items-start gap-4">
          <div class="w-10 h-10 rounded-full bg-[#FCFBF8] border border-[#E6E4DD] flex items-center justify-center text-crimson shrink-0">
            <span class="material-symbols-outlined text-[20px]">mail</span>
          </div>
          <div>
            <div class="font-mono text-xs uppercase tracking-wider text-[#070709] font-bold mb-1">Primary Factory Email</div>
            <a href="mailto:<?= e(CONTACT_EMAIL) ?>" class="text-sm text-[#070709] font-semibold hover:text-crimson transition-colors block">
              <?= e(CONTACT_EMAIL) ?>
            </a>
            <?php if (defined('CONTACT_EMAIL_2') && CONTACT_EMAIL_2): ?>
              <a href="mailto:<?= e(CONTACT_EMAIL_2) ?>" class="text-xs text-[#5A6472] hover:text-crimson transition-colors block mt-0.5">
                <?= e(CONTACT_EMAIL_2) ?> (Secondary / Info)
              </a>
            <?php endif; ?>
          </div>
        </div>

        <!-- Phone & WhatsApp Card -->
        <div class="bg-white rounded-[22px] border border-[#E6E4DD] p-6 shadow-sm flex items-start gap-4">
          <div class="w-10 h-10 rounded-full bg-[#FCFBF8] border border-[#E6E4DD] flex items-center justify-center text-crimson shrink-0">
            <span class="material-symbols-outlined text-[20px]">call</span>
          </div>
          <div>
            <div class="font-mono text-xs uppercase tracking-wider text-[#070709] font-bold mb-1">Phone &amp; WhatsApp Desk</div>
            <a href="tel:<?= e(str_replace(' ', '', CONTACT_PHONE)) ?>" class="text-sm text-[#070709] font-semibold hover:text-crimson transition-colors block">
              <?= e(CONTACT_PHONE) ?>
            </a>
            <div class="mt-3">
              <a href="<?= whatsapp_link("Assalam-o-Alaikum, I would like to speak with the production desk regarding an OEM order.") ?>" 
                 target="_blank" rel="noopener noreferrer" 
                 class="inline-flex items-center gap-2 text-xs font-mono font-bold text-crimson uppercase tracking-wider hover:underline">
                <span>Open Instant WhatsApp Chat</span>
                <span>→</span>
              </a>
            </div>
          </div>
        </div>

        <!-- NDA Commitment Card -->
        <div class="p-6 rounded-[22px] bg-[#F6F3ED] border border-[#E6E4DD] text-xs font-mono text-[#5A6472] leading-relaxed">
          <div class="text-[#070709] font-bold uppercase tracking-wider mb-1">Strict Confidentiality (NDA)</div>
          All proprietary patterns, CAD drawings, brand logos, and custom hardware moulds remain the exclusive property of our client brands.
        </div>
      </div>

      <!-- Right Column: Studio White RFQ Submission Card (7 cols) -->
      <div class="lg:col-span-7">
        <div class="bg-white rounded-[24px] border border-[#E6E4DD] p-8 sm:p-10 shadow-[0_8px_30px_rgba(0,0,0,0.04)]">
          <?php if ($sent): ?>
            <div class="p-8 rounded-[18px] bg-emerald-50 border border-emerald-200 text-emerald-900 text-center space-y-3">
              <div class="w-12 h-12 rounded-full bg-emerald-500 text-white flex items-center justify-center mx-auto text-xl font-bold">✓</div>
              <h3 class="font-serif text-2xl text-emerald-950 font-normal">Inquiry Successfully Received</h3>
              <p class="text-sm text-emerald-800 leading-relaxed max-w-md mx-auto">
                Thank you, <?= e($name) ?>. Our commercial engineering desk will review your specifications and respond within 2 business hours.
              </p>
            </div>
          <?php else: ?>
            <div class="mb-8 pb-6 border-b border-[#E6E4DD]">
              <span class="font-mono text-crimson text-xs uppercase tracking-widest font-bold block mb-1">
                ONLINE RFQ DISPATCH
              </span>
              <h2 class="font-serif text-2xl sm:text-3xl text-[#070709] font-normal">
                Submit Production Specifications
              </h2>
              <p class="text-sm text-[#5A6472] mt-1.5">
                Please complete the parameters below for itemized FOB/CIF quotation.
              </p>
            </div>

            <form method="post" class="space-y-5">
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                  <label class="block text-xs font-mono font-bold uppercase tracking-wider text-[#070709] mb-1.5">Your Full Name *</label>
                  <input type="text" name="name" required placeholder="e.g. Marcus Vance" class="w-full bg-[#FCFBF8] border border-[#E6E4DD] rounded-xl px-4 py-3 text-sm text-[#070709] focus:outline-none focus:border-crimson">
                </div>
                <div>
                  <label class="block text-xs font-mono font-bold uppercase tracking-wider text-[#070709] mb-1.5">Business Email *</label>
                  <input type="email" name="email" required placeholder="name@company.com" class="w-full bg-[#FCFBF8] border border-[#E6E4DD] rounded-xl px-4 py-3 text-sm text-[#070709] focus:outline-none focus:border-crimson">
                </div>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                  <label class="block text-xs font-mono font-bold uppercase tracking-wider text-[#070709] mb-1.5">Company / Brand Name</label>
                  <input type="text" name="company" placeholder="e.g. Vance Moto Supply Ltd" class="w-full bg-[#FCFBF8] border border-[#E6E4DD] rounded-xl px-4 py-3 text-sm text-[#070709] focus:outline-none focus:border-crimson">
                </div>
                <div>
                  <label class="block text-xs font-mono font-bold uppercase tracking-wider text-[#070709] mb-1.5">Target Division *</label>
                  <select name="interest" class="w-full bg-[#FCFBF8] border border-[#E6E4DD] rounded-xl px-4 py-3 text-sm text-[#070709] focus:outline-none focus:border-crimson">
                    <option value="Leather Wears">Leather Outerwear &amp; Racing Suits</option>
                    <option value="Textile Wears">Technical Textile &amp; All-Weather Gear</option>
                    <option value="Western Wears">Western Heritage &amp; Suede</option>
                    <option value="Leather Products">Artisan Aprons &amp; Leather Goods</option>
                    <option value="Other">Custom OEM / Multiple Categories</option>
                  </select>
                </div>
              </div>

              <div>
                <label class="block text-xs font-mono font-bold uppercase tracking-wider text-[#070709] mb-1.5">Destination Country &amp; Estimated Quantity</label>
                <input type="text" name="country" placeholder="e.g. 200 units · Sea Cargo to Hamburg, Germany" class="w-full bg-[#FCFBF8] border border-[#E6E4DD] rounded-xl px-4 py-3 text-sm text-[#070709] focus:outline-none focus:border-crimson">
              </div>

              <div>
                <label class="block text-xs font-mono font-bold uppercase tracking-wider text-[#070709] mb-1.5">Specification Notes &amp; Material Requirements *</label>
                <textarea name="message" rows="5" required placeholder="Describe leather gauge, hardware requirements, sizing scale, or link to Dropbox/Drive tech packs..." class="w-full bg-[#FCFBF8] border border-[#E6E4DD] rounded-xl px-4 py-3 text-sm text-[#070709] focus:outline-none focus:border-crimson"></textarea>
              </div>

              <input type="text" name="company_website" class="hidden" tabindex="-1" autocomplete="off">

              <div class="pt-2">
                <button type="submit" class="w-full bg-crimson hover:bg-crimson-hover text-white py-4 px-6 rounded-xl font-mono text-xs font-bold uppercase tracking-wider transition-colors shadow-md">
                  Send RFQ to Sialkot Production Desk →
                </button>
              </div>

              <p class="text-center text-[11px] font-mono text-[#5A6472] mt-3">
                Direct factory response within 2 hours. FOB / CIF quotes provided upon review.
              </p>
            </form>
          <?php endif; ?>
        </div>
      </div>

    </div>
  </div>
</div>
