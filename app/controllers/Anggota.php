<?php
session_start();
class Anggota extends Controller{
    
    public function index(){
        $id = $_SESSION['id_admin'];
        $data ['admin'] = $this->model('tb_admin')->getDataAdmin($id);
        $data ['notifikasi'] = $this->model('tb_peminjaman')->getDataTerlambat();
        $data ['anggota'] = $this->model('tb_anggota')->getDataAnggota();
        $this->view('anggota/index', $data);
    }

    public function hapus_anggota($id){
        // Periksa apakah parameter 'id' telah dikirim melalui URL
        if($id != null) {
            
            $sql = $this->model('tb_anggota')->hapus_anggota($id);
            
            // Periksa apakah penghapusan berhasil
            if ($sql > 0) {
                echo '<script language="javascript" type="text/javascript">
                alert("Data anggota berhasil dihapus!");</script>';
            echo "<meta http-equiv='refresh' content='0; url=" . BASEURL . "/anggota'>";
            } else {
                echo "Error: Data anggota gagal dihapus.";
            }
        } else {
            echo "Error: Parameter 'id' tidak ditemukan dalam URL.";
        }
    }    

    public function tambah_anggota(){
        $nama_anggota = $_POST['nama'];
        $nis_anggota = $_POST['nis'];
        $alamat_anggota = $_POST['alamat'];
        $nomor_hp_anggota = $_POST['nomorhp'];
        $email_anggota = $_POST['email'];
        $tanggal_bergabung = $_POST['tanggal'];

        // Query SQL untuk menyimpan data anggota
        $sql = $this->model('tb_anggota')->insert_anggota($nama_anggota, $nis_anggota, $alamat_anggota, $nomor_hp_anggota, $email_anggota, $tanggal_bergabung);

        if ($sql > 0) {
            echo '<script language="javascript" type="text/javascript">
            alert("Data anggota berhasil disimpan!");</script>';
        echo "<meta http-equiv='refresh' content='0; url=" . BASEURL . "/anggota'>";
        } else {
            echo "Error: ";
        }
    }

    public function edit_anggota(){
        $id_anggota = $_POST['id_anggota'];
        $nama_anggota = $_POST['nama'];
        $nis_anggota = $_POST['nis'];
        $alamat_anggota = $_POST['alamat'];
        $nomor_hp_anggota = $_POST['nomorhp'];
        $email_anggota = $_POST['email'];
        $tanggal_bergabung = $_POST['tanggal'];
        
        // Query SQL untuk memperbarui data anggota
        $sql = $this->model('tb_anggota')->update_anggota($id_anggota,$nama_anggota, $nis_anggota, $alamat_anggota, $nomor_hp_anggota, $email_anggota, $tanggal_bergabung);
        
        if ($sql > 0) {
            echo '<script language="javascript" type="text/javascript">
              alert("Data anggota berhasil diperbarui.!");</script>';
            echo "<meta http-equiv='refresh' content='0; url=" . BASEURL . "/anggota'>";
        } else {
            echo "Error: ";
        }
    }
}