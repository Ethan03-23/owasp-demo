<?php
require_once 'includes/functions.php';
require_once 'includes/db.php';
requireLogin();

$stmt = $pdo->query("SELECT id, username, email, role, created_at FROM users ORDER BY id ASC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once 'includes/header.php';
?>

<section class="card">
    <h1>Vulnerable Admin Page</h1>
    <p>
        This page is intentionally vulnerable for the Broken Access Control demonstration.
        It only checks whether the user is logged in, not whether they are actually an admin.
    </p>
    <p>
        That means any logged-in user can access this page and view admin-level functionality.
    </p>
</section>

<section class="card">
    <h2>All Users</h2>

    <?php if (isset($_GET['message'])): ?>
        <div class="message success">
            <?php echo e($_GET['message']); ?>
        </div>
    <?php endif; ?>

    <table class="user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created</th>
                <th>Actions (Vulnerable)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo e((string)$user['id']); ?></td>
                    <td><?php echo e($user['username']); ?></td>
                    <td><?php echo e($user['email']); ?></td>
                    <td><?php echo e($user['role']); ?></td>
                    <td><?php echo e($user['created_at']); ?></td>
                    <td>
                        <a href="update_role.php?user_id=<?php echo e((string)$user['id']); ?>&role=user">Set User</a> |
                        <a href="update_role.php?user_id=<?php echo e((string)$user['id']); ?>&role=admin">Set Admin</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<?php require_once 'includes/footer.php'; ?>