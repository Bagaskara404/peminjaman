<?php
session_start();

class Kategori extends Controller{

    public function index(){
        $id = $_SESSION['id_admin'];
        $data ['admin'] = $this->model('tb_admin')->getDataAdmin($id);
        $data ['kategori'] = $this->model('tb_kategori')->getDataKategori();
        $data ['notifikasi'] = $this->model('tb_peminjaman')->getDataTerlambat();
        $this->view('kategori/index', $data);
    }

    public function hapus_kategori($id){
        $sql = $this->model('tb_kategori')->hapus_kategori($id);
        
        if ($sql >0) {
            echo '<script language="javascript" type="text/javascript">
              alert("Data kategori berhasil dihapus!");</script>';
            echo "<meta http-equiv='refresh' content='0; url=" . BASEURL . "/kategori/index'>";
        } else {
            echo "Error: ";
        }
    }

    public function tambah_kategori(){
        $nama = $_POST['nama'];
        $deskripsi = $_POST['deskripsi'];
        
        // Query SQL untuk menyimpan data anggota
        $sql = $this->model('tb_kategori')->tambah_kategori($nama, $deskripsi);
        
        if ($sql > 0) {
            echo '<script language="javascript" type="text/javascript">
              alert("Data kategori berhasil disimpan!");</script>';
            echo "<meta http-equiv='refresh' content='0; url=".BASEURL."/kategori/index'>";
        } else {
            echo "Error: ";
        }
    }

    public function update_kategori(){
        // Ambil data dari formulir
        $id_kategori = $_POST['id_kategori'];
        $nama = $_POST['nama'];
        $deskripsi = $_POST['deskripsi'];
        
        // Query SQL untuk memperbarui data anggota
        $sql = $this->model('tb_kategori')->update_kategori($nama, $deskripsi, $id_kategori);
        
        if ($sql > 0) {
            echo '<script language="javascript" type="text/javascript">
              alert("Data kategori '.$nama.' berhasil diperbarui.!");</script>';
            echo "<meta http-equiv='refresh' content='0; url=".BASEURL."/kategori/index'>";
        } else {
            echo "Error: ";
        }
    }
}