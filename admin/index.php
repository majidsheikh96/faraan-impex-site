<?php
/** Admin login. */
declare(strict_types=1);

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/auth.php';

if (admin_logged_in()) {
    header('Location: /admin/dashboard.php');
    exit;
}

$error = '';
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (login_rate_limited($ip)) {
        $error = 'Too many attempts. Try again in 10 minutes.';
    } else {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        if (verify_admin($username, $password)) {
            session_regenerate_id(true);
            $stmt = db()->prepare('SELECT id FROM admin_users WHERE username = ?');
            $stmt->execute([$username]);
            $_SESSION['admin_id'] = (int)$stmt->fetchColumn();
            header('Location: /admin/dashboard.php');
            exit;
        }
        record_login_attempt($ip);
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login — Faraan Impex</title><link rel="stylesheet" href="/assets/css/main.css"></head>
<body class="bg-[#FAF7F2] min-h-screen flex items-center justify-center">
<div class="bg-white rounded-xl border border-[#0A0A0A]/10 p-8 w-full max-w-sm">
  <h1 class="text-xl font-extrabold mb-6">Faraan Impex <span class="text-[#E10600]">Admin</span></h1>
  <?php if ($error): ?><p class="text-red-600 text-sm mb-4"><?= e($error) ?></p><?php endif; ?>
  <form method="post" class="space-y-4">
    <div><label class="text-sm font-medium">Username</label><input name="username" required autocomplete="username" class="mt-1 w-full border rounded px-3 py-2"></div>
    <div><label class="text-sm font-medium">Password</label><input name="password" type="password" required autocomplete="current-password" class="mt-1 w-full border rounded px-3 py-2"></div>
    <button class="w-full bg-[#0A0A0A] text-white py-2 rounded font-semibold">Log In</button>
  </form>
</div>
</body>
</html>
