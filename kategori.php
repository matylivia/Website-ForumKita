<?php
session_start();
include 'includes/db.php';

// Ambil data kategori dari tabel categories
try {
    $stmt = $pdo->query("SELECT * FROM categories ORDER BY name ASC");
    $categories = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Gagal mengambil data kategori: " . $e->getMessage());
}

include 'includes/header.php';
?>

<main class="container my-5">
    <h1 class="mb-4 text-center">Daftar Kategori Diskusi</h1>
    <?php if (!empty($categories)): ?>
        <div class="row g-4">
            <?php foreach ($categories as $category): ?>
                <div class="col-md-4">
                    <div 
                        class="card shadow-sm h-100 category-card"
                        style="cursor:pointer;"
                        onclick="handleCategoryClick('<?= htmlspecialchars($category['slug']) ?>')"
                        title="Klik untuk lihat kategori"
                    >
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3 category-icon" style="font-size: 2rem;">
                                <i class="<?= htmlspecialchars($category['icon'] ?? 'bi bi-folder') ?>"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-1"><?= htmlspecialchars($category['name']) ?></h5>
                                <p class="card-text text-muted small mb-0"><?= htmlspecialchars($category['description']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center text-muted">Tidak ada kategori ditemukan.</p>
    <?php endif; ?>
</main>

<script>
function handleCategoryClick(slug) {
    <?php if (!isset($_SESSION['user_id'])): ?>
        // Jika belum login, arahkan ke halaman login dengan redirect ke kategori yang dipilih
        window.location.href = "login.php?redirect=kategori.php?slug=" + encodeURIComponent(slug);
    <?php else: ?>
        // Jika sudah login, langsung ke halaman kategori
        window.location.href = "kategori.php?slug=" + encodeURIComponent(slug);
    <?php endif; ?>
}
</script>

<style>
.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
    cursor: pointer;
}
.category-icon i {
    color: #0d6efd; /* Bootstrap primary color */
}
</style>

<?php include 'includes/footer.php'; ?>
