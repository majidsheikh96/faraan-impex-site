<?php
$siteName = get_setting('site_name', SITE_NAME);
try { $topCats = get_top_categories(); } catch (Throwable $e) { $topCats = []; }
$waNumber = get_setting('whatsapp_number', WHATSAPP_NUMBER);
$contactEmail = get_setting('contact_email', CONTACT_EMAIL);
$contactPhone = phone_display(get_setting('contact_phone', CONTACT_PHONE));
$cssFile = __DIR__ . '/../assets/css/main.css';
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($page_title ?? ($siteName . ' — OEM / ODM Leather Garments Manufacturer, Sialkot')) ?></title>
<meta name="description" content="<?= e($page_description ?? ($siteName . ' — OEM / ODM manufacturer and exporter of leather garments, motorcycle apparel, technical textiles and western wear from Sialkot, Pakistan.')) ?>">

<link rel="icon" type="image/png" sizes="32x32" href="/favicon.png">
<link rel="icon" type="image/x-icon" href="/favicon.ico">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500;600;700&family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">

<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = { theme: { extend: {
  colors: { accent: '#C8102E', ink: '#0D0D0D', paper: '#F4F3F1', line: '#D9D7D3', muted: '#565656', 'red-dark': '#FF5C61' },
  fontFamily: { display: ['Barlow Condensed', 'sans-serif'], sans: ['IBM Plex Sans', 'system-ui', 'sans-serif'], mono: ['IBM Plex Mono', 'monospace'] }
} } };
</script>
<script>document.documentElement.classList.add('js')</script>
<link rel="stylesheet" href="/assets/css/main.css?v=<?= is_file($cssFile) ? filemtime($cssFile) : '1' ?>">
</head>
<body>

<div class="topbar">
  <div class="wrap">
    <a class="tb-quote" href="/contact-us">B2B QUOTE TURNAROUND &middot; <?= e(strtoupper(get_setting('quote_turnaround', 'UNDER 2 HOURS'))) ?></a>
    <span class="tb-contact">
      <a href="<?= e(whatsapp_link('Hello, I would like to inquire about contract manufacturing with ' . $siteName . '.')) ?>" target="_blank" rel="noopener" aria-label="WhatsApp <?= e($contactPhone) ?>">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12.03 2C6.5 2 2 6.49 2 12.03c0 1.96.56 3.78 1.54 5.33L2 22l4.79-1.52a10 10 0 0 0 5.11 1.43C17.44 21.91 22 17.42 22 11.88 22 6.49 17.57 2 12.03 2Zm5.73 14.2c-.24.68-1.39 1.3-1.93 1.34-.54.05-1.2.2-3.87-.91-3.24-1.34-5.32-4.66-5.48-4.88-.16-.22-1.31-1.75-1.31-3.33s.83-2.36 1.12-2.68c.3-.32.64-.4.86-.4h.62c.2.01.46-.07.72.55.27.64.91 2.22.99 2.38.08.16.14.35.03.56-.1.22-.16.35-.32.54-.16.19-.34.42-.48.56-.16.16-.33.34-.14.66.19.32.84 1.38 1.8 2.23 1.23 1.1 2.27 1.44 2.59 1.6.32.16.51.13.7-.08.19-.22.8-.94 1.02-1.26.21-.32.43-.27.72-.16.3.11 1.87.88 2.2 1.04.32.16.54.24.62.38.08.13.08.78-.16 1.46Z"/></svg>
        <span>WhatsApp <?= e($contactPhone) ?></span>
      </a>
      <span class="tb-sep" aria-hidden="true">&middot;</span>
      <a href="mailto:<?= e($contactEmail) ?>" aria-label="Email <?= e($contactEmail) ?>">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="1"/><path d="m3 7 9 6 9-6"/></svg>
        <span><?= e($contactEmail) ?></span>
      </a>
    </span>
  </div>
</div>


<header class="site-header">
  <div class="wrap">
    <div style="display:flex;flex-direction:column;gap:3px">
      <a class="brand" href="/" aria-label="<?= e($siteName) ?> home">
        <img src="/assets/images/logo-wordmark.png" alt="<?= e($siteName) ?>" width="1306" height="330" style="height:44px;width:auto">
      </a>
      <?php $tagline = get_setting('topbar_tagline', 'Sialkot Factory & Direct OEM/ODM Manufacturer'); if ($tagline): ?><span style="font-size:10px;letter-spacing:.07em;color:var(--muted);text-transform:uppercase;font-weight:500;padding-left:2px"><?= e($tagline) ?></span><?php endif; ?>
    </div>

    <nav class="nav" aria-label="Primary">
      <?php foreach ($topCats as $cat):
        $subs = get_subcategories((int)$cat['id']);
        [$headline, $blurb] = division_blurb($cat);
        $lines = $subs ? count($subs) : 0;
      ?>
        <div class="dd">
          <a class="dd-trigger" href="/<?= e($cat['slug']) ?>/"><?= e(display_name($cat['name'])) ?>
            <?php if ($subs): ?><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 9l7 7 7-7"/></svg><?php endif; ?>
          </a>
          <?php if ($subs): ?>
          <div class="dd-panel">
            <div class="wrap">
              <div class="dd-inner">
                <div class="dd-lead">
                  <span class="eyebrow on-dark"><?= str_pad((string)$lines, 2, '0', STR_PAD_LEFT) ?> PRODUCT LINES</span>
                  <span class="big"><?= e($headline) ?></span>
                  <p><?= e($blurb) ?></p>
                  <a class="btn btn-primary" href="/<?= e($cat['slug']) ?>/"><span>View all <?= e(display_name($cat['name'])) ?></span><?= icon_arrow() ?></a>
                </div>
                <div class="dd-links">
                  <?php foreach ($subs as $sub): ?>
                    <a class="dd-link" href="/<?= e($sub['slug']) ?>/"><span><?= e(display_name($sub['name'])) ?></span><?= icon_arrow() ?></a>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
      <a class="dd-trigger" href="/about-us">About</a>
      <a class="dd-trigger" href="/contact-us">Contact</a>
    </nav>

    <a class="btn btn-primary hdr-cta" href="/contact-us" style="padding:13px 24px">Request a quote</a>

    <!-- Mobile drawer: pure <details>, no JavaScript -->
    <details class="m-menu">
      <summary aria-label="Menu"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"/></svg></summary>
      <div class="m-drawer">
        <?php foreach ($topCats as $cat): $subs = get_subcategories((int)$cat['id']); ?>
          <?php if ($subs): ?>
            <details class="m-sub">
              <summary><span><?= e(display_name($cat['name'])) ?></span><small class="mono" style="font-size:11.5px;color:var(--muted);font-weight:400"><?= count($subs) ?> lines</small></summary>
              <a href="/<?= e($cat['slug']) ?>/" style="font-weight:600">All <?= e(display_name($cat['name'])) ?></a>
              <?php foreach ($subs as $sub): ?><a href="/<?= e($sub['slug']) ?>/"><?= e(display_name($sub['name'])) ?></a><?php endforeach; ?>
            </details>
          <?php else: ?>
            <a class="m-row" href="/<?= e($cat['slug']) ?>/"><span><?= e(display_name($cat['name'])) ?></span></a>
          <?php endif; ?>
        <?php endforeach; ?>
        <a class="m-row" href="/about-us"><span>About</span></a>
        <a class="m-row" href="/contact-us"><span>Contact</span></a>
        <a class="btn btn-primary" href="/contact-us" style="margin-top:16px;width:100%">Request a quote</a>
      </div>
    </details>
  </div>
</header>

<main>
