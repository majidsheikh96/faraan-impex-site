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

<!-- Tailwind CSS v3 via CDN configured with Google Stitch Red & Black Design Tokens -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
tailwind.config = {
  darkMode: "class",
  theme: {
    extend: {
      colors: {
        "brand-red": "#E10600",
        "brand-red-hover": "#b80500",
        "dark-bg": "#0A0A0A",
        "dark-surface": "#141414",
        "dark-card": "#1F1F1F",
        "dark-border": "#262626",
        "dark-border-light": "#3E3E3E",
        "primary": "#110603",
        "primary-container": "#0A0A0A",
        "secondary": "#E10600",
        "secondary-hover": "#b80500",
        "surface": "#FCF9F4",
        "surface-container": "#F0EDE9",
        "surface-container-low": "#F6F3EE",
        "surface-container-high": "#EBE8E3",
        "background": "#FCF9F4",
        "on-surface": "#1C1C19",
        "on-surface-variant": "#4F4540",
        "outline-variant": "#D2C4BE"
      },
      borderRadius: {
        "DEFAULT": "0.125rem",
        "sm": "0.125rem",
        "md": "0.25rem",
        "lg": "0.375rem",
        "xl": "0.5rem",
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
<body class="bg-[#FCF9F4] text-[#1C1C19] antialiased font-body overflow-x-hidden min-w-[320px]">

<!-- 1. TOPBAR (Solid Dark Black #0A0A0A strip, Red Accent, off-white text) -->
<header class="text-[#E5E2E1] border-b border-[#262626] text-[12px] sm:text-[13px] py-2 px-4 sm:px-6 lg:px-12 select-none" style="background-color: #0A0A0A;">
  <div class="max-w-[1440px] mx-auto flex items-center justify-between font-mono">
    <a class="flex items-center gap-2 text-[#E5E2E1]/80 hover:text-white transition-colors truncate" href="mailto:<?= e(CONTACT_EMAIL) ?>">
      <svg class="w-4 h-4 fill-current text-[#E10600] shrink-0" viewBox="0 0 24 24">
        <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"></path>
      </svg>
      <span class="tracking-wide truncate"><?= e(CONTACT_EMAIL) ?></span>
    </a>
    <div class="text-[#9E9E9E] font-medium tracking-wide hidden md:flex items-center gap-2 shrink-0">
      <span class="w-1.5 h-1.5 rounded-full bg-[#E10600] animate-pulse"></span>
      <span>OEM &amp; Private Label Services Available</span>
    </div>
  </div>
</header>

<!-- 2. NAVBAR (Solid Dark #141414 bar, FARAAN IMPEX Red & White brand) -->
<nav class="sticky top-0 z-50 border-b border-[#262626] shadow-md" style="background-color: #141414;">
  <div class="w-full px-4 sm:px-6 lg:px-12 flex items-center justify-between mx-auto h-20 max-w-[1440px]">
    <!-- Brand Logo Wordmark -->
    <a class="font-headline text-xl sm:text-2xl uppercase font-extrabold tracking-tight text-white shrink-0 flex items-center gap-1.5 mr-4 lg:mr-8" href="/">
      <span>FARAAN</span><span class="text-[#E10600]">IMPEX</span>
    </a>

    <!-- Center Nav: 4 Core Categories + About Us + Contact Us -->
    <div class="hidden xl:flex items-center space-x-4 2xl:space-x-7 text-[13px] 2xl:text-[14px] font-headline font-bold uppercase tracking-wider text-[#A0A0A0]">
      <?php foreach (get_top_categories() as $cat): ?>
        <?php if ($cat['slug'] === 'uncategorized') continue; ?>
        <?php $subs = get_subcategories((int)$cat['id']); ?>
        <div class="relative group cursor-pointer flex items-center gap-1 py-2 hover:text-white transition-colors">
          <a href="/<?= e($cat['slug']) ?>/" class="hover:text-white whitespace-nowrap"><?= e($cat['name']) ?></a>
          <?php if ($subs): ?>
            <svg class="w-3.5 h-3.5 text-[#E10600] transform group-hover:rotate-180 transition-transform duration-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
            </svg>
            <div class="absolute left-0 top-full hidden group-hover:block bg-[#1F1F1F] shadow-2xl border border-[#262626] rounded p-4 min-w-[240px] z-50">
              <?php foreach ($subs as $sub): ?>
                <a href="/<?= e($sub['slug']) ?>/" class="block px-3 py-2 rounded text-[13px] text-[#D1D1D1] hover:bg-[#2A2A2A] hover:text-[#E10600] normal-case font-normal transition-colors"><?= e($sub['name']) ?></a>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
      <a class="hover:text-[#E10600] transition-colors py-2 whitespace-nowrap" href="/about-us">About Us</a>
      <a class="hover:text-[#E10600] transition-colors py-2 whitespace-nowrap" href="/contact-us">Contact Us</a>
    </div>

    <!-- Right Action Buttons -->
    <div class="hidden sm:flex items-center gap-3 shrink-0">
      <a class="hidden 2xl:inline-flex items-center justify-center border border-[#3E3E3E] text-white px-3.5 py-2 font-headline font-bold uppercase tracking-wider text-[12px] hover:border-[#E10600] hover:text-[#E10600] transition-all rounded" href="/contact-us">
        Catalog
      </a>
      <a class="inline-flex items-center gap-2 bg-[#25D366] text-white px-3.5 py-2 font-headline font-bold uppercase tracking-wider text-[12px] 2xl:text-[13px] rounded shadow-sm hover:brightness-105 active:scale-[0.98] transition-all" href="<?= whatsapp_link("Assalam-o-Alaikum, I'd like to enquire about your products.") ?>" rel="noopener noreferrer" target="_blank">
        <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 24 24">
          <path d="M12.031 2C6.494 2 2 6.494 2 12.031c0 1.956.564 3.782 1.542 5.334L2 22l4.789-1.517c1.498.907 3.242 1.428 5.109 1.428 5.537 0 10.031-4.494 10.031-10.031S17.568 2 12.031 2zm5.727 14.195c-.241.677-1.391 1.296-1.928 1.341-.536.046-1.196.195-3.874-.912-3.238-1.339-5.321-4.664-5.483-4.88-.16-.217-1.309-1.745-1.309-3.328 0-1.583.829-2.361 1.123-2.684.294-.323.643-.404.858-.404.214 0 .429.003.616.012.198.01.463-.075.724.551.268.643.91 2.224.991 2.385.08.161.134.349.027.563-.107.215-.16.349-.321.536-.161.188-.338.419-.482.563-.161.16-.329.335-.141.658.188.322.836 1.378 1.794 2.231 1.233 1.096 2.274 1.436 2.595 1.597.321.161.509.134.696-.08.188-.215.804-.938 1.018-1.26.214-.322.429-.268.723-.161.295.107 1.874.884 2.196 1.045.321.161.536.241.616.375.08.134.08.777-.161 1.454z"></path>
        </svg>
        <span class="hidden md:inline">WhatsApp Inquiry</span>
        <span class="md:hidden">WhatsApp</span>
      </a>
    </div>

    <!-- Mobile Navigation Toggle (< xl) -->
    <div class="flex xl:hidden items-center gap-2">
      <a class="sm:hidden inline-flex items-center justify-center p-2 bg-[#25D366] text-white rounded shadow-sm" href="<?= whatsapp_link("Assalam-o-Alaikum, I'd like to enquire about your products.") ?>" target="_blank" rel="noopener">
        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
          <path d="M12.031 2C6.494 2 2 6.494 2 12.031c0 1.956.564 3.782 1.542 5.334L2 22l4.789-1.517c1.498.907 3.242 1.428 5.109 1.428 5.537 0 10.031-4.494 10.031-10.031S17.568 2 12.031 2zm5.727 14.195c-.241.677-1.391 1.296-1.928 1.341-.536.046-1.196.195-3.874-.912-3.238-1.339-5.321-4.664-5.483-4.88-.16-.217-1.309-1.745-1.309-3.328 0-1.583.829-2.361 1.123-2.684.294-.323.643-.404.858-.404.214 0 .429.003.616.012.198.01.463-.075.724.551.268.643.91 2.224.991 2.385.08.161.134.349.027.563-.107.215-.16.349-.321.536-.161.188-.338.419-.482.563-.161.16-.329.335-.141.658.188.322.836 1.378 1.794 2.231 1.233 1.096 2.274 1.436 2.595 1.597.321.161.509.134.696-.08.188-.215.804-.938 1.018-1.26.214-.322.429-.268.723-.161.295.107 1.874.884 2.196 1.045.321.161.536.241.616.375.08.134.08.777-.161 1.454z"></path>
        </svg>
      </a>
      <button id="mobile-menu-toggle" type="button" class="p-2 text-white hover:text-[#E10600] focus:outline-none" aria-label="Toggle Navigation">
        <svg class="w-6 h-6 fill-none stroke-current stroke-2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
    </div>
  </div>

  <!-- Mobile Dropdown Drawer -->
  <div id="mobile-menu" class="hidden xl:hidden border-b border-[#262626] px-6 py-5 space-y-3 font-headline uppercase font-bold text-[13px]" style="background-color: #0A0A0A;">
    <?php foreach (get_top_categories() as $cat): ?>
      <?php if ($cat['slug'] === 'uncategorized') continue; ?>
      <a href="/<?= e($cat['slug']) ?>/" class="block py-2 text-[#D1D1D1] hover:text-[#E10600] border-b border-white/5"><?= e($cat['name']) ?></a>
    <?php endforeach; ?>
    <a href="/about-us" class="block py-2 text-[#D1D1D1] hover:text-[#E10600] border-b border-white/5">About Us</a>
    <a href="/contact-us" class="block py-2 text-[#D1D1D1] hover:text-[#E10600] border-b border-white/5">Contact Us</a>
    <div class="pt-3 flex flex-col gap-2">
      <a class="block text-center border border-[#3E3E3E] text-white py-2.5 rounded text-[12px] hover:border-[#E10600]" href="/contact-us">Request Catalog</a>
      <a class="block text-center bg-[#25D366] text-white py-2.5 rounded text-[12px] font-bold" href="<?= whatsapp_link("Assalam-o-Alaikum, I'd like to enquire about your products.") ?>" target="_blank" rel="noopener">WhatsApp Inquiry</a>
    </div>
  </div>
</nav>

<main class="w-full overflow-x-hidden">
