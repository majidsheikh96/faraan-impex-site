<?php
/**
 * Faraan Impex — site configuration
 * Copy to config.local.php style overrides on staging/production as needed.
 */

declare(strict_types=1);

// ---- Database ----
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'u174045762_faraanimpex');
define('DB_USER', getenv('DB_USER') ?: 'u174045762_faraanimpex');
define('DB_PASS', getenv('DB_PASS') ?: 'H716whwfWO6Hl8LF78IR');

// ---- Site ----
define('SITE_NAME', 'Faraan Impex');
define('SITE_URL', getenv('SITE_URL') ?: 'https://lightgray-fly-854392.hostingersite.com');
define('ADMIN_PATH', '/admin'); // keep admin on a non-blocked path

// ---- Contact (real data from faraanimpex.com) ----
define('CONTACT_EMAIL', 'info@faraanimpex.com');
define('CONTACT_EMAIL_2', 'faraanimpex@gmail.com');
define('CONTACT_PHONE', '+92 332 7464484');
define('CONTACT_PHONE_2', '+92 322 7464482');
define('CONTACT_ADDRESS', 'P.O. 10/94, Nekapura Road, Sialkot 51310, Pakistan');
define('WHATSAPP_NUMBER', '923327464484'); // wa.me format, no +

// ---- Geo-blocking ----
// Block visitors from these ISO country codes (empty array = disabled).
// Requires MaxMind GeoLite2-Country.mmdb at includes/geo/ (see README).
// Admin panel path is NEVER blocked (owner allowlist).
define('GEO_BLOCK_ENABLED', false); // enable on production
define('GEO_BLOCKED_COUNTRIES', ['PK', 'IN']);

// ---- Image protection ----
// Deterrent-level only: disables right-click/drag on product images.
// True screenshot prevention is technically impossible; watermarks
// (planned later) are the real protection.
define('IMAGE_PROTECTION', true);
