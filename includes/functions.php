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
    return whatsapp_link("Hello, I'm interested in: {$name} (SKU: {$sku}). Please share details.");
}

/** Best-effort real visitor IP behind Hostinger's CDN / proxies. */
function client_ip(): string
{
    $candidates = [$_SERVER['HTTP_CF_CONNECTING_IP'] ?? '', $_SERVER['HTTP_X_REAL_IP'] ?? ''];
    foreach (explode(',', (string)($_SERVER['HTTP_X_FORWARDED_FOR'] ?? '')) as $p) {
        $candidates[] = trim($p);
    }
    $candidates[] = $_SERVER['REMOTE_ADDR'] ?? '';
    foreach ($candidates as $ip) {
        if ($ip !== '' && filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
            return $ip;
        }
    }
    return $_SERVER['REMOTE_ADDR'] ?? '';
}

/** True when $ip falls in the bundled range list for ISO country code $cc (includes/geo/<cc>.bin, see tools/build-geo-ranges.py). */
function ip_in_country(string $ip, string $cc): bool
{
    $file = __DIR__ . '/geo/' . strtolower($cc) . '.bin';
    $bin = @inet_pton($ip);
    if ($bin === false || !is_file($file)) {
        return false;
    }
    if (strlen($bin) === 4) {
        $bin = str_repeat("\0", 10) . "\xff\xff" . $bin;
    }
    $fh = fopen($file, 'rb');
    if (!$fh) {
        return false;
    }
    $lo = 0;
    $hi = intdiv((int)filesize($file), 32) - 1;
    $found = false;
    while ($lo <= $hi) {
        $mid = intdiv($lo + $hi, 2);
        fseek($fh, $mid * 32);
        $rec = fread($fh, 32);
        if (strlen($rec) < 32) {
            break;
        }
        $start = substr($rec, 0, 16);
        $end = substr($rec, 16, 16);
        if (strcmp($bin, $start) < 0) {
            $hi = $mid - 1;
        } elseif (strcmp($bin, $end) > 0) {
            $lo = $mid + 1;
        } else {
            $found = true;
            break;
        }
    }
    fclose($fh);
    return $found;
}

/**
 * Country block (Admin > Site Settings > Geo-blocking; defaults in config.php).
 * Never blocks: the admin panel, a logged-in admin, or a visitor holding the preview / geo-bypass cookie.
 * Bypass link for staff in a blocked country: /?geo_bypass=<coming-soon key> (sets a 30-day cookie).
 * Fails open (no block) if the range files are missing. A VPN gets around any IP-based block.
 */
function geo_block_check(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $enabled = get_setting('geo_block_enabled', GEO_BLOCK_ENABLED ? '1' : '0') === '1';
    if (!$enabled) {
        return;
    }
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
    if (str_starts_with($path, '/admin') || !empty($_SESSION['admin_id']) || str_starts_with($path, '/assets/')) {
        return;
    }
    if (isset($_GET['geo_bypass']) && hash_equals(strtolower(trim(get_setting('coming_soon_key', 'faraan')) ?: 'faraan'), strtolower((string)$_GET['geo_bypass']))) {
        setcookie('geo_bypass', '1', ['expires' => time() + 86400 * 30, 'path' => '/', 'httponly' => true, 'samesite' => 'Lax', 'secure' => !empty($_SERVER['HTTPS'])]);
        return;
    }
    if (($_COOKIE['geo_bypass'] ?? '') === '1' || ($_COOKIE['preview_access'] ?? '') === '1' || !empty($_SESSION['preview_access'])) {
        return;
    }
    $codes = array_filter(array_map('trim', explode(',', get_setting('geo_blocked_countries', implode(',', GEO_BLOCKED_COUNTRIES)))));
    $ip = client_ip();
    foreach ($codes as $cc) {
        if (ip_in_country($ip, $cc)) {
            http_response_code(403);
            header('Cache-Control: no-store');
            header('X-Robots-Tag: noindex');
            require __DIR__ . '/../templates/blocked.php';
            exit;
        }
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

/* ==========================================================================
   Presentation helpers (public templates)
   ========================================================================== */

/** Right-pointing arrow icon used on buttons and cards. */
function icon_arrow(int $size = 16, string $class = ''): string
{
    return '<svg' . ($class ? ' class="' . e($class) . '"' : '') . ' width="' . $size . '" height="' . $size
        . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 12h16M14 6l6 6-6 6"/></svg>';
}

/** Mega-menu / footer blurb per top-level division. Falls back to the category's own lead text. */
function division_blurb(array $cat): array
{
    $map = [
        'leather-products' => ['Leather goods, made to order', 'Wholesale contract production from the Sialkot factory. Custom branding on every line.'],
        'leather-wears'    => ['Leather garments and racewear', 'Jackets, suits, vests and gloves cut from graded hides. Custom branding available.'],
        'textile-wears'    => ['Technical and everyday textiles', 'Denim, flannel and weatherproof outerwear sewn to your tech pack.'],
        'western-wears'    => ['Western heritage, hand finished', 'Hats, fringed jackets, chaps and saddlery for western labels.'],
    ];
    if (isset($map[$cat['slug']])) {
        return $map[$cat['slug']];
    }
    return [$cat['name'], (string)($cat['lead_text'] ?? 'Wholesale contract production from the Sialkot factory.')];
}

/** Request-quote form token (session based). */
function rfq_token(): string
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['rfq_token'])) {
        $_SESSION['rfq_token'] = bin2hex(random_bytes(16));
    }
    return $_SESSION['rfq_token'];
}

