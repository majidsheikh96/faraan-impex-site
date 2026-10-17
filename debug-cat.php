<?php
// Temporary debug script - DELETE AFTER USE
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/models.php';

header('Content-Type: text/plain');

echo "=== Category lookup ===\n";
$cat = get_category_by_slug('aprons');
var_dump($cat);

echo "\n=== Products by category ===\n";
if ($cat) {
    $products = get_products_by_category((int)$cat['id']);
    echo "Count: " . count($products) . "\n";
    if ($products) {
        echo "First: " . $products[0]['name'] . " | image: " . ($products[0]['image'] ?? 'NULL') . "\n";
    }
}

echo "\n=== Direct product count ===\n";
$stmt = db()->query("SELECT COUNT(*) FROM products WHERE is_active = 1");
echo "Active products: " . $stmt->fetchColumn() . "\n";

echo "\n=== Sample product category_ids ===\n";
$stmt = db()->query("SELECT id, name, category_id, image FROM products LIMIT 3");
foreach ($stmt->fetchAll() as $r) {
    echo "{$r['id']}: {$r['name']} | cat={$r['category_id']} | img=" . ($r['image'] ?? 'NULL') . "\n";
}
