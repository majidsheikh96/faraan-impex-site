<?php
/**
 * Faraan Impex — site configuration
 * Copy to config.local.php style overrides on staging/production as needed.
 */

declare(strict_types=1);

// ---- Database ----
// This Hostinger account's MySQL runs on a separate server — srv1294.hstgr.io,
// not localhost/127.0.0.1. All databases on this plan share that host.
// srv1294.hstgr.io resolves to an IPv6 address from the Hostinger server;
// the DB user is only granted for IPv4. Use the literal IPv4 to force IPv4.
define('DB_HOST', getenv('DB_HOST') ?: '193.203.166.165');
define('DB_NAME', getenv('DB_NAME') ?: 'u174045762_faraanimpex');
define('DB_USER', getenv('DB_USER') ?: 'u174045762_faraanimpex');
define('DB_PASS', getenv('DB_PASS') ?: 'H716whwfWO6Hl8LF78IR');

// ---- Site ----
define('SITE_NAME', 'Faraan Impex');
define('SITE_URL', getenv('SITE_URL') ?: 'https://faraanimpex.com');
define('ADMIN_PATH', '/admin'); // keep admin on a non-blocked path

// ---- Launch control ----
// true  = site is live; Coming Soon page is never shown (overrides DB setting).
// false = respect the Admin > Settings coming_soon_enabled toggle.
define('SITE_LIVE', true);

// ---- Contact (Gmail prioritized as primary per client instruction) ----
define('CONTACT_EMAIL', 'faraanimpex@gmail.com');
define('CONTACT_EMAIL_2', 'info@faraanimpex.com');
define('CONTACT_PHONE', '+92 332 7464484');
define('CONTACT_PHONE_2', '+92 322 7464482');
define('CONTACT_ADDRESS', 'P.O. 10/94, Nekapura Road, Sialkot 51310, Pakistan');
define('WHATSAPP_NUMBER', '923327464484'); // wa.me format, no +

// ---- Geo-blocking ----
// Visitors from these ISO country codes see a 403 page (can be changed in Admin > Site Settings).
// Uses the range files in includes/geo/<cc>.bin (build them with tools/build-geo-ranges.py).
// The admin panel and logged-in admins are never blocked.
define('GEO_BLOCK_ENABLED', true);
define('GEO_BLOCKED_COUNTRIES', ['PK', 'IN']);

// ---- Image protection ----
// Deterrent-level only: disables right-click/drag on product images.
define('IMAGE_PROTECTION', true);

// ---- SMTP (outgoing email for RFQ form) ----
// Set SMTP_PASS to a Gmail App Password (16 chars, no spaces).
// Generate at: myaccount.google.com → Security → App passwords
// Store in a server-side override file (config.local.php) — never commit the real password.
define('SMTP_HOST',     getenv('SMTP_HOST')     ?: 'smtp.gmail.com');
define('SMTP_PORT',     (int)(getenv('SMTP_PORT')     ?: 587));
define('SMTP_USER',     getenv('SMTP_USER')     ?: CONTACT_EMAIL);   // faraanimpex@gmail.com
define('SMTP_PASS',     getenv('SMTP_PASS')     ?: '');               // fill in config.local.php
define('SMTP_FROM',     getenv('SMTP_FROM')     ?: CONTACT_EMAIL);
define('SMTP_FROM_NAME',getenv('SMTP_FROM_NAME')?: SITE_NAME . ' Website');
