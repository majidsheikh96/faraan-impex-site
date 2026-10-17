<?php
/** Admin: category list + add/edit/delete. */
declare(strict_types=1);
require_once __DIR__ . '/layout.php';

$error = '';

// Delete (only if no products)
if (isset($_GET['delete']) && isset($_GET['csrf']) && verify_csrf($_GET['csrf'])) {
    $id = (int)$_GET['delete'];
    $cnt = db()->prepare('SELECT COUNT(*) FROM products WHERE category_id = ?');
    $cnt->execute([$id]);
    if ((int)$cnt->fetchColumn() > 0) {
        $error = 'Cannot delete: category has products. Move them first.';
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
    if ($name !== '') {
        $slug = make_slug($name);
        $s = $slug; $n = 1;
        while (true) {
            $chk = db()->prepare('SELECT id FROM categories WHERE slug = ? AND id != ?');
            $chk->execute([$s, $id]);
            if (!$chk->fetch()) break;
            $s = $slug . '-' . (++$n);
        }
        if ($id) {
            db()->prepare('UPDATE categories SET name=?, slug=?, parent_id=?, meta_description=? WHERE id=?')
              ->execute([$name, $s, $parent_id, $meta_description, $id]);
        } else {
            db()->prepare('INSERT INTO categories (name, slug, parent_id, meta_description) VALUES (?,?,?,?)')
              ->execute([$name, $s, $parent_id, $meta_description]);
        }
        flash_set('Category saved.');
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

admin_header('Categories');
$flash = flash_get();
if ($flash) echo '<p class="bg-green-100 text-green-800 rounded px-4 py-2 mb-4 text-sm">' . e($flash) . '</p>';
if ($error) echo '<p class="bg-red-100 text-red-800 rounded px-4 py-2 mb-4 text-sm">' . e($error) . '</p>';
?>
<h1 class="text-2xl font-extrabold mb-6">Categories</h1>
<div class="grid lg:grid-cols-2 gap-8">
<div class="bg-white rounded-xl border overflow-x-auto">
<table class="w-full text-sm">
  <tr class="border-b text-left text-gray-500"><th class="p-3">Name</th><th class="p-3">Parent</th><th class="p-3">Products</th><th class="p-3"></th></tr>
  <?php foreach ($cats as $c): ?>
  <tr class="border-b hover:bg-gray-50">
    <td class="p-3 font-medium"><?= e($c['name']) ?></td>
    <td class="p-3 text-gray-500"><?= e($c['parent_name'] ?? '—') ?></td>
    <td class="p-3"><?= $c['product_count'] ?></td>
    <td class="p-3 whitespace-nowrap">
      <a href="/admin/categories.php?edit=<?= $c['id'] ?>" class="text-blue-600 hover:underline mr-3">Edit</a>
      <a href="/admin/categories.php?delete=<?= $c['id'] ?>&csrf=<?= csrf_token() ?>" onclick="return confirm('Delete?')" class="text-red-600 hover:underline">Delete</a>
    </td>
  </tr>
  <?php endforeach; ?>
</table>
</div>
<div class="bg-white rounded-xl border p-6 h-fit">
  <h2 class="font-bold mb-4"><?= $edit ? 'Edit' : 'Add' ?> Category</h2>
  <form method="post" class="space-y-4">
    <input type="hidden" name="csrf" value="<?= csrf_token() ?>">
    <input type="hidden" name="id" value="<?= $edit['id'] ?? 0 ?>">
    <div><label class="text-sm font-medium">Name *</label><input name="name" value="<?= e($edit['name'] ?? '') ?>" required class="mt-1 w-full border rounded px-3 py-2"></div>
    <div><label class="text-sm font-medium">Parent</label>
      <select name="parent_id" class="mt-1 w-full border rounded px-3 py-2">
        <option value="0">— Top level —</option>
        <?php foreach ($tops as $t): ?>
          <?php if (($edit['id'] ?? 0) != $t['id']): ?>
          <option value="<?= $t['id'] ?>" <?= (($edit['parent_id'] ?? 0) == $t['id']) ? 'selected' : '' ?>><?= e($t['name']) ?></option>
          <?php endif; ?>
        <?php endforeach; ?>
      </select>
    </div>
    <div><label class="text-sm font-medium">Meta Description</label><input name="meta_description" value="<?= e($edit['meta_description'] ?? '') ?>" maxlength="255" class="mt-1 w-full border rounded px-3 py-2"></div>
    <button class="bg-[#0A0A0A] text-white px-6 py-2 rounded font-medium text-sm">Save</button>
    <?php if ($edit): ?><a href="/admin/categories.php" class="text-sm text-gray-500 ml-3">Cancel</a><?php endif; ?>
  </form>
</div>
</div>
<?php admin_footer(); ?>
