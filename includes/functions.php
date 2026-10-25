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
            $out[] = ['label' => $label, 'url' => $u];
        }
    }
    return $out;
}
