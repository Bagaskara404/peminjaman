<?php

session_start();
class Laporan extends Controller{
    public function index(){
        $id = $_SESSION['id_admin'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $tanggalp = $_POST['tanggal_pinjam'];
            $tanggalk = $_POST['tanggal_kembali'];
            $status1 = $_POST['status'];
            $data ['laporan'] = $this->model('tb_peminjaman')->getDataLaporan($tanggalp, $tanggalk, $status1);
        }else{
            $data ['laporan'] = [];
            $tanggalp = null;
            $tanggalk = null;
            $status1 = null;
        }
        $data ['admin'] = $this->model('tb_admin')->getDataAdmin($id);
        $data ['kategori'] = $this->model('tb_kategori')->getDataKategori();
        $data ['notifikasi'] = $this->model('tb_peminjaman')->getDataTerlambat();
        $data['tanggalp'] = $tanggalp;
        $data['tanggalk'] = $tanggalk;
        $data['status1'] = $status1;
        $this->view('laporan/index', $data, $tanggalk, $tanggalp, $status1);
    }

    public function cetak($tanggalp, $tanggalk, $status){
        $data ['data_cetak'] = $this->model('tb_peminjaman')->data_cetak($tanggalp, $tanggalk, $status);
        $data['status'] = $status;
        $this->view('laporan/cetak', $data);
    }

    public function cetak_1($id, $tanggalp, $tanggalk, $status){
        $data ['data_cetak1'] = $this->model('tb_peminjaman')->data_cetak1($id, $tanggalp, $tanggalk, $status);
        $data['status'] = $status;
        $this->view('laporan/cetak1', $data);
    }
}