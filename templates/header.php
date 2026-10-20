<!DOCTYPE html>
<html class="scroll-smooth" lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($page_title ?? 'FARAAN IMPEX — Luxury Leather & Technical Garments Manufacturer | Sialkot') ?></title>
<meta name="description" content="<?= e($page_description ?? 'Faraan Impex — Direct B2B OEM/ODM contract manufacturer and exporter of premium leather garments, motorcycle apparel, and leather goods from Sialkot, Pakistan.') ?>">

<!-- Favicon & Touch Icons -->
<link rel="icon" type="image/png" sizes="32x32" href="/favicon.png">
<link rel="icon" type="image/x-icon" href="/favicon.ico">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">

<!-- Google Fonts: Inter (Sans), Space Mono -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Mono:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

<!-- Material Symbols Outlined -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

<!-- Tailwind CSS v3 via CDN configured with Luxury Editorial Tokens -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
tailwind.config = {
  theme: {
    extend: {
      colors: {
        paper: "#FCFBF8",
        ivory: "#F6F3ED",
        ink: "#0B1623",
        navy: "#10243B",
        navysoft: "#18324D",
        crimson: "#C51E28",
        "crimson-hover": "#A81822",
        carmine: "#C51E28",
        "carmine-hover": "#A81822",
        "body-text": "#17212B",
        muted: "#6B7580",
        line: "rgba(16, 36, 59, 0.12)",
        obsidian: "#0B0C0E",
        "text-muted": "#64748B",
        "text-dim": "#94A3B8"
      },
      fontFamily: {
        sans: ["Inter", "ui-sans-serif", "system-ui", "-apple-system", "sans-serif"],
        body: ["Inter", "ui-sans-serif", "system-ui", "-apple-system", "sans-serif"],
        headline: ["Georgia", "Times New Roman", "serif"],
        serif: ["Georgia", "Times New Roman", "serif"],
        mono: ["Space Mono", "monospace"]
      }
    }
  }
}
</script>
<link rel="stylesheet" href="/assets/css/main.css?v=<?= file_exists(__DIR__ . '/../assets/css/main.css') ? filemtime(__DIR__ . '/../assets/css/main.css') : '2.0' ?>">
</head>
<body class="bg-paper text-body-text antialiased font-body overflow-x-hidden min-w-[320px]">

<!-- 1. EDITORIAL B2B TOPLINE (STAGFIELD CALIBER) -->
<aside class="bg-[#070709] text-[#BFC9D2] border-b border-white/[0.08] text-[11px] font-sans select-none">
  <div class="max-w-[1440px] mx-auto min-h-[34px] px-4 sm:px-6 lg:px-12 flex items-center justify-between gap-4 tracking-[0.12em] uppercase">
    <!-- Brand Lineage / Direct Authority -->
    <div class="flex items-center gap-2 truncate min-w-0">
      <strong class="font-bold text-white tracking-[0.14em]">Faraan Impex</strong>
      <span class="text-white/30">·</span>
      <span class="truncate text-slate-300">Sialkot Factory &amp; Direct OEM/ODM Manufacturer</span>
    </div>

    <!-- Direct B2B Contact & Turnaround -->
    <div class="hidden md:flex items-center gap-3 shrink-0 text-[#BFC9D2]">
      <a class="flex items-center gap-1.5 hover:text-white transition-colors lowercase font-normal" href="mailto:<?= e(CONTACT_EMAIL) ?>">
        <span class="material-symbols-outlined text-[14px] text-crimson">mail</span>
        <span><?= e(CONTACT_EMAIL) ?></span>
      </a>
      <span class="text-white/30">·</span>
      <span class="text-slate-200">B2B Quote Turnaround: Under 2 Hours</span>
    </div>
  </div>
</aside>