/**
 * Handle an RFQ POST (home page form and /contact-us share it).
 * Returns ['ok' => bool, 'error' => string]. Mails CONTACT_EMAIL; optional tech-pack attachment.
 */
function rfq_handle_post(): array
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!hash_equals($_SESSION['rfq_token'] ?? '', (string)($_POST['token'] ?? ''))) {
        return ['ok' => false, 'error' => 'Your session expired. Please reload the page and try again.'];
    }
    if (trim((string)($_POST['company_website'] ?? '')) !== '') {
        return ['ok' => true, 'error' => '']; // honeypot: pretend success
    }
    $f = [];
    foreach (['name', 'email', 'company', 'division', 'quantity', 'message'] as $k) {
        $f[$k] = trim(str_replace(["\r", "\n"], ' ', (string)($_POST[$k] ?? '')));
    }
    $f['message'] = trim((string)($_POST['message'] ?? ''));
    if ($f['name'] === '' || !filter_var($f['email'], FILTER_VALIDATE_EMAIL) || $f['message'] === '') {
        return ['ok' => false, 'error' => 'Please enter your name, a valid business email and your project scope.'];
    }

    $to = get_setting('contact_email', CONTACT_EMAIL);
    $subject = 'RFQ from ' . $f['name'] . ($f['company'] !== '' ? ' (' . $f['company'] . ')' : '');
    $body = "Name: {$f['name']}\nEmail: {$f['email']}\nCompany: {$f['company']}\nDivision: {$f['division']}\n"
          . "Target quantity: {$f['quantity']}\n\n{$f['message']}\n";

    $headers = ['From: ' . SITE_NAME . ' <no-reply@' . (parse_url(SITE_URL, PHP_URL_HOST) ?: 'localhost') . '>', 'Reply-To: ' . $f['email'], 'MIME-Version: 1.0'];
    $upload = $_FILES['techpack'] ?? null;
    $allowed = ['pdf', 'jpg', 'jpeg', 'png', 'zip', 'doc', 'docx', 'xls', 'xlsx'];
    if ($upload && ($upload['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($upload['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed, true) || $upload['size'] > 5 * 1024 * 1024) {
            return ['ok' => false, 'error' => 'Attachment must be PDF, image, Office or ZIP and under 5 MB.'];
        }
        $b = bin2hex(random_bytes(8));
        $headers[] = "Content-Type: multipart/mixed; boundary=\"$b\"";
        $name = preg_replace('/[^A-Za-z0-9._-]/', '_', $upload['name']);
        $msg = "--$b\r\nContent-Type: text/plain; charset=UTF-8\r\n\r\n$body\r\n--$b\r\n"
             . "Content-Type: application/octet-stream; name=\"$name\"\r\nContent-Transfer-Encoding: base64\r\n"
             . "Content-Disposition: attachment; filename=\"$name\"\r\n\r\n"
             . chunk_split(base64_encode((string)file_get_contents($upload['tmp_name']))) . "--$b--";
    } else {
        $headers[] = 'Content-Type: text/plain; charset=UTF-8';
        $msg = $body;
    }

    if (!@mail($to, '=?UTF-8?B?' . base64_encode($subject) . '?=', $msg, implode("\r\n", $headers))) {
        error_log('RFQ mail() failed for ' . $f['email']);
        return ['ok' => false, 'error' => 'We could not send your request. Please email ' . $to . ' or message us on WhatsApp.'];
    }
    unset($_SESSION['rfq_token']);
    return ['ok' => true, 'error' => ''];
}

