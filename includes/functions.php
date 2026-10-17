<?php
/** Shared helpers: escaping, URLs, WhatsApp links, geo-blocking. */
declare(strict_types=1);

function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Build a wa.me enquiry link with prefilled product text. */
function whatsapp_link(string $message): string
{
    return 'https://wa.me/' . WHATSAPP_NUMBER . '?text=' . rawurlencode($message);
}

function product_whatsapp_link(string $name, string $sku): string
{
    return whatsapp_link("Assalam-o-Alaikum, I'm interested in: {$name} (SKU: {$sku}). Please share details.");
}

/**
 * Geo-block check. Runs before any page output.
 * - Disabled unless GEO_BLOCK_ENABLED is true.
 * - Admin path is never blocked (owner needs access from Pakistan).
 * - Uses MaxMind GeoLite2-Country if present; fails OPEN (no block) if DB missing.
 */
function geo_block_check(): void
{
    if (!GEO_BLOCK_ENABLED) {
        return;
    }
    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    if (str_starts_with($uri, ADMIN_PATH)) {
        return; // owner allowlist
    }
    $mmdb = __DIR__ . '/geo/GeoLite2-Country.mmdb';
    if (!is_file($mmdb) || !class_exists('GeoIp2\Database\Reader')) {
        return; // fail open when DB/reader unavailable
    }
    try {
        $reader = new GeoIp2\Database\Reader($mmdb);
        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['REMOTE_ADDR'] ?? '';
        $country = $reader->country($ip)->country->isoCode;
        if (in_array($country, GEO_BLOCKED_COUNTRIES, true)) {
            http_response_code(403);
            echo '<h1>Not available in your region</h1>';
            exit;
        }
    } catch (Throwable $t) {
        // fail open on lookup errors
    }
}
