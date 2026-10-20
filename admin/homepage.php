<?php
/**
 * Admin: Homepage Sections Visual Editor.
 * Edit Core Manufacturing Divisions, Material Lab Capabilities, Curated Styles, OEM Process & Inquiry Desk.
 */
declare(strict_types=1);
require_once __DIR__ . '/layout.php';

$error = '';
$divisions = get_divisions_data();
$capabilities = get_capabilities_data();
$process_steps = get_process_steps_data();
$trust_points = get_trust_points_data();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && verify_csrf($_POST['csrf'] ?? '')) {
    
    // 1. Text settings
    $text_keys = [
        'divisions_heading'      => 'divisions',
        'divisions_subheading'   => 'divisions',
        'capabilities_heading'   => 'capabilities',
        'capabilities_subheading'=> 'capabilities',
        'curated_heading'        => 'curated',
        'curated_subheading'     => 'curated',
        'curated_moq_badge'      => 'curated',
        'process_heading'        => 'process',
        'process_subheading'     => 'process',
        'inquiry_heading'        => 'inquiry',
        'inquiry_subheading'     => 'inquiry',
    ];
    foreach ($text_keys as $k => $grp) {
        if (isset($_POST[$k])) {
            update_setting($k, trim((string)$_POST[$k]), $grp);
        }
    }

    // 2. Manufacturing Divisions (4 cards)
    $updated_divisions = [];
    for ($i = 0; $i < 4; $i++) {
        $existing = $divisions[$i] ?? [];
        $specs_raw = trim((string)($_POST["div_{$i}_specs"] ?? ''));
        $specs = array_filter(array_map('trim', explode(',', $specs_raw)));
        $img = trim((string)($_POST["div_{$i}_image"] ?? ($existing['image'] ?? '')));

        if (isset($_FILES["div_{$i}_file"]) && $_FILES["div_{$i}_file"]['error'] !== UPLOAD_ERR_NO_FILE) {
            try {
                $up = handle_image_upload($_FILES["div_{$i}_file"], "division-card-" . ($i + 1), 'showcase');
                if ($up) $img = '/' . ltrim($up, '/');
            } catch (Exception $e) {
                $error = "Division " . ($i + 1) . " image upload error: " . $e->getMessage();
            }
        }

        $updated_divisions[] = [
            'slug'   => trim((string)($_POST["div_{$i}_slug"] ?? ($existing['slug'] ?? ''))),
            'href'   => trim((string)($_POST["div_{$i}_href"] ?? ($existing['href'] ?? ''))),
            'number' => sprintf('%02d', $i + 1),
            'kicker' => trim((string)($_POST["div_{$i}_kicker"] ?? '')),
            'title'  => trim((string)($_POST["div_{$i}_title"] ?? '')),
            'lead'   => trim((string)($_POST["div_{$i}_lead"] ?? '')),
            'specs'  => !empty($specs) ? array_values($specs) : ($existing['specs'] ?? []),
            'cta'    => trim((string)($_POST["div_{$i}_cta"] ?? 'Explore Division')),
            'image'  => $img
        ];
    }
    update_setting('divisions_json', json_encode($updated_divisions, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT), 'divisions');

    // 3. Material Lab Capabilities (6 cards)
    $updated_caps = [];
    for ($i = 0; $i < 6; $i++) {
        $updated_caps[] = [
            'number' => sprintf('%02d', $i + 1),
            'title'  => trim((string)($_POST["cap_{$i}_title"] ?? '')),
            'desc'   => trim((string)($_POST["cap_{$i}_desc"] ?? ''))
        ];
    }
    update_setting('capabilities_json', json_encode($updated_caps, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT), 'capabilities');

    // 4. OEM Process Steps (4 steps)
    $updated_steps = [];
    for ($i = 0; $i < 4; $i++) {
        $updated_steps[] = [
            'num'   => sprintf('%02d', $i + 1),
            'title' => trim((string)($_POST["step_{$i}_title"] ?? '')),
            'desc'  => trim((string)($_POST["step_{$i}_desc"] ?? ''))
        ];
    }
    update_setting('process_steps_json', json_encode($updated_steps, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT), 'process');

    if (!$error) {
        flash_set('Homepage sections updated successfully.');
        header('Location: /admin/homepage.php');
        exit;
    }
}

