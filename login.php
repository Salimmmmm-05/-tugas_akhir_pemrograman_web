<!-- app/views/auth/login.php -->
<div class="row justify-content-center mt-5">
    <div class="col-md-8 text-center mb-4">
        <h2 class="fw-bold text-brand" style="font-family: 'Poppins', sans-serif; letter-spacing: 2px; text-shadow: 1px 1px 2px rgba(0,0,0,0.1);">
            MADURA DISASTER EARLY WARNING SYSTEM
        </h2>
        <p class="text-muted fs-5">Sistem Informasi Peringatan Dini Bencana Terpadu Pulau Madura</p>
    </div>
</div>

<div class="row justify-content-center mb-5">
    <div class="col-md-5">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white text-center py-4 border-bottom-0">
                <h4 class="mb-0 fw-bold text-dark">Masuk ke Akun Anda</h4>
            </div>
            <div class="card-body p-4 pt-0">
                <?php if(isset($_GET['registered'])): ?>
                    <div class="alert alert-success rounded-3">Registrasi berhasil! Silakan login.</div>
                <?php endif; ?>
                
                <?php if(isset($data['error'])): ?>
                    <div class="alert alert-danger rounded-3"><?= $data['error']; ?></div>
                <?php endif; ?>

                <!-- Tipe Login Toggle -->
                <ul class="nav nav-pills nav-fill bg-light p-1 rounded-pill mb-4" id="loginTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active rounded-pill fw-semibold" id="user-tab" data-bs-toggle="tab" data-bs-target="#user-login" type="button" role="tab" aria-selected="true">User</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill fw-semibold" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin-login" type="button" role="tab" aria-selected="false">Admin</button>
                    </li>
                </ul>

                <div class="tab-content" id="loginTabContent">
                    <!-- User Login Form -->
                    <div class="tab-pane fade show active" id="user-login" role="tabpanel">
                        <form action="<?= BASE_URL; ?>/auth/login" method="POST">
                            <input type="hidden" name="login_type" value="user">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama yang Didaftarkan</label>
                                <input type="text" class="form-control rounded-3" id="nama" name="nama" required placeholder="Masukkan nama Anda">
                            </div>
                            <div class="mb-4">
                                <label for="password_user" class="form-label">Password</label>
                                <input type="password" class="form-control rounded-3" id="password_user" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-brand w-100 py-2 rounded-pill fw-bold shadow-sm">Login User</button>
                        </form>
                    </div>

                    <!-- Admin Login Form -->
                    <div class="tab-pane fade" id="admin-login" role="tabpanel">
                        <form action="<?= BASE_URL; ?>/auth/login" method="POST">
                            <input type="hidden" name="login_type" value="admin">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username Admin</label>
                                <input type="text" class="form-control rounded-3" id="username" name="username" required placeholder="Masukkan username">
                            </div>
                            <div class="mb-4">
                                <label for="password_admin" class="form-label">Password</label>
                                <input type="password" class="form-control rounded-3" id="password_admin" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-dark w-100 py-2 rounded-pill fw-bold shadow-sm">Login Admin</button>
                        </form>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <p class="text-muted">Belum punya akun? <a href="<?= BASE_URL; ?>/auth/register" class="text-brand text-decoration-none fw-bold">Daftar sekarang</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
