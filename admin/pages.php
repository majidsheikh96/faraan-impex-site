<?php
/**
 * Admin: Pages & Content Editor (About Us & Contact Us).
 * Controls all narrative text, factory story, key stats, QC standards, and contact page messaging.
 */
declare(strict_types=1);
require_once __DIR__ . '/layout.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && verify_csrf($_POST['csrf'] ?? '')) {
    $fields = [
        // About Page
        'about_hero_title'   => 'about',
        'about_hero_lead'    => 'about',
        'about_story_1'      => 'about',
        'about_story_2'      => 'about',
        'about_stat_1_num'   => 'about',
        'about_stat_1_label' => 'about',
        'about_stat_2_num'   => 'about',
        'about_stat_2_label' => 'about',
        'about_stat_3_num'   => 'about',
        'about_stat_3_label' => 'about',
        'about_stat_4_num'   => 'about',
        'about_stat_4_label' => 'about',
        // Contact Page
        'contact_hero_title' => 'contact',
        'contact_hero_lead'  => 'contact'
    ];

    foreach ($fields as $key => $group) {
        if (isset($_POST[$key])) {
            update_setting($key, trim((string)$_POST[$key]), $group);
        }
    }

    flash_set('About Us and Contact Us pages updated successfully.');
    header('Location: /admin/pages.php');
    exit;
}

admin_header('Pages & Text Editor');
?>

