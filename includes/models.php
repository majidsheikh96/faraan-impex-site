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

/** Hero Slides data getter with resilient fallback */
function get_hero_slides_data(): array
{
    $slides = get_json_setting('hero_slides_json', []);
    if (!empty($slides)) return $slides;

    return [
        [
            'number' => '01',
            'tab_label' => 'Motorcycle Racing',
            'kicker' => 'CE LEVEL 2 CERTIFIED · TRACK RACING SUITS · SIALKOT',
            'title' => 'Precision racewear. Built for the track.',
            'lead' => 'Direct private-label manufacturing of 1.3mm race cowhide suits, aerodynamic speed humps, and fortified carbon knuckle gloves tested for severe track slide resistance.',
            'pills' => ['CE Level 2 Armor', '1.3mm Race Cowhide', 'Aerodynamic Speed Hump', 'Carbon Knuckles'],
            'primary_cta_text' => 'Explore Racing Division',
            'primary_cta_url' => '/leather-wears/',
            'secondary_cta_text' => 'Start an RFQ',
            'secondary_cta_url' => '/contact-us',
            'image' => '/assets/images/showcase/hero-slide-racing-2560.jpg',
            'image_pos' => 'object-center'
        ],
        [
            'number' => '02',
            'tab_label' => 'Technical Flannels',
            'kicker' => 'DWR WEATHERPROOF · CORDURA® 1000D APPAREL · SIALKOT',
            'title' => 'Technical flannels & all-weather shells.',
            'lead' => 'Heavyweight 280 GSM yarn-dyed cotton flannels, Cordura® 1000D adventure touring jackets, and ballistic denim outer shells engineered for extreme durability.',
            'pills' => ['Heavy 280 GSM Flannel', 'Cordura® 1000D Shell', 'DWR Water-Repellent', 'Ballistic Denim'],
            'primary_cta_text' => 'Explore Textile Division',
            'primary_cta_url' => '/textile-wears/',
            'secondary_cta_text' => 'Request Swatches',
            'secondary_cta_url' => '/contact-us',
            'image' => '/assets/images/showcase/hero-slide-flannel-2560.jpg',
            'image_pos' => 'object-[80%_center]'
        ],
        [
            'number' => '03',
            'tab_label' => 'Western Headwear',
            'kicker' => 'HAND-BLOCKED LEATHER · FRONTIER CRAFT · SIALKOT',
            'title' => 'Artisanal western hats & heritage suede.',
            'lead' => 'Custom hand-blocked leather top hats, custom-blocked cowboy headwear, fringed roughout suede jackets, and heavy rancher riding chaps built by master craftsmen.',
            'pills' => ['Hand-Blocked Leather', 'Roughout Suede', 'Hand-Cut Fringes', 'Ranch Riding Chaps'],
            'primary_cta_text' => 'Explore Western Division',
            'primary_cta_url' => '/western-wears/',
            'secondary_cta_text' => 'Order Custom Hats',
            'secondary_cta_url' => '/contact-us',
            'image' => '/assets/images/showcase/hero-slide-western-hat-2560.jpg',
            'image_pos' => 'object-[85%_center]'
        ],
        [
            'number' => '04',
            'tab_label' => 'Biker Vests & Gear',
            'kicker' => 'FULL-GRAIN VEG-TAN · BIKER CUTS & GOODS · SIALKOT',
            'title' => 'Biker club vests & heavy leather goods.',
            'lead' => 'Heavyweight full-grain cowhide biker cuts with concho chain closures, fortified riding gloves, artisan workshop aprons, and custom embossed leather accessories.',
            'pills' => ['Concho Chain Vests', 'Full-Grain Veg-Tan', 'Workshop Aprons', 'Side-Laced Cuts'],
            'primary_cta_text' => 'Explore Leather Goods',
            'primary_cta_url' => '/leather-products/',
            'secondary_cta_text' => 'Submit Vest Tech Pack',
            'secondary_cta_url' => '/contact-us',
            'image' => '/assets/images/showcase/hero-slide-biker-vest-2560.jpg',
            'image_pos' => 'object-[80%_center]'
        ]
    ];
}

/** 4 Core Divisions data getter with fallback */
function get_divisions_data(): array
{
    $divs = get_json_setting('divisions_json', []);
    if (!empty($divs)) return $divs;

    return [
        [
            'slug'        => 'leather-wears',
            'href'        => '/leather-wears/',
            'number'      => '01',
            'kicker'      => 'MOTORCYCLE RACING',
            'title'       => 'Motorcycle Racing Suits & Track Gear',
            'image'       => '/assets/images/showcase/motorcycle-gear-showroom-hires.jpg',
            'lead'        => 'Bespoke 1.3mm cowhide race suits, aerodynamic speed humps, fortified knuckle gloves, and CE Level 2 track armor built for severe slide resistance.',
            'specs'       => ['1.3mm Race Cowhide', 'CE Level 2 Armor', 'Speed Hump Fit', 'Carbon Knuckles'],
            'cta'         => 'Explore Racing Division'
        ],
        [
            'slug'        => 'textile-wears',
            'href'        => '/textile-wears/',
            'number'      => '02',
            'kicker'      => 'TECHNICAL TEXTILES',
            'title'       => 'Technical Textiles & Plaid Flannels',
            'image'       => '/assets/images/showcase/flannel-textile-shirt-hires.jpg',
            'lead'        => 'Heavy yarn-dyed cotton flannels, Cordura® 1000D adventure shells, ballistic denim jackets, and all-weather touring apparel built for durability.',
            'specs'       => ['Heavy Flannel 280 GSM', 'Cordura® 1000D', 'DWR Weatherproof', 'Ballistic Denim'],
            'cta'         => 'Explore Textile Division'
        ],
        [
            'slug'        => 'western-wears',
            'href'        => '/western-wears/',
            'number'      => '03',
            'kicker'      => 'WESTERN WEAR',
            'title'       => 'Western Heritage & Custom Headwear',
            'image'       => '/assets/images/showcase/custom-leather-hat-hires.jpg',
            'lead'        => 'Traditional hand-blocked leather top hats, custom cowboy headwear, fringed roughout suede jackets, and rugged rancher riding chaps.',
            'specs'       => ['Hand-Blocked Hats', 'Roughout Suede', 'Hand-Cut Fringes', 'Riding Chaps'],
            'cta'         => 'Explore Western Division'
        ],
        [
            'slug'        => 'leather-products',
            'href'        => '/leather-products/',
            'number'      => '04',
            'kicker'      => 'LEATHER GOODS & VESTS',
            'title'       => 'Biker Vests & Artisan Leather Goods',
            'image'       => '/assets/images/showcase/leather-biker-vest-hires.jpg',
            'lead'        => 'Heavyweight full-grain biker club vests with concho chain closures, heavy leather workshop aprons, fortified riding gloves, and leather goods.',
            'specs'       => ['Concho Chain Vests', 'Side-Laced Cuts', 'Workshop Aprons', 'Full-Grain Veg-Tan'],
            'cta'         => 'Explore Leather Goods'
        ]
    ];
}

