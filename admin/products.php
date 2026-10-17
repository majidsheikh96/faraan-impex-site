<?php
/** Admin: product list + delete. */
declare(strict_types=1);
require_once __DIR__ . '/layout.php';

// Delete
if (isset($_GET['delete']) && isset($_GET['csrf']) && verify_csrf($_GET['csrf'])) {
    $id = (int)$_GET['delete'];
    $stmt = db()->prepare('SELECT image FROM products WHERE id = ?');
    $stmt->execute([$id]);
    $img = $stmt->fetchColumn();
    db()->prepare('DELETE FROM products WHERE id = ?')->execute([$id]);
    if ($img && str_starts_with($img, 'assets/')) {
        @unlink(__DIR__ . '/../' . $img);
    }
    flash_set('Product deleted.');
    header('Location: /admin/products.php');
    exit;
}

$search = trim($_GET['q'] ?? '');
if ($search) {
    $stmt = db()->prepare(
        'SELECT p.*, c.name AS cat_name FROM products p
         JOIN categories c ON c.id = p.category_id
         WHERE p.name LIKE ? OR p.sku LIKE ? ORDER BY p.name LIMIT 200'
    );
    $stmt->execute(["%$search%", "%$search%"]);
} else {
    $stmt = db()->query(
        'SELECT p.*, c.name AS cat_name FROM products p
         JOIN categories c ON c.id = p.category_id
         ORDER BY p.name LIMIT 200'
    );
}
$products = $stmt->fetchAll();

admin_header('Products');
$flash = flash_get();
if ($flash) echo '<p class="bg-green-100 text-green-800 rounded px-4 py-2 mb-4 text-sm">' . e($flash) . '</p>';
?>
<div class="flex justify-between items-center mb-6">
  <h1 class="text-2xl font-extrabold">Products (<?= count($products) ?>)</h1>
  <a href="/admin/product_edit.php" class="bg-[#0A0A0A] text-white px-4 py-2 rounded font-medium text-sm">+ Add Product</a>
</div>
<form method="get" class="mb-4">
  <input name="q" value="<?= e($search) ?>" placeholder="Search name or SKU..." class="border rounded px-3 py-2 w-64 text-sm">
  <button class="bg-[#E10600] text-white px-4 py-2 rounded text-sm">Search</button>
</form>
<div class="bg-white rounded-xl border overflow-x-auto">
<table class="w-full text-sm">
  <tr class="border-b text-left text-gray-500"><th class="p-3">Name</th><th class="p-3">SKU</th><th class="p-3">Category</th><th class="p-3">Featured</th><th class="p-3">Active</th><th class="p-3"></th></tr>
  <?php foreach ($products as $p): ?>
  <tr class="border-b hover:bg-gray-50">
    <td class="p-3 font-medium"><?= e($p['name']) ?></td>
    <td class="p-3 text-gray-500"><?= e($p['sku']) ?></td>
    <td class="p-3"><?= e($p['cat_name']) ?></td>
    <td class="p-3"><?= $p['is_featured'] ? '★' : '' ?></td>
    <td class="p-3"><?= $p['is_active'] ? 'Yes' : 'No' ?></td>
    <td class="p-3 whitespace-nowrap">
      <a href="/admin/product_edit.php?id=<?= $p['id'] ?>" class="text-blue-600 hover:underline mr-3">Edit</a>
      <a href="/admin/products.php?delete=<?= $p['id'] ?>&csrf=<?= csrf_token() ?>" onclick="return confirm('Delete this product?')" class="text-red-600 hover:underline">Delete</a>
    </td>
  </tr>
  <?php endforeach; ?>
</table>
</div>
<?php admin_footer(); ?>
