<?php
require_once 'includes/functions.php';
require_once 'includes/db.php';
requireLogin();

$results = [];
$error = '';
$queryText = '';

if (isset($_GET['q'])) {
    $queryText = trim($_GET['q']);

    if ($queryText !== '') {
        // Intentionally vulnerable SQL query for demonstration purposes
        $sql = "SELECT id, username, email, role FROM users 
                WHERE username = '$queryText' 
                OR email = '$queryText'";

        try {
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $error = $e->getMessage();
        }
    }
}

require_once 'includes/header.php';
?>

<section class="card">
    <h1>SQL Injection Demo</h1>
    <p>
        This page is intentionally vulnerable to SQL Injection.
        The search value is inserted directly into the SQL query without prepared statements or parameter binding.
    </p>
    <p>
        Example normal input: <strong>admin@example.com</strong><br>
        Example SQL Injection payload: <strong>' OR '1'='1</strong>
    </p>
</section>

<section class="card">
    <h2>Search Users</h2>

    <form method="GET" action="search.php" class="form">
        <label for="q">Enter username or email</label>
        <input type="text" id="q" name="q" value="<?php echo e($queryText); ?>">
        <button type="submit">Run Query</button>
    </form>

    <?php if ($error): ?>
        <div class="message error">
            <strong>Database error:</strong><br>
            <?php echo e($error); ?>
        </div>
    <?php endif; ?>
</section>

<?php if (isset($_GET['q']) && !$error): ?>
    <section class="card">
        <h2>Query Results</h2>

        <?php if (!empty($results)): ?>
            <table class="user-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td><?php echo e((string)$row['id']); ?></td>
                            <td><?php echo e($row['username']); ?></td>
                            <td><?php echo e($row['email']); ?></td>
                            <td><?php echo e($row['role']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No matching users found.</p>
        <?php endif; ?>
    </section>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>