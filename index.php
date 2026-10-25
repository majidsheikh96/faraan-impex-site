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
coming_soon_check();

$path = trim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), '/');
$segments = $path === '' ? [] : explode('/', $path);

// AJAX RFQ submit (progressive enhancement; the normal form post still works without JS)
if ($path === 'contact-us' && ($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && ($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'fetch') {
    header('Content-Type: application/json; charset=utf-8');
    $res = rfq_handle_post();
    $res['token'] = rfq_token();
    echo json_encode($res);
    exit;
}

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
        } elseif ($slug === 'all-styles') {
            $perPage = 24;
            $page = max(1, (int)($_GET['page'] ?? 1));
            $template = 'templates/category.php';
            $data['page'] = $page;
            $data['total'] = count_all_products();
            $partial = isset($_GET['partial']);
            $data['products'] = $partial ? get_all_products($perPage, $perPage * ($page - 1)) : get_all_products($perPage * $page, 0);
            $data['subcategories'] = get_top_categories();
            $data['category'] = ['id' => 0, 'parent_id' => null, 'slug' => 'all-styles', 'name' => 'All Styles',
                'kicker' => 'FULL CATALOGUE', 'lead_text' => 'Every active style from the Sialkot factory, across all four divisions. MOQ 50 pieces per style, custom branding on every line.',
                'custom_moq' => null, 'stat_label' => 'Divisions'];
            $data['page_title'] = 'All Styles — ' . SITE_NAME;
            $data['page_description'] = 'Browse every active style from ' . SITE_NAME . ': leather garments, textile wears, western wears and leather goods, made to order in Sialkot.';
        } else {
            $cat = get_category_by_slug($slug);
            if ($cat) {
                $template = 'templates/category.php';
                $data['category'] = $cat;
                $perPage = 24;
                $page = max(1, (int)($_GET['page'] ?? 1));
                $data['page'] = $page;
                $data['total'] = count_products_by_category((int)$cat['id']);
                $partial = isset($_GET['partial']);
                $data['products'] = $partial ? get_products_by_category((int)$cat['id'], $perPage, $perPage * ($page - 1)) : get_products_by_category((int)$cat['id'], $perPage * $page, 0);
                $data['subcategories'] = get_subcategories((int)$cat['id']);
                $data['page_title'] = $cat['name'] . ' — ' . SITE_NAME;
                $data['page_description'] = $cat['meta_description'] ?: $cat['name'] . ' — wholesale B2B catalog from ' . SITE_NAME . ', Sialkot.';
            }
        }
    } elseif (count($segments) === 2) {
        [$catSlug, $prodSlug] = $segments;
        $product = get_product_by_slug($prodSlug);
        if ($product) {
            $template = 'templates/product.php';
            $data['product'] = $product;
            $data['related'] = get_related_products((int)$product['category_id'], (int)$product['id']);
            $data['page_title'] = $product['name'] . ' (' . $product['sku'] . ') — ' . SITE_NAME;
            $data['page_description'] = $product['meta_description'] ?: $product['name'] . ' — wholesale enquiry from ' . SITE_NAME . ', Sialkot.';
        }
    }
} catch (Throwable $t) {
    error_log('Router error: ' . $t->getMessage());
    $template = 'templates/500.php';
}

http_response_code($template === 'templates/404.php' ? 404 : ($template === 'templates/500.php' ? 500 : 200));

extract($data);

// AJAX "load more": return just the next batch of cards as JSON
if ($template === 'templates/category.php' && isset($_GET['partial'])) {
    ob_start();
    require __DIR__ . '/templates/partials/product-cards.php';
    $html = ob_get_clean();
    $shown = min($total, ($page - 1) * $perPage + count($products));
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['html' => $html, 'shown' => $shown, 'total' => $total, 'page' => $page, 'more' => $shown < $total]);
    exit;
}

if ($template === 'templates/500.php') {
    require __DIR__ . '/' . $template; // standalone page, no header/footer (no DB access)
    exit;
}

require __DIR__ . '/templates/header.php';
require __DIR__ . '/' . $template;
require __DIR__ . '/templates/footer.php';
