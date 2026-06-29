<?php
// app/models/User.php

class User {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function login($identifier, $password, $is_admin = false) {
        if ($is_admin) {
            $this->db->executeParams("SELECT * FROM users WHERE username = ?", [$identifier], "s");
        } else {
            $this->db->executeParams("SELECT * FROM users WHERE nama = ?", [$identifier], "s");
        }
        $row = $this->db->single();

        if ($row) {
            if (password_verify($password, $row['password'])) {
                return $row;
            }
        }
        return false;
    }

    public function register($data, $is_admin = false) {
        $role = $is_admin ? 'admin_bpbd' : 'masyarakat';
        
        if ($is_admin) {
            $query = "INSERT INTO users (nama, username, password, role) VALUES (?, ?, ?, ?)";
            $params = [$data['nama'], $data['username'], $data['password'], $role];
        } else {
            $query = "INSERT INTO users (nama, no_hp, password, role) VALUES (?, ?, ?, ?)";
            $params = [$data['nama'], $data['no_hp'], $data['password'], $role];
        }
        $types = "ssss";

        try {
            $this->db->executeParams($query, $params, $types);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getUserByNama($nama) {
        $this->db->executeParams("SELECT * FROM users WHERE nama = ?", [$nama], "s");
        return $this->db->single();
    }

    public function getUserByUsername($username) {
        $this->db->executeParams("SELECT * FROM users WHERE username = ?", [$username], "s");
        return $this->db->single();
    }
}
