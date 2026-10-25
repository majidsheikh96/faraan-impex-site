<?php
/**
 * Admin: Homepage Hero Slider Visual Editor.
 * Edit all 4 hero slides, background banners, titles, descriptions, technical pills, and CTAs.
 */
declare(strict_types=1);
require_once __DIR__ . '/layout.php';

$slides = get_hero_slides_data();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && verify_csrf($_POST['csrf'] ?? '')) {
    $updated_slides = [];

    for ($i = 0; $i < 4; $i++) {
        $existing = $slides[$i] ?? [];
        
        $pills_raw = trim((string)($_POST["slide_{$i}_pills"] ?? ''));
        $pills = array_filter(array_map('trim', explode(',', $pills_raw)));

        $image_path = trim((string)($_POST["slide_{$i}_image"] ?? ($existing['image'] ?? '')));

        // Check if a new image file was uploaded for this slide
        if (isset($_FILES["slide_{$i}_file"]) && $_FILES["slide_{$i}_file"]['error'] !== UPLOAD_ERR_NO_FILE) {
            try {
                $uploaded = handle_image_upload($_FILES["slide_{$i}_file"], "hero-slide-" . ($i + 1), 'showcase');
                if ($uploaded) {
                    $image_path = '/' . ltrim($uploaded, '/');
                }
            } catch (Exception $e) {
                $error = "Slide " . ($i + 1) . " image upload error: " . $e->getMessage();
            }
        }

        $updated_slides[] = [
            'number'             => sprintf('%02d', $i + 1),
            'tab_label'          => trim((string)($_POST["slide_{$i}_tab_label"] ?? "Slide " . ($i + 1))),
            'kicker'             => trim((string)($_POST["slide_{$i}_kicker"] ?? '')),
            'title'              => trim((string)($_POST["slide_{$i}_title"] ?? '')),
            'lead'               => trim((string)($_POST["slide_{$i}_lead"] ?? '')),
            'pills'              => !empty($pills) ? array_values($pills) : ($existing['pills'] ?? []),
            'primary_cta_text'   => trim((string)($_POST["slide_{$i}_primary_cta_text"] ?? 'Explore Division')),
            'primary_cta_url'    => trim((string)($_POST["slide_{$i}_primary_cta_url"] ?? '/contact-us')),
            'secondary_cta_text' => trim((string)($_POST["slide_{$i}_secondary_cta_text"] ?? 'Start an RFQ')),
            'secondary_cta_url'  => trim((string)($_POST["slide_{$i}_secondary_cta_url"] ?? '/contact-us')),
            'image'              => $image_path,
            'image_pos'          => trim((string)($_POST["slide_{$i}_image_pos"] ?? 'object-center'))
        ];
    }

    if (!$error) {
        update_setting('hero_slides_json', json_encode($updated_slides, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT), 'hero');
        flash_set('Hero Slider updated successfully with all 4 slides live.');
        header('Location: /admin/slider.php');
        exit;
    }
}

admin_header('Hero Slider Editor');
?>

