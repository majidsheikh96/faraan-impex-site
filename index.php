<?php
/**
 * Faraan Impex — front controller / router.
 * Pretty URLs (keeps old WooCommerce slugs for SEO):
 *   /                          -> home
 *   /about-us                  -> about
 *   /contact-us                -> contact
 *   /{category-slug}/          -> category listing
 *   /{category-slug}/{product-slug}/ -> product detail
 */
declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/models.php';

geo_block_check();

$path = trim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), '/');
$segments = $path === '' ? [] : explode('/', $path);

$template = 'templates/404.php';
$data = [];

try {
    if (count($segments) === 0) {
        $template = 'templates/home.php';
    } elseif (count($segments) === 1) {
        $slug = $segments[0];
        if ($slug === 'about-us') {
            $template = 'templates/about.php';
        } elseif ($slug === 'contact-us') {
            $template = 'templates/contact.php';
        } else {
            $cat = get_category_by_slug($slug);
            if ($cat) {
                $template = 'templates/category.php';
                $data['category'] = $cat;
                $data['products'] = get_products_by_category((int)$cat['id']);
                $data['subcategories'] = get_subcategories((int)$cat['id']);
            }
        }
    } elseif (count($segments) === 2) {
        [$catSlug, $prodSlug] = $segments;
        $product = get_product_by_slug($prodSlug);
        if ($product) {
            $template = 'templates/product.php';
            $data['product'] = $product;
            $data['related'] = get_related_products((int)$product['category_id'], (int)$product['id']);
        }
    }
} catch (Throwable $t) {
    error_log('Router error: ' . $t->getMessage());
    $template = 'templates/500.php';
}

http_response_code($template === 'templates/404.php' ? 404 : 200);

require __DIR__ . '/templates/header.php';
require __DIR__ . '/' . $template;
require __DIR__ . '/templates/footer.php';
