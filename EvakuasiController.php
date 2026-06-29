<?php
// app/controllers/EvakuasiController.php

class EvakuasiController extends Controller {
    public function index() {
        $data = [
            'title' => 'Peta Evakuasi - ' . APP_NAME
        ];
        $this->view('layouts/header', $data);
        $this->view('evakuasi/index', $data);
        $this->view('layouts/footer');
    }
}
