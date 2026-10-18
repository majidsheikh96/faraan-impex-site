<!DOCTYPE html>
<html class="scroll-smooth" lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($page_title ?? 'FARAAN IMPEX — Luxury Leather & Technical Garments Manufacturer | Sialkot') ?></title>
<meta name="description" content="<?= e($page_description ?? 'Faraan Impex — Direct B2B OEM/ODM contract manufacturer and exporter of premium leather garments, motorcycle apparel, and leather goods from Sialkot, Pakistan.') ?>">

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
  darkMode: "class",
  theme: {
    extend: {
      colors: {
        "obsidian": "#0B0C0E",
        "surface-dark": "#121316",
        "surface-card": "#18191E",
        "surface-card-hover": "#22242B",
        "crimson": "#C51E28",
        "crimson-hover": "#A51820",
        "carmine": "#C51E28",
        "carmine-hover": "#A51820",
        "brass": "#C88A58",
        "studio": "#F9F9FB",
        "studio-card": "#FFFFFF",
        "border-subtle": "rgba(255, 255, 255, 0.08)",
        "border-light": "rgba(255, 255, 255, 0.15)",
        "text-muted": "#94A3B8",
        "text-dim": "#64748B"
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
<link rel="stylesheet" href="/assets/css/main.css">
</head>
<body class="bg-obsidian text-slate-100 antialiased font-body overflow-x-hidden min-w-[320px]">

<!-- 1. EDITORIAL B2B TOPLINE (STAGFIELD CALIBER) -->
<aside class="bg-[#07080A] text-[#BFC9D2] border-b border-white/[0.08] text-[11px] font-sans select-none">
  <div class="max-w-[1440px] mx-auto min-h-[36px] px-4 sm:px-6 lg:px-12 flex items-center justify-between gap-4 tracking-[0.12em] uppercase">
    <!-- Brand Lineage / Direct Authority -->
    <div class="flex items-center gap-2 truncate min-w-0">
      <strong class="font-bold text-white tracking-[0.14em]">Faraan Impex</strong>
      <span class="text-white/30">·</span>
      <span class="truncate text-slate-300">Sialkot Atelier &amp; Direct OEM Contractor</span>
    </div>

    <!-- Direct B2B Contact & Turnaround -->
    <div class="hidden md:flex items-center gap-3 shrink-0 text-[#BFC9D2]">
      <a class="flex items-center gap-1.5 hover:text-white transition-colors lowercase font-normal" href="mailto:<?= e(CONTACT_EMAIL) ?>">
        <span class="material-symbols-outlined text-[14px] text-carmine">mail</span>
        <span><?= e(CONTACT_EMAIL) ?></span>
      </a>
      <span class="text-white/30">·</span>
      <span class="text-slate-200">B2B Quote Turnaround: Under 2 Hours</span>
    </div>
  </div>
</aside>

<!-- 2. GLASSMORPHIC MAIN NAVBAR -->
<nav class="sticky top-0 z-50 bg-[#09090B]/95 backdrop-blur-xl border-b border-white/[0.08] shadow-2xl transition-all duration-300 w-full">
  <div class="w-full px-4 sm:px-6 lg:px-12 flex items-center justify-between mx-auto h-20 max-w-[1440px]">
    <!-- Brand Logo Wordmark with Atelier Heritage -->
    <a class="flex flex-col group shrink-0 mr-3 lg:mr-8" href="/">
      <div class="font-headline text-lg sm:text-2xl uppercase font-extrabold tracking-tight text-white flex items-center gap-1.5">
        <span>FARAAN</span>
        <span class="text-carmine group-hover:brightness-125 transition-all">IMPEX</span>
      </div>
      <span class="font-mono text-[8px] sm:text-[9px] uppercase tracking-[0.2em] sm:tracking-[0.25em] text-text-muted -mt-1 font-semibold">
        Sialkot Leatherworks · Est. 1998
      </span>
    </a>

    <!-- Center Navigation Links -->
    <div class="hidden xl:flex items-center space-x-4 2xl:space-x-7 text-[12px] 2xl:text-[13px] font-headline font-semibold uppercase tracking-wider text-slate-300">
      <?php foreach (get_top_categories() as $cat): ?>
        <?php if ($cat['slug'] === 'uncategorized') continue; ?>
        <?php $subs = get_subcategories((int)$cat['id']); ?>
        <div class="relative group cursor-pointer py-2">
          <a href="/<?= e($cat['slug']) ?>/" class="flex items-center gap-1.5 text-slate-300 group-hover:text-white transition-colors whitespace-nowrap">
            <span><?= e($cat['name']) ?></span>
            <?php if ($subs): ?>
              <svg class="w-3 h-3 text-carmine transform group-hover:rotate-180 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"></path>
              </svg>
            <?php endif; ?>
          </a>
          
          <?php if ($subs): ?>
            <div class="absolute left-0 top-full pt-3 hidden group-hover:block min-w-[260px] z-50">
              <div class="glass-card rounded-lg p-3 shadow-2xl border border-white/10 backdrop-blur-2xl">
                <div class="font-mono text-[10px] text-text-dim px-3 py-1.5 border-b border-white/5 uppercase tracking-widest font-bold">
                  <?= e($cat['name']) ?> Lines
                </div>
                <div class="mt-1 space-y-0.5">
                  <?php foreach ($subs as $sub): ?>
                    <a href="/<?= e($sub['slug']) ?>/" class="block px-3 py-2 rounded text-[13px] text-slate-300 hover:text-white hover:bg-white/[0.06] normal-case font-normal transition-colors flex items-center justify-between">
                      <span><?= e($sub['name']) ?></span>
                      <span class="material-symbols-outlined text-[14px] text-carmine opacity-0 group-hover:opacity-100 transition-opacity">arrow_forward</span>
                    </a>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
      <a class="text-slate-300 hover:text-white transition-colors py-2 whitespace-nowrap" href="/about-us">About Us</a>
      <a class="text-slate-300 hover:text-white transition-colors py-2 whitespace-nowrap" href="/contact-us">Contact Desk</a>
    </div>

    <!-- Right Header Action Cluster -->
    <div class="hidden sm:flex items-center gap-3 shrink-0">
      <a class="hidden 2xl:inline-flex items-center justify-center border border-white/15 bg-white/[0.03] hover:bg-white/[0.08] hover:border-carmine text-slate-200 px-4 py-2.5 font-headline font-semibold uppercase tracking-wider text-[12px] rounded transition-all duration-200" href="/contact-us">
        <span class="material-symbols-outlined text-[16px] mr-1.5 text-carmine">description</span>
        <span>Submit Tech Pack</span>
      </a>

      <!-- WhatsApp Direct B2B Desk -->
      <a class="inline-flex items-center gap-2 bg-[#25D366] hover:bg-[#20ba5a] text-white px-3.5 py-2.5 font-headline font-bold uppercase tracking-wider text-[11px] sm:text-[12px] rounded shadow-lg hover:shadow-[#25D366]/20 transition-all duration-200 active:scale-[0.98] whitespace-nowrap" href="<?= whatsapp_link("Assalam-o-Alaikum, I would like to inquire about contract manufacturing with Faraan Impex.") ?>" rel="noopener noreferrer" target="_blank">
        <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 24 24">
          <path d="M12.031 2C6.494 2 2 6.494 2 12.031c0 1.956.564 3.782 1.542 5.334L2 22l4.789-1.517c1.498.907 3.242 1.428 5.109 1.428 5.537 0 10.031-4.494 10.031-10.031S17.568 2 12.031 2zm5.727 14.195c-.241.677-1.391 1.296-1.928 1.341-.536.046-1.196.195-3.874-.912-3.238-1.339-5.321-4.664-5.483-4.88-.16-.217-1.309-1.745-1.309-3.328 0-1.583.829-2.361 1.123-2.684.294-.323.643-.404.858-.404.214 0 .429.003.616.012.198.01.463-.075.724.551.268.643.91 2.224.991 2.385.08.161.134.349.027.563-.107.215-.16.349-.321.536-.161.188-.338.419-.482.563-.161.16-.329.335-.141.658.188.322.836 1.378 1.794 2.231 1.233 1.096 2.274 1.436 2.595 1.597.321.161.509.134.696-.08.188-.215.804-.938 1.018-1.26.214-.322.429-.268.723-.161.295.107 1.874.884 2.196 1.045.321.161.536.241.616.375.08.134.08.777-.161 1.454z"></path>
        </svg>
        <span>B2B WhatsApp Desk</span>
      </a>
    </div>

    <!-- Mobile Navigation Trigger (< xl) -->
    <div class="flex xl:hidden items-center gap-2">
      <a class="sm:hidden inline-flex items-center justify-center p-2.5 bg-[#25D366] text-white rounded shadow-sm" href="<?= whatsapp_link("Assalam-o-Alaikum, I'd like to enquire about your products.") ?>" target="_blank" rel="noopener">
        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
          <path d="M12.031 2C6.494 2 2 6.494 2 12.031c0 1.956.564 3.782 1.542 5.334L2 22l4.789-1.517c1.498.907 3.242 1.428 5.109 1.428 5.537 0 10.031-4.494 10.031-10.031S17.568 2 12.031 2zm5.727 14.195c-.241.677-1.391 1.296-1.928 1.341-.536.046-1.196.195-3.874-.912-3.238-1.339-5.321-4.664-5.483-4.88-.16-.217-1.309-1.745-1.309-3.328 0-1.583.829-2.361 1.123-2.684.294-.323.643-.404.858-.404.214 0 .429.003.616.012.198.01.463-.075.724.551.268.643.91 2.224.991 2.385.08.161.134.349.027.563-.107.215-.16.349-.321.536-.161.188-.338.419-.482.563-.161.16-.329.335-.141.658.188.322.836 1.378 1.794 2.231 1.233 1.096 2.274 1.436 2.595 1.597.321.161.509.134.696-.08.188-.215.804-.938 1.018-1.26.214-.322.429-.268.723-.161.295.107 1.874.884 2.196 1.045.321.161.536.241.616.375.08.134.08.777-.161 1.454z"></path>
        </svg>
      </a>
      <button id="mobile-menu-toggle" type="button" class="p-2 text-white hover:text-carmine focus:outline-none transition-colors" aria-label="Toggle Navigation">
        <svg class="w-6 h-6 fill-none stroke-current stroke-2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
    </div>
  </div>

  <!-- Mobile Dropdown Drawer -->
  <div id="mobile-menu" class="hidden xl:hidden bg-[#0C0C0F] border-b border-white/10 px-6 py-6 space-y-3 font-headline uppercase font-bold text-[13px]">
    <?php foreach (get_top_categories() as $cat): ?>
      <?php if ($cat['slug'] === 'uncategorized') continue; ?>
      <a href="/<?= e($cat['slug']) ?>/" class="block py-2.5 text-slate-300 hover:text-carmine border-b border-white/5 flex items-center justify-between">
        <span><?= e($cat['name']) ?></span>
        <span class="font-mono text-[11px] text-text-dim"><?= (int)$cat['live_count'] ?> Styles</span>
      </a>
    <?php endforeach; ?>
    <a href="/about-us" class="block py-2.5 text-slate-300 hover:text-carmine border-b border-white/5">About Atelier</a>
    <a href="/contact-us" class="block py-2.5 text-slate-300 hover:text-carmine border-b border-white/5">Factory Contact</a>
    <div class="pt-3 flex flex-col gap-2.5">
      <a class="block text-center border border-white/15 text-white py-3 rounded text-[12px] font-semibold hover:border-carmine transition-colors" href="/contact-us">
        Submit Tech Pack &amp; Inquiry
      </a>
      <a class="block text-center bg-[#25D366] text-white py-3 rounded text-[12px] font-bold shadow-md" href="<?= whatsapp_link("Assalam-o-Alaikum, I'd like to enquire about your products.") ?>" target="_blank" rel="noopener">
        Direct WhatsApp Concierge
      </a>
    </div>
  </div>
</nav>

<main class="w-full overflow-x-hidden">
