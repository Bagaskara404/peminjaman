<?php
session_start();

class Buku extends Controller{

    public function index(){
        $id = $_SESSION['id_admin'];
        $data ['admin'] = $this->model('tb_admin')->getDataAdmin($id);
        $data ['notifikasi'] = $this->model('tb_peminjaman')->getDataTerlambat();
        $data ['buku'] = $this->model('tb_buku')->getDataBuku();
        $data ['kategori'] = $this->model('tb_kategori')->getDataKategori();
        $data ['data_semua_buku'] = $this->model('tb_buku')->getSemuaBuku();
        $this->view('buku/index', $data);
    }

    public function hapus_buku($id){
        // Periksa apakah parameter 'id' telah dikirim melalui URL
        if($id != null) {
            $sql = $this->model('tb_buku')->hapus_buku($id);
            
            // Periksa apakah penghapusan berhasil
            if ($sql > 0) {
                // Data berhasil dihapus
                echo '<script language="javascript" type="text/javascript">
                  alert("Data buku berhasil dihapus!");</script>';
                echo "<meta http-equiv='refresh' content='0; url=" . BASEURL . "/buku/index''>";
            } else {
                // Jika terjadi kesalahan dalam query
                echo "Error: ";
            }
        } else {
            echo "Error: Parameter 'id' tidak ditemukan dalam URL.";
        }
    }   

    public function tambah_buku(){
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["simpan"])) {
            $judul = $_POST['judul'];
            $pengarang = $_POST['pengarang'];
            $penerbit = $_POST['penerbit'];
            $tahun = $_POST['tahun'];
            $isbn = $_POST['isbn'];
            $jumbuku = $_POST['jumbuku'];
            $jumsalin = $_POST['jumsalin'];
            $kategori = $_POST['kategori'];
            $deskripsi = $_POST['deskripsi'];
            
            // Upload gambar
            $gambar = $_FILES["gambar"]["name"];
            $gambar_tmp = $_FILES["gambar"]["tmp_name"];
            $upload_folder = "C:/xampp/htdocs/peminjaman/public/buku/"; // Direktori penyimpanan gambar (sesuaikan sama punyamu)
            move_uploaded_file($gambar_tmp, $upload_folder . $gambar);
        
            // Query SQL untuk menyimpan data ke tabel item
            $sql = $this->model('tb_buku')->insert_buku($judul, $pengarang, $penerbit, $tahun, $isbn, $jumbuku, $jumsalin, $kategori, $deskripsi, $gambar);
            if ($sql > 0) {
                echo '<script language="javascript" type="text/javascript">
                  alert("Data buku berhasil disimpan.");</script>';
                echo "<meta http-equiv='refresh' content='0; url=" . BASEURL . "/buku/index''>";
            } else {
                echo "Error: ";
            }
        }
    }

    public function update_buku(){
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
            $id_buku = $_POST["id_buku"];
            $judul = $_POST['judul'];
            $pengarang = $_POST['pengarang'];
            $penerbit = $_POST['penerbit'];
            $tahun = $_POST['tahun'];
            $isbn = $_POST['isbn'];
            $jumbuku = $_POST['jumbuku'];
            $jumsalin = $_POST['jumsalin'];
            $kategori = $_POST['kategori'];
            $deskripsi = $_POST['deskripsi'];
        
            // Upload gambar jika ada perubahan gambar
            if ($_FILES["gambar"]["name"]) {
                $gambar = $_FILES["gambar"]["name"];
                $gambar_tmp = $_FILES["gambar"]["tmp_name"];
                $upload_folder = "C:/xampp/htdocs/peminjaman/public/buku/"; // Direktori penyimpanan gambar (Sesuaikan Sama Punyamu)
                move_uploaded_file($gambar_tmp, $upload_folder . $gambar);
                
                // Update data staff dengan gambar
                $sql = $this->model('tb_buku')->update_buku_gambar($id_buku, $judul, $pengarang, $penerbit, $tahun, $isbn, $jumbuku, $jumsalin, $kategori, $deskripsi, $gambar);
            } else {
                // Update data staff tanpa perubahan gambar
                $sql = $this->model('tb_buku')->update_buku($id_buku, $judul, $pengarang, $penerbit, $tahun, $isbn, $jumbuku, $jumsalin, $kategori, $deskripsi);
            }
        
            if ($sql > 0 ) {
                echo '<script language="javascript" type="text/javascript">
                  alert("Data buku berhasil diupdate.");</script>';
                echo "<meta http-equiv='refresh' content='0; url=buku.php'>";
            } else {
                echo "Error: ";
            }
        }
    }
}