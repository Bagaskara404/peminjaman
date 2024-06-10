<?php

class tb_peminjaman {
    private $table = 'tb_peminjaman';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getJumlahPeminjaman(){
        $this->db->query("SELECT COUNT(*) total FROM ".$this->table);
        $user = $this->db->single();
        return $user;
    }

    public function getDataTerlambat(){
        $tanggal_sekarang = date("Y-m-d"); // Tanggal sekarang
        $this->db->query("SELECT * FROM tb_peminjaman, tb_buku WHERE id_buku=buku_id AND tgl_pengembalian_a < '$tanggal_sekarang'");
        $user = $this->db->resultset();
        return $user;
    }

    public function getDataPeminjaman(){
        $this->db->query("SELECT * FROM tb_peminjaman,tb_anggota, tb_buku WHERE id_anggota=agt_id AND id_buku=buku_id ORDER BY id_peminjaman DESC");
        $data = $this->db->resultset();
        return $data;
    }

    public function getDataKwitansi($id){
        $this->db->query("SELECT * FROM tb_peminjaman, tb_anggota, tb_buku WHERE id_anggota=agt_id AND id_buku=buku_id AND id_peminjaman=$id");
        $data = $this->db->single();
        return $data;
    }

    public function getDataSemuaPeminjaman(){
        $this->db->query("SELECT * FROM ".$this->table);
        $data = $this->db->resultset();
        return $data;
    }

    public function insert_data_peminjaman($agt_id, $buku_id, $tgl_peminjaman, $nama_pinjam, $tgl_pengembalian_r, $tgl_pengembalian_a, $jumlah_pinjam, $catatan){
        $sql = "INSERT INTO ".$this->table." (agt_id, buku_id, tgl_peminjaman, nama_pinjam, tgl_pengembalian_r, tgl_pengembalian_a, status_peminjaman, jumlah_pinjam, catatan) VALUES ('$agt_id', '$buku_id', '$tgl_peminjaman', '$nama_pinjam', '$tgl_pengembalian_r', '$tgl_pengembalian_a', '1', '$jumlah_pinjam', '$catatan')";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function get_id_terbaru(){
        $this->db->query("SELECT MAX(id_peminjaman) AS max_id FROM ".$this->table);
        $result = $this->db->single();
        return $result['max_id'];
    }

    public function update_peminjaman($id_agt, $id_buku, $tgl_peminjaman, $nama_pinjam, $tgl_pengembalian_r, $tgl_pengembalian_a, $jumlah_pinjam, $catatan, $id_peminjaman){
        $sql = "UPDATE ".$this->table." SET agt_id = '$id_agt', buku_id = '$id_buku', tgl_peminjaman = '$tgl_peminjaman', nama_pinjam = '$nama_pinjam', tgl_pengembalian_r = '$tgl_pengembalian_r', tgl_pengembalian_a = '$tgl_pengembalian_a', jumlah_pinjam = '$jumlah_pinjam', catatan = '$catatan' WHERE id_peminjaman = '$id_peminjaman'";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function proses_jumlah_kembalikan($jumlah_pinjam, $idp){
        $sql = "UPDATE ".$this->table." SET jumlah_pinjam = jumlah_pinjam - $jumlah_pinjam WHERE id_peminjaman = $idp";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function proses_jumlah_penambahan($jumlah_pinjam, $idp){
        $sql = "UPDATE ".$this->table." SET jumlah_pinjam = jumlah_pinjam + $jumlah_pinjam WHERE id_peminjaman = $idp";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getStatus(){
        $this->db->query("SELECT * FROM ".$this->table.", tb_buku WHERE id_buku=buku_id");
        $data = $this->db->resultset();
        return $data;
    }

    public function update_status($status, $idp){
        $sql = "UPDATE ".$this->table." SET status_peminjaman = '$status' WHERE id_peminjaman = $idp";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getDataLaporan($tanggalp, $tanggalk, $status1){
        $sql = "SELECT * FROM ".$this->table.", tb_buku WHERE id_buku=buku_id AND tgl_peminjaman >= '$tanggalp' AND (tgl_pengembalian_r <= '$tanggalk' OR tgl_pengembalian_a <= '$tanggalk') AND status_peminjaman = '$status1'";
        $this->db->query($sql);
        $data = $this->db->resultset();
        return $data;
    }

    public function data_cetak($tanggalp, $tanggalk, $status){
        $sql = "SELECT * FROM ".$this->table.", tb_buku WHERE id_buku=buku_id AND tgl_peminjaman >= '$tanggalp' AND (tgl_pengembalian_r <= '$tanggalk' OR tgl_pengembalian_a <= '$tanggalk') AND status_peminjaman = '$status'";
        $this->db->query($sql);
        $data = $this->db->resultset();
        return $data;
    }

    public function data_cetak1($id, $tanggalp, $tanggalk, $status){
        $sql = "SELECT * FROM tb_peminjaman, tb_buku WHERE id_buku=buku_id AND tgl_peminjaman >= '$tanggalp' AND (tgl_pengembalian_r <= '$tanggalk' OR tgl_pengembalian_a <= '$tanggalk') AND status_peminjaman = '$status' AND id_peminjaman = '$id'";
        $this->db->query($sql);
        $data = $this->db->resultset();
        return $data;
    }
}