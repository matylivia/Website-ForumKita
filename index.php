<?php
include 'includes/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ambil data kategori
$stmt = $pdo->query("SELECT id, name, slug FROM categories ORDER BY name ASC");
$categories = $stmt->fetchAll();

// Ambil diskusi terpopuler berdasarkan view_count
$stmt = $pdo->query("SELECT d.id, d.title, d.slug, d.view_count, c.name AS category_name, c.slug AS category_slug, u.username 
                     FROM discussions d
                     JOIN categories c ON d.category_id = c.id
                     JOIN users u ON d.user_id = u.id
                     ORDER BY d.view_count DESC
                     LIMIT 5");
$popularDiscussions = $stmt->fetchAll();

// Ambil diskusi terbaru
$stmt = $pdo->query("SELECT d.id, d.title, d.slug, d.created_at, c.name AS category_name, c.slug AS category_slug, u.username
                     FROM discussions d
                     JOIN categories c ON d.category_id = c.id
                     JOIN users u ON d.user_id = u.id
                     ORDER BY d.created_at DESC
                     LIMIT 5");
$newDiscussions = $stmt->fetchAll();

// Ambil pengguna teraktif berdasarkan level_points
$stmt = $pdo->query("SELECT id, username, full_name, profile_pic, level, level_points
                     FROM users
                     ORDER BY level_points DESC
                     LIMIT 5");
$activeUsers = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>FORUM KITA - Beranda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>

<?php include 'includes/header.php'; ?>

<main class="container my-4">
    <!-- Hero Section -->
    <section class="hero-section text-center py-5 mb-5">
        <h1 class="display-4 fw-bold">FORUM DISKUSI ONLINE TERBAIK DI INDONESIA</h1>
        <p class="lead">Bergabunglah dengan ribuan pengguna untuk berbagai ide, mendapatkan solusi, dan membangun komunitas yang bermanfaat.</p>
        <?php if (!isset($_SESSION['user_id'])): ?>
            <div class="mt-4">
                <a href="register.php" class="btn btn-primary btn-lg me-2">Daftar</a>
                <a href="login.php" class="btn btn-outline-primary btn-lg">Masuk</a>
            </div>
        <?php endif; ?>
    </section>

    <!-- Kategori dan Diskusi Terpopuler -->
    <section class="row mb-5">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h2 class="h5 mb-0">Kategori</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php foreach ($categories as $cat): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="kategori.php?slug=<?= htmlspecialchars($cat['slug']) ?>" class="text-decoration-none text-dark"><?= htmlspecialchars($cat['name']) ?></a>
                            </li>
                        <?php endforeach; ?>
                        <li class="list-group-item">
                            <a href="kategori.php" class="text-primary">Lainnya</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="h5 mb-0">Diskusi Terpopuler</h2>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <?php foreach ($popularDiscussions as $disc): ?>
                        <a href="diskusi.php?id=<?= $disc['id'] ?>" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <span class="badge bg-info text-dark"><?= htmlspecialchars($disc['category_name']) ?></span>
                                <small><?= number_format($disc['view_count']) ?> views</small>
                            </div>
                            <h3 class="h6 mb-1"><?= htmlspecialchars($disc['title']) ?></h3>
                            <small>Oleh <?= htmlspecialchars($disc['username']) ?></small>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Diskusi Terbaru -->
    <section class="mb-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="h5 mb-0">Diskusi Terbaru</h2>
            </div>
            <div class="card-body">
                <?php foreach ($newDiscussions as $disc): ?>
                <div class="discussion-item mb-4 pb-4 border-bottom">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h3 class="h5"><?= htmlspecialchars($disc['title']) ?></h3>
                        <small class="text-muted"><?= date('d M Y H:i', strtotime($disc['created_at'])) ?></small>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <span class="badge bg-secondary me-2"><?= htmlspecialchars($disc['category_name']) ?></span>
                        <small class="text-muted">Oleh <?= htmlspecialchars($disc['username']) ?></small>
                    </div>
                    <a href="diskusi.php?id=<?= $disc['id'] ?>" class="btn btn-sm btn-outline-primary">Lihat</a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Pengguna Teraktif -->
    <section class="mb-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="h5 mb-0">Pengguna Teraktif</h2>
            </div>
            <div class="card-body d-flex flex-wrap justify-content-start gap-3">
                <?php foreach ($activeUsers as $user): ?>
                    <div class="user-card text-center" style="width: 120px;">
                        <img src="<?= htmlspecialchars($user['profile_pic'] ?: 'assets/img/default-profile.png') ?>" alt="<?= htmlspecialchars($user['username']) ?>" class="rounded-circle mb-2" width="80" height="80" />
                        <h6 class="mb-1"><?= htmlspecialchars($user['username']) ?></h6>
                        <small class="text-muted">Level <?= (int)$user['level'] ?></small>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
