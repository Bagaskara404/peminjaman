<?php

session_start();

class Admin extends Controller{
    public function index(){
        $id = $_SESSION['id_admin'];
        $data ['admin'] = $this->model('tb_admin')->getDataAdmin($id);
        $data ['notifikasi'] = $this->model('tb_peminjaman')->getDataTerlambat();
        $data ['semua_admin'] = $this->model('tb_admin')->getDataSemuaAdmin();
        $this->view('admin/index', $data);
    }

    public function hapus_admin($id){
        $id_admin = $id;
        $sql = $this->model('tb_admin')->hapus_admin($id_admin);
        
        if ($sql > 0) {
            echo '<script language="javascript" type="text/javascript">
              alert("Data berhasil dihapus!");</script>';
            echo "<meta http-equiv='refresh' content='0; url=".BASEURL."admin/index'>";
        } else {
            echo "Error ";
        }
    }

    public function tambah_admin(){
        // Mengambil data dari formulir
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $nama_lengkap = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $nomor_hp = $_POST['nomor'];
        $hak_akses = $_POST['hakakses'];
        
        // Mengupload gambar
        $gambar_name = $_FILES['foto']['name'];
        $gambar_tmp = $_FILES['foto']['tmp_name'];
        $gambar_destination = "C:/xampp/htdocs/peminjaman/public/admin/" . $gambar_name;
        
        if (move_uploaded_file($gambar_tmp, $gambar_destination)) {
            // Query untuk menyimpan data ke dalam tabel admin
            $query = $this->model('tb_admin')->insert_data_admin($username, $password, $nama_lengkap, $alamat, $nomor_hp, $hak_akses, $gambar_destination);
        
            if ($query > 0) {
                echo '<script language="javascript" type="text/javascript">
                  alert("Data admin berhasil disimpan!");</script>';
                echo "<meta http-equiv='refresh' content='0; url=".BASEURL."/admin/index'>";
            } else {
                echo "Error ";
            }
        } else {
            echo "Gagal mengupload gambar.";
        }
    }

    public function update_admin(){
        // Mengambil data dari formulir
        $id_admin = $_POST['id'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $nama_lengkap = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $nomor_hp = $_POST['nomor'];
        $hak_akses = $_POST['hakakses'];
        
        // Mengupload gambar
        $gambar_name = $_FILES['foto']['name'];
        $gambar_tmp = $_FILES['foto']['tmp_name'];
        $gambar_destination = "C:/xampp/htdocs/peminjaman/public/admin/" . $gambar_name;
        
        // Mengecek apakah password ingin diupdate
        if (!empty($_POST['password'])) {
            $password = md5($_POST['password']);
            $updatePassword = true;
        } else {
            $updatePassword = false;
        }
        
        if (!empty($gambar_name)) {
            if (move_uploaded_file($gambar_tmp, $gambar_destination)) {
                // Query untuk mengupdate data admin dengan gambar baru
                if ($updatePassword) {
                    $query = $this->model('tb_admin')->update_password($username, $password, $nama_lengkap, $alamat, $nomor_hp, $hak_akses, $gambar_destination, $id_admin);
                } else {
                    $query = $this->model('tb_admin')->update_admin_gambar($username, $nama_lengkap, $alamat, $nomor_hp, $hak_akses, $gambar_destination, $id_admin);
                }
            } else {
                echo "Gagal mengupload gambar.";
            }
        } else {
            // Query untuk mengupdate data admin tanpa mengubah gambar
            if ($updatePassword) {
                $query = $this->model('tb_admin')->update_password($username, $password, $nama_lengkap, $alamat, $nomor_hp, $hak_akses, $gambar_destination, $id_admin);
            } else {
                $query = $this->model('tb_admin')->update_admin($username, $nama_lengkap, $alamat, $nomor_hp, $hak_akses, $id_admin);
            }
        }
        
        if ($query > 0) {
            echo '<script language="javascript" type="text/javascript">
              alert("Data admin berhasil diupdate!");</script>';
            echo "<meta http-equiv='refresh' content='0; url=".BASEURL."/admin/index'>";
        } else {
            echo "Error ";
        }
    }
}