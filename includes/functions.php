<?php
/** Shared helpers: escaping, URLs, WhatsApp links, geo-blocking, coming soon / preview access. */
declare(strict_types=1);

function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Build a wa.me enquiry link with prefilled product text. */
function whatsapp_link(string $message): string
{
    $number = get_setting('whatsapp_number', WHATSAPP_NUMBER);
    return 'https://wa.me/' . $number . '?text=' . rawurlencode($message);
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
    $path = parse_url($uri, PHP_URL_PATH) ?? '/';
    if (str_starts_with($path, ADMIN_PATH) || str_starts_with($path, '/admin')) {
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

/**
 * Coming Soon / Maintenance Mode check.
 * - Skipped if coming_soon_enabled is not '1'.
 * - Skipped for admin paths (/admin*) and logged-in admins.
 * - Can be bypassed via URL param (?preview=1, ?preview=faraan, ?bypass=1, ?key=...).
 * - Sets session and 30-day cookie so visitor stays unlocked across all page clicks.
 * - Can be locked again via ?lock=1 or ?exit_preview=1.
 */
function coming_soon_check(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    $path = parse_url($uri, PHP_URL_PATH) ?? '/';

    // 1. Admin paths are NEVER blocked
    if (str_starts_with($path, '/admin') || (defined('ADMIN_PATH') && str_starts_with($path, ADMIN_PATH))) {
        return;
    }

    // 2. Logged-in admin always has full bypass
    if (!empty($_SESSION['admin_id'])) {
        return;
    }

    // 3. Handle Lock / Exit Preview
    if (isset($_GET['lock']) || isset($_GET['exit_preview'])) {
        unset($_SESSION['preview_access']);
        setcookie('preview_access', '', [
            'expires' => time() - 3600,
            'path' => '/',
            'httponly' => true,
            'samesite' => 'Lax'
        ]);
        $cleanPath = strtok($uri, '?') ?: '/';
        header('Location: ' . $cleanPath);
        exit;
    }

    // 4. Check if Coming Soon is enabled in settings (default '1' = enabled)
    $enabled = get_setting('coming_soon_enabled', '1');
    if ($enabled !== '1' && $enabled !== 'true' && $enabled !== 'yes') {
        return; // Disabled, site is live to public
    }

    // 5. Secret bypass key configuration
    $secretKey = trim(get_setting('coming_soon_key', 'faraan'));
    if ($secretKey === '') {
        $secretKey = 'faraan';
    }

    // 6. Check if user provided bypass parameter
    // Supports ?preview=1, ?preview=faraan, ?preview={key}, ?bypass=1, ?access=1, ?key={key}, or ?{secretKey}=1
    $providedKey = null;
    if (isset($_GET['preview'])) {
        $providedKey = (string)$_GET['preview'];
    } elseif (isset($_GET['bypass'])) {
        $providedKey = (string)$_GET['bypass'];
    } elseif (isset($_GET['access'])) {
        $providedKey = (string)$_GET['access'];
    } elseif (isset($_GET['key'])) {
        $providedKey = (string)$_GET['key'];
    } elseif (isset($_GET[$secretKey])) {
        $providedKey = $secretKey;
    }

    if ($providedKey !== null) {
        $trimmedProvided = trim($providedKey);
        // Valid if matches empty string (just ?preview), '1', 'true', configured key, or 'faraan' / 'preview'
        $isMatch = ($trimmedProvided === '' || 
                    $trimmedProvided === '1' || 
                    strtolower($trimmedProvided) === 'true' || 
                    strtolower($trimmedProvided) === strtolower($secretKey) || 
                    strtolower($trimmedProvided) === 'faraan' || 
                    strtolower($trimmedProvided) === 'preview');

        if ($isMatch) {
            $_SESSION['preview_access'] = true;
            setcookie('preview_access', '1', [
                'expires' => time() + (86400 * 30),
                'path' => '/',
                'httponly' => true,
                'samesite' => 'Lax'
            ]);
            return; // Immediate access granted on this request
        } else {
            $GLOBALS['coming_soon_error'] = 'Invalid preview passcode. Please verify with site administration.';
        }
    }

    // 7. Check existing session or cookie access
    if (!empty($_SESSION['preview_access']) || (isset($_COOKIE['preview_access']) && $_COOKIE['preview_access'] === '1')) {
        return; // Authorized preview visitor
    }

    // 8. Render Coming Soon page and exit
    http_response_code(503);
    header('Retry-After: 86400');
    require __DIR__ . '/../templates/coming-soon.php';
    exit;
}

/**
 * Check if the current visitor is viewing the site under preview bypass.
 */
function is_preview_active(): bool
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return (!empty($_SESSION['preview_access']) || (isset($_COOKIE['preview_access']) && $_COOKIE['preview_access'] === '1'))
        && get_setting('coming_soon_enabled', '1') === '1'
        && empty($_SESSION['admin_id']);
}
