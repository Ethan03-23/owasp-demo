<?php
require_once 'includes/functions.php';
require_once 'includes/db.php';
requireLogin();

$results = [];
$error = '';
$queryText = '';
<<<<<<< HEAD
$sqlPreview = '';
=======
>>>>>>> broken_access_control_and_injection

if (isset($_GET['q'])) {
    $queryText = trim($_GET['q']);

    if ($queryText !== '') {
<<<<<<< HEAD
        $sqlPreview = "SELECT id, username, email, role FROM users WHERE username LIKE '%$queryText%' OR email LIKE '%$queryText%'";

        try {
            $stmt = $pdo->query($sqlPreview);
=======
        // Intentionally vulnerable SQL query for demonstration purposes
        $sql = "SELECT id, username, email, role FROM users 
                WHERE username = '$queryText' 
                OR email = '$queryText'";

        try {
            $stmt = $pdo->query($sql);
>>>>>>> broken_access_control_and_injection
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $error = $e->getMessage();
        }
    }
}

require_once 'includes/header.php';
?>

<section class="card">
<<<<<<< HEAD
    <h1>Vulnerable Search Page</h1>
    <p>
        This page is intentionally vulnerable to SQL Injection.
        The search input is inserted directly into the SQL query without parameter binding.
=======
    <h1>SQL Injection Demo</h1>
    <p>
        This page is intentionally vulnerable to SQL Injection.
        The search value is inserted directly into the SQL query without prepared statements or parameter binding.
    </p>
    <p>
        Example normal input: <strong>admin@example.com</strong><br>
        Example SQL Injection payload: <strong>' OR '1'='1</strong>
>>>>>>> broken_access_control_and_injection
    </p>
</section>

<section class="card">
    <h2>Search Users</h2>

    <form method="GET" action="search.php" class="form">
<<<<<<< HEAD
        <label for="q">Search by username or email</label>
        <input type="text" id="q" name="q" value="<?php echo e($queryText); ?>">
        <button type="submit">Search</button>
    </form>

    <?php if ($sqlPreview): ?>
        <div class="message">
            <strong>Executed SQL:</strong><br>
            <?php echo e($sqlPreview); ?>
        </div>
    <?php endif; ?>

=======
        <label for="q">Enter username or email</label>
        <input type="text" id="q" name="q" value="<?php echo e($queryText); ?>">
        <button type="submit">Run Query</button>
    </form>

>>>>>>> broken_access_control_and_injection
    <?php if ($error): ?>
        <div class="message error">
            <strong>Database error:</strong><br>
            <?php echo e($error); ?>
        </div>
    <?php endif; ?>
</section>

<<<<<<< HEAD
<?php if (!empty($results)): ?>
    <section class="card">
        <h2>Search Results</h2>

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
=======
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
>>>>>>> broken_access_control_and_injection
    </section>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>