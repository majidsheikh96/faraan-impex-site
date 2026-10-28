<?php
// Temporary DB diagnostic — DELETE after use
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

header('Content-Type: text/plain');
try {
    $pdo = db();
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    echo "Connected OK\nTables: " . implode(', ', $tables) . "\n";
    if (in_array('categories', $tables)) {
        $n = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();
        echo "Categories: $n rows\n";
    } else {
        echo "categories table: MISSING\n";
    }
    if (in_array('products', $tables)) {
        $n = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
        echo "Products: $n rows\n";
    } else {
        echo "products table: MISSING\n";
    }
} catch (Throwable $e) {
    echo "DB ERROR: " . $e->getMessage() . "\n";
}
