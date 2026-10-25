<?php
/** Server error (design: ServerError.dc.html). Standalone: must not touch the database. */
$email = defined('CONTACT_EMAIL') ? CONTACT_EMAIL : 'faraanimpex@gmail.com';
$wa = defined('WHATSAPP_NUMBER') ? WHATSAPP_NUMBER : '923327464484';
$phone = defined('CONTACT_PHONE') ? CONTACT_PHONE : '+92 332 7464484';
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Server error | FARAAN IMPEX</title>
<meta name="robots" content="noindex">
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500;600;700&family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/main.css">
</head>
<body>
<section class="solo">
  <div class="head"><a class="brand" href="/"><img src="/assets/images/logo-wordmark.png" alt="Faraan Impex" width="1306" height="330" style="height:52px;width:auto"></a></div>
  <div class="mid">
    <span class="eyebrow on-dark">ERROR 500 &middot; SERVER ERROR</span>
    <h1 class="h-display h-xl" style="max-width:900px">Something went wrong on our side</h1>
    <p>The page didn&rsquo;t load. Try again in a moment. If it keeps happening, message the factory desk and we&rsquo;ll sort it out.</p>
    <div class="hero-ctas">
      <a class="btn btn-primary" href="/">Reload the page</a>
      <a class="btn btn-light" href="https://wa.me/<?= htmlspecialchars($wa) ?>">WhatsApp <?= htmlspecialchars($phone) ?></a>
    </div>
  </div>
  <div class="foot"><span><?= htmlspecialchars($email) ?></span><span>&copy; <?= date('Y') ?> FARAAN IMPEX</span></div>
</section>
</body>
</html>
