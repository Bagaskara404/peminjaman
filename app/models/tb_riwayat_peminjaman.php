<?php

class tb_riwayat_peminjaman {
    private $table = 'tb_riwayat_peminjaman';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function insert_data_riwayat( $id_peminjaman, $agt_id, $buku_id, $tgl_peminjaman, $tgl_pengembalian_a){
        $sql = "INSERT INTO ".$this->table." (id_pinjam, id_agt, id_bku, tgl_peminjaman, tgl_pengembalian) VALUES ('$id_peminjaman', '$agt_id', '$buku_id', '$tgl_peminjaman', '$tgl_pengembalian_a')";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function update_data_riwayat($id_agt, $id_buku, $tgl_peminjaman, $tgl_pengembalian_a, $id_peminjaman){
        $sql = "UPDATE tb_riwayat_peminjaman SET id_agt = '$id_agt', id_bku = '$id_buku', tgl_peminjaman = '$tgl_peminjaman', tgl_pengembalian = '$tgl_pengembalian_a' WHERE id_pinjam = '$id_peminjaman'";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getDataRiwayat(){
        $this->db->query("SELECT * FROM ".$this->table.", tb_anggota, tb_buku WHERE id_anggota=id_agt AND id_buku=id_bku");
        $data = $this->db->resultset();
        return $data;
    }
}