/** Material Lab capabilities getter */
function get_capabilities_data(): array
{
    $caps = get_json_setting('capabilities_json', []);
    if (!empty($caps)) return $caps;

    return [
        [
            'number' => '01',
            'title' => 'Multi-Hide Tanning & Grading',
            'desc' => 'Calibrated gauges from 0.7mm silky sheep nappa to 1.3mm drum-dyed race-grade cowhide, roughout split suede, and vegetable-tanned harness hides.'
        ],
        [
            'number' => '02',
            'title' => 'Heavy Flannels & Cordura® 1000D',
            'desc' => 'Heavyweight yarn-dyed 280 GSM cotton flannels, Cordura® 1000D ballistic shells, DuPont™ Kevlar® abrasion linings, and DWR water-repellent barriers.'
        ],
        [
            'number' => '03',
            'title' => 'CE Armor & Carbon Shielding',
            'desc' => 'CE Level 1 & Level 2 viscoelastic impact protectors, aerodynamic track humps, titanium elbow sliders, and carbon fiber motorcycle glove knuckles.'
        ],
        [
            'number' => '04',
            'title' => 'Conchos, Heavy Brass & YKK® Fasteners',
            'desc' => 'Solid antiqued brass hardware, biker vest concho chains, heavy-gauge YKK® zippers, debossed leather patches, and custom cast hardware.'
        ],
        [
            'number' => '05',
            'title' => 'Hand-Blocked Hats & Artisan Craft',
            'desc' => 'Traditional wooden block molding for leather top hats and western cowboy headwear, precision edge burnishing, and heavy-duty workshop aprons.'
        ],
        [
            'number' => '06',
            'title' => 'Digital CAD Patterning & Rapid Sampling',
            'desc' => 'Digital 2D CAD grading from your sketches or reference garment. First physical production counter-sample delivered to your desk in 7–10 days.'
        ]
    ];
}

/** Trust strip data getter */
function get_trust_points_data(): array
{
    $points = get_json_setting('trust_points_json', []);
    if (!empty($points)) return $points;

    return [
        ['title' => 'Specification Review', 'desc' => 'Reference image, CAD tech pack or design brief'],
        ['title' => 'Rapid Sampling', 'desc' => 'Validate leather hand-feel, textile weave & armor fit'],
        ['title' => 'Private-Label Finishing', 'desc' => 'Custom debossed badges, hardware, woven labels & trims'],
        ['title' => 'Direct Factory Export', 'desc' => 'Door-to-door air freight & sea cargo to US & Europe']
    ];
}

/** OEM Process steps getter */
function get_process_steps_data(): array
{
    $steps = get_json_setting('process_steps_json', []);
    if (!empty($steps)) return $steps;

    return [
        [
            'num' => '01',
            'title' => 'Tech Pack & Material Grading',
            'desc' => 'Submit your sketches, vector patterns, or physical garment counter-sample. Our pattern-masters grade sizes and source certified 1.3mm cowhide, heavy cotton flannels, or Cordura®.'
        ],
        [
            'num' => '02',
            'title' => 'Precision Counter-Sample',
            'desc' => 'A physical production prototype is engineered at our Sialkot factory within 7 to 10 working days, incorporating your private branding, custom lining, and hardware for fit approval.'
        ],
        [
            'num' => '03',
            'title' => 'Batch Cutting & Precision Assembly',
            'desc' => 'Approved patterns proceed to specialized automated cutting stations, reinforced heavy nylon stitching lines, and laser-guided embroidery or embossed patch attachment.'
        ],
        [
            'num' => '04',
            'title' => 'Dual-Station QC & Global Export',
            'desc' => 'Every garment undergoes a 100% two-stage technical check for seam integrity, armor placement, and zip alignment before export packaging and air/sea dispatch.'
        ]
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
        'SELECT * FROM products WHERE is_active = 1 AND category_id = ? AND id != ?
         ORDER BY sort_order, name LIMIT ?'
    );
    $stmt->bindValue(1, $categoryId, PDO::PARAM_INT);
    $stmt->bindValue(2, $excludeId, PDO::PARAM_INT);
    $stmt->bindValue(3, $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}
