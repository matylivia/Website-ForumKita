<?php
include 'includes/db.php';
include 'includes/header.php';

// Fungsi ambil diskusi terpopuler per kategori
function getPopularDiscussionsByCategory($pdo, $categoryName, $limit = 3) {
    $sql = "
        SELECT d.id, d.title, d.view_count, 
               (SELECT COUNT(*) FROM comments c WHERE c.discussion_id = d.id) AS replies,
               c.name AS category_name
        FROM discussions d
        JOIN categories c ON d.category_id = c.id
        WHERE c.name = :categoryName
        ORDER BY d.view_count DESC
        LIMIT :limit
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Ambil data diskusi terpopuler untuk kategori Pendidikan dan Olahraga
$populer_pendidikan = getPopularDiscussionsByCategory($pdo, 'Pendidikan');
$populer_olahraga = getPopularDiscussionsByCategory($pdo, 'Olahraga');
?>

<main class="container my-5">
    <div class="row">
        <!-- Konten Utama -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h1 class="h3 mb-0">Diskusi Terpopuler</h1>
                </div>
                <div class="card-body">
                    <!-- Kategori Favorit Pendidikan -->
                    <div class="mb-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h2 class="h4">
                                <i class="fas fa-graduation-cap text-success me-2"></i>
                                Pendidikan
                            </h2>
                            <a href="kategori-detail.php?kategori=pendidikan" class="btn btn-sm btn-success">
                                Lihat Semua <i class="fas fa-chevron-right ms-1"></i>
                            </a>
                        </div>
                        
                        <div class="list-group">
                            <?php if (!empty($populer_pendidikan)): ?>
                                <?php foreach ($populer_pendidikan as $diskusi): ?>
                                    <a href="diskusi.php?id=<?= $diskusi['id'] ?>" class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h3 class="h6 mb-1"><?= htmlspecialchars($diskusi['title']) ?></h3>
                                            <small class="text-success">Trending</small>
                                        </div>
                                        <div class="d-flex mt-2">
                                            <small class="text-muted me-3"><i class="far fa-eye me-1"></i> <?= number_format($diskusi['view_count']) ?></small>
                                            <small class="text-muted"><i class="far fa-comment me-1"></i> <?= $diskusi['replies'] ?> Balasan</small>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-muted">Belum ada diskusi populer di kategori ini.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Kategori Favorit Olahraga -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h2 class="h4">
                                <i class="fas fa-running text-warning me-2"></i>
                                Olahraga
                            </h2>
                            <a href="kategori-detail.php?kategori=olahraga" class="btn btn-sm btn-warning">
                                Lihat Semua <i class="fas fa-chevron-right ms-1"></i>
                            </a>
                        </div>
                        
                        <div class="list-group">
                            <?php if (!empty($populer_olahraga)): ?>
                                <?php foreach ($populer_olahraga as $diskusi): ?>
                                    <a href="diskusi.php?id=<?= $diskusi['id'] ?>" class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h3 class="h6 mb-1"><?= htmlspecialchars($diskusi['title']) ?></h3>
                                            <small class="text-warning">Hot</small>
                                        </div>
                                        <div class="d-flex mt-2">
                                            <small class="text-muted me-3"><i class="far fa-eye me-1"></i> <?= number_format($diskusi['view_count']) ?></small>
                                            <small class="text-muted"><i class="far fa-comment me-1"></i> <?= $diskusi['replies'] ?> Balasan</small>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-muted">Belum ada diskusi populer di kategori ini.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="col-md-4">
            <?php include 'includes/sidebar.php'; ?>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
