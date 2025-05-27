<?php include 'includes/header.php'; ?>

<main class="container my-5">
    <!-- Hero Section -->
    <section class="contact-hero text-center py-5 mb-5 bg-light rounded-3">
        <div class="container py-4">
            <h1 class="display-4 fw-bold mb-3">Hubungi Kami</h1>
            <p class="lead col-md-8 mx-auto">
                Punya pertanyaan atau masukan? Kami siap membantu Anda!
            </p>
        </div>
    </section>

    <div class="row">
        <!-- Form Kontak -->
        <div class="col-lg-7 mb-5 mb-lg-0">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <h2 class="h3 mb-4">Kirim Pesan</h2>
                    <form id="contactForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subjek</label>
                            <select class="form-select" id="subject" required>
                                <option value="" selected disabled>Pilih subjek</option>
                                <option value="pertanyaan">Pertanyaan</option>
                                <option value="masukan">Masukan</option>
                                <option value="kerjasama">Kerjasama</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Pesan</label>
                            <textarea class="form-control" id="message" rows="5" required></textarea>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="agree" required>
                            <label class="form-check-label" for="agree">Saya setuju dengan kebijakan privasi</label>
                        </div>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-paper-plane me-2"></i> Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Info Kontak -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4 p-md-5">
                    <h2 class="h3 mb-4">Informasi Kontak</h2>
                    
                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0 bg-primary bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-map-marker-alt text-primary fs-4"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="h5">Alamat</h3>
                            <p class="mb-0">Jl. Inovasi Digital No. 88<br>Gedung Kampus TI<br>Tanjungpinang, Indonesia</p>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0 bg-primary bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-envelope text-primary fs-4"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="h5">Email</h3>
                            <p class="mb-0">
                                <a href="mailto:forumkit@email.com" class="text-decoration-none">forumkit@email.com</a><br>
                                <a href="mailto:support@forumkit.com" class="text-decoration-none">support@forumkit.com</a>
                            </p>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0 bg-primary bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-phone-alt text-primary fs-4"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="h5">Telepon</h3>
                            <p class="mb-0">
                                <a href="tel:+62771123456" class="text-decoration-none">(0771) 123-456</a><br>
                                <a href="tel:+6281234567890" class="text-decoration-none">0812-3456-7890</a>
                            </p>
                        </div>
                    </div>
                    
                    <div class="d-flex">
                        <div class="flex-shrink-0 bg-primary bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-clock text-primary fs-4"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="h5">Jam Operasional</h3>
                            <p class="mb-0">
                                Senin-Jumat: 08.00 - 17.00 WIB<br>
                                Sabtu: 08.00 - 14.00 WIB<br>
                                Minggu: Tutup
                            </p>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <h3 class="h5 mb-3">Media Sosial</h3>
                    <div class="social-media">
                        <a href="#" class="btn btn-outline-primary btn-sm rounded-circle me-2">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="btn btn-outline-info btn-sm rounded-circle me-2">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-outline-danger btn-sm rounded-circle me-2">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="btn btn-outline-primary btn-sm rounded-circle me-2">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="btn btn-outline-success btn-sm rounded-circle">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>

