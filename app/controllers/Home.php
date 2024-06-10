<?php
session_start();
class home extends Controller{

    public function index (){
        $id = $_SESSION['id_admin'];
        $data ['admin'] = $this->model('tb_admin')->getDataAdmin($id);
        $data ['jumlah_peminjaman'] = $this->model('tb_peminjaman')->getJumlahPeminjaman();
        $data ['jumlah_anggota'] = $this->model('tb_anggota')->getJumlahAnggota();
        $data ['jumlah_buku'] = $this->model('tb_buku')->getJumlahBuku();
        $data ['jumlah_akun'] = $this->model('tb_admin')->getJumlahAdmin();
        $data ['notifikasi'] = $this->model('tb_peminjaman')->getDataTerlambat();
        $this->view('home/index', $data);
    }
}