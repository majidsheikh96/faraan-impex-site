<?php
/**
 * Admin: Global Site Settings & Commercial MOQ Configuration.
 * Fully controls all global text, email addresses, phone numbers, WhatsApp, SLAs, and MOQs.
 */
declare(strict_types=1);
require_once __DIR__ . '/layout.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && verify_csrf($_POST['csrf'] ?? '')) {
    $fields = [
        // Commercial & MOQ
        'global_moq'        => 'general',
        'sample_turnaround' => 'general',
        'quote_turnaround'  => 'general',
        'topbar_tagline'    => 'general',
        // Company & Contact
        'site_name'         => 'general',
        'contact_email'     => 'general',
        'contact_email_2'   => 'general',
        'contact_phone'     => 'general',
        'contact_phone_2'   => 'general',
        'whatsapp_number'   => 'general',
        'contact_address'   => 'general',
        // Footer & Legal
        'footer_about'      => 'footer',
        'footer_disclaimer' => 'footer'
    ];

    foreach ($fields as $key => $group) {
        if (isset($_POST[$key])) {
            update_setting($key, trim((string)$_POST[$key]), $group);
        }
    }

    flash_set('Global settings and commercial MOQ updated successfully.');
    header('Location: /admin/settings.php');
    exit;
}

admin_header('Site Settings & MOQ');
?>

