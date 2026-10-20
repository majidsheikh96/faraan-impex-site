<?php
/** Admin login. */
declare(strict_types=1);

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';
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
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login — Faraan Impex</title>
<link rel="stylesheet" href="/assets/css/main.css">
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FAF7F2] min-h-screen flex items-center justify-center p-4">
<div class="bg-white rounded-2xl border border-[#0A0A0A]/10 p-8 w-full max-w-sm shadow-xl">
  <div class="flex items-center gap-2 mb-6">
    <div class="w-3 h-3 rounded-full bg-[#C51E28]"></div>
    <h1 class="text-xl font-extrabold tracking-tight text-gray-900">Faraan Impex <span class="text-[#C51E28]">Admin</span></h1>
  </div>
  <?php if ($error): ?>
    <div class="bg-red-50 border border-red-200 text-red-700 px-3 py-2 rounded-lg text-xs font-mono mb-4">
      <?= e($error) ?>
    </div>
  <?php endif; ?>
  <form method="post" class="space-y-4">
    <div>
      <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-1">Username</label>
      <input name="username" required autocomplete="username" class="w-full bg-[#FAF7F2] border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-900 focus:outline-none focus:border-[#C51E28]">
    </div>
    <div>
      <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-1">Password</label>
      <input name="password" type="password" required autocomplete="current-password" class="w-full bg-[#FAF7F2] border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-900 focus:outline-none focus:border-[#C51E28]">
    </div>
    <button type="submit" class="w-full bg-[#0B0C0E] hover:bg-[#C51E28] text-white py-2.5 rounded-lg font-mono text-xs font-bold uppercase tracking-wider transition-colors shadow-sm">
      Log In to Admin Desk →
    </button>
  </form>
</div>
</body>
</html>