admin_header('Homepage Sections Editor');
?>

<div class="max-w-5xl">

  <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
      <span class="font-mono text-xs uppercase tracking-widest text-[#C51E28] font-bold">PAGE ARCHITECTURE</span>
      <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mt-1">Homepage Sections Editor</h1>
      <p class="text-sm text-gray-500 mt-1">
        Edit Core Manufacturing Divisions, Material Lab Capabilities, Process Steps, Curated Styles headings, and Inquiry Desk.
      </p>
    </div>
    <a href="/#divisions" target="_blank" class="inline-flex items-center gap-1.5 px-4 py-2 bg-white border border-gray-300 rounded-xl text-xs font-mono font-bold text-gray-700 hover:border-gray-400 shadow-sm">
      <span>Preview Homepage</span>
      <span>↗</span>
    </a>
  </div>

  <?php if ($error): ?>
    <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 text-rose-900 px-4 py-3 text-sm">
      <?= e($error) ?>
    </div>
  <?php endif; ?>

  <form method="post" enctype="multipart/form-data" class="space-y-12">
    <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

    <!-- SECTION A: CORE MANUFACTURING DIVISIONS -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8 space-y-8">
      <div class="flex items-center gap-3 pb-4 border-b border-gray-100">
        <span class="w-3 h-3 rounded-full bg-[#C51E28]"></span>
        <h2 class="text-lg font-bold text-gray-900 uppercase tracking-wide font-mono">
          Section A: 4 Core Manufacturing Divisions
        </h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">Section Headline *</label>
          <input type="text" name="divisions_heading" 
                 value="<?= e(get_setting('divisions_heading', 'Four dedicated production divisions.')) ?>" required
                 class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm font-serif">
        </div>
        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">Section Subheading *</label>
          <textarea name="divisions_subheading" rows="2" required
                    class="w-full px-4 py-2 rounded-xl border border-gray-300 text-xs"><?= e(get_setting('divisions_subheading', 'Our Sialkot facility is equipped with dedicated cutting lines, heavy-stitch machinery, and finishing units across four specialized sectors — ensuring every order meets international export standards.')) ?></textarea>
        </div>
      </div>

      <!-- 4 Division Cards -->
      <div class="space-y-6 pt-4 border-t border-gray-100">
        <span class="text-xs font-mono font-bold uppercase tracking-wider text-gray-600 block">4 Editorial Division Cards</span>

        <?php foreach ($divisions as $idx => $d): ?>
          <div class="p-6 rounded-xl bg-gray-50 border border-gray-200/80 space-y-4">
            <div class="flex items-center justify-between pb-2 border-b border-gray-200">
              <span class="font-mono text-xs font-bold text-[#C51E28]">DIVISION <?= sprintf('%02d', $idx + 1) ?></span>
              <span class="font-mono text-xs text-gray-500">Route: <?= e($d['href'] ?? '') ?></span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                <label class="block text-[11px] font-mono text-gray-600 mb-1">Kicker</label>
                <input type="text" name="div_<?= $idx ?>_kicker" value="<?= e($d['kicker'] ?? '') ?>" 
                       class="w-full px-3 py-1.5 rounded-lg border border-gray-300 text-xs font-mono">
              </div>
              <div class="md:col-span-2">
                <label class="block text-[11px] font-mono text-gray-600 mb-1">Card Title</label>
                <input type="text" name="div_<?= $idx ?>_title" value="<?= e($d['title'] ?? '') ?>" 
                       class="w-full px-3 py-1.5 rounded-lg border border-gray-300 text-xs font-serif font-semibold">
              </div>
            </div>

            <div>
              <label class="block text-[11px] font-mono text-gray-600 mb-1">Lead Narrative</label>
              <textarea name="div_<?= $idx ?>_lead" rows="2" 
                        class="w-full px-3 py-1.5 rounded-lg border border-gray-300 text-xs"><?= e($d['lead'] ?? '') ?></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-[11px] font-mono text-gray-600 mb-1">Specs Badges (Comma-separated)</label>
                <input type="text" name="div_<?= $idx ?>_specs" value="<?= e(implode(', ', $d['specs'] ?? [])) ?>" 
                       class="w-full px-3 py-1.5 rounded-lg border border-gray-300 text-xs font-mono">
              </div>
              <div>
                <label class="block text-[11px] font-mono text-gray-600 mb-1">CTA Label</label>
                <input type="text" name="div_<?= $idx ?>_cta" value="<?= e($d['cta'] ?? 'Explore Division') ?>" 
                       class="w-full px-3 py-1.5 rounded-lg border border-gray-300 text-xs">
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
              <div class="md:col-span-8">
                <label class="block text-[11px] font-mono text-gray-600 mb-1">Card Image URL</label>
                <input type="text" name="div_<?= $idx ?>_image" value="<?= e($d['image'] ?? '') ?>" 
                       class="w-full px-3 py-1.5 rounded-lg border border-gray-300 text-xs font-mono">
                <input type="hidden" name="div_<?= $idx ?>_slug" value="<?= e($d['slug'] ?? '') ?>">
                <input type="hidden" name="div_<?= $idx ?>_href" value="<?= e($d['href'] ?? '') ?>">
              </div>
              <div class="md:col-span-4">
                <label class="block text-[11px] font-mono text-gray-600 mb-1">Or Upload New Image</label>
                <input type="file" name="div_<?= $idx ?>_file" accept="image/*" class="text-xs text-gray-500">
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- SECTION B: MATERIAL LAB & MANUFACTURING CAPABILITIES -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8 space-y-6">
      <div class="flex items-center gap-3 pb-4 border-b border-gray-100">
        <span class="w-3 h-3 rounded-full bg-blue-500"></span>
        <h2 class="text-lg font-bold text-gray-900 uppercase tracking-wide font-mono">
          Section B: Material Lab &amp; Manufacturing Capabilities (6 Cards)
        </h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">Section Headline *</label>
          <input type="text" name="capabilities_heading" 
                 value="<?= e(get_setting('capabilities_heading', 'Engineered around your technical pack.')) ?>" required
                 class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm font-serif">
        </div>
        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">Section Subheading *</label>
          <textarea name="capabilities_subheading" rows="2" required
                    class="w-full px-4 py-2 rounded-xl border border-gray-300 text-xs"><?= e(get_setting('capabilities_subheading', 'Our Sialkot manufacturing plant operates as your direct offshore production line. Capabilities span racing suits, technical flannels, western headwear, and bespoke leathercraft — each calibrated to your exact tolerances.')) ?></textarea>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 pt-4 border-t border-gray-100">
        <?php foreach ($capabilities as $idx => $cap): ?>
          <div class="p-4 rounded-xl bg-gray-50 border border-gray-200 space-y-3">
            <span class="font-mono text-xs font-bold text-[#C51E28]">CAPABILITY <?= sprintf('%02d', $idx + 1) ?></span>
            <div>
              <label class="block text-[11px] font-mono text-gray-600 mb-1">Title</label>
              <input type="text" name="cap_<?= $idx ?>_title" value="<?= e($cap['title'] ?? '') ?>" 
                     class="w-full px-3 py-1.5 rounded-lg border border-gray-300 text-xs font-semibold">
            </div>
            <div>
              <label class="block text-[11px] font-mono text-gray-600 mb-1">Description</label>
              <textarea name="cap_<?= $idx ?>_desc" rows="3" 
                        class="w-full px-3 py-1.5 rounded-lg border border-gray-300 text-xs leading-relaxed"><?= e($cap['desc'] ?? '') ?></textarea>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- SECTION C: CURATED STYLES & INQUIRY DESK -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8 space-y-6">
      <div class="flex items-center gap-3 pb-4 border-b border-gray-100">
        <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
        <h2 class="text-lg font-bold text-gray-900 uppercase tracking-wide font-mono">
          Section C: Curated Styles &amp; Production Desk
        </h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">Curated Headline</label>
          <input type="text" name="curated_heading" 
                 value="<?= e(get_setting('curated_heading', 'Curated styles ready for sampling.')) ?>" 
                 class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm font-serif">
        </div>
        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">Curated Subtitle</label>
          <input type="text" name="curated_subheading" 
                 value="<?= e(get_setting('curated_subheading', 'Benchmark specifications spanning motorbike suits, fortified racing gloves, technical flannels, cowboy hats, denim outerwear, vests, and artisan aprons.')) ?>" 
                 class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-xs">
        </div>
        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">Curated MOQ Badge Text</label>
          <input type="text" name="curated_moq_badge" 
                 value="<?= e(get_setting('curated_moq_badge', '50 Pcs / Style · Custom Branding Available')) ?>" 
                 class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-xs font-mono text-[#C51E28]">
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-100">
        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">Inquiry Desk Headline</label>
          <input type="text" name="inquiry_heading" 
                 value="<?= e(get_setting('inquiry_heading', 'Direct factory production desk.')) ?>" 
                 class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm font-serif">
        </div>
        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">Inquiry Desk Subtext</label>
          <textarea name="inquiry_subheading" rows="2" 
                    class="w-full px-4 py-2 rounded-xl border border-gray-300 text-xs"><?= e(get_setting('inquiry_subheading', 'Connect directly with our master pattern cutters and export merchandisers. Fast-track custom sampling, leather lab dips, and wholesale FOB/CIF quotations.')) ?></textarea>
        </div>
      </div>
    </div>

    <!-- SECTION D: 4-STEP OEM WORKFLOW -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8 space-y-6">
      <div class="flex items-center gap-3 pb-4 border-b border-gray-100">
        <span class="w-3 h-3 rounded-full bg-purple-500"></span>
        <h2 class="text-lg font-bold text-gray-900 uppercase tracking-wide font-mono">
          Section D: 4-Step OEM Production Workflow
        </h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">Process Section Headline</label>
          <input type="text" name="process_heading" 
                 value="<?= e(get_setting('process_heading', 'From CAD tech pack to export dock in 4 disciplined phases.')) ?>" 
                 class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm font-serif">
        </div>
        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">Process Subheading</label>
          <input type="text" name="process_subheading" 
                 value="<?= e(get_setting('process_subheading', 'Direct factory transparency with dedicated line supervisors at each stage.')) ?>" 
                 class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-xs">
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-100">
        <?php foreach ($process_steps as $idx => $step): ?>
          <div class="p-4 rounded-xl bg-gray-50 border border-gray-200 space-y-2">
            <span class="font-mono text-xs font-bold text-[#C51E28]">PHASE <?= sprintf('%02d', $idx + 1) ?></span>
            <div>
              <label class="block text-[11px] font-mono text-gray-600 mb-1">Step Title</label>
              <input type="text" name="step_<?= $idx ?>_title" value="<?= e($step['title'] ?? '') ?>" 
                     class="w-full px-3 py-1.5 rounded-lg border border-gray-300 text-xs font-semibold">
            </div>
            <div>
              <label class="block text-[11px] font-mono text-gray-600 mb-1">Description</label>
              <textarea name="step_<?= $idx ?>_desc" rows="3" 
                        class="w-full px-3 py-1.5 rounded-lg border border-gray-300 text-xs leading-relaxed"><?= e($step['desc'] ?? '') ?></textarea>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Save Button Bar -->
    <div class="sticky bottom-6 z-40 bg-white/95 backdrop-blur-md p-4 rounded-2xl border border-gray-200 shadow-xl flex items-center justify-between">
      <a href="/admin/dashboard.php" class="text-xs font-mono text-gray-500 hover:text-gray-900 uppercase tracking-wider px-2">
        ← Back to Dashboard
      </a>
      <button type="submit" 
              class="inline-flex items-center justify-center gap-2 bg-[#C51E28] hover:bg-[#A81822] text-white px-8 py-3.5 rounded-xl font-mono text-xs font-bold uppercase tracking-wider transition-colors shadow-md">
        <span>Save All Homepage Sections</span>
        <span>✓</span>
      </button>
    </div>

  </form>

</div>

<?php admin_footer(); ?>