<div class="max-w-4xl">
  
  <div class="mb-8">
    <span class="font-mono text-xs uppercase tracking-widest text-[#C51E28] font-bold">CONFIGURATION HUB</span>
    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mt-1">Site Settings &amp; Global MOQ</h1>
    <p class="text-sm text-gray-500 mt-1">
      Manage wholesale MOQ, direct factory emails, phone numbers, WhatsApp integration, turnaround SLAs, and footer text across the entire site.
    </p>
  </div>

  <form method="post" class="space-y-8">
    <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

    <!-- 1. Commercial Minimum Order Quantities & SLAs -->
    <div class="bg-white rounded-2xl border border-gray-200/80 p-6 sm:p-8 shadow-sm">
      <div class="flex items-center gap-3 pb-4 mb-6 border-b border-gray-100">
        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
        <h2 class="text-base font-bold text-gray-900 uppercase tracking-wide font-mono">1. Commercial MOQ &amp; Lead Times</h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">
            Global Default MOQ *
          </label>
          <input type="text" name="global_moq" 
                 value="<?= e(get_setting('global_moq', '50 Pcs / Style')) ?>" required
                 class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#C51E28] focus:border-transparent text-sm">
          <p class="text-[11px] text-gray-500 mt-1.5 font-mono">
            Displays on top banner, curated styles, category heroes &amp; product spec sheets.
          </p>
        </div>

        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">
            Sample Turnaround SLA *
          </label>
          <input type="text" name="sample_turnaround" 
                 value="<?= e(get_setting('sample_turnaround', '7–10 Business Days')) ?>" required
                 class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#C51E28] focus:border-transparent text-sm">
          <p class="text-[11px] text-gray-500 mt-1.5 font-mono">
            Physical counter-sample production lead time.
          </p>
        </div>

        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">
            Quote Turnaround SLA *
          </label>
          <input type="text" name="quote_turnaround" 
                 value="<?= e(get_setting('quote_turnaround', 'Under 2 Hours')) ?>" required
                 class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#C51E28] focus:border-transparent text-sm">
          <p class="text-[11px] text-gray-500 mt-1.5 font-mono">
            Displayed on header top-bar and inquiry prompts.
          </p>
        </div>

        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">
            Header Sub-Tagline *
          </label>
          <input type="text" name="topbar_tagline" 
                 value="<?= e(get_setting('topbar_tagline', 'Sialkot Factory & Direct OEM/ODM Manufacturer')) ?>" required
                 class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#C51E28] focus:border-transparent text-sm">
          <p class="text-[11px] text-gray-500 mt-1.5 font-mono">
            Displayed in top black authority bar next to brand title.
          </p>
        </div>
      </div>
    </div>

    <!-- 2. Direct Factory Contact Channels & Turnaround -->
    <div class="bg-white rounded-2xl border border-gray-200/80 p-6 sm:p-8 shadow-sm">
      <div class="flex items-center gap-3 pb-4 mb-6 border-b border-gray-100">
        <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
        <h2 class="text-base font-bold text-gray-900 uppercase tracking-wide font-mono">2. Direct Factory Contacts &amp; Inquiries</h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">
            Primary Contact Email (Gmail / High Priority) *
          </label>
          <input type="email" name="contact_email" 
                 value="<?= e(get_setting('contact_email', 'faraanimpex@gmail.com')) ?>" required
                 class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#C51E28] focus:border-transparent text-sm font-mono">
          <p class="text-[11px] text-gray-500 mt-1.5 font-mono">
            Shown in topbar, contact page, and footer inquiry desk.
          </p>
        </div>

        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">
            Secondary / Domain Email
          </label>
          <input type="email" name="contact_email_2" 
                 value="<?= e(get_setting('contact_email_2', 'info@faraanimpex.com')) ?>"
                 class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#C51E28] focus:border-transparent text-sm font-mono">
          <p class="text-[11px] text-gray-500 mt-1.5 font-mono">
            Secondary corporate desk email.
          </p>
        </div>

        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">
            WhatsApp Direct Number (Digits only, no +) *
          </label>
          <input type="text" name="whatsapp_number" 
                 value="<?= e(get_setting('whatsapp_number', '923327464484')) ?>" required
                 class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#C51E28] focus:border-transparent text-sm font-mono">
          <p class="text-[11px] text-gray-500 mt-1.5 font-mono">
            Used for 1-click WhatsApp quote buttons: wa.me/<?= e(get_setting('whatsapp_number', '923327464484')) ?>
          </p>
        </div>

        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">
            Primary Phone Number *
          </label>
          <input type="text" name="contact_phone" 
                 value="<?= e(get_setting('contact_phone', '+92 332 7464484')) ?>" required
                 class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#C51E28] focus:border-transparent text-sm font-mono">
        </div>

        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">
            Secondary Phone Number
          </label>
          <input type="text" name="contact_phone_2" 
                 value="<?= e(get_setting('contact_phone_2', '+92 322 7464482')) ?>"
                 class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#C51E28] focus:border-transparent text-sm font-mono">
        </div>

        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">
            Official Brand / Entity Title
          </label>
          <input type="text" name="site_name" 
                 value="<?= e(get_setting('site_name', 'FARAAN IMPEX')) ?>" required
                 class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#C51E28] focus:border-transparent text-sm">
        </div>

        <div class="md:col-span-2">
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">
            Factory Physical Address *
          </label>
          <input type="text" name="contact_address" 
                 value="<?= e(get_setting('contact_address', 'P.O. 10/94, Nekapura Road, Sialkot 51310, Pakistan')) ?>" required
                 class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#C51E28] focus:border-transparent text-sm">
        </div>
      </div>
    </div>

    <!-- 3. Footer Copy & Legal Disclaimers -->
    <div class="bg-white rounded-2xl border border-gray-200/80 p-6 sm:p-8 shadow-sm">
      <div class="flex items-center gap-3 pb-4 mb-6 border-b border-gray-100">
        <span class="w-2.5 h-2.5 rounded-full bg-purple-500"></span>
        <h2 class="text-base font-bold text-gray-900 uppercase tracking-wide font-mono">3. Footer Summary &amp; B2B Disclaimer</h2>
      </div>

      <div class="space-y-6">
        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">
            Footer Company Bio / Mission Text
          </label>
          <textarea name="footer_about" rows="3" 
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#C51E28] focus:border-transparent text-sm"><?= e(get_setting('footer_about', 'Direct OEM/ODM private-label manufacturer and exporter of motorcycle suits, technical flannels, western headwear, and artisan leather goods from Sialkot, Pakistan.')) ?></textarea>
        </div>

        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">
            B2B Commercial Disclaimer
          </label>
          <textarea name="footer_disclaimer" rows="2" 
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#C51E28] focus:border-transparent text-sm"><?= e(get_setting('footer_disclaimer', '* Faraan Impex operates strictly as a wholesale B2B contract manufacturer. Retail inquiries are not serviced. Production begins upon counter-sample signoff.')) ?></textarea>
        </div>
      </div>
    </div>

    <!-- Save Button Bar -->
    <div class="flex items-center justify-between pt-4">
      <a href="/admin/dashboard.php" class="text-xs font-mono text-gray-500 hover:text-gray-900 uppercase tracking-wider">
        ← Back to Dashboard
      </a>
      <button type="submit" 
              class="inline-flex items-center justify-center gap-2 bg-[#C51E28] hover:bg-[#A81822] text-white px-8 py-3.5 rounded-xl font-mono text-xs font-bold uppercase tracking-wider transition-colors shadow-md">
        <span>Save All Settings</span>
        <span>✓</span>
      </button>
    </div>

  </form>

</div>

<?php admin_footer(); ?>