<div class="max-w-5xl">

  <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
      <span class="font-mono text-xs uppercase tracking-widest text-[#C8102E] font-bold">HOMEPAGE SHOWCASE</span>
      <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mt-1">Hero Slider Editor (4 Slides)</h1>
      <p class="text-sm text-gray-500 mt-1">
        Update headlines, technical specification tags, call-to-actions, and 2K high-resolution master banners.
      </p>
    </div>
    <a href="/" target="_blank" class="inline-flex items-center gap-1.5 px-4 py-2 bg-white border border-gray-300 rounded-xl text-xs font-mono font-bold text-gray-700 hover:border-gray-400 shadow-sm">
      <span>Preview Live Hero</span>
      <span>↗</span>
    </a>
  </div>

  <?php if ($error): ?>
    <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 text-rose-900 px-4 py-3 text-sm">
      <?= e($error) ?>
    </div>
  <?php endif; ?>

  <form method="post" enctype="multipart/form-data" class="space-y-10">
    <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

    <?php foreach ($slides as $idx => $s): ?>
      <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
        
        <!-- Slide Header Ribbon -->
        <div class="bg-[#0D0D0D] text-white px-6 py-4 flex items-center justify-between border-b border-white/10">
          <div class="flex items-center gap-3">
            <span class="font-mono text-xs px-2.5 py-1 rounded bg-[#C8102E] text-white font-bold tracking-wider">
              SLIDE <?= sprintf('%02d', $idx + 1) ?>
            </span>
            <span class="font-serif text-lg font-normal text-white">
              <?= e($s['tab_label'] ?? 'Slide ' . ($idx + 1)) ?>
            </span>
          </div>
          <span class="text-xs font-mono text-slate-400 hidden sm:inline">
            Zero-Jitter Hardware Composited
          </span>
        </div>

        <div class="p-6 sm:p-8 space-y-6">
          
          <!-- Tab Title & Kicker -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
              <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">
                Tab Pill Label *
              </label>
              <input type="text" name="slide_<?= $idx ?>_tab_label" 
                     value="<?= e($s['tab_label'] ?? '') ?>" required
                     class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#C8102E] text-sm">
              <p class="text-[11px] text-gray-500 mt-1 font-mono">Appears on the bottom slide selector pill.</p>
            </div>

            <div class="md:col-span-2">
              <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">
                Header Kicker Tagline *
              </label>
              <input type="text" name="slide_<?= $idx ?>_kicker" 
                     value="<?= e($s['kicker'] ?? '') ?>" required
                     class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#C8102E] text-sm font-mono text-crimson">
              <p class="text-[11px] text-gray-500 mt-1 font-mono">Red uppercase specification badge above headline.</p>
            </div>
          </div>

          <!-- Headline & Paragraph -->
          <div>
            <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">
              Main Hero Headline *
            </label>
            <input type="text" name="slide_<?= $idx ?>_title" 
                   value="<?= e($s['title'] ?? '') ?>" required
                   class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#C8102E] text-base font-serif">
          </div>

          <div>
            <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">
              Editorial Lead Paragraph *
            </label>
            <textarea name="slide_<?= $idx ?>_lead" rows="3" required
                      class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#C8102E] text-sm leading-relaxed"><?= e($s['lead'] ?? '') ?></textarea>
          </div>

          <!-- Technical Pills (Comma Separated) -->
          <div>
            <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">
              Technical Specification Badges (Comma-separated)
            </label>
            <input type="text" name="slide_<?= $idx ?>_pills" 
                   value="<?= e(implode(', ', $s['pills'] ?? [])) ?>" 
                   class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#C8102E] text-sm font-mono">
            <p class="text-[11px] text-gray-500 mt-1 font-mono">Example: CE Level 2 Armor, 1.3mm Race Cowhide, Aerodynamic Speed Hump</p>
          </div>

          <!-- Call to Action Buttons -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4 rounded-xl bg-gray-50 border border-gray-100">
            <div class="space-y-3">
              <span class="block text-xs font-mono font-bold uppercase tracking-wider text-[#C8102E]">Primary CTA Button</span>
              <div>
                <label class="block text-[11px] font-mono text-gray-600 mb-1">Button Text</label>
                <input type="text" name="slide_<?= $idx ?>_primary_cta_text" 
                       value="<?= e($s['primary_cta_text'] ?? 'Explore Division') ?>" 
                       class="w-full px-3 py-2 rounded-lg border border-gray-300 text-xs">
              </div>
              <div>
                <label class="block text-[11px] font-mono text-gray-600 mb-1">Button Destination URL</label>
                <input type="text" name="slide_<?= $idx ?>_primary_cta_url" 
                       value="<?= e($s['primary_cta_url'] ?? '/contact-us') ?>" 
                       class="w-full px-3 py-2 rounded-lg border border-gray-300 text-xs font-mono">
              </div>
            </div>

            <div class="space-y-3">
              <span class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-800">Secondary CTA Button</span>
              <div>
                <label class="block text-[11px] font-mono text-gray-600 mb-1">Button Text</label>
                <input type="text" name="slide_<?= $idx ?>_secondary_cta_text" 
                       value="<?= e($s['secondary_cta_text'] ?? 'Start an RFQ') ?>" 
                       class="w-full px-3 py-2 rounded-lg border border-gray-300 text-xs">
              </div>
              <div>
                <label class="block text-[11px] font-mono text-gray-600 mb-1">Button Destination URL</label>
                <input type="text" name="slide_<?= $idx ?>_secondary_cta_url" 
                       value="<?= e($s['secondary_cta_url'] ?? '/contact-us') ?>" 
                       class="w-full px-3 py-2 rounded-lg border border-gray-300 text-xs font-mono">
              </div>
            </div>
          </div>

          <!-- Slide Banner Image & Placement -->
          <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center pt-2">
            
            <!-- Current Image Preview -->
            <div class="md:col-span-4">
              <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">
                Current Background Banner
              </label>
              <div class="relative aspect-video rounded-xl overflow-hidden border border-gray-200 bg-gray-900 shadow-inner flex items-center justify-center">
                <?php if (!empty($s['image'])): ?>
                  <img src="<?= e($s['image']) ?>" alt="" class="w-full h-full object-cover">
                <?php else: ?>
                  <span class="text-xs font-mono text-gray-400">No Image Set</span>
                <?php endif; ?>
              </div>
            </div>

            <!-- Image URL & File Upload Input -->
            <div class="md:col-span-8 space-y-4">
              <div>
                <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-1.5">
                  Banner Image Path / URL *
                </label>
                <input type="text" name="slide_<?= $idx ?>_image" 
                       value="<?= e($s['image'] ?? '') ?>" required
                       class="w-full px-4 py-2 rounded-xl border border-gray-300 text-xs font-mono">
              </div>

              <div>
                <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-1.5">
                  Upload Replacement High-Res Banner (JPG/PNG/WebP)
                </label>
                <input type="file" name="slide_<?= $idx ?>_file" accept="image/jpeg,image/png,image/webp"
                       class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-mono file:font-semibold file:bg-gray-900 file:text-white hover:file:bg-[#C8102E]">
              </div>

              <div>
                <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-1.5">
                  Focal Positioning Class
                </label>
                <input type="text" name="slide_<?= $idx ?>_image_pos" 
                       value="<?= e($s['image_pos'] ?? 'object-center') ?>" 
                       class="w-full px-3 py-1.5 rounded-lg border border-gray-300 text-xs font-mono">
                <p class="text-[11px] text-gray-500 mt-1 font-mono">E.g., object-center, object-[center_28%], object-[center_60%]</p>
              </div>
            </div>

          </div>

        </div>
      </div>
    <?php endforeach; ?>

    <!-- Save Button Bar -->
    <div class="sticky bottom-6 z-40 bg-white/95 backdrop-blur-md p-4 rounded-2xl border border-gray-200 shadow-xl flex items-center justify-between">
      <a href="/admin/dashboard.php" class="text-xs font-mono text-gray-500 hover:text-gray-900 uppercase tracking-wider px-2">
        ← Back to Dashboard
      </a>
      <button type="submit" 
              class="inline-flex items-center justify-center gap-2 bg-[#C8102E] hover:bg-[#9E0C24] text-white px-8 py-3.5 rounded-xl font-mono text-xs font-bold uppercase tracking-wider transition-colors shadow-md">
        <span>Save All 4 Slides</span>
        <span>✓</span>
      </button>
    </div>

  </form>

</div>

<?php admin_footer(); ?>
