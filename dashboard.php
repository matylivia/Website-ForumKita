<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include 'includes/db.php';
include 'includes/header.php';

// Ambil info user
$stmt = $pdo->prepare("SELECT username, full_name, profile_pic, level, level_points FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

// Ambil diskusi user
$stmt = $pdo->prepare("SELECT id, title, created_at FROM discussions WHERE user_id = ? ORDER BY created_at DESC LIMIT 5");
$stmt->execute([$_SESSION['user_id']]);
$myDiscussions = $stmt->fetchAll();

// Hitung statistik user
$stmt = $pdo->prepare("SELECT COUNT(*) FROM discussions WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$totalDiscussions = $stmt->fetchColumn();

$stmt = $pdo->prepare("SELECT COUNT(*) FROM replies WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$totalReplies = $stmt->fetchColumn();
?>

<main class="container my-5">
    <div class="row">
        <!-- Sidebar Profil -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <img src="uploads/profiles/<?= htmlspecialchars($user['profile_pic'] ?: 'default.jpg') ?>" class="rounded-circle mb-3" width="100" height="100" alt="Foto Profil">
                    <h4><?= htmlspecialchars($user['full_name'] ?: $user['username']) ?></h4>
                    <p class="text-muted">Level <?= ucfirst($user['level']) ?> (<?= $user['level_points'] ?> XP)</p>
                    <a href="profile.php" class="btn btn-outline-primary btn-sm">Lihat Profil</a>
                    <a href="logout.php" class="btn btn-outline-danger btn-sm mt-2">Keluar</a>
                </div>
            </div>
        </div>

        <!-- Konten Utama -->
        <div class="col-md-8">
            <h2 class="mb-4">Selamat datang, <?= htmlspecialchars($user['username']) ?> 👋</h2>

            <!-- Quick Actions -->
            <div class="mb-4">
                <a href="buat-diskusi.php" class="btn btn-primary me-2"><i class="fas fa-plus"></i> Buat Diskusi</a>
                <a href="diskusi-saya.php" class="btn btn-outline-secondary me-2"><i class="fas fa-comments"></i> Diskusi Saya</a>
                <a href="profil.php" class="btn btn-outline-info"><i class="fas fa-user"></i> Edit Profil</a>
            </div>

            <!-- Statistik -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Diskusi</h5>
                            <p class="display-6"><?= $totalDiscussions ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Balasan</h5>
                            <p class="display-6"><?= $totalReplies ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Diskusi Terakhir -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Diskusi Terakhir Anda</h5>
                </div>
                <div class="card-body">
                    <?php if (count($myDiscussions) > 0): ?>
                        <ul class="list-group">
                            <?php foreach ($myDiscussions as $disc): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="diskusi.php?id=<?= $disc['id'] ?>"><?= htmlspecialchars($disc['title']) ?></a>
                                    <small class="text-muted"><?= date('d M Y H:i', strtotime($disc['created_at'])) ?></small>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted">Anda belum memulai diskusi.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
