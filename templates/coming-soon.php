<?php
/** Coming Soon (design: ComingSoon.dc.html). Rendered standalone by coming_soon_check(); no header/footer. */
declare(strict_types=1);

$siteName = get_setting('site_name', SITE_NAME);
$launch = get_setting('coming_soon_date', '');
$title = get_setting('coming_soon_title', 'Something is being cut to spec');
$lead = get_setting('coming_soon_lead', 'Our new catalog of leather garments, motorcycle apparel, technical textiles and western wear is on its way. Quotes are still open, and the factory desk replies in under two hours.');
$email = get_setting('contact_email', CONTACT_EMAIL);
$phone = phone_display(get_setting('contact_phone', CONTACT_PHONE));
$phone2 = phone_display(get_setting('contact_phone_2', CONTACT_PHONE_2));
$secretKey = get_setting('coming_soon_key', 'faraan');
$hasError = !empty($GLOBALS['coming_soon_error']);
$bg = '/assets/images/hero-leather-atelier.jpg';
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($siteName) ?> — Launching Soon</title>
<meta name="description" content="<?= e($lead) ?>">
<meta name="robots" content="noindex, nofollow">
<link rel="icon" type="image/png" href="/favicon.png">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500;600;700&family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/main.css?v=<?= (int)@filemtime(__DIR__ . '/../assets/css/main.css') ?>">
</head>
<body>
<section class="solo">
  <div class="bgimg"><img src="<?= e($bg) ?>" alt=""></div>
  <div class="head">
    <a class="brand" href="/"><img src="/assets/images/logo-wordmark.png" alt="<?= e($siteName) ?>" width="1306" height="330" style="height:52px;width:auto"></a>
    <button type="button" class="btn btn-light" style="padding:10px 18px;font-size:14px" onclick="document.getElementById('vip').hidden=false">Preview access</button>
  </div>
  <div class="mid">
    <span class="eyebrow on-dark">NEW WEBSITE<?= $launch !== '' ? ' &middot; LAUNCHING ' . e(strtoupper($launch)) : '' ?></span>
    <h1 class="h-display h-xl" style="max-width:900px"><?= e($title) ?></h1>
    <p><?= e($lead) ?></p>
    <div class="hero-ctas">
      <a class="btn btn-primary" href="<?= e(whatsapp_link('Hello, I would like to inquire about contract manufacturing with ' . $siteName . '.')) ?>">Message the factory desk</a>
      <a class="btn btn-light" href="mailto:<?= e($email) ?>"><?= e($email) ?></a>
    </div>
  </div>
  <div class="foot"><span>WhatsApp <?= e($phone) ?><?= $phone2 ? ' &middot; ' . e($phone2) : '' ?></span><span>&copy; <?= date('Y') ?> <?= e(strtoupper($siteName)) ?></span></div>

  <div class="modal" id="vip" <?= $hasError ? '' : 'hidden' ?>>
    <div class="box" role="dialog" aria-label="Preview access">
      <span class="eyebrow">PREVIEW ACCESS</span>
      <?php if ($hasError): ?><div class="notice err" role="alert"><?= e($GLOBALS['coming_soon_error']) ?></div><?php endif; ?>
      <form method="get" action="/" style="display:flex;flex-direction:column;gap:14px">
        <div class="field"><label for="pw">Passcode</label><input id="pw" type="text" name="preview" value="<?= e($hasError ? '' : $secretKey) ?>" required></div>
        <button class="btn btn-primary" type="submit">Enter site</button>
        <button class="btn btn-ghost" type="button" onclick="document.getElementById('vip').hidden=true">Cancel</button>
      </form>
    </div>
  </div>
</section>
</body>
</html>
