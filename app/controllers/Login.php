<?php
session_start();
class Login extends Controller {

    public function index(){
        $this->view('user_beranda/index');
    }

    public function auth(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = md5($_POST["password"]); // Menggunakan MD5 untuk hash password
        
            $result = $this->model("tb_admin")->login($username, $password);

            if ($result != null) {
                $_SESSION['login_type'] = "login";
                $_SESSION["id_admin"] = $result["id_admin"];
                $_SESSION["nama_admin"] = $result["nama_lengkap"];
                $_SESSION["hak_akses"] = $result["hak_akses"];
        
                echo '<script language="javascript" type="text/javascript">
                    alert("Selamat Datang '.$_SESSION["nama_admin"].', Anda Berhasil Login!");</script>';
                echo "<meta http-equiv='refresh' content='0; url=" . BASEURL . "/home'>";
                 // Redirect ke halaman dashboard atau halaman lain sesuai kebutuhan
                exit();
            } else {
                echo '<script language="javascript" type="text/javascript">
                    alert("Maaf Username dan Password Salah.!");</script>';
                echo "<meta http-equiv='refresh' content='0; url=" . BASEURL . "/login'>";
            }
        }
    }

    public function keluar(){
        session_start();
        session_destroy(); // Menghapus semua data sesi
        
        header("Location:".BASEURL."/login"); // Redirect kembali ke halaman login setelah logout
        exit();
    }

    public function atur_ulang_password(){
        $this->view('login/lupa_password');
    }

    public function lupa_password(){
        $username = $_POST['username'];
        $password = md5($_POST['password']); // Gunakan md5 untuk mengenkripsi password
        
        // Cek apakah username ada dalam database
        $query = $this->model('tb_admin')->cek_admin($username);
        
        if (!empty($query)) {
            // Update password
            $updateQuery = $this->model('tb_admin')->reset_password($password, $username);
            if ($updateQuery > 0) {
                echo '<script language="javascript" type="text/javascript">
                    alert("Password berhasil direset. Silakan login kembali.");</script>';
                echo "<meta http-equiv='refresh' content='0; url=".BASEURL."/home/index'>";
            } else {
                echo "Error";
            }
        } else {
            echo "Username tidak ditemukan.";
        }
    }
}