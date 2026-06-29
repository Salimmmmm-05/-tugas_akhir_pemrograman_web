<?php
// app/controllers/AdminController.php

class AdminController extends Controller {
    public function __construct() {
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // Protect route
        if (!isset($_SESSION['user_id']) || !in_array($_SESSION['user_role'], ['superadmin', 'admin_bpbd'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }
    }

    public function index() {
        $db = new Database();
        
        $db->executeParams(
            "SELECT l.*, u.nama as pelapor, j.nama as jenis_bencana, j.icon 
             FROM laporan_masyarakat l 
             LEFT JOIN users u ON l.user_id = u.id 
             LEFT JOIN jenis_bencana j ON l.jenis_bencana_id = j.id 
             WHERE l.status = 'menunggu' 
             ORDER BY l.created_at DESC", 
            []
        );
        $laporan = $db->resultSet();
        
        $db->executeParams("SELECT COUNT(*) as total FROM laporan_masyarakat WHERE status = 'menunggu'", []);
        $count_menunggu = $db->single()['total'];
        
        $db->executeParams("SELECT COUNT(*) as total FROM laporan_masyarakat WHERE status != 'menunggu'", []);
        $count_selesai = $db->single()['total'];

        $data = [
            'title' => 'Dashboard Admin - ' . APP_NAME,
            'user_nama' => $_SESSION['user_nama'],
            'laporan' => $laporan,
            'count_menunggu' => $count_menunggu,
            'count_selesai' => $count_selesai
        ];
        
        $this->view('layouts/header', $data);
        $this->view('admin/index', $data);
        $this->view('layouts/footer');
    }

    public function verifikasi() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $solusi = filter_input(INPUT_POST, 'solusi', FILTER_SANITIZE_STRING);
            
            $db = new Database();
            try {
                $db->executeParams(
                    "UPDATE laporan_masyarakat SET status = 'diverifikasi', solusi = ?, diverifikasi_oleh = ? WHERE id = ?",
                    [$solusi, $_SESSION['user_id'], $id],
                    "sii"
                );
                echo json_encode(['success' => true]);
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            }
            exit;
        }
    }
}
