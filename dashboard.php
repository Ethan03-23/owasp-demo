<?php
require_once 'includes/functions.php';
requireLogin();
require_once 'includes/header.php';
?>

<section class="card">
    <h1>User Dashboard</h1>
    <p>Welcome, <?php echo e($_SESSION['username'] ?? 'User'); ?>.</p>
    <p>Your email: <?php echo e($_SESSION['email'] ?? ''); ?></p>
    <p>Your role: <?php echo e($_SESSION['role'] ?? 'user'); ?></p>
</section>

<section class="card">
    <h2>Project Progress</h2>
    <p>
        This dashboard is part of the base application structure created in Week 2.
        Later weeks will use this application to demonstrate selected OWASP vulnerabilities.
    </p>
</section>

<?php require_once 'includes/footer.php'; ?>