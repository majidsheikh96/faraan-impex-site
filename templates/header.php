<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($page_title ?? 'Faraan Impex — Premium Leather Garments Manufacturer & Exporter, Sialkot') ?></title>
<meta name="description" content="<?= e($page_description ?? 'Faraan Impex — Sialkot-based manufacturer & exporter of premium leather garments, textile wears and leather products. B2B wholesale, custom OEM orders welcome.') ?>">
<link rel="stylesheet" href="/assets/css/main.css">
</head>
<body class="bg-[#FAF7F2] text-[#0A0A0A] font-sans antialiased">

<!-- Top utility bar -->
<div class="bg-[#0A0A0A] text-[#FAF7F2]/90 text-xs">
  <div class="max-w-7xl mx-auto px-4 py-2 flex justify-between items-center">
    <a href="mailto:<?= e(CONTACT_EMAIL) ?>" class="flex items-center gap-2 hover:text-[#E10600]">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
      <?= e(CONTACT_EMAIL) ?>
    </a>
    <span class="hidden sm:inline tracking-wide">OEM &amp; Private Label Services Available</span>
  </div>
</div>

<!-- Main navbar -->
<header class="sticky top-0 z-50 bg-[#FAF7F2]/95 backdrop-blur border-b border-[#0A0A0A]/10">
  <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between gap-6">
    <a href="/" class="text-2xl font-extrabold tracking-tight whitespace-nowrap">
      FARAAN <span class="text-[#E10600]">IMPEX</span>
    </a>
    <nav class="hidden lg:flex items-center gap-7 text-[15px] font-medium whitespace-nowrap">
      <?php foreach (get_top_categories() as $cat): ?>
        <div class="relative group">
          <a href="/<?= e($cat['slug']) ?>/" class="hover:text-[#E10600] flex items-center gap-1 py-2">
            <?= e($cat['name']) ?>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
          </a>
          <?php $subs = get_subcategories((int)$cat['id']); ?>
          <?php if ($subs): ?>
          <div class="absolute left-0 top-full hidden group-hover:block bg-white shadow-xl border border-[#0A0A0A]/10 rounded-lg p-4 min-w-[220px]">
            <?php foreach ($subs as $sub): ?>
              <a href="/<?= e($sub['slug']) ?>/" class="block px-3 py-2 rounded hover:bg-[#FAF7F2] hover:text-[#E10600]"><?= e($sub['name']) ?></a>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
      <a href="/about-us" class="hover:text-[#E10600]">About Us</a>
      <a href="/contact-us" class="hover:text-[#E10600]">Contact Us</a>
    </nav>
    <div class="flex items-center gap-3">
      <a href="/contact-us" class="hidden md:inline-block border border-[#0A0A0A] px-4 py-2 rounded font-medium hover:bg-[#0A0A0A] hover:text-[#FAF7F2] transition">Request Catalog</a>
      <a href="<?= whatsapp_link("Assalam-o-Alaikum, I'd like to enquire about your products.") ?>" target="_blank" rel="noopener" class="bg-[#25D366] text-white px-4 py-2 rounded font-medium hover:brightness-95 transition whitespace-nowrap">WhatsApp Inquiry</a>
    </div>
  </div>
</header>

<main>
