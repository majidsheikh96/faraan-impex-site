<?php
/**
 * Admin Dashboard — Faraan Impex Control Center.
 * Quick overview stats & direct access to all editable website components.
 */
declare(strict_types=1);
require_once __DIR__ . '/layout.php';

$stats = [
    'products'   => (int)db()->query('SELECT COUNT(*) FROM products WHERE is_active = 1')->fetchColumn(),
    'categories' => (int)db()->query('SELECT COUNT(*) FROM categories')->fetchColumn(),
    'featured'   => (int)db()->query('SELECT COUNT(*) FROM products WHERE is_featured = 1')->fetchColumn(),
];

$csActive = get_setting('coming_soon_enabled', '1') === '1';
$csKey = get_setting('coming_soon_key', 'faraan');

admin_header('Dashboard');
?>

<div class="space-y-10">

  <!-- Welcome & Live Overview -->
  <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b border-gray-200">
    <div>
      <span class="font-mono text-xs uppercase tracking-widest text-[#C51E28] font-bold">ADMINISTRATION DASHBOARD</span>
      <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mt-1">Faraan Impex Control Center</h1>
      <p class="text-sm text-gray-500 mt-1">
        Direct management of wholesale MOQs, catalog categories, 4-slide hero banner, homepage sections, and page narratives.
      </p>
    </div>
    <div class="flex items-center gap-3">
      <div class="px-4 py-2 rounded-xl bg-white border border-gray-200 shadow-sm text-xs font-mono">
        <span class="text-gray-500">Global Default MOQ:</span>
        <strong class="text-[#C51E28] font-bold ml-1"><?= e(get_site_moq()) ?></strong>
      </div>
      <a href="/" target="_blank" class="px-4 py-2 rounded-xl bg-[#0B0C0E] text-white hover:bg-[#C51E28] transition-colors text-xs font-mono font-bold uppercase tracking-wider shadow-sm flex items-center gap-1.5">
        <span>View Live Site</span>
        <span>↗</span>
      </a>
    </div>
  </div>

  <!-- Coming Soon & Launch Gate Alert Banner -->
  <div class="p-4 sm:p-5 rounded-2xl border <?= $csActive ? 'bg-amber-50/80 border-amber-300 text-amber-950' : 'bg-emerald-50/80 border-emerald-300 text-emerald-950' ?> flex flex-col md:flex-row md:items-center justify-between gap-4 text-xs font-mono shadow-sm">
    <div class="flex items-start sm:items-center gap-3">
      <span class="w-3 h-3 rounded-full mt-0.5 sm:mt-0 shrink-0 <?= $csActive ? 'bg-amber-500 animate-pulse' : 'bg-emerald-500' ?>"></span>
      <div>
        <strong class="font-bold text-sm block"><?= $csActive ? 'Coming Soon Mode is Active' : 'Website is Live to the Public' ?></strong>
        <span class="<?= $csActive ? 'text-amber-800' : 'text-emerald-800' ?> text-[11px] block mt-0.5">
          <?= $csActive ? 'Public visitors are directed to the dark luxury Coming Soon page.' : 'All visitors can view the full catalog and navigation.' ?>
        </span>
      </div>
    </div>
    <div class="flex flex-wrap items-center gap-3 shrink-0">
      <?php if ($csActive): ?>
        <span class="text-amber-900 bg-amber-100/90 border border-amber-300 px-2.5 py-1 rounded-lg">
          Bypass: <strong>?preview=<?= e($csKey) ?></strong>
        </span>
        <a href="/?preview=<?= e($csKey) ?>" target="_blank" class="px-3 py-1.5 rounded-lg bg-amber-800 text-white hover:bg-amber-900 transition-colors font-bold">
          Test Bypass ↗
        </a>
      <?php endif; ?>
      <a href="/admin/settings.php" class="px-3 py-1.5 rounded-lg bg-white border border-gray-300 text-gray-900 hover:text-[#C51E28] hover:border-[#C51E28] transition-colors font-bold shadow-xs">
        Configure Settings →
      </a>
    </div>
  </div>

  <!-- Key Statistics Counters -->
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
    <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-sm flex items-center justify-between">
      <div>
        <span class="text-xs font-mono font-bold uppercase tracking-wider text-gray-400 block mb-1">Live Products</span>
        <div class="text-4xl font-extrabold text-gray-900 font-mono"><?= $stats['products'] ?></div>
      </div>
      <a href="/admin/products.php" class="text-xs font-mono text-[#C51E28] font-bold hover:underline">Manage →</a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-sm flex items-center justify-between">
      <div>
        <span class="text-xs font-mono font-bold uppercase tracking-wider text-gray-400 block mb-1">Taxonomy Divisions</span>
        <div class="text-4xl font-extrabold text-gray-900 font-mono"><?= $stats['categories'] ?></div>
      </div>
      <a href="/admin/categories.php" class="text-xs font-mono text-[#C51E28] font-bold hover:underline">Manage →</a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-sm flex items-center justify-between">
      <div>
        <span class="text-xs font-mono font-bold uppercase tracking-wider text-gray-400 block mb-1">Featured Styles</span>
        <div class="text-4xl font-extrabold text-gray-900 font-mono"><?= $stats['featured'] ?></div>
      </div>
      <a href="/admin/products.php" class="text-xs font-mono text-[#C51E28] font-bold hover:underline">Manage →</a>
    </div>
  </div>

  <!-- Quick Action Edit Hubs (6 Big Visual Management Modules) -->
  <div>
    <h2 class="text-base font-bold text-gray-900 uppercase tracking-wide font-mono mb-4">
      Direct Website Content Management Modules
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      
      <!-- Card 1: Settings & MOQ -->
      <a href="/admin/settings.php" class="group bg-white rounded-2xl border border-gray-200/80 p-6 shadow-sm hover:shadow-md hover:border-[#C51E28]/40 transition-all block">
        <div class="flex items-center justify-between mb-4">
          <span class="w-10 h-10 rounded-xl bg-rose-50 text-[#C51E28] flex items-center justify-center font-mono font-bold text-base group-hover:scale-110 transition-transform">
            ⚡
          </span>
          <span class="text-xs font-mono text-[#C51E28] font-bold group-hover:translate-x-1 transition-transform">Edit →</span>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-1.5 font-serif group-hover:text-[#C51E28] transition-colors">
          Site Settings &amp; MOQ
        </h3>
        <p class="text-xs text-gray-500 leading-relaxed">
          Configure wholesale Minimum Order Quantity (MOQ), sample/quote turnaround SLAs, primary Gmail priority, phone numbers, WhatsApp, and Coming Soon gate.
        </p>
      </a>

      <!-- Card 2: Hero Slider -->
      <a href="/admin/slider.php" class="group bg-white rounded-2xl border border-gray-200/80 p-6 shadow-sm hover:shadow-md hover:border-[#C51E28]/40 transition-all block">
        <div class="flex items-center justify-between mb-4">
          <span class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-mono font-bold text-base group-hover:scale-110 transition-transform">
            🎬
          </span>
          <span class="text-xs font-mono text-[#C51E28] font-bold group-hover:translate-x-1 transition-transform">Edit →</span>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-1.5 font-serif group-hover:text-[#C51E28] transition-colors">
          Hero Slider (4 Slides)
        </h3>
        <p class="text-xs text-gray-500 leading-relaxed">
          Customize all 4 homepage slides: titles, sub-headlines, technical specification tags, CTA button actions, and 2K banner images.
        </p>
      </a>

      <!-- Card 3: Homepage Sections -->
      <a href="/admin/homepage.php" class="group bg-white rounded-2xl border border-gray-200/80 p-6 shadow-sm hover:shadow-md hover:border-[#C51E28]/40 transition-all block">
        <div class="flex items-center justify-between mb-4">
          <span class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-mono font-bold text-base group-hover:scale-110 transition-transform">
            🏛️
          </span>
          <span class="text-xs font-mono text-[#C51E28] font-bold group-hover:translate-x-1 transition-transform">Edit →</span>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-1.5 font-serif group-hover:text-[#C51E28] transition-colors">
          Homepage Sections
        </h3>
        <p class="text-xs text-gray-500 leading-relaxed">
          Edit 4 Core Manufacturing Divisions, 6 Material Lab capabilities, Curated Styles headings, 4-step OEM workflow, and Inquiry Desk.
        </p>
      </a>

      <!-- Card 4: Pages & Text Content -->
      <a href="/admin/pages.php" class="group bg-white rounded-2xl border border-gray-200/80 p-6 shadow-sm hover:shadow-md hover:border-[#C51E28]/40 transition-all block">
        <div class="flex items-center justify-between mb-4">
          <span class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-mono font-bold text-base group-hover:scale-110 transition-transform">
            📄
          </span>
          <span class="text-xs font-mono text-[#C51E28] font-bold group-hover:translate-x-1 transition-transform">Edit →</span>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-1.5 font-serif group-hover:text-[#C51E28] transition-colors">
          Pages &amp; Text Content
        </h3>
        <p class="text-xs text-gray-500 leading-relaxed">
          Edit the About Us factory history, 4 capacity metrics, quality control narrative, and Contact Us headlines and prompts.
        </p>
      </a>

      <!-- Card 5: Categories & Custom MOQs -->
      <a href="/admin/categories.php" class="group bg-white rounded-2xl border border-gray-200/80 p-6 shadow-sm hover:shadow-md hover:border-[#C51E28]/40 transition-all block">
        <div class="flex items-center justify-between mb-4">
          <span class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center font-mono font-bold text-base group-hover:scale-110 transition-transform">
            🏷️
          </span>
          <span class="text-xs font-mono text-[#C51E28] font-bold group-hover:translate-x-1 transition-transform">Edit →</span>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-1.5 font-serif group-hover:text-[#C51E28] transition-colors">
          Categories &amp; MOQs
        </h3>
        <p class="text-xs text-gray-500 leading-relaxed">
          Manage product categories, hierarchy, editorial kickers, category-specific MOQs, and custom hero descriptions.
        </p>
      </a>

      <!-- Card 6: Products Catalog -->
      <a href="/admin/products.php" class="group bg-white rounded-2xl border border-gray-200/80 p-6 shadow-sm hover:shadow-md hover:border-[#C51E28]/40 transition-all block">
        <div class="flex items-center justify-between mb-4">
          <span class="w-10 h-10 rounded-xl bg-stone-100 text-stone-800 flex items-center justify-center font-mono font-bold text-base group-hover:scale-110 transition-transform">
            🧥
          </span>
          <span class="text-xs font-mono text-[#C51E28] font-bold group-hover:translate-x-1 transition-transform">Edit →</span>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-1.5 font-serif group-hover:text-[#C51E28] transition-colors">
          Products Catalog
        </h3>
        <p class="text-xs text-gray-500 leading-relaxed">
          Add new styles, upload photography, update SKUs, technical parameters, and featured homepage toggles.
        </p>
      </a>

    </div>
  </div>

</div>

<?php admin_footer(); ?>
