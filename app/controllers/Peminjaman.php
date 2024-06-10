<?php
session_start();

class Peminjaman extends Controller{

    public function index(){
        $id = $_SESSION['id_admin'];
        $data ['admin'] = $this->model('tb_admin')->getDataAdmin($id);
        $data ['notifikasi'] = $this->model('tb_peminjaman')->getDataTerlambat();
        $data ['peminjaman'] = $this->model('tb_peminjaman')->getDataPeminjaman();
        $data ['anggota'] = $this->model('tb_anggota')->getDataAnggota();
        $data ['data_semua_buku'] = $this->model('tb_buku')->getSemuaBuku();
        $data ['semua_peminjaman'] = $this->model('tb_peminjaman')->getDataSemuaPeminjaman();
        $data ['status'] = $this->model('tb_peminjaman')->getStatus();
        $this->view('peminjaman/index', $data);
    }

    public function cetak_kwitansi($id){        
        //panggil data peminjaman dan data buku gabung jadi satu
        $data ['kwitansi'] = $this->model('tb_peminjaman')->getDataKwitansi($id);
        $this->view('peminjaman/cetak_kwitansi', $data);
    }

    public function tambah_peminjaman(){
        // Data peminjaman
        $agt_id = $_POST['anggota'];
        $buku_id = $_POST['buku'];
        $tgl_peminjaman = $_POST['tanggalp'];
        $nama_pinjam = $_POST['nama'];
        $tgl_pengembalian_r = $_POST['tanggalpr'];
        $tgl_pengembalian_a = $_POST['tanggalpa'];
        $jumlah_pinjam = $_POST['jumlah'];
        $catatan = $_POST['catatan'];
        
        // Proses penyimpanan data peminjaman
        $sql_peminjaman = $this->model('tb_peminjaman')->insert_data_peminjaman($agt_id, $buku_id, $tgl_peminjaman, $nama_pinjam, $tgl_pengembalian_r, $tgl_pengembalian_a, $jumlah_pinjam, $catatan);
        
        if ($sql_peminjaman > 0) {
            // Proses penyimpanan riwayat peminjaman
            $id_peminjaman = $this->model('tb_peminjaman')->get_id_terbaru(); // Mendapatkan ID peminjaman yang baru saja dimasukkan
            
            $sql_riwayat = $this->model('tb_riwayat_peminjaman')->insert_data_riwayat( $id_peminjaman, $agt_id, $buku_id, $tgl_peminjaman, $tgl_pengembalian_a);
            
            if ($sql_riwayat > 0) {
                // Update jumlah buku di tabel buku
                $sql_update_jumlah_buku = $this->model('tb_buku')->update_jumlah_buku($jumlah_pinjam, $buku_id);
                
                if ($sql_update_jumlah_buku > 0) {
                    echo '<script language="javascript" type="text/javascript">
                      alert("Data peminjaman berhasil disimpan.");</script>';
                    echo "<meta http-equiv='refresh' content='0; url=".BASEURL."/peminjaman/index'>";
                } else {
                    echo "Gagal mengupdate jumlah buku ";
                }
            } else {
                echo "Gagal menyimpan data riwayat peminjaman ";
            }
        } else {
            echo "Gagal menyimpan data peminjaman ";
        }

    }

    public function update_peminjaman(){
        // Mendapatkan data dari form
        $id_peminjaman = $_POST['idp'];
        $id_agt = $_POST['anggota'];
        $id_buku = $_POST['buku'];
        $tgl_peminjaman = $_POST['tanggalp'];
        $nama_pinjam = $_POST['nama'];
        $tgl_pengembalian_r = $_POST['tanggalpr'];
        $tgl_pengembalian_a = $_POST['tanggalpa'];
        $jumlah_pinjam = $_POST['jumlah'];
        $catatan = $_POST['catatan'];
        
        // Update tabel peminjaman
        $query_peminjaman = $this->model('tb_peminjaman')->update_peminjaman($id_agt, $id_buku, $tgl_peminjaman, $nama_pinjam, $tgl_pengembalian_r, $tgl_pengembalian_a, $jumlah_pinjam, $catatan, $id_peminjaman);
        
        if ($query_peminjaman == 0) {
            die("Gagal melakukan update pada tabel peminjaman ");
        }
        
        // Update tabel riwayat
        $query_riwayat = $this->model('tb_riwayat_peminjaman')->update_data_riwayat($id_agt, $id_buku, $tgl_peminjaman, $tgl_pengembalian_a, $id_peminjaman);
        
        if ($query_riwayat == 0) {
            die("Gagal melakukan update pada tabel riwayat ");
        }
        
        // Redirect ke halaman lain setelah berhasil melakukan update
        echo '<script language="javascript" type="text/javascript">
            alert("Data peminjaman berhasil diupdate.");</script>';
        echo "<meta http-equiv='refresh' content='0; url=".BASEURL."/peminjaman/index'>";
    }

    public function proses_jumlah(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Ambil data dari form
            $idp = $_POST['idpinjam'];
            $id_buku = $_POST['idbuku'];
            $jumlah_pinjam = $_POST['jumlah_pinjam'];
            $action = $_POST['action']; // 'kembalikan' atau 'tambah'
        
            if ($action === 'kembalikan') {
                // Proses pengurangan jumlah peminjaman
                $query = $this->model('tb_peminjaman')->proses_jumlah_kembalikan($jumlah_pinjam, $idp);
                // Proses pengembalian buku
                $sql = $this->model('tb_buku')->proses_jumlah_kembali($jumlah_pinjam, $id_buku);
            } elseif ($action === 'tambah') {
                // Proses penambahan jumlah Peminjaman
                $query = $this->model('tb_peminjaman')->proses_jumlah_penambahan($jumlah_pinjam, $idp);            
                // Proses pengurangan buku
                $sql = $this->model('tb_buku')->proses_jumlah_tambah($jumlah_pinjam, $id_buku);
            }
        
            if ($sql > 0) {
                echo '<script language="javascript" type="text/javascript">
                  alert("Data berhasil!");</script>';
                echo "<meta http-equiv='refresh' content='0; url=".BASEURL."/peminjaman/index'>";
            } else {
                echo "Error ";
            }
        }
    }

    public function update_status(){
        $idp = $_POST['idpin'];
        $idb = $_POST['idbuku'];
        $jumlah = $_POST['jumlah'];
        $status = $_POST['status'];
        
        if ($status == '1') {
            //proses update status
            $query = $this->model('tb_peminjaman')->update_status($status, $idp);
        }elseif ($status == '2') {
            //proses update status
            $query = $this->model('tb_peminjaman')->update_status($status, $idp);
        
            //proses update jumlah kembalikan buku
            $query = $this->model('tb_buku')->update_jumlah_buku_kembali($jumlah, $idb);
        }elseif ($status == '3') {
            //proses update status
            $query = $this->model('tb_peminjaman')->update_status($status, $idp);
        }
        
        echo '<script language="javascript" type="text/javascript">
               alert("Data berhasil!");</script>';
        echo "<meta http-equiv='refresh' content='0; url=".BASEURL."/peminjaman/index'>";
    }

}