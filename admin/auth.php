<?php
/**
 * Admin auth helpers: session login, rate-limiting, CSRF tokens.
 */
declare(strict_types=1);

session_start();

function admin_logged_in(): bool
{
    return isset($_SESSION['admin_id']);
}

function require_admin_login(): void
{
    if (!admin_logged_in()) {
        header('Location: /admin/index.php');
        exit;
    }
}

/** Rate-limit: max 5 attempts per IP per 10 minutes. */
function login_rate_limited(string $ip): bool
{
    $stmt = db()->prepare(
        "SELECT COUNT(*) FROM login_attempts WHERE ip = ? AND attempted_at > (NOW() - INTERVAL 10 MINUTE)"
    );
    $stmt->execute([$ip]);
    return (int)$stmt->fetchColumn() >= 5;
}

function record_login_attempt(string $ip): void
{
    $stmt = db()->prepare('INSERT INTO login_attempts (ip) VALUES (?)');
    $stmt->execute([$ip]);
}

function verify_admin(string $username, string $password): bool
{
    $stmt = db()->prepare('SELECT id, password_hash FROM admin_users WHERE username = ? LIMIT 1');
    $stmt->execute([$username]);
    $row = $stmt->fetch();
    return $row && password_verify($password, $row['password_hash']);
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function verify_csrf(string $token): bool
{
    return hash_equals($_SESSION['csrf'] ?? '', $token);
}
