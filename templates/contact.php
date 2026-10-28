<?php
/** Contact + RFQ (design: Contact.dc.html). Also receives the homepage RFQ form. */
$page_title = 'Contact — Request a Quote | FARAAN IMPEX, Sialkot';
$page_description = 'Send your tech pack and get a formal FOB quotation from the Sialkot factory desk within two hours.';

$result = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = rfq_handle_post();
}
$email = get_setting('contact_email', CONTACT_EMAIL);
$phone = phone_display(get_setting('contact_phone', CONTACT_PHONE));
$phone2 = phone_display(get_setting('contact_phone_2', CONTACT_PHONE_2));
$address = get_setting('contact_address', CONTACT_ADDRESS);
$intro      = get_setting('contact_intro', '');
$heroTitle  = get_setting('contact_hero_title', 'Production desk & quotation.');
$heroLead   = get_setting('contact_hero_lead', 'Direct contract manufacturing desk. Submit your technical drawings, bill of materials, or sample inquiries for immediate factory costing and leather hide validation.');
$rfqId = 'c';
$rfqFull = true;
?>
<section class="wrap" style="padding-top:28px">
  <nav class="crumbs" aria-label="Breadcrumb" style="color:var(--muted)"><a href="/">Home</a> <span aria-hidden="true">/</span> <span style="color:var(--ink);font-weight:500">Contact Us</span></nav>
</section>
<section class="wrap" style="padding-top:32px;padding-bottom:40px;display:flex;flex-direction:column;gap:16px">
  <span class="eyebrow">CONTACT / RFQ</span>
  <h1 class="h-display h-xl" style="max-width:900px"><?= e($heroTitle) ?></h1>
  <p style="max-width:640px;font-size:18px;color:var(--muted);margin:0"><?= e($heroLead) ?></p>
</section>

<section class="wrap" style="padding-bottom:96px;display:flex;flex-wrap:wrap;gap:56px" id="rfq">
  <div style="flex:1 1 360px;min-width:0;display:flex;flex-direction:column;gap:28px">
    <p class="lede" style="margin:0;max-width:460px"><?= $intro !== '' ? e($intro) . ' ' : '' ?>The factory desk replies with a formal FOB quotation within two hours.</p>
    <div class="info-list">
      <div><span class="k">EXPORT DESK EMAIL</span><a class="v" href="mailto:<?= e($email) ?>"><?= e($email) ?></a></div>
      <div><span class="k">WHATSAPP / PHONE</span><span class="v"><a href="<?= e(phone_href($phone)) ?>"><?= e($phone) ?></a><?= $phone2 ? '<br><a href="' . e(phone_href($phone2)) . '">' . e($phone2) . '</a>' : '' ?></span></div>
      <div><span class="k">FACTORY ADDRESS</span><span class="v"><?= e($address) ?></span></div>
      <div><span class="k">QUOTE TURNAROUND</span><span class="v"><?= e(get_setting('quote_turnaround', 'Under 2 hours')) ?>, FOB quotation</span></div>
      <?php if ($ali = alibaba_links()): ?><div><span class="k">GOLD SUPPLIER ON ALIBABA</span><span class="v"><?php foreach ($ali as $i => $a): ?><?= $i ? '<br>' : '' ?><a href="<?= e($a['url']) ?>" target="_blank" rel="noopener"><?= e($a['label']) ?> &#8599;</a><?php endforeach; ?></span></div><?php endif; ?>
    </div>
    <a class="btn btn-ghost" style="align-self:flex-start" href="<?= e(whatsapp_link('Hello, I would like to inquire about contract manufacturing with ' . SITE_NAME . '.')) ?>" target="_blank" rel="noopener">Message on WhatsApp</a>
  </div>

  <div style="flex:1.2 1 460px;min-width:0;display:flex;flex-direction:column;gap:16px" id="rfq-result">
    <?php if ($result && $result['ok']): ?>
      <div class="notice ok" role="status"><strong>Request received.</strong> The factory desk will reply with a formal FOB quotation within two hours.</div>
    <?php else: ?>
      <?php if ($result): ?><div class="notice err" role="alert"><?= e($result['error']) ?></div><?php endif; ?>
      <?php require __DIR__ . '/sections/rfq-form.php'; ?>
    <?php endif; ?>
  </div>
</section>
