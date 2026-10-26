<?php
/**
 * Admin: Change Password
 */
declare(strict_types=1);
require_once __DIR__ . '/layout.php';

$error   = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && verify_csrf($_POST['csrf'] ?? '')) {
    $current  = (string)($_POST['current_password']  ?? '');
    $new      = (string)($_POST['new_password']       ?? '');
    $confirm  = (string)($_POST['confirm_password']   ?? '');

    if ($current === '' || $new === '' || $confirm === '') {
        $error = 'All fields are required.';
    } elseif (strlen($new) < 10) {
        $error = 'New password must be at least 10 characters.';
    } elseif ($new !== $confirm) {
        $error = 'New password and confirmation do not match.';
    } else {
        $stmt = db()->prepare('SELECT id, username, password_hash FROM admin_users WHERE id = ? LIMIT 1');
        $stmt->execute([$_SESSION['admin_id']]);
        $row = $stmt->fetch();
        if (!$row || !password_verify($current, $row['password_hash'])) {
            $error = 'Current password is incorrect.';
        } else {
            $hash = password_hash($new, PASSWORD_BCRYPT, ['cost' => 12]);
            db()->prepare('UPDATE admin_users SET password_hash = ? WHERE id = ?')
               ->execute([$hash, $row['id']]);
            flash_set('Password updated successfully.');
            $success = true;
        }
    }
}

admin_header('Change Password');
?>

<div class="max-w-lg">
  <div class="mb-8">
    <span class="font-mono text-xs uppercase tracking-widest text-[#C8102E] font-bold">ACCOUNT</span>
    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mt-1">Change Password</h1>
  </div>

  <?php if ($error): ?>
    <div class="mb-6 bg-red-50 border border-red-200 rounded-xl px-5 py-4 text-sm text-red-700 font-mono"><?= e($error) ?></div>
  <?php endif; ?>

  <form method="post" class="bg-white rounded-2xl border border-gray-200/80 p-6 sm:p-8 shadow-sm space-y-5">
    <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

    <div>
      <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">Current Password</label>
      <input type="password" name="current_password" required autocomplete="current-password"
             class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm">
    </div>
    <div>
      <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">New Password <span class="font-normal text-gray-400">(min 10 characters)</span></label>
      <input type="password" name="new_password" required autocomplete="new-password"
             class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm">
    </div>
    <div>
      <label class="block text-xs font-mono font-bold uppercase tracking-wider text-gray-700 mb-2">Confirm New Password</label>
      <input type="password" name="confirm_password" required autocomplete="new-password"
             class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm">
    </div>

    <div class="flex items-center justify-between pt-2">
      <a href="/admin/dashboard.php" class="text-xs font-mono text-gray-500 hover:text-gray-900 uppercase tracking-wider">← Back</a>
      <button type="submit"
              class="inline-flex items-center gap-2 bg-[#C8102E] hover:bg-[#9E0C24] text-white px-8 py-3 rounded-xl font-mono text-xs font-bold uppercase tracking-wider transition-colors shadow-md">
        Update Password
      </button>
    </div>
  </form>
</div>

<?php admin_footer(); ?>
