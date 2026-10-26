<?php
/**
 * Admin Layout & Management Shell — Faraan Impex Editorial Control Center.
 */
declare(strict_types=1);

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/models.php';
require_once __DIR__ . '/auth.php';

require_admin_login();

function admin_header(string $title, string $activeNav = ''): void {
    $uri = $_SERVER['SCRIPT_NAME'] ?? '';
    $nav = [
        ['/admin/dashboard.php', 'Dashboard', 'dashboard', 'M3 12l9-9 9 9M5 10v10h5v-6h4v6h5V10'],
        ['/admin/settings.php', 'Site Settings &amp; MOQ', 'settings', 'M4 6h16M4 12h16M4 18h16'],
        ['/admin/slider.php', 'Hero Slider', 'slider', 'M3 5h18v14H3zM8 12l3 3 5-6'],
        ['/admin/homepage.php', 'Homepage Sections', 'homepage', 'M4 4h7v7H4zM13 4h7v7h-7zM4 13h7v7H4zM13 13h7v7h-7z'],
        ['/admin/pages.php', 'Pages &amp; Text', 'pages', 'M6 3h9l4 4v14H6zM14 3v5h5M9 13h7M9 17h7'],
        ['/admin/categories.php', 'Categories &amp; MOQs', 'categories', 'M4 6h16M4 12h10M4 18h6'],
        ['/admin/products.php', 'Products', 'product', 'M12 3l9 5v8l-9 5-9-5V8zM3 8l9 5 9-5M12 13v8'],
    ];
    $icon = fn(string $d) => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="' . $d . '"/></svg>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex, nofollow">
<title><?= e($title) ?> — Faraan Impex Admin</title>
<link rel="icon" type="image/png" sizes="32x32" href="/favicon.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500;600;700&family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="/assets/css/admin.css?v=<?= (int)@filemtime(__DIR__ . '/../assets/css/admin.css') ?>">
</head>
<body class="admin-app">

<div class="admin-top">
  <div class="bar"><span>FARAAN IMPEX</span><a href="/admin/logout.php" style="font-family:var(--f-body);font-size:14px;font-weight:500;letter-spacing:0">Log out</a></div>
  <nav aria-label="Admin">
    <?php foreach ($nav as [$href, $label, $key]): ?>
      <a href="<?= $href ?>"<?= str_contains($uri, $key) ? ' aria-current="page"' : '' ?>><?= $label ?></a>
    <?php endforeach; ?>
  </nav>
</div>

<div class="admin-shell">
  <aside class="admin-side">
    <div>
      <a class="admin-brand" href="/admin/dashboard.php"><b>FARAAN IMPEX</b><small>ADMIN PANEL</small></a>
      <nav class="admin-nav" aria-label="Admin">
        <?php foreach ($nav as [$href, $label, $key, $d]): ?>
          <a href="<?= $href ?>"<?= str_contains($uri, $key) ? ' aria-current="page"' : '' ?>><?= $icon($d) ?><span><?= $label ?></span></a>
        <?php endforeach; ?>
      </nav>
    </div>
    <div class="admin-foot">
      <a href="/" target="_blank" rel="noopener"><?= $icon('M14 4h6v6M20 4l-9 9M18 14v6H4V6h6') ?><span>View site</span></a>
      <a href="/admin/profile.php"><?= $icon('M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8z') ?><span>Change password</span></a>
      <a href="/admin/logout.php"><?= $icon('M9 4H4v16h5M16 8l4 4-4 4M20 12H9') ?><span>Log out</span></a>
    </div>
  </aside>

  <main class="admin-main"><div class="admin-inner">
<?php
    $flash = flash_get();
    if ($flash) {
        echo '<div class="admin-flash" role="status"><span>' . e($flash) . '</span><span class="font-mono" style="font-size:12px;color:#1F7A3A">✓ UPDATED</span></div>';
    }
}

function admin_footer(): void {
?>
  </div></main>
</div>
</body>
</html>
<?php
}

/** Flash message helpers. */
function flash_set(string $msg): void { $_SESSION['flash'] = $msg; }
function flash_get(): ?string {
    $m = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $m;
}

/** Generate URL-safe slug. */
function make_slug(string $text): string {
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

/**
 * Handle image upload: mime-check, rename to safe unique name.
 * Returns relative path or null. Throws on invalid upload.
 */
function handle_image_upload(array $file, string $slug, string $folder = 'products'): ?string {
    if ($file['error'] === UPLOAD_ERR_NO_FILE) return null;
    if ($file['error'] !== UPLOAD_ERR_OK) throw new Exception('Upload failed with code ' . $file['error']);
    if ($file['size'] > 12 * 1024 * 1024) throw new Exception('Image too large (max 12MB).');

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($file['tmp_name']);
    $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
    if (!isset($allowed[$mime])) throw new Exception('Only JPG, PNG, WebP allowed.');

    $ext = $allowed[$mime];
    $targetDir = __DIR__ . '/../assets/images/' . trim($folder, '/') . '/';
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $name = make_slug($slug) . '-' . bin2hex(random_bytes(4)) . '.' . $ext;
    $dest = $targetDir . $name;
    if (!move_uploaded_file($file['tmp_name'], $dest)) {
        throw new Exception('Could not save uploaded image.');
    }
    return 'assets/images/' . trim($folder, '/') . '/' . $name;
}
