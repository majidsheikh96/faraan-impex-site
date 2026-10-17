<!DOCTYPE html>
<html class="scroll-smooth" lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($page_title ?? 'FARAAN IMPEX — Leather & Textile Garments Manufacturer | Sialkot, Pakistan') ?></title>
<meta name="description" content="<?= e($page_description ?? 'Faraan Impex — Sialkot-based manufacturer & exporter of premium leather garments, textile wears and leather products. B2B wholesale, custom OEM orders welcome.') ?>">

<!-- Google Fonts: Plus Jakarta Sans, Work Sans, Space Mono -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Space+Mono:wght@400;700&family=Work+Sans:wght@400;500;600&display=swap" rel="stylesheet">

<!-- Material Symbols Outlined -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

<!-- Tailwind CSS v3 via CDN configured with Google Stitch Design Tokens -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
tailwind.config = {
  darkMode: "class",
  theme: {
    extend: {
      colors: {
        "primary": "#110603",
        "primary-container": "#2B1D16",
        "on-primary": "#ffffff",
        "on-primary-container": "#998379",
        "on-primary-fixed": "#261812",
        "on-primary-fixed-variant": "#54433b",
        "primary-fixed": "#f7ddd2",
        "primary-fixed-dim": "#dac1b6",
        "secondary": "#C67B3C",
        "secondary-hover": "#b56e33",
        "secondary-container": "#fda865",
        "on-secondary": "#ffffff",
        "on-secondary-container": "#753c00",
        "secondary-fixed": "#ffdcc4",
        "secondary-fixed-dim": "#ffb780",
        "tertiary": "#140600",
        "tertiary-container": "#361900",
        "surface": "#FAF7F2",
        "surface-bright": "#fcf9f4",
        "surface-dim": "#dcdad5",
        "surface-variant": "#e5e2dd",
        "surface-container": "#f0ede9",
        "surface-container-low": "#f6f3ee",
        "surface-container-lowest": "#ffffff",
        "surface-container-high": "#ebe8e3",
        "surface-container-highest": "#e5e2dd",
        "surface-tint": "#6d5a51",
        "background": "#FAF7F2",
        "on-surface": "#1c1c19",
        "on-surface-variant": "#4f4540",
        "outline": "#807570",
        "outline-variant": "#d2c4be",
        "error": "#ba1a1a"
      },
      borderRadius: {
        "DEFAULT": "0.25rem",
        "sm": "0.125rem",
        "md": "0.375rem",
        "lg": "0.5rem",
        "xl": "0.75rem",
        "full": "9999px"
      },
      fontFamily: {
        sans: ["Work Sans", "sans-serif"],
        headline: ["Plus Jakarta Sans", "sans-serif"],
        body: ["Work Sans", "sans-serif"],
        mono: ["Space Mono", "monospace"]
      }
    }
  }
}
</script>
<link rel="stylesheet" href="/assets/css/main.css">
</head>
<body class="bg-background text-on-surface antialiased font-body">

