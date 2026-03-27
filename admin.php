<?php
require_once 'includes/functions.php';
requireAdmin();
require_once 'includes/header.php';
?>

<section class="card">
    <h1>Admin Area</h1>
    <p>This page is only accessible to users with the admin role.</p>
    <p>Welcome, <?php echo e($_SESSION['username'] ?? 'Admin'); ?>.</p>
</section>

<section class="card">
    <h2>Why this page matters</h2>
    <p>
        This admin page is part of the Week 2 role-based structure.
        In later weeks, it can be used as the basis for Broken Access Control demonstrations.
    </p>
</section>

<?php require_once 'includes/footer.php'; ?>