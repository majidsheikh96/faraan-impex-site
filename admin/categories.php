<?php
/**
 * Admin: Category & Division Management with Custom MOQ & Editorial Kickers.
 */
declare(strict_types=1);
require_once __DIR__ . '/layout.php';

$error = '';

// Delete (only if no products)
if (isset($_GET['delete']) && isset($_GET['csrf']) && verify_csrf($_GET['csrf'])) {
    $id = (int)$_GET['delete'];
    $cnt = db()->prepare('SELECT COUNT(*) FROM products WHERE category_id = ?');
    $cnt->execute([$id]);
    if ((int)$cnt->fetchColumn() > 0) {
        $error = 'Cannot delete: category has products. Reassign or delete products first.';
    } else {
        db()->prepare('DELETE FROM categories WHERE id = ?')->execute([$id]);
        flash_set('Category deleted.');
        header('Location: /admin/categories.php');
        exit;
    }
}

// Add / edit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && verify_csrf($_POST['csrf'] ?? '')) {
    $id = (int)($_POST['id'] ?? 0);
    $name = trim($_POST['name'] ?? '');
    $parent_id = (int)($_POST['parent_id'] ?? 0) ?: null;
    $meta_description = trim($_POST['meta_description'] ?? '');
    $kicker = trim($_POST['kicker'] ?? '');
    $lead_text = trim($_POST['lead_text'] ?? '');
    $custom_moq = trim($_POST['custom_moq'] ?? '');
    $sort_order = (int)($_POST['sort_order'] ?? 0);
    $image = trim($_POST['image'] ?? '');

    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] !== UPLOAD_ERR_NO_FILE) {
        try {
            $up = handle_image_upload($_FILES['image_file'], 'cat-' . make_slug($name), 'categories');
            if ($up) $image = '/' . ltrim($up, '/');
        } catch (Exception $e) {
            $error = "Image upload failed: " . $e->getMessage();
        }
    }

    if ($name !== '' && !$error) {
        $slug = make_slug($name);
        $s = $slug; $n = 1;
        while (true) {
            $chk = db()->prepare('SELECT id FROM categories WHERE slug = ? AND id != ?');
            $chk->execute([$s, $id]);
            if (!$chk->fetch()) break;
            $s = $slug . '-' . (++$n);
        }

        if ($id) {
            db()->prepare(
                'UPDATE categories SET name=?, slug=?, parent_id=?, meta_description=?, kicker=?, lead_text=?, custom_moq=?, sort_order=?, image=? WHERE id=?'
            )->execute([$name, $s, $parent_id, $meta_description, $kicker, $lead_text, $custom_moq, $sort_order, $image, $id]);
        } else {
            db()->prepare(
                'INSERT INTO categories (name, slug, parent_id, meta_description, kicker, lead_text, custom_moq, sort_order, image) VALUES (?,?,?,?,?,?,?,?,?)'
            )->execute([$name, $s, $parent_id, $meta_description, $kicker, $lead_text, $custom_moq, $sort_order, $image]);
        }
        flash_set('Category and custom MOQ saved successfully.');
        header('Location: /admin/categories.php');
        exit;
    }
}

$cats = db()->query(
    'SELECT c.*, p.name AS parent_name,
     (SELECT COUNT(*) FROM products WHERE category_id = c.id) AS product_count
     FROM categories c LEFT JOIN categories p ON p.id = c.parent_id
     ORDER BY c.parent_id IS NOT NULL, c.sort_order, c.name'
)->fetchAll();
$tops = array_filter($cats, fn($c) => !$c['parent_id']);

$edit = null;
if (isset($_GET['edit'])) {
    $stmt = db()->prepare('SELECT * FROM categories WHERE id = ?');
    $stmt->execute([(int)$_GET['edit']]);
    $edit = $stmt->fetch();
}

admin_header('Categories & MOQ');
?>

