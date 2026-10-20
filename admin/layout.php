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
    $currentUri = $_SERVER['SCRIPT_NAME'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($title) ?> — Faraan Impex Control Panel</title>
<link rel="icon" type="image/png" sizes="32x32" href="/favicon.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/main.css">
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F8F7F4] text-[#111827] min-h-screen font-sans antialiased">

<!-- Admin Top Navigation Bar -->
<header class="bg-[#0B0C0E] text-white border-b border-white/10 sticky top-0 z-50 shadow-md">
  <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between gap-4">
    
    <!-- Brand / Control Center Title -->
    <div class="flex items-center gap-6">
      <a href="/admin/dashboard.php" class="flex items-center gap-2.5 font-mono text-sm tracking-widest uppercase font-bold text-white hover:text-white/90">
        <span class="w-2.5 h-2.5 rounded-full bg-[#C51E28]"></span>
        <span>FARAAN <span class="text-[#C51E28]">CONTROL</span></span>
      </a>

      <!-- Primary Navigation Links -->
      <nav class="hidden lg:flex items-center space-x-1 text-[13px] font-medium">
        <a href="/admin/dashboard.php" class="px-3 py-1.5 rounded-md transition-colors <?= str_contains($currentUri, 'dashboard') ? 'bg-white/15 text-white font-semibold' : 'text-slate-300 hover:text-white hover:bg-white/5' ?>">Dashboard</a>
        <a href="/admin/products.php" class="px-3 py-1.5 rounded-md transition-colors <?= str_contains($currentUri, 'product') ? 'bg-white/15 text-white font-semibold' : 'text-slate-300 hover:text-white hover:bg-white/5' ?>">Products</a>
        <a href="/admin/categories.php" class="px-3 py-1.5 rounded-md transition-colors <?= str_contains($currentUri, 'categories') ? 'bg-white/15 text-white font-semibold' : 'text-slate-300 hover:text-white hover:bg-white/5' ?>">Categories &amp; MOQ</a>
        <a href="/admin/slider.php" class="px-3 py-1.5 rounded-md transition-colors <?= str_contains($currentUri, 'slider') ? 'bg-white/15 text-white font-semibold' : 'text-slate-300 hover:text-white hover:bg-white/5' ?>">Hero Slider</a>
        <a href="/admin/homepage.php" class="px-3 py-1.5 rounded-md transition-colors <?= str_contains($currentUri, 'homepage') ? 'bg-white/15 text-white font-semibold' : 'text-slate-300 hover:text-white hover:bg-white/5' ?>">Homepage Sections</a>
        <a href="/admin/pages.php" class="px-3 py-1.5 rounded-md transition-colors <?= str_contains($currentUri, 'pages') ? 'bg-white/15 text-white font-semibold' : 'text-slate-300 hover:text-white hover:bg-white/5' ?>">Pages &amp; Text</a>
        <a href="/admin/settings.php" class="px-3 py-1.5 rounded-md transition-colors <?= str_contains($currentUri, 'settings') ? 'bg-white/15 text-white font-semibold' : 'text-slate-300 hover:text-white hover:bg-white/5' ?>">Site Settings</a>
      </nav>
    </div>

    <!-- Actions: Live Site View & Logout -->
    <div class="flex items-center gap-4 text-xs font-mono">
      <a href="/" target="_blank" class="hidden sm:inline-flex items-center gap-1.5 bg-white/10 hover:bg-white/20 text-white px-3 py-1.5 rounded-md transition-colors">
        <span>View Live Site</span>
        <span>↗</span>
      </a>
      <a href="/admin/logout.php" class="text-rose-400 hover:text-rose-300 transition-colors uppercase tracking-wider font-semibold">
        Log Out
      </a>
    </div>

  </div>

  <!-- Mobile Secondary Menu Bar -->
  <div class="lg:hidden flex items-center overflow-x-auto px-4 py-2 border-t border-white/10 gap-2 text-xs font-mono bg-black/40">
    <a href="/admin/dashboard.php" class="px-2.5 py-1 rounded text-slate-300 hover:text-white whitespace-nowrap">Dashboard</a>
    <a href="/admin/products.php" class="px-2.5 py-1 rounded text-slate-300 hover:text-white whitespace-nowrap">Products</a>
    <a href="/admin/categories.php" class="px-2.5 py-1 rounded text-slate-300 hover:text-white whitespace-nowrap">Categories</a>
    <a href="/admin/slider.php" class="px-2.5 py-1 rounded text-slate-300 hover:text-white whitespace-nowrap">Slider</a>
    <a href="/admin/homepage.php" class="px-2.5 py-1 rounded text-slate-300 hover:text-white whitespace-nowrap">Homepage</a>
    <a href="/admin/pages.php" class="px-2.5 py-1 rounded text-slate-300 hover:text-white whitespace-nowrap">Pages</a>
    <a href="/admin/settings.php" class="px-2.5 py-1 rounded text-slate-300 hover:text-white whitespace-nowrap">Settings</a>
  </div>
</header>

<!-- Main Admin Content Container -->
<main class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-8">
<?php
    $flash = flash_get();
    if ($flash) {
        echo '<div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-900 px-4 py-3 text-sm flex items-center justify-between shadow-sm">';
        echo '<span>' . e($flash) . '</span>';
        echo '<span class="text-xs font-mono text-emerald-700">✓ Updated</span>';
        echo '</div>';
    }
}

function admin_footer(): void {
?>
</main>

<footer class="border-t border-gray-200 bg-white py-6 mt-16 text-center text-xs text-gray-500 font-mono">
  <div class="max-w-[1400px] mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-2">
    <div>Faraan Impex CMS Control Panel · Direct Sialkot Factory Administration</div>
    <div>Strictly Wholesale B2B · All Changes Instant Live</div>
  </div>
</footer>

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
