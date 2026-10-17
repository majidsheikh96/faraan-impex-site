<?php
/** Admin: add/edit product. */
declare(strict_types=1);
require_once __DIR__ . '/layout.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$product = null;
if ($id) {
    $stmt = db()->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$id]);
    $product = $stmt->fetch();
    if (!$product) { header('Location: /admin/products.php'); exit; }
}

$cats = db()->query('SELECT id, name, parent_id FROM categories ORDER BY parent_id IS NOT NULL, sort_order, name')->fetchAll();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf($_POST['csrf'] ?? '')) $error = 'Invalid request.';
    else {
        try {
            $name = trim($_POST['name'] ?? '');
            $sku = trim($_POST['sku'] ?? '');
            $category_id = (int)($_POST['category_id'] ?? 0);
            $description = trim($_POST['description'] ?? '');
            $meta_description = trim($_POST['meta_description'] ?? '');
            $is_featured = isset($_POST['is_featured']) ? 1 : 0;
            $is_active = isset($_POST['is_active']) ? 1 : 0;
            if ($name === '' || $category_id === 0) throw new Exception('Name and category are required.');

            $slug = $product['slug'] ?? make_slug($name . '-' . $sku);
            // Ensure unique slug
            $s = $slug; $n = 1;
            while (true) {
                $chk = db()->prepare('SELECT id FROM products WHERE slug = ? AND id != ?');
                $chk->execute([$s, $id]);
                if (!$chk->fetch()) break;
                $s = $slug . '-' . (++$n);
            }
            $slug = $s;

            $image = $product['image'] ?? null;
            if (!empty($_FILES['image']['name'])) {
                $new = handle_image_upload($_FILES['image'], $slug);
                if ($new) {
                    if ($image && str_starts_with($image, 'assets/')) @unlink(__DIR__ . '/../public/' . $image);
                    $image = $new;
                }
            }

            if ($id) {
                $stmt = db()->prepare(
                    'UPDATE products SET name=?, sku=?, slug=?, category_id=?, description=?, image=?, meta_description=?, is_featured=?, is_active=? WHERE id=?'
                );
                $stmt->execute([$name, $sku, $slug, $category_id, $description, $image, $meta_description, $is_featured, $is_active, $id]);
            } else {
                $stmt = db()->prepare(
                    'INSERT INTO products (name, sku, slug, category_id, description, image, meta_description, is_featured, is_active) VALUES (?,?,?,?,?,?,?,?,?)'
                );
                $stmt->execute([$name, $sku, $slug, $category_id, $description, $image, $meta_description, $is_featured, $is_active]);
                $id = (int)db()->lastInsertId();
            }
            flash_set('Product saved.');
            header('Location: /admin/product_edit.php?id=' . $id);
            exit;
        } catch (Exception $ex) {
            $error = $ex->getMessage();
        }
    }
}

$v = fn($k) => e((string)($_POST[$k] ?? $product[$k] ?? ''));
admin_header($id ? 'Edit Product' : 'Add Product');
if ($error) echo '<p class="bg-red-100 text-red-800 rounded px-4 py-2 mb-4 text-sm">' . e($error) . '</p>';
?>
<h1 class="text-2xl font-extrabold mb-6"><?= $id ? 'Edit' : 'Add' ?> Product</h1>
<form method="post" enctype="multipart/form-data" class="bg-white rounded-xl border p-6 space-y-4 max-w-2xl">
  <input type="hidden" name="csrf" value="<?= csrf_token() ?>">
  <div><label class="text-sm font-medium">Name *</label><input name="name" value="<?= $v('name') ?>" required class="mt-1 w-full border rounded px-3 py-2"></div>
  <div class="grid grid-cols-2 gap-4">
    <div><label class="text-sm font-medium">SKU</label><input name="sku" value="<?= $v('sku') ?>" class="mt-1 w-full border rounded px-3 py-2"></div>
    <div><label class="text-sm font-medium">Category *</label>
      <select name="category_id" class="mt-1 w-full border rounded px-3 py-2">
        <?php foreach ($cats as $c): ?>
          <option value="<?= $c['id'] ?>" <?= ((int)($_POST['category_id'] ?? $product['category_id'] ?? 0) === (int)$c['id']) ? 'selected' : '' ?>><?= e($c['name']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div><label class="text-sm font-medium">Description</label><textarea name="description" rows="4" class="mt-1 w-full border rounded px-3 py-2"><?= $v('description') ?></textarea></div>
  <div><label class="text-sm font-medium">Meta Description (SEO)</label><input name="meta_description" value="<?= $v('meta_description') ?>" maxlength="255" class="mt-1 w-full border rounded px-3 py-2"></div>
  <div>
    <label class="text-sm font-medium">Product Image</label>
    <?php if (!empty($product['image'])): ?><p class="text-xs text-gray-500 mb-1">Current: <?= e($product['image']) ?></p><?php endif; ?>
    <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="mt-1 text-sm">
  </div>
  <div class="flex gap-6 text-sm">
    <label><input type="checkbox" name="is_featured" <?= ($_POST['is_featured'] ?? $product['is_featured'] ?? 0) ? 'checked' : '' ?>> Featured</label>
    <label><input type="checkbox" name="is_active" <?= ($_POST['is_active'] ?? $product['is_active'] ?? 1) ? 'checked' : '' ?>> Active</label>
  </div>
  <div class="flex gap-3">
    <button class="bg-[#0A0A0A] text-white px-6 py-2 rounded font-medium">Save</button>
    <a href="/admin/products.php" class="px-4 py-2 text-sm text-gray-500">Cancel</a>
  </div>
</form>
<?php admin_footer(); ?>
