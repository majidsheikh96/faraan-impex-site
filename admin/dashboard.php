<?php
/** Admin dashboard — overview. Product/category CRUD comes next. */
declare(strict_types=1);

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/auth.php';

require_admin_login();

$stats = [
    'products'   => (int)db()->query('SELECT COUNT(*) FROM products')->fetchColumn(),
    'categories' => (int)db()->query('SELECT COUNT(*) FROM categories')->fetchColumn(),
    'featured'   => (int)db()->query('SELECT COUNT(*) FROM products WHERE is_featured = 1')->fetchColumn(),
];
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard — Faraan Impex Admin</title><link rel="stylesheet" href="/assets/css/main.css"></head>
<body class="bg-[#FAF7F2]">
<div class="max-w-5xl mx-auto px-4 py-10">
  <div class="flex justify-between items-center mb-8">
    <h1 class="text-2xl font-extrabold">Dashboard</h1>
    <a href="/admin/logout.php" class="text-sm text-[#E10600] hover:underline">Log out</a>
  </div>
  <div class="grid grid-cols-3 gap-6">
    <div class="bg-white rounded-xl border p-6"><div class="text-3xl font-extrabold"><?= $stats['products'] ?></div><div class="text-sm text-gray-500">Products</div></div>
    <div class="bg-white rounded-xl border p-6"><div class="text-3xl font-extrabold"><?= $stats['categories'] ?></div><div class="text-sm text-gray-500">Categories</div></div>
    <div class="bg-white rounded-xl border p-6"><div class="text-3xl font-extrabold"><?= $stats['featured'] ?></div><div class="text-sm text-gray-500">Featured</div></div>
  </div>
  <p class="mt-8 text-sm text-gray-500">Product &amp; category management (CRUD) — next build step.</p>
</div>
</body>
</html>
