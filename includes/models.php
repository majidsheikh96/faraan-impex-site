<?php
/** Data-access layer — all queries use prepared statements. */
declare(strict_types=1);

function get_category_by_slug(string $slug): ?array
{
    $stmt = db()->prepare('SELECT * FROM categories WHERE slug = ? LIMIT 1');
    $stmt->execute([$slug]);
    $row = $stmt->fetch();
    return $row ?: null;
}

function get_top_categories(): array
{
    $stmt = db()->query(
        "SELECT c.*, (SELECT COUNT(*) FROM products p 
         WHERE (p.category_id = c.id OR p.category_id IN (SELECT id FROM categories WHERE parent_id = c.id)) 
         AND p.is_active = 1) AS live_count 
         FROM categories c 
         WHERE c.parent_id IS NULL AND c.slug != 'uncategorized' 
         ORDER BY c.sort_order"
    );
    return $stmt->fetchAll();
}

function get_subcategories(int $parentId): array
{
    $stmt = db()->prepare('SELECT * FROM categories WHERE parent_id = ? ORDER BY sort_order, name');
    $stmt->execute([$parentId]);
    return $stmt->fetchAll();
}

/** All active products in a category + its subcategories. */
function get_products_by_category(int $categoryId, int $limit = 48, int $offset = 0): array
{
    $stmt = db()->prepare(
        'SELECT * FROM products WHERE is_active = 1
         AND (category_id = ? OR category_id IN (SELECT id FROM categories WHERE parent_id = ?))
         ORDER BY sort_order, name LIMIT ? OFFSET ?'
    );
    $stmt->bindValue(1, $categoryId, PDO::PARAM_INT);
    $stmt->bindValue(2, $categoryId, PDO::PARAM_INT);
    $stmt->bindValue(3, $limit, PDO::PARAM_INT);
    $stmt->bindValue(4, $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

function get_product_by_slug(string $slug): ?array
{
    $stmt = db()->prepare(
        'SELECT p.*, c.name AS category_name, c.slug AS category_slug
         FROM products p JOIN categories c ON c.id = p.category_id
         WHERE p.slug = ? AND p.is_active = 1 LIMIT 1'
    );
    $stmt->execute([$slug]);
    $row = $stmt->fetch();
    return $row ?: null;
}

function get_featured_products(int $limit = 8): array
{
    $stmt = db()->prepare(
        'SELECT p.*, c.slug AS category_slug FROM products p JOIN categories c ON c.id = p.category_id
         WHERE p.is_active = 1 AND p.is_featured = 1
         ORDER BY p.sort_order, p.name LIMIT ?'
    );
    $stmt->bindValue(1, $limit, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    if (empty($rows)) {
        // Fallback to active catalog items with images for homepage showcase
        $stmt = db()->prepare(
            'SELECT p.*, c.slug AS category_slug FROM products p JOIN categories c ON c.id = p.category_id
             WHERE p.is_active = 1 AND p.image IS NOT NULL AND p.image != ""
             ORDER BY p.sort_order, p.id LIMIT ?'
        );
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }
    return $rows;
}

function get_related_products(int $categoryId, int $excludeId, int $limit = 4): array
{
    $stmt = db()->prepare(
        'SELECT * FROM products WHERE is_active = 1 AND category_id = ? AND id != ?
         ORDER BY sort_order, name LIMIT ?'
    );
    $stmt->bindValue(1, $categoryId, PDO::PARAM_INT);
    $stmt->bindValue(2, $excludeId, PDO::PARAM_INT);
    $stmt->bindValue(3, $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}