<div class="max-w-4xl">

  <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
      <span class="font-mono text-xs uppercase tracking-widest text-[#C51E28] font-bold">PAGE TEXT &amp; NARRATIVES</span>
      <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mt-1">Pages &amp; Text Content</h1>
      <p class="text-sm text-gray-500 mt-1">
        Update editorial narratives, factory capacity figures, quality control standards, and contact page introductions.
      </p>
    </div>
    <div class="flex items-center gap-2">
      <a href="/about-us" target="_blank" class="inline-flex items-center gap-1 px-3 py-1.5 bg-white border border-gray-300 rounded-lg text-xs font-mono font-bold text-gray-700 hover:border-gray-400 shadow-sm">
        <span>About Page</span>
        <span>↗</span>
      </a>
      <a href="/contact-us" target="_blank" class="inline-flex items-center gap-1 px-3 py-1.5 bg-white border border-gray-300 rounded-lg text-xs font-mono font-bold text-gray-700 hover:border-gray-400 shadow-sm">
        <span>Contact Page</span>
        <span>↗</span>
      </a>
    </div>
  </div>

  <form method="post" class="space-y-10">
    <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

    <!-- 1. ABOUT US PAGE -->
    <div class="bg-white rounded-2xl border border-gray-200/80 p-6 sm:p-8 shadow-sm space-y-6">
      <div class="flex items-center gap-3 pb-4 border-b border-gray-100">
        <span class="w-3 h-3 rounded-full bg-[#C51E28]"></span>
        <h2 class="text-base font-bold text-gray-900 uppercase tracking-wide font-mono">1. About Us Page Content</h2>
      </div>

      <div class="space-y-5">
        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">
            About Hero Title *
          </label>
          <input type="text" name="about_hero_title" 
                 value="<?= e(get_setting('about_hero_title', 'Sialkot manufacturing authority.')) ?>" required
                 class="w-full px-4 py-2.5 rounded-xl border border-gray-300 font-serif text-base">
        </div>

        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">
            About Hero Lead Subtitle *
          </label>
          <textarea name="about_hero_lead" rows="2" required
                    class="w-full px-4 py-2 rounded-xl border border-gray-300 text-sm"><?= e(get_setting('about_hero_lead', 'Faraan Impex is a direct B2B contract manufacturer specializing in high-performance motorcycle apparel, technical flannels, western outerwear, and bespoke artisan leather goods.')) ?></textarea>
        </div>

        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">
            Factory Story &amp; Origins (Paragraph 1) *
          </label>
          <textarea name="about_story_1" rows="3" required
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm leading-relaxed"><?= e(get_setting('about_story_1', 'Established in Sialkot, Pakistan — the global epicenter of athletic leathercraft and precision stitching — Faraan Impex manufactures exclusively for private-label brands, international importers, motorcycle clubs, and enterprise apparel distributors across North America, Europe, and Australasia.')) ?></textarea>
        </div>

        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">
            Production &amp; Tannery Operations (Paragraph 2) *
          </label>
          <textarea name="about_story_2" rows="3" required
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm leading-relaxed"><?= e(get_setting('about_story_2', 'Our multi-disciplinary facility integrates high-precision cutting, computerized heavy-stitch sewing stations, dedicated lining and insulation tables, and dual-station quality control benches. We hold direct tannery contracts ensuring calibrated cowhide, sheep nappa, and buffalo hides meet REACH and CE standards.')) ?></textarea>
        </div>

        <!-- 4 Key Factory Statistics -->
        <div class="pt-4 border-t border-gray-100">
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-3">
            4 Key Factory Statistics Grid
          </label>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            
            <div class="p-3.5 rounded-xl bg-gray-50 border border-gray-200">
              <label class="block text-[10px] font-mono text-gray-500 uppercase mb-1">Stat 1 Value</label>
              <input type="text" name="about_stat_1_num" value="<?= e(get_setting('about_stat_1_num', '1,200+')) ?>" class="w-full px-2.5 py-1.5 rounded-lg border border-gray-300 font-mono font-bold text-sm mb-2">
              <label class="block text-[10px] font-mono text-gray-500 uppercase mb-1">Stat 1 Label</label>
              <input type="text" name="about_stat_1_label" value="<?= e(get_setting('about_stat_1_label', 'Monthly Race Suit Capacity')) ?>" class="w-full px-2.5 py-1.5 rounded-lg border border-gray-300 text-xs">
            </div>

            <div class="p-3.5 rounded-xl bg-gray-50 border border-gray-200">
              <label class="block text-[10px] font-mono text-gray-500 uppercase mb-1">Stat 2 Value</label>
              <input type="text" name="about_stat_2_num" value="<?= e(get_setting('about_stat_2_num', '4')) ?>" class="w-full px-2.5 py-1.5 rounded-lg border border-gray-300 font-mono font-bold text-sm mb-2">
              <label class="block text-[10px] font-mono text-gray-500 uppercase mb-1">Stat 2 Label</label>
              <input type="text" name="about_stat_2_label" value="<?= e(get_setting('about_stat_2_label', 'Specialized Cutting Lines')) ?>" class="w-full px-2.5 py-1.5 rounded-lg border border-gray-300 text-xs">
            </div>

            <div class="p-3.5 rounded-xl bg-gray-50 border border-gray-200">
              <label class="block text-[10px] font-mono text-gray-500 uppercase mb-1">Stat 3 Value</label>
              <input type="text" name="about_stat_3_num" value="<?= e(get_setting('about_stat_3_num', '28+')) ?>" class="w-full px-2.5 py-1.5 rounded-lg border border-gray-300 font-mono font-bold text-sm mb-2">
              <label class="block text-[10px] font-mono text-gray-500 uppercase mb-1">Stat 3 Label</label>
              <input type="text" name="about_stat_3_label" value="<?= e(get_setting('about_stat_3_label', 'Global Export Destinations')) ?>" class="w-full px-2.5 py-1.5 rounded-lg border border-gray-300 text-xs">
            </div>

            <div class="p-3.5 rounded-xl bg-gray-50 border border-gray-200">
              <label class="block text-[10px] font-mono text-gray-500 uppercase mb-1">Stat 4 Value</label>
              <input type="text" name="about_stat_4_num" value="<?= e(get_setting('about_stat_4_num', '7–10')) ?>" class="w-full px-2.5 py-1.5 rounded-lg border border-gray-300 font-mono font-bold text-sm mb-2">
              <label class="block text-[10px] font-mono text-gray-500 uppercase mb-1">Stat 4 Label</label>
              <input type="text" name="about_stat_4_label" value="<?= e(get_setting('about_stat_4_label', 'Days Sample Turnaround')) ?>" class="w-full px-2.5 py-1.5 rounded-lg border border-gray-300 text-xs">
            </div>

          </div>
        </div>

      </div>
    </div>

    <!-- 2. CONTACT US PAGE -->
    <div class="bg-white rounded-2xl border border-gray-200/80 p-6 sm:p-8 shadow-sm space-y-6">
      <div class="flex items-center gap-3 pb-4 border-b border-gray-100">
        <span class="w-3 h-3 rounded-full bg-blue-500"></span>
        <h2 class="text-base font-bold text-gray-900 uppercase tracking-wide font-mono">2. Contact Us Page Header</h2>
      </div>

      <div class="space-y-5">
        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">
            Contact Hero Title *
          </label>
          <input type="text" name="contact_hero_title" 
                 value="<?= e(get_setting('contact_hero_title', 'Production desk & quotation.')) ?>" required
                 class="w-full px-4 py-2.5 rounded-xl border border-gray-300 font-serif text-base">
        </div>

        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">
            Contact Hero Lead Narrative *
          </label>
          <textarea name="contact_hero_lead" rows="2" required
                    class="w-full px-4 py-2 rounded-xl border border-gray-300 text-sm"><?= e(get_setting('contact_hero_lead', 'Direct contract manufacturing desk. Submit your technical drawings, bill of materials, or sample inquiries for immediate factory costing and leather hide validation.')) ?></textarea>
        </div>
      </div>
    </div>

    <!-- Save Button Bar -->
    <div class="flex items-center justify-between pt-4">
      <a href="/admin/dashboard.php" class="text-xs font-mono text-gray-500 hover:text-gray-900 uppercase tracking-wider">
        ← Back to Dashboard
      </a>
      <button type="submit" 
              class="inline-flex items-center justify-center gap-2 bg-[#C51E28] hover:bg-[#A81822] text-white px-8 py-3.5 rounded-xl font-mono text-xs font-bold uppercase tracking-wider transition-colors shadow-md">
        <span>Save All Pages Content</span>
        <span>✓</span>
      </button>
    </div>

  </form>

</div>

<?php admin_footer(); ?>
