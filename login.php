<?php
session_start();
include 'includes/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameOrEmail = trim($_POST['username_or_email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$usernameOrEmail || !$password) {
        $error = 'Username/email dan password harus diisi.';
    } else {
        $stmt = $pdo->prepare("SELECT id, username, email, password FROM users WHERE username = :ue OR email = :ue");
        $stmt->execute(['ue' => $usernameOrEmail]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Username/email atau password salah.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Forum Kita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container my-5" style="max-width: 400px;">
        <h2 class="mb-4 text-center">Masuk ke Akun Anda</h2>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php" novalidate>
            <div class="mb-3">
                <label for="username_or_email" class="form-label">Username atau Email</label>
                <input type="text" name="username_or_email" id="username_or_email" class="form-control" required 
                       value="<?= htmlspecialchars($_POST['username_or_email'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required minlength="6">
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Masuk</button>
            </div>
        </form>

        <p class="mt-3 text-center">
            Belum punya akun? <a href="register.php">Daftar di sini</a>
        </p>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
