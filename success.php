<!-- app/views/laporan/success.php -->
<div class="row justify-content-center mt-5 mb-5">
  <div class="col-md-6 text-center">
    <div class="card shadow-sm border-0 rounded-4 p-5">
      <div class="success-icon mb-4">
        <div class="success-circle mx-auto">
          <i class="fa-solid fa-check-double"></i>
        </div>
      </div>
      <h3 class="fw-bold mb-2">Laporan Terkirim!</h3>
      <p class="text-muted mb-4">Terima kasih telah melaporkan kejadian. Laporan Anda telah diterima dan akan segera diverifikasi oleh petugas BPBD setempat.</p>
      
      <div class="alert alert-success text-start">
        <div class="fw-semibold mb-1"><i class="fa-solid fa-clock me-2"></i>Estimasi Waktu Respon</div>
        <ul class="mb-0 small">
          <li>Status <strong>Waspada/Siaga</strong>: Respon dalam 2–4 jam</li>
          <li>Status <strong>Awas/Darurat</strong>: Respon dalam 30–60 menit</li>
        </ul>
      </div>

      <div class="d-grid gap-2">
        <a href="<?= BASE_URL; ?>" class="btn btn-brand py-2">
          <i class="fa-solid fa-house me-2"></i>Kembali ke Dashboard
        </a>
        <a href="<?= BASE_URL; ?>/laporan/create" class="btn btn-outline-secondary py-2">
          <i class="fa-solid fa-plus me-2"></i>Kirim Laporan Lain
        </a>
      </div>
    </div>
  </div>
</div>

<style>
  .success-circle {
    width: 90px; height: 90px;
    background: linear-gradient(135deg, #205A28, #2ecc71);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: white; font-size: 2.2rem;
    box-shadow: 0 8px 25px rgba(32, 90, 40, 0.3);
  }
  .btn-brand { background: #106EBE; color: white; border: none; }
  .btn-brand:hover { background: #0b4f8c; color: white; }
</style>
