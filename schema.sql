CREATE DATABASE IF NOT EXISTS madura_db;
USE madura_db;

CREATE TABLE `wilayah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `level` enum('kabupaten','kecamatan','desa') NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`parent_id`) REFERENCES `wilayah` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('superadmin','admin_bpbd','petugas','masyarakat') NOT NULL DEFAULT 'masyarakat',
  `kabupaten_id` int(11) DEFAULT NULL,
  `desa_id` int(11) DEFAULT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `no_hp` (`no_hp`),
  FOREIGN KEY (`kabupaten_id`) REFERENCES `wilayah` (`id`),
  FOREIGN KEY (`desa_id`) REFERENCES `wilayah` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `jenis_bencana` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `deskripsi` text,
  `icon` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `peringatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wilayah_id` int(11) NOT NULL,
  `jenis_bencana_id` int(11) NOT NULL,
  `tingkat` enum('hijau','kuning','oranye','merah') NOT NULL DEFAULT 'hijau',
  `deskripsi` text,
  `sumber` enum('sistem_otomatis','laporan_masyarakat','manual_admin') NOT NULL,
  `dipublikasi_oleh` int(11) NOT NULL,
  `status` enum('aktif','selesai') NOT NULL DEFAULT 'aktif',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`wilayah_id`) REFERENCES `wilayah` (`id`),
  FOREIGN KEY (`jenis_bencana_id`) REFERENCES `jenis_bencana` (`id`),
  FOREIGN KEY (`dipublikasi_oleh`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `laporan_masyarakat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `jenis_bencana_id` int(11) NOT NULL,
  `deskripsi` text,
  `foto` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `status` enum('menunggu','diverifikasi','ditindaklanjuti','ditolak') NOT NULL DEFAULT 'menunggu',
  `diverifikasi_oleh` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  FOREIGN KEY (`jenis_bencana_id`) REFERENCES `jenis_bencana` (`id`),
  FOREIGN KEY (`diverifikasi_oleh`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `notifikasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `peringatan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `channel` enum('in_app','whatsapp','sms') NOT NULL DEFAULT 'in_app',
  `status_kirim` enum('pending','terkirim','gagal') NOT NULL DEFAULT 'pending',
  `sent_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`peringatan_id`) REFERENCES `peringatan` (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `shelter_evakuasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wilayah_id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `kapasitas` int(11) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `kontak_penanggung_jawab` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`wilayah_id`) REFERENCES `wilayah` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `data_cuaca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wilayah_id` int(11) NOT NULL,
  `curah_hujan` decimal(8,2) DEFAULT NULL,
  `kecepatan_angin` decimal(8,2) DEFAULT NULL,
  `tinggi_gelombang` decimal(8,2) DEFAULT NULL,
  `recorded_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`wilayah_id`) REFERENCES `wilayah` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `log_aktivitas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `aksi` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- DUMMY DATA FOR TESTING
INSERT INTO `wilayah` (`id`, `nama`, `level`, `parent_id`, `latitude`, `longitude`) VALUES
(1, 'Kabupaten Bangkalan', 'kabupaten', NULL, -7.0263, 112.7441),
(2, 'Kabupaten Sampang', 'kabupaten', NULL, -7.1895, 113.2435),
(3, 'Kabupaten Pamekasan', 'kabupaten', NULL, -7.1611, 113.4819),
(4, 'Kabupaten Sumenep', 'kabupaten', NULL, -7.0163, 113.8660);

INSERT INTO `jenis_bencana` (`id`, `nama`, `deskripsi`, `icon`) VALUES
(1, 'Banjir', 'Banjir musiman', 'fa-water'),
(2, 'Kekeringan', 'Kekeringan ekstrim', 'fa-sun'),
(3, 'Angin Puting Beliung', 'Angin kencang memutar', 'fa-wind'),
(4, 'Gempa Bumi', 'Getaran bumi', 'fa-house-crack');

INSERT INTO `users` (`id`, `nama`, `no_hp`, `password`, `role`, `kabupaten_id`, `status`) VALUES
(1, 'Super Admin', '081234567890', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'superadmin', NULL, 'aktif'); -- password is 'password'