/** Display form of a stored phone number: "92 332 7464484" -> "+92 332 7464484". */
function phone_display(string $p): string
{
    $p = trim($p);
    return preg_match('/^\d/', $p) ? '+' . $p : $p;
}

/** tel: href for a phone number. */
function phone_href(string $p): string
{
    return 'tel:+' . preg_replace('/\D+/', '', $p);
}

/**
 * Clean a product description imported from the old WordPress site: strips the leftover
 * mobile-redirect script, turns literal "\n" into line breaks and decodes HTML entities.
 */
function clean_description(?string $s): string
{
    $s = (string)$s;
    $s = preg_replace('/\(window\.matchMedia.*?location\.replace\([^)]*\)\s*;?/si', '', $s);
    $s = str_replace(['\\n', "\r"], ["\n", ''], $s);
    $s = html_entity_decode($s, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $s = str_replace("\xC2\xA0", ' ', $s);
    $s = preg_replace("/[ \t]+/", ' ', $s);
    $s = preg_replace("/\n\s*\n+/", "\n", $s);
    return trim($s);
}

/** Consistent Title Case for category names in menus, chips and headings ("Travel bags" -> "Travel Bags"). */
function display_name(string $s): string
{
    $t = mb_convert_case(trim($s), MB_CASE_TITLE, 'UTF-8');
    return preg_replace_callback('/\s(And|Of|The|For|In|To|&Amp;)\b/u', fn($m) => ' ' . strtolower($m[1]) === ' &amp;' ? ' &' : ' ' . strtolower($m[1]), $t);
}

/** The two Alibaba storefronts (Gold Supplier). URLs/labels can be changed in Admin > Site Settings. */
function alibaba_links(): array
{
    $out = [];
    $defaults = [1 => ['Faraan Impex', 'https://faraanimpex.trustpass.alibaba.com'], 2 => ['Namra Leather', 'https://namraleather.trustpass.alibaba.com']];
    foreach ($defaults as $i => [$label, $url]) {
        $u = trim(get_setting("alibaba_{$i}_url", $url));
        if ($u !== '' && preg_match('#^https?://#i', $u)) {
            $out[] = ['label' => trim(get_setting("alibaba_{$i}_label", $label)) ?: $label, 'url' => $u];
        }
    }
    return $out;
}

/** Social profile links; only the ones filled in under Admin > Site Settings are shown. */
function social_links(): array
{
    $out = [];
    foreach (['facebook' => 'Facebook', 'instagram' => 'Instagram', 'linkedin' => 'LinkedIn', 'youtube' => 'YouTube', 'tiktok' => 'TikTok', 'x' => 'X'] as $key => $label) {
        $u = trim(get_setting('social_' . $key, $key === 'instagram' ? 'https://www.instagram.com/faraan_impex' : ''));
        if ($u !== '' && preg_match('#^https?://#i', $u)) {
            $out[] = ['label' => $label, 'key' => $key, 'url' => $u];
        }
    }
    return $out;
}

function social_icon(string $platform): string
{
    return match ($platform) {
        'instagram' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>',
        'facebook'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
        'linkedin'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>',
        'youtube'   => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23.495 6.205a3.007 3.007 0 0 0-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 0 0 .527 6.205a31.247 31.247 0 0 0-.522 5.805 31.247 31.247 0 0 0 .522 5.783 3.007 3.007 0 0 0 2.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 0 0 2.088-2.088 31.247 31.247 0 0 0 .5-5.783 31.247 31.247 0 0 0-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/></svg>',
        'tiktok'    => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>',
        'x'         => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.747l7.73-8.835L1.254 2.25H8.08l4.253 5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
        default     => '',
    };
}
