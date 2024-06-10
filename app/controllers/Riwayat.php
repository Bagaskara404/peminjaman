<?php
session_start();

class Riwayat extends Controller{

    public function index(){
        $id = $_SESSION['id_admin'];
        $data ['admin'] = $this->model('tb_admin')->getDataAdmin($id);
        $data ['riwayat'] = $this->model('tb_riwayat_peminjaman')->getDataRiwayat();
        $this->view('riwayat/index', $data);
    }
}