<?php
/** Contact — info cards + enquiry form (mailto fallback until SMTP configured). */
$page_title = 'Contact Us — Faraan Impex';
$sent = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Basic honeypot + validation; actual delivery via SMTP configured at deploy.
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $country = trim($_POST['country'] ?? '');
    $interest = trim($_POST['interest'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $honeypot = trim($_POST['company_website'] ?? '');
    if ($honeypot === '' && $name !== '' && filter_var($email, FILTER_VALIDATE_EMAIL) && $message !== '') {
        $sent = true; // TODO: wire to SMTP / WhatsApp fallback on production
    }
}
?>
<section class="bg-[#0A0A0A] text-[#FAF7F2]">
  <div class="max-w-7xl mx-auto px-4 py-16">
    <h1 class="text-4xl font-extrabold">Contact Us</h1>
    <p class="mt-3 text-[#FAF7F2]/70">Send an enquiry — we respond to wholesale queries promptly.</p>
  </div>
</section>

<div class="max-w-7xl mx-auto px-4 py-14 grid lg:grid-cols-2 gap-10">
  <!-- Info -->
  <div class="space-y-5">
    <div class="bg-white rounded-xl border border-[#0A0A0A]/10 p-6">
      <h3 class="font-bold mb-1">Factory Address</h3>
      <p class="text-sm text-[#0A0A0A]/70"><?= e(CONTACT_ADDRESS) ?></p>
    </div>
    <div class="bg-white rounded-xl border border-[#0A0A0A]/10 p-6">
      <h3 class="font-bold mb-1">Email</h3>
      <p class="text-sm"><a href="mailto:<?= e(CONTACT_EMAIL) ?>" class="text-[#E10600] hover:underline"><?= e(CONTACT_EMAIL) ?></a></p>
      <p class="text-sm mt-1"><a href="mailto:<?= e(CONTACT_EMAIL_2) ?>" class="text-[#E10600] hover:underline"><?= e(CONTACT_EMAIL_2) ?></a></p>
    </div>
    <div class="bg-white rounded-xl border border-[#0A0A0A]/10 p-6">
      <h3 class="font-bold mb-1">Phone / WhatsApp</h3>
      <p class="text-sm"><?= e(CONTACT_PHONE) ?></p>
      <p class="text-sm mt-1"><?= e(CONTACT_PHONE_2) ?></p>
    </div>
    <a href="<?= whatsapp_link("Assalam-o-Alaikum, I'd like to enquire about your products.") ?>" target="_blank" rel="noopener" class="inline-block bg-[#25D366] text-white px-8 py-3 rounded font-semibold">Chat on WhatsApp</a>
  </div>

  <!-- Form -->
  <div class="bg-white rounded-xl border border-[#0A0A0A]/10 p-8">
    <?php if ($sent): ?>
      <div class="bg-green-50 border border-green-200 text-green-800 rounded p-4 text-sm">Thank you, <?= e($_POST['name'] ?? '') ?>. Your enquiry has been received — we'll get back to you soon.</div>
    <?php else: ?>
      <h2 class="text-xl font-extrabold mb-6">Send an Enquiry</h2>
      <form method="post" class="space-y-4">
        <div><label class="text-sm font-medium">Name *</label><input name="name" required class="mt-1 w-full border border-[#0A0A0A]/20 rounded px-3 py-2"></div>
        <div><label class="text-sm font-medium">Email *</label><input name="email" type="email" required class="mt-1 w-full border border-[#0A0A0A]/20 rounded px-3 py-2"></div>
        <div><label class="text-sm font-medium">Country</label><input name="country" class="mt-1 w-full border border-[#0A0A0A]/20 rounded px-3 py-2"></div>
        <div><label class="text-sm font-medium">Product Interest</label>
          <select name="interest" class="mt-1 w-full border border-[#0A0A0A]/20 rounded px-3 py-2">
            <option>Leather Wears</option><option>Textile Wears</option><option>Western Wears</option><option>Leather Products</option><option>Other</option>
          </select>
        </div>
        <div><label class="text-sm font-medium">Message *</label><textarea name="message" rows="4" required class="mt-1 w-full border border-[#0A0A0A]/20 rounded px-3 py-2"></textarea></div>
        <input type="text" name="company_website" class="hidden" tabindex="-1" autocomplete="off">
        <button class="bg-[#0A0A0A] text-white px-6 py-3 rounded font-semibold hover:bg-[#E10600] transition">Send Enquiry</button>
      </form>
    <?php endif; ?>
  </div>
</div>
