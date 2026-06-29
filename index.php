<!-- app/views/dashboard/index.php -->
<div class="row mb-4">
    <div class="col-12 text-center">
        <h2 class="fw-bold mb-3">Status Kebencanaan Madura Hari Ini</h2>
        <p class="text-muted">Pantau titik rawan dan peringatan dini bencana alam di 4 Kabupaten Pulau Madura secara real-time.</p>
    </div>
</div>

<div class="row">
    <!-- Map Section -->
    <div class="col-lg-8 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center py-3">
                <span class="fw-bold"><i class="fa-solid fa-map-location-dot me-2 text-brand"></i>Peta Peringatan Dini</span>
                <div>
                    <span class="badge badge-aman me-1">Aman</span>
                    <span class="badge badge-waspada me-1">Waspada</span>
                    <span class="badge badge-siaga me-1">Siaga</span>
                    <span class="badge badge-awas">Awas</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div id="map"></div>
            </div>
        </div>
    </div>

    <!-- Sidebar Section -->
    <div class="col-lg-4 mb-4">
        <!-- Weather Widget (Mock) -->
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <span class="fw-bold"><i class="fa-solid fa-cloud-sun me-2 text-brand"></i>Prakiraan Cuaca (Mock API)</span>
            </div>
            <div class="card-body text-center">
                <div class="display-4 fw-bold text-brand mb-2">29&deg;C</div>
                <h5 class="fw-bold">Cerah Berawan</h5>
                <p class="text-muted mb-0">Curah Hujan: 0mm | Angin: 12 km/h</p>
                <small class="text-muted">Update: <?= date('d M Y H:i'); ?></small>
            </div>
        </div>

        <!-- Recent Alerts -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <span class="fw-bold"><i class="fa-solid fa-bell me-2 text-brand"></i>Peringatan Terkini</span>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-start py-3">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold"><i class="fa-solid fa-water text-primary me-2"></i>Waspada Banjir</div>
                        Kec. Blega, Kabupaten Bangkalan
                        <div class="text-muted small mt-1">2 Jam yang lalu</div>
                    </div>
                    <span class="badge badge-waspada rounded-pill">Waspada</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start py-3">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold"><i class="fa-solid fa-sun text-warning me-2"></i>Kekeringan Kritis</div>
                        Kec. Batumarmar, Kabupaten Pamekasan
                        <div class="text-muted small mt-1">5 Jam yang lalu</div>
                    </div>
                    <span class="badge badge-siaga rounded-pill">Siaga</span>
                </li>
            </ul>
            <div class="card-body text-center py-2">
                <a href="#" class="btn btn-sm btn-outline-brand">Lihat Semua Peringatan</a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize map centered on Madura
    var map = L.map('map').setView([-7.0865, 113.3134], 10);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Dummy Markers based on PRD colors
    // Aman: #205A28, Waspada: #F9A825, Siaga: #EF6C00, Awas: #C62828

    // Bangkalan (Waspada)
    var markerBangkalan = L.circleMarker([-7.0263, 112.7441], {
        color: '#F9A825', fillColor: '#F9A825', fillOpacity: 0.8, radius: 12
    }).addTo(map).bindPopup('<b>Bangkalan</b><br>Status: Waspada (Banjir)');

    // Sampang (Aman)
    var markerSampang = L.circleMarker([-7.1895, 113.2435], {
        color: '#205A28', fillColor: '#205A28', fillOpacity: 0.8, radius: 10
    }).addTo(map).bindPopup('<b>Sampang</b><br>Status: Aman');

    // Pamekasan (Siaga)
    var markerPamekasan = L.circleMarker([-7.1611, 113.4819], {
        color: '#EF6C00', fillColor: '#EF6C00', fillOpacity: 0.8, radius: 12
    }).addTo(map).bindPopup('<b>Pamekasan</b><br>Status: Siaga (Kekeringan)');

    // Sumenep (Awas)
    var markerSumenep = L.circleMarker([-7.0163, 113.8660], {
        color: '#C62828', fillColor: '#C62828', fillOpacity: 0.8, radius: 15
    }).addTo(map).bindPopup('<b>Sumenep</b><br>Status: Awas (Gelombang Tinggi)');
});
</script>
