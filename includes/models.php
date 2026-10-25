<?php
/**
 * Data-access & CMS Settings Layer — all queries use prepared statements.
 * Manages Products, Categories, Global Site Settings, Hero Slides & Page Content.
 */
declare(strict_types=1);

/**
 * Self-healing schema migration: Ensures site_settings and category columns exist.
 * Runs once per request life-cycle.
 */
function ensure_settings_schema(): void
{
    static $checked = false;
    if ($checked) return;
    $checked = true;

    try {
        db()->exec("CREATE TABLE IF NOT EXISTS site_settings (
            setting_key VARCHAR(100) NOT NULL PRIMARY KEY,
            setting_value LONGTEXT NOT NULL,
            setting_group VARCHAR(50) NOT NULL DEFAULT 'general',
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // Ensure extended category columns exist
        $cols = db()->query("SHOW COLUMNS FROM categories")->fetchAll(PDO::FETCH_COLUMN);
        if (!in_array('kicker', $cols, true)) {
            db()->exec("ALTER TABLE categories ADD COLUMN kicker VARCHAR(100) NULL AFTER meta_description");
        }
        if (!in_array('lead_text', $cols, true)) {
            db()->exec("ALTER TABLE categories ADD COLUMN lead_text TEXT NULL AFTER kicker");
        }
        if (!in_array('custom_moq', $cols, true)) {
            db()->exec("ALTER TABLE categories ADD COLUMN custom_moq VARCHAR(60) NULL AFTER lead_text");
        }
        if (!in_array('image', $cols, true)) {
            db()->exec("ALTER TABLE categories ADD COLUMN image VARCHAR(255) NULL AFTER custom_moq");
        }
    } catch (Throwable $e) {
        // fail-soft
    }
}

/**
 * Retrieve a site setting with fast in-memory caching (1 single query per request).
 */
function get_setting(string $key, string $default = ''): string
{
    static $settings = null;
    if ($settings === null) {
        $settings = [];
        try {
            ensure_settings_schema();
            $rows = db()->query('SELECT setting_key, setting_value FROM site_settings')->fetchAll();
            foreach ($rows as $r) {
                $settings[$r['setting_key']] = $r['setting_value'];
            }
        } catch (Throwable $e) {
            // fail-soft
        }
    }
    return $settings[$key] ?? $default;
}

/**
 * Retrieve a JSON-encoded setting as a PHP associative array.
 */
function get_json_setting(string $key, array $default = []): array
{
    $val = get_setting($key, '');
    if ($val === '') return $default;
    $decoded = json_decode($val, true);
    return is_array($decoded) ? $decoded : $default;
}

/**
 * Update or insert a site setting into the database.
 */
function update_setting(string $key, string $value, string $group = 'general'): void
{
    ensure_settings_schema();
    $stmt = db()->prepare(
        'INSERT INTO site_settings (setting_key, setting_value, setting_group) 
         VALUES (?, ?, ?) 
         ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value), setting_group = VALUES(setting_group)'
    );
    $stmt->execute([$key, $value, $group]);
}

/** Global MOQ helper */
function get_site_moq(): string
{
    return get_setting('global_moq', '50 Pcs / Style');
}

/** Hero Slides data getter with resilient fallback (copy from the approved design). */
function get_hero_slides_data(): array
{
    $slides = get_json_setting('hero_slides_json', []);
    if (!empty($slides)) return $slides;

    return [
        ['number' => '01', 'tab_label' => 'Racing', 'kicker' => 'RACING DIVISION',
         'title' => 'Precision racewear. Built for the track.',
         'lead' => '1.3mm race cowhide suits, speed humps and carbon knuckle gloves, built around CE Level 2 armor.',
         'pills' => [], 'primary_cta_text' => 'Explore Racing Division', 'primary_cta_url' => '/leather-wears/',
         'secondary_cta_text' => 'Start an RFQ', 'secondary_cta_url' => '/contact-us',
         'image' => '/assets/images/client/hero-rider.jpg', 'image_pos' => 'object-center'],
        ['number' => '02', 'tab_label' => 'Textiles', 'kicker' => 'TEXTILE DIVISION',
         'title' => 'Technical flannels & all-weather shells.',
         'lead' => '280 GSM flannels and Cordura® 1000D jackets, cut and sewn to your tech pack.',
         'pills' => [], 'primary_cta_text' => 'Explore Textile Division', 'primary_cta_url' => '/textile-wears/',
         'secondary_cta_text' => 'Request Swatches', 'secondary_cta_url' => '/contact-us',
         'image' => '/assets/images/client/hero-flannel.jpg', 'image_pos' => 'object-[80%_center]'],
        ['number' => '03', 'tab_label' => 'Western', 'kicker' => 'WESTERN DIVISION',
         'title' => 'Artisanal western hats & heritage suede.',
         'lead' => 'Hand-blocked hats and fringed suede jackets for western labels.',
         'pills' => [], 'primary_cta_text' => 'Explore Western Division', 'primary_cta_url' => '/western-wears/',
         'secondary_cta_text' => 'Order Custom Hats', 'secondary_cta_url' => '/contact-us',
         'image' => '/assets/images/client/hero-hat.jpg', 'image_pos' => 'object-[85%_center]'],
        ['number' => '04', 'tab_label' => 'Leather goods', 'kicker' => 'LEATHER GOODS DIVISION',
         'title' => 'Biker club vests & heavy leather goods.',
         'lead' => 'Concho-chain vests and workshop aprons, made to spec with your branding.',
         'pills' => [], 'primary_cta_text' => 'Explore Leather Goods', 'primary_cta_url' => '/leather-products/',
         'secondary_cta_text' => 'Submit Vest Tech Pack', 'secondary_cta_url' => '/contact-us',
         'image' => '/assets/images/client/hero-vest.jpg', 'image_pos' => 'object-[80%_center]'],
    ];
}

