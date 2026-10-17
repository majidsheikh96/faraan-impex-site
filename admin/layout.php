<?php
/** Admin layout wrapper. */
declare(strict_types=1);

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/auth.php';

require_admin_login();

function admin_header(string $title): void {
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($title) ?> — Faraan Impex Admin</title><link rel="stylesheet" href="/assets/css/main.css"></head>
<body class="bg-[#FAF7F2]">
<div class="max-w-6xl mx-auto px-4 py-8">
  <div class="flex justify-between items-center mb-8">
    <div class="flex items-center gap-6">
      <a href="/admin/dashboard.php" class="text-xl font-extrabold">FARAAN <span class="text-[#E10600]">Admin</span></a>
      <nav class="flex gap-4 text-sm">
        <a href="/admin/products.php" class="hover:text-[#E10600]">Products</a>
        <a href="/admin/categories.php" class="hover:text-[#E10600]">Categories</a>
      </nav>
    </div>
    <a href="/admin/logout.php" class="text-sm text-[#E10600] hover:underline">Log out</a>
  </div>
<?php
}

function admin_footer(): void {
?>
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
function handle_image_upload(array $file, string $slug): ?string {
    if ($file['error'] === UPLOAD_ERR_NO_FILE) return null;
    if ($file['error'] !== UPLOAD_ERR_OK) throw new Exception('Upload failed.');
    if ($file['size'] > 5 * 1024 * 1024) throw new Exception('Image too large (max 5MB).');

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($file['tmp_name']);
    $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
    if (!isset($allowed[$mime])) throw new Exception('Only JPG, PNG, WebP allowed.');

    $ext = $allowed[$mime];
    $name = make_slug($slug) . '-' . bin2hex(random_bytes(4)) . '.' . $ext;
    $dest = __DIR__ . '/../assets/images/products/' . $name;
    if (!move_uploaded_file($file['tmp_name'], $dest)) {
        throw new Exception('Could not save image.');
    }
    return 'assets/images/products/' . $name;
}
