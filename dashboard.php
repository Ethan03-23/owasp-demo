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
    <h2>Week 3 Vulnerability Modules</h2>
    <p>
        This week focuses on Broken Access Control and Injection.
    </p>

    <ul>
        <li><a href="admin_weak.php">Broken Access Control Demo</a></li>
        <li><a href="search.php">Injection Demo</a></li>
    </ul>

    <p>
        The secure admin page is still available only to admins through <strong>admin.php</strong>,
        while <strong>admin_weak.php</strong> is the intentionally vulnerable version.
    </p>
</section>

<?php require_once 'includes/footer.php'; ?>