/** Homepage divisions getter with fallback. */
function get_divisions_data(): array
{
    $divs = get_json_setting('divisions_json', []);
    if (!empty($divs)) return $divs;

    return [
        ['slug' => 'leather-wears', 'href' => '/leather-wears/', 'number' => '01', 'kicker' => 'MOTORCYCLE RACING',
         'title' => 'Motorcycle Racing Suits & Track Gear',
         'image' => '/assets/images/client/card-racing.jpg',
         'lead' => '1.3mm race cowhide suits, speed humps and carbon knuckle gloves, built around CE Level 2 armor.',
         'specs' => ['Cowhide', 'CE Armor', 'Gloves'], 'cta' => 'Explore'],
        ['slug' => 'textile-wears', 'href' => '/textile-wears/', 'number' => '02', 'kicker' => 'TECHNICAL TEXTILES',
         'title' => 'Technical Textiles & Plaid Flannels',
         'image' => '/assets/images/client/card-flannel.jpg',
         'lead' => '280 GSM flannels, denim, and Cordura® 1000D all-weather jackets and pilot shells.',
         'specs' => ['Flannel', 'Cordura®', 'Denim'], 'cta' => 'Explore'],
        ['slug' => 'western-wears', 'href' => '/western-wears/', 'number' => '03', 'kicker' => 'WESTERN WEAR',
         'title' => 'Western Heritage & Custom Headwear',
         'image' => '/assets/images/client/card-hat.jpg',
         'lead' => 'Hand-blocked hats, fringed suede jackets, chaps and saddlery for western labels.',
         'specs' => ['Hats', 'Suede', 'Chaps'], 'cta' => 'Explore'],
        ['slug' => 'leather-products', 'href' => '/leather-products/', 'number' => '04', 'kicker' => 'LEATHER GOODS & VESTS',
         'title' => 'Biker Vests & Artisan Leather Goods',
         'image' => '/assets/images/client/card-vest.jpg',
         'lead' => 'Concho-chain club vests, workshop aprons, wallets, bags and heavy leather goods.',
         'specs' => ['Vests', 'Aprons', 'Bags'], 'cta' => 'Explore'],
    ];
}

/** Capabilities getter (dark section). */
function get_capabilities_data(): array
{
    $caps = get_json_setting('capabilities_json', []);
    if (!empty($caps)) return $caps;

    return [
        ['number' => '01', 'title' => 'Multi-hide tanning & grading', 'desc' => 'Hides sorted and graded before cutting, so panels match across the batch.'],
        ['number' => '02', 'title' => 'Heavy flannels & Cordura® 1000D', 'desc' => '280 GSM flannel and 1000D shells for outerwear that takes weather.'],
        ['number' => '03', 'title' => 'CE armor & carbon shielding', 'desc' => 'CE Level 2 armor and carbon protection fitted into racewear patterns.'],
        ['number' => '04', 'title' => 'Conchos & YKK® fasteners', 'desc' => 'Hardware sourced to spec for vests, jackets and leather goods.'],
        ['number' => '05', 'title' => 'Hand-blocked hats', 'desc' => 'Custom crowns and brims shaped by hand for western headwear.'],
        ['number' => '06', 'title' => 'Digital CAD & rapid sampling', 'desc' => 'CAD patterning turns your tech pack into a counter-sample in 7–10 days.'],
    ];
}

/** Trust points getter (kept for the admin editor). */
function get_trust_points_data(): array
{
    $points = get_json_setting('trust_points_json', []);
    if (!empty($points)) return $points;

    return [
        ['title' => 'Specification Review', 'desc' => 'Reference image, CAD tech pack or design brief'],
        ['title' => 'Rapid Sampling', 'desc' => 'Validate leather hand-feel, textile weave & armor fit'],
        ['title' => 'Private-Label Finishing', 'desc' => 'Custom debossed badges, hardware, woven labels & trims'],
        ['title' => 'Direct Factory Export', 'desc' => 'Door-to-door air freight & sea cargo to US & Europe'],
    ];
}