<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
  <div>
    <span class="font-mono text-xs uppercase tracking-widest text-[#C51E28] font-bold">CATALOG TAXONOMY</span>
    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mt-1">Categories &amp; Custom MOQs</h1>
    <p class="text-sm text-gray-500 mt-1">
      Manage manufacturing divisions, product lines, custom category MOQs, editorial kickers, and hero descriptions.
    </p>
  </div>
  <a href="/admin/categories.php" class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#C51E28] text-white rounded-xl text-xs font-mono font-bold tracking-wider uppercase shadow-sm hover:bg-[#A81822]">
    <span>+ New Category</span>
  </a>
</div>

<?php if ($error): ?>
  <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 text-rose-900 px-4 py-3 text-sm">
    <?= e($error) ?>
  </div>
<?php endif; ?>

<div class="grid lg:grid-cols-12 gap-8 items-start">
  
  <!-- Left Column: Categories Table (7 cols) -->
  <div class="lg:col-span-7 bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
    <div class="p-4 bg-gray-50/80 border-b border-gray-100 flex items-center justify-between text-xs font-mono text-gray-500">
      <span>Total Categories: <?= count($cats) ?></span>
      <span>Global Fallback MOQ: <?= e(get_site_moq()) ?></span>
    </div>
    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead>
          <tr class="border-b text-left text-gray-500 font-mono text-xs uppercase bg-gray-50/40">
            <th class="p-3.5">Category</th>
            <th class="p-3.5">Parent</th>
            <th class="p-3.5">Category MOQ</th>
            <th class="p-3.5">Styles</th>
            <th class="p-3.5 text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          <?php foreach ($cats as $c): ?>
            <tr class="hover:bg-gray-50/80 transition-colors <?= ($edit['id'] ?? 0) === $c['id'] ? 'bg-amber-50/60' : '' ?>">
              <td class="p-3.5">
                <a href="/<?= e($c['slug']) ?>/" target="_blank" class="font-semibold text-gray-900 hover:text-[#C51E28] flex items-center gap-1.5">
                  <span><?= e($c['name']) ?></span>
                  <span class="text-xs text-gray-400">↗</span>
                </a>
                <?php if (!empty($c['kicker'])): ?>
                  <span class="font-mono text-[10px] text-[#C51E28] uppercase tracking-wider block mt-0.5"><?= e($c['kicker']) ?></span>
                <?php endif; ?>
              </td>
              <td class="p-3.5 text-xs text-gray-500 font-mono">
                <?= e($c['parent_name'] ?? '— Top Level —') ?>
              </td>
              <td class="p-3.5 text-xs font-mono">
                <?php if (!empty($c['custom_moq'])): ?>
                  <span class="px-2 py-0.5 rounded bg-rose-50 border border-rose-200 text-[#C51E28] font-bold"><?= e($c['custom_moq']) ?></span>
                <?php else: ?>
                  <span class="text-gray-400"><?= e(get_site_moq()) ?> (Global)</span>
                <?php endif; ?>
              </td>
              <td class="p-3.5 text-xs font-mono font-bold text-gray-700">
                <?= $c['product_count'] ?>
              </td>
              <td class="p-3.5 text-right whitespace-nowrap text-xs font-mono">
                <a href="/admin/categories.php?edit=<?= $c['id'] ?>" class="text-blue-600 hover:underline mr-3 font-semibold">Edit</a>
                <a href="/admin/categories.php?delete=<?= $c['id'] ?>&csrf=<?= csrf_token() ?>" onclick="return confirm('Delete this category?')" class="text-rose-600 hover:underline">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Right Column: Add/Edit Form (5 cols) -->
  <div class="lg:col-span-5 bg-white rounded-2xl border border-gray-200/80 p-6 shadow-sm sticky top-24">
    <div class="flex items-center justify-between pb-3 mb-5 border-b border-gray-100">
      <h2 class="font-bold text-gray-900 font-mono uppercase text-sm">
        <?= $edit ? 'Edit Category #' . $edit['id'] : 'Create New Category' ?>
      </h2>
      <?php if ($edit): ?>
        <a href="/admin/categories.php" class="text-xs text-gray-500 hover:text-gray-900 font-mono">✕ Cancel</a>
      <?php endif; ?>
    </div>

    <form method="post" enctype="multipart/form-data" class="space-y-4">
      <input type="hidden" name="csrf" value="<?= csrf_token() ?>">
      <input type="hidden" name="id" value="<?= $edit['id'] ?? 0 ?>">

      <div>
        <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-1">Category Name *</label>
        <input name="name" value="<?= e($edit['name'] ?? '') ?>" required 
               class="w-full px-3.5 py-2 rounded-xl border border-gray-300 text-sm font-medium focus:ring-2 focus:ring-[#C51E28]">
      </div>

      <div>
        <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-1">Parent Hierarchy</label>
        <select name="parent_id" class="w-full px-3.5 py-2 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-[#C51E28]">
          <option value="0">— Top Level Manufacturing Division —</option>
          <?php foreach ($tops as $t): ?>
            <?php if (($edit['id'] ?? 0) != $t['id']): ?>
              <option value="<?= $t['id'] ?>" <?= (($edit['parent_id'] ?? 0) == $t['id']) ? 'selected' : '' ?>><?= e($t['name']) ?></option>
            <?php endif; ?>
          <?php endforeach; ?>
        </select>
      </div>

      <div>
        <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-1">
          Custom Category MOQ (Overrides Global Default)
        </label>
        <input name="custom_moq" value="<?= e($edit['custom_moq'] ?? '') ?>" placeholder="e.g. 50 Pcs / Style (Leave empty to use global)" 
               class="w-full px-3.5 py-2 rounded-xl border border-gray-300 text-xs font-mono focus:ring-2 focus:ring-[#C51E28]">
        <p class="text-[11px] text-gray-500 mt-1 font-mono">Current global default: <?= e(get_site_moq()) ?></p>
      </div>

      <div>
        <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-1">Editorial Red Kicker</label>
        <input name="kicker" value="<?= e($edit['kicker'] ?? '') ?>" placeholder="e.g. MOTORCYCLE RACING" 
               class="w-full px-3.5 py-2 rounded-xl border border-gray-300 text-xs font-mono text-[#C51E28] focus:ring-2 focus:ring-[#C51E28]">
      </div>

      <div>
        <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-1">Category Hero Lead Description</label>
        <textarea name="lead_text" rows="2" placeholder="Custom editorial summary for the category hero banner" 
                  class="w-full px-3.5 py-2 rounded-xl border border-gray-300 text-xs leading-relaxed"><?= e($edit['lead_text'] ?? '') ?></textarea>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-1">Sort Order</label>
          <input type="number" name="sort_order" value="<?= (int)($edit['sort_order'] ?? 0) ?>" 
                 class="w-full px-3.5 py-2 rounded-xl border border-gray-300 text-xs font-mono">
        </div>
        <div>
          <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-1">Meta Description</label>
          <input name="meta_description" value="<?= e($edit['meta_description'] ?? '') ?>" maxlength="255" placeholder="SEO description" 
                 class="w-full px-3.5 py-2 rounded-xl border border-gray-300 text-xs">
        </div>
      </div>

      <div>
        <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-1">Category Image URL</label>
        <input name="image" value="<?= e($edit['image'] ?? '') ?>" placeholder="/assets/images/..." 
               class="w-full px-3.5 py-2 rounded-xl border border-gray-300 text-xs font-mono mb-2">
        <label class="block text-[11px] font-mono text-gray-500 mb-1">Or upload new banner:</label>
        <input type="file" name="image_file" accept="image/*" class="text-xs text-gray-500">
      </div>

      <div class="pt-3 border-t border-gray-100 flex items-center justify-between">
        <button type="submit" class="bg-[#C51E28] hover:bg-[#A81822] text-white px-6 py-2.5 rounded-xl font-mono text-xs font-bold uppercase tracking-wider shadow-sm transition-colors">
          <?= $edit ? 'Save Changes' : 'Create Category' ?>
        </button>
        <?php if ($edit): ?>
          <a href="/admin/categories.php" class="text-xs text-gray-500 hover:text-gray-900 font-mono">Cancel</a>
        <?php endif; ?>
      </div>

    </form>
  </div>

</div>

<?php admin_footer(); ?>
