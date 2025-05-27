<?php 
include 'includes/header.php';
include 'includes/db.php';

// Cek apakah user sudah login
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<main class="container my-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h1 class="h4 mb-0">Buat Diskusi Baru</h1>
                </div>
                <div class="card-body">
                    <form id="createDiscussionForm" action="process-discussion.php" method="POST" enctype="multipart/form-data">
                        <!-- CSRF Token -->
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        
                        <!-- Judul Diskusi -->
                        <div class="mb-4">
                            <label for="judul" class="form-label fw-bold">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan judul diskusi Anda" required>
                            <div class="form-text">Buat judul yang menarik untuk diskusi Anda</div>
                        </div>
                        
                        <!-- Kategori -->
                        <div class="mb-4">
                            <label for="kategori" class="form-label fw-bold">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori" required>
                                <option value="" selected disabled>Pilih kategori</option>
                                <option value="teknologi">Teknologi</option>
                                <option value="pendidikan">Pendidikan</option>
                                <option value="kesehatan">Kesehatan</option>
                                <option value="keuangan">Keuangan</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        
                        <!-- Konten Diskusi -->
                        <div class="mb-4">
                            <label for="konten" class="form-label fw-bold">Konten</label>
                            <textarea class="form-control" id="konten" name="konten" rows="8" placeholder="Tulis isi diskusi Anda di sini..." required></textarea>
                            <div class="form-text">Gunakan format yang jelas dan sopan</div>
                        </div>
                        
                        <!-- Lampiran -->
                        <div class="mb-4">
                            <label for="lampiran" class="form-label fw-bold">Lampiran (Opsional)</label>
                            <input type="file" class="form-control" id="lampiran" name="lampiran">
                            <div class="form-text">Format: JPG, PNG, PDF (maks. 5MB)</div>
                        </div>
                        
                        <!-- Formatting Toolbar -->
                        <div class="formatting-toolbar mb-3 bg-light p-2 rounded">
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-format="bold"><i class="fas fa-bold"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-format="italic"><i class="fas fa-italic"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-format="list-ul"><i class="fas fa-list-ul"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-format="list-ol"><i class="fas fa-list-ol"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-format="link"><i class="fas fa-link"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-format="image"><i class="fas fa-image"></i></button>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="reset" class="btn btn-secondary me-md-2">Reset</button>
                            <button type="submit" class="btn btn-primary">Publikasikan Diskusi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>