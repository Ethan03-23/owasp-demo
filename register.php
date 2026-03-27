<?php
require_once 'includes/functions.php';
require_once 'includes/db.php';

$errors = [];
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    $role = $_POST['role'] ?? 'user';

    if ($username === '') {
        $errors[] = "Username is required.";
    }

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid email is required.";
    }

    if ($password === '') {
        $errors[] = "Password is required.";
    }

    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match.";
    }

    if (!in_array($role, ['user', 'admin'], true)) {
        $role = 'user';
    }

    if (empty($errors)) {
        $checkStmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
        $checkStmt->execute(['email' => $email]);

        if ($checkStmt->fetch()) {
            $errors[] = "An account with that email already exists.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("
                INSERT INTO users (username, email, password, role)
                VALUES (:username, :email, :password, :role)
            ");

            $stmt->execute([
                'username' => $username,
                'email' => $email,
                'password' => $hashedPassword,
                'role' => $role
            ]);

            $success = "Registration successful. You can now log in.";
        }
    }
}

require_once 'includes/header.php';
?>

<section class="card">
    <h1>Register</h1>

    <?php if (!empty($errors)): ?>
        <div class="message error">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="message success">
            <?php echo e($success); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="register.php" class="form">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <label for="role">Role</label>
        <select id="role" name="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>

        <button type="submit">Create Account</button>
    </form>
</section>

<?php require_once 'includes/footer.php'; ?>