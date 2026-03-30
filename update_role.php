<?php
require_once 'includes/functions.php';
require_once 'includes/db.php';
requireLogin();

$userId = isset($_GET['user_id']) ? (int) $_GET['user_id'] : 0;
$role = $_GET['role'] ?? '';

if ($userId <= 0 || !in_array($role, ['user', 'admin'], true)) {
    redirect('admin_weak.php?message=Invalid request');
}

$stmt = $pdo->prepare("UPDATE users SET role = :role WHERE id = :id");
$stmt->execute([
    'role' => $role,
    'id'   => $userId
]);

redirect('admin_weak.php?message=Role updated successfully');