<!-- 2. STAGFIELD-CALIBER EDITORIAL MAIN NAVBAR -->
<header class="sticky top-0 z-50 bg-[#FCFBF8]/95 backdrop-blur-md border-b border-[#10243B]/10 shadow-[0_4px_25px_rgba(8,18,29,0.03)] w-full transition-all duration-300">
  <div class="w-full px-4 sm:px-6 lg:px-12 flex items-center justify-between mx-auto h-20 max-w-[1440px]">
    <!-- Brand Official Logo -->
    <a class="flex items-center shrink-0 mr-4 lg:mr-8 group" href="/" aria-label="Faraan Impex Home">
      <img src="/assets/images/logo.png" alt="FARAAN IMPEX" class="h-10 sm:h-12 w-auto object-contain transition-transform group-hover:scale-[1.02]">
    </a>

    <!-- Center Navigation Links -->
    <div class="hidden xl:flex items-center space-x-7 text-[13.5px] font-sans font-bold text-[#2A3642]">
      <?php foreach (get_top_categories() as $cat): ?>
        <?php if ($cat['slug'] === 'uncategorized') continue; ?>
        <?php $subs = get_subcategories((int)$cat['id']); ?>
        <div class="relative group py-6">
          <a href="/<?= e($cat['slug']) ?>/" class="nav-link flex items-center gap-1 text-[#2A3642] group-hover:text-crimson transition-colors whitespace-nowrap">
            <span><?= e(ucwords(strtolower($cat['name']))) ?></span>
            <?php if ($subs): ?>
              <svg class="w-3.5 h-3.5 text-[#64748B] group-hover:text-crimson transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2"></path>
              </svg>
            <?php endif; ?>
          </a>
          
          <?php if ($subs): ?>
            <div class="absolute left-0 top-full pt-1 hidden group-hover:block min-w-[250px] z-50">
              <div class="bg-white rounded-xl p-3 shadow-[0_20px_50px_rgba(8,18,29,0.12)] border border-[#10243B]/10">
                <div class="text-[10px] text-[#64748B] px-3 py-1.5 border-b border-gray-100 uppercase tracking-widest font-bold">
                  <?= e($cat['name']) ?> Lines
                </div>
                <div class="mt-1 space-y-0.5">
                  <?php foreach ($subs as $sub): ?>
                    <a href="/<?= e($sub['slug']) ?>/" class="group/sub block px-3 py-2 rounded-lg text-[13px] text-[#2A3642] hover:text-crimson hover:bg-[#F6F3ED] transition-colors flex items-center justify-between font-medium">
                      <span><?= e($sub['name']) ?></span>
                      <span class="material-symbols-outlined text-[14px] text-crimson opacity-0 group-hover/sub:opacity-100 transition-opacity">arrow_forward</span>
                    </a>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>

      <div class="relative group py-6">
        <a class="nav-link text-[#2A3642] group-hover:text-crimson transition-colors whitespace-nowrap" href="/about-us">
          About Us
        </a>
      </div>

      <div class="relative group py-6">
        <a class="nav-link text-[#2A3642] group-hover:text-crimson transition-colors whitespace-nowrap" href="/contact-us">
          Contact
        </a>
      </div>
    </div>

    <!-- Right Header Action (Single Confident CTA like Stagfield) -->
    <div class="hidden sm:flex items-center shrink-0">
      <a class="inline-flex items-center justify-center bg-crimson hover:bg-crimson-hover text-white px-6 py-2.5 rounded-full font-bold text-[13px] tracking-wide shadow-sm hover:shadow-md transition-all duration-200 active:scale-[0.98]" href="/contact-us">
        <span>Request a Quote</span>
      </a>
    </div>

    <!-- Mobile Navigation Trigger (< xl) -->
    <div class="flex xl:hidden items-center gap-2">
      <a class="sm:hidden inline-flex items-center justify-center bg-crimson text-white px-4 py-2 rounded-full font-bold text-[12px] shadow-sm" href="/contact-us">
        Quote
      </a>
      <button id="mobile-menu-toggle" type="button" class="p-2 text-[#0B1623] hover:text-crimson focus:outline-none transition-colors" aria-label="Toggle Navigation">
        <svg class="w-6 h-6 fill-none stroke-current stroke-2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
    </div>
  </div>

  <!-- Mobile Dropdown Drawer -->
  <div id="mobile-menu" class="hidden xl:hidden bg-[#FCFBF8] border-b border-[#10243B]/10 px-6 py-6 space-y-3 font-sans font-bold text-[14px]">
    <?php foreach (get_top_categories() as $cat): ?>
      <?php if ($cat['slug'] === 'uncategorized') continue; ?>
      <a href="/<?= e($cat['slug']) ?>/" class="block py-2.5 text-[#2A3642] hover:text-crimson border-b border-gray-100 flex items-center justify-between">
        <span><?= e(ucwords(strtolower($cat['name']))) ?></span>
        <span class="text-[11px] text-[#64748B] font-mono"><?= (int)$cat['live_count'] ?> Styles</span>
      </a>
    <?php endforeach; ?>
    <a href="/about-us" class="block py-2.5 text-[#2A3642] hover:text-crimson border-b border-gray-100">About Us</a>
    <a href="/contact-us" class="block py-2.5 text-[#2A3642] hover:text-crimson border-b border-gray-100">Contact</a>
    <div class="pt-3">
      <a class="block text-center bg-crimson text-white py-3 rounded-full text-[13px] font-bold shadow-sm" href="/contact-us">
        Request a Quote
      </a>
    </div>
  </div>
</header>

<main class="w-full overflow-x-hidden">
