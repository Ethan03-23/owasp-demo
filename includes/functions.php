<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn(): bool
{
    return isset($_SESSION['user_id']);
}

function redirect(string $location): void
{
    header("Location: $location");
    exit;
}

function requireLogin(): void
{
    if (!isLoggedIn()) {
        redirect("login.php");
    }
}

function requireAdmin(): void
{
    requireLogin();

    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        redirect("dashboard.php");
    }
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>