<!-- 1. TOPBAR (Thin dark espresso strip #2B1D16, off-white text) -->
<header class="bg-primary-container text-surface border-b border-on-primary-fixed-variant/30 text-[13px] py-2 px-6 lg:px-12 select-none">
  <div class="max-w-[1440px] mx-auto flex items-center justify-between font-mono">
    <a class="flex items-center gap-2 text-surface/90 hover:text-secondary-fixed transition-colors" href="mailto:<?= e(CONTACT_EMAIL) ?>">
      <svg class="w-4 h-4 fill-current text-secondary-container" viewBox="0 0 24 24">
        <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"></path>
      </svg>
      <span class="tracking-wide"><?= e(CONTACT_EMAIL) ?></span>
    </a>
    <div class="text-surface-variant font-medium tracking-wide hidden sm:block">
      OEM &amp; Private Label Services Available
    </div>
  </div>
</header>

<!-- 2. NAVBAR (Clean single horizontal bar, bold sans-serif) -->
<nav class="sticky top-0 z-50 bg-surface/98 backdrop-blur-md border-b border-outline-variant shadow-sm">
  <div class="w-full px-6 lg:px-12 flex items-center justify-between mx-auto h-20 max-w-[1440px] flex-nowrap whitespace-nowrap">
    <!-- Brand Logo Wordmark -->
    <a class="font-headline text-2xl uppercase font-bold tracking-tight text-primary flex-shrink-0" href="/">
      FARAAN <span class="text-secondary">IMPEX</span>
    </a>

    <!-- Center Nav: Categories + About Us + Contact Us -->
    <div class="hidden xl:flex items-center space-x-7 text-[14px] font-headline font-bold uppercase tracking-wider text-on-surface-variant flex-shrink-0">
      <?php foreach (get_top_categories() as $cat): ?>
        <?php $subs = get_subcategories((int)$cat['id']); ?>
        <div class="relative group cursor-pointer flex items-center gap-1.5 py-2 hover:text-secondary transition-colors">
          <a href="/<?= e($cat['slug']) ?>/" class="hover:text-secondary"><?= e($cat['name']) ?></a>
          <?php if ($subs): ?>
            <svg class="w-3.5 h-3.5 text-on-surface-variant transform group-hover:rotate-180 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
            </svg>
            <div class="absolute left-0 top-full hidden group-hover:block bg-surface-container-lowest shadow-xl border border-outline-variant rounded p-4 min-w-[240px] z-50">
              <?php foreach ($subs as $sub): ?>
                <a href="/<?= e($sub['slug']) ?>/" class="block px-3 py-2 rounded text-[13px] hover:bg-surface-container hover:text-secondary normal-case font-normal"><?= e($sub['name']) ?></a>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
      <a class="hover:text-secondary transition-colors py-2" href="/about-us">About Us</a>
      <a class="hover:text-secondary transition-colors py-2" href="/contact-us">Contact Us</a>
    </div>

    <!-- Action Buttons -->
    <div class="flex items-center gap-3 flex-shrink-0">
      <a class="hidden sm:inline-flex items-center justify-center border border-primary text-primary px-4 py-2.5 font-headline font-semibold uppercase tracking-wider text-[13px] hover:bg-surface-container transition-all duration-150 rounded" href="/contact-us">
        Request Catalog
      </a>
      <a class="inline-flex items-center gap-2 bg-[#25D366] text-white px-4 py-2.5 font-headline font-semibold uppercase tracking-wider text-[13px] rounded shadow-sm hover:brightness-105 active:scale-[0.98] transition-all" href="<?= whatsapp_link("Assalam-o-Alaikum, I'd like to enquire about your products.") ?>" rel="noopener noreferrer" target="_blank">
        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
          <path d="M12.031 2C6.494 2 2 6.494 2 12.031c0 1.956.564 3.782 1.542 5.334L2 22l4.789-1.517c1.498.907 3.242 1.428 5.109 1.428 5.537 0 10.031-4.494 10.031-10.031S17.568 2 12.031 2zm5.727 14.195c-.241.677-1.391 1.296-1.928 1.341-.536.046-1.196.195-3.874-.912-3.238-1.339-5.321-4.664-5.483-4.88-.16-.217-1.309-1.745-1.309-3.328 0-1.583.829-2.361 1.123-2.684.294-.323.643-.404.858-.404.214 0 .429.003.616.012.198.01.463-.075.724.551.268.643.91 2.224.991 2.385.08.161.134.349.027.563-.107.215-.16.349-.321.536-.161.188-.338.419-.482.563-.161.16-.329.335-.141.658.188.322.836 1.378 1.794 2.231 1.233 1.096 2.274 1.436 2.595 1.597.321.161.509.134.696-.08.188-.215.804-.938 1.018-1.26.214-.322.429-.268.723-.161.295.107 1.874.884 2.196 1.045.321.161.536.241.616.375.08.134.08.777-.161 1.454z"></path>
        </svg>
        <span>WhatsApp Inquiry</span>
      </a>
    </div>
  </div>
</nav>

<main>
