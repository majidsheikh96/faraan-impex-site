<?php
/**
 * Homepage — FARAAN IMPEX Industrial Luxury Atelier Design System.
 * Editorial B2B Contract Manufacturing Showcase.
 */
$page_title = 'FARAAN IMPEX — Luxury Leather & Technical Garments Manufacturer | Sialkot, Pakistan';
$page_description = 'Direct OEM/ODM private-label manufacturer of export-grade leather outerwear, racing suits, textile apparel, and bespoke leather goods from Sialkot, Pakistan.';

$topCats = get_top_categories();
$featured = get_featured_products(8);

// Division metadata with rich craftsmanship attributes
$divisionMeta = [
    'leather-wears' => [
        'image'       => '/assets/images/stitch/cat-leather-wears.jpg',
        'tagline'     => 'Flagship Atelier Division',
        'hides'       => '1.2mm Cowhide · Sheep Nappa · Buffalo',
        'lead'        => 'Bespoke motorcycle racing suits, cafe racers, aviator bombers, and luxury runway outerwear tailored to exacting millimeter tolerance.',
        'subs'        => ['Biker Jackets', 'Motorbike Suits', 'Leather Vests', 'Shearling Bombers'],
        'badge'       => 'CE Level 1 & 2 Ready'
    ],
    'textile-wears' => [
        'image'       => '/assets/images/stitch/cat-textile-wears.jpg',
        'tagline'     => 'Technical Apparel',
        'hides'       => 'Cordura® 1000D · Softshell · Waxed Canvas',
        'lead'        => 'High-tenacity all-weather touring garments, waterproof adventure shells, insulated tactical gear, and reinforced fleece apparel.',
        'subs'        => ['Cordura Jackets', 'Denim Outerwear', 'Flannel Shirts', 'Softshell Vests'],
        'badge'       => 'Water-Repellent DWR'
    ],
    'western-wears' => [
        'image'       => '/assets/images/stitch/cat-western-wears.jpg',
        'tagline'     => 'Heritage & Frontier',
        'hides'       => 'Roughout Suede · Split Hide · Suede Goat',
        'lead'        => 'Authentic hand-fringed leather coats, rugged frontier vests, heavy riding chaps, and traditional hand-blocked leather hats.',
        'subs'        => ['Fringed Jackets', 'Cowboy Hats', 'Western Vests', 'Riding Chaps'],
        'badge'       => 'Hand-Cut Fringes'
    ],
    'leather-products' => [
        'image'       => '/assets/images/stitch/cat-leather-products.jpg',
        'tagline'     => 'Artisan Goods & Trims',
        'hides'       => 'Heavy Veg-Tan · Biker Harness Leather',
        'lead'        => 'Heavyweight workshop aprons, fortified motorcycle gloves, vintage biker chain wallets, and custom embossed leather accessories.',
        'subs'        => ['Artisan Aprons', 'Riding Gloves', 'Biker Wallets', 'Leather Skins'],
        'badge'       => 'Full-Grain Veg Tan'
    ]
];

// --- MODULAR HOMEPAGE SECTIONS ---
require __DIR__ . '/sections/home/hero.php';
require __DIR__ . '/sections/home/trust-strip.php';
require __DIR__ . '/sections/home/divisions.php';
require __DIR__ . '/sections/home/material-lab.php';
require __DIR__ . '/sections/home/featured-styles.php';
require __DIR__ . '/sections/home/process.php';
require __DIR__ . '/sections/home/inquiry-desk.php';
