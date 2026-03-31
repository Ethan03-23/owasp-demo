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
    <h2>Secure Baseline</h2>
    <p>
        This page represents the secure admin-only version. It requires the user
        to have the admin role before access is granted.
    </p>
</section>

<?php require_once 'includes/footer.php'; ?>