/** OEM Process steps getter. */
function get_process_steps_data(): array
{
    $steps = get_json_setting('process_steps_json', []);
    if (!empty($steps)) return $steps;

    return [
        ['num' => '01', 'title' => 'Tech pack & material grading', 'desc' => 'Send your pack. We grade hides and fabrics against it before anything is cut.'],
        ['num' => '02', 'title' => 'Precision counter-sample', 'desc' => 'Your first sample in 7–10 days. Production starts only after you sign it off.'],
        ['num' => '03', 'title' => 'Batch cutting & assembly', 'desc' => 'The batch is cut and stitched to the approved sample, style by style.'],
        ['num' => '04', 'title' => 'Dual-station QC & export', 'desc' => 'Two inspection stations, then door-to-door air or ocean freight.'],
    ];
}

/* ==========================================================================
   Catalog Categories & Products
   ========================================================================== */

function get_category_by_slug(string $slug): ?array
{
    ensure_settings_schema();
    $stmt = db()->prepare('SELECT * FROM categories WHERE slug = ? LIMIT 1');
    $stmt->execute([$slug]);
    $row = $stmt->fetch();
    return $row ?: null;
}

function get_top_categories(): array
{
    ensure_settings_schema();
    $stmt = db()->query(
        "SELECT c.*, (SELECT COUNT(*) FROM products p 
         WHERE (p.category_id = c.id OR p.category_id IN (SELECT id FROM categories WHERE parent_id = c.id)) 
         AND p.is_active = 1) AS live_count 
         FROM categories c 
         WHERE c.parent_id IS NULL AND c.slug != 'uncategorized' 
         ORDER BY c.sort_order, c.name"
    );
    return $stmt->fetchAll();
}

function get_subcategories(int $parentId): array
{
    ensure_settings_schema();
    $stmt = db()->prepare('SELECT * FROM categories WHERE parent_id = ? ORDER BY sort_order, name');
    $stmt->execute([$parentId]);
    return $stmt->fetchAll();
}

/** All active products in a category + its subcategories. */
function get_products_by_category(int $categoryId, int $limit = 48, int $offset = 0): array
{
    $stmt = db()->prepare(
        "SELECT * FROM products WHERE is_active = 1
         AND (category_id = ? OR category_id IN (SELECT id FROM categories WHERE parent_id = ?))
         ORDER BY (image IS NULL OR image = '') ASC, sort_order, name LIMIT ? OFFSET ?"
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
        'SELECT p.*, c.name AS category_name, c.slug AS category_slug, c.custom_moq
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
        "SELECT * FROM products WHERE is_active = 1 AND category_id = ? AND id != ?
         ORDER BY (image IS NULL OR image = '') ASC, sort_order, name LIMIT ?"
    );
    $stmt->bindValue(1, $categoryId, PDO::PARAM_INT);
    $stmt->bindValue(2, $excludeId, PDO::PARAM_INT);
    $stmt->bindValue(3, $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

function get_category_by_id(int $id): ?array
{
    $stmt = db()->prepare('SELECT * FROM categories WHERE id = ? LIMIT 1');
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    return $row ?: null;
}

/** Number of active products in a category + its subcategories. */
function count_products_by_category(int $categoryId): int
{
    $stmt = db()->prepare(
        'SELECT COUNT(*) FROM products WHERE is_active = 1
         AND (category_id = ? OR category_id IN (SELECT id FROM categories WHERE parent_id = ?))'
    );
    $stmt->execute([$categoryId, $categoryId]);
    return (int)$stmt->fetchColumn();
}

/** Active products across every division (for /all-styles/ and the homepage "browse all" button). */
function count_all_products(): int
{
    return (int)db()->query('SELECT COUNT(*) FROM products WHERE is_active = 1')->fetchColumn();
}

function get_all_products(int $limit = 24, int $offset = 0): array
{
    $stmt = db()->prepare(
        "SELECT p.*, c.slug AS category_slug FROM products p JOIN categories c ON c.id = p.category_id
         WHERE p.is_active = 1 ORDER BY (p.image IS NULL OR p.image = '') ASC, p.is_featured DESC, p.sort_order, p.name LIMIT ? OFFSET ?"
    );
    $stmt->bindValue(1, $limit, PDO::PARAM_INT);
    $stmt->bindValue(2, $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

/** Product lines = sub-categories (for the catalogue stat line). */
function count_product_lines(): int
{
    return (int)db()->query('SELECT COUNT(*) FROM categories WHERE parent_id IS NOT NULL')->fetchColumn();
}
