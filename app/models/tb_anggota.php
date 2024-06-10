<?php

class tb_anggota {
    private $table = 'tb_anggota';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getJumlahAnggota(){
        $this->db->query("SELECT COUNT(*) total FROM ".$this->table);
        $user = $this->db->single();
        return $user;
    }

    public function getDataAnggota(){
        $this->db->query("SELECT * FROM ".$this->table);
        $data = $this->db->resultset();
        return $data;
    }

    public function hapus_anggota($id){
        $this->db->query("DELETE FROM ".$this->table." WHERE id_anggota = ".$id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function insert_anggota($nama_anggota, $nis_anggota, $nomor_hp_anggota, $alamat_anggota, $email_anggota, $tanggal_bergabung){
        $sql = "INSERT INTO ".$this->table." (nama_anggota, nis, alamat, nomor_hp, email, tgl_bergabung) VALUES ('$nama_anggota', '$nis_anggota', '$alamat_anggota', '$nomor_hp_anggota', '$email_anggota', '$tanggal_bergabung')";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function update_anggota($id_anggota,$nama_anggota, $nis_anggota, $nomor_hp_anggota, $alamat_anggota, $email_anggota, $tanggal_bergabung){
        $sql = "UPDATE ".$this->table." SET nama_anggota='$nama_anggota', nis='$nis_anggota', alamat='$alamat_anggota', nomor_hp='$nomor_hp_anggota', email='$email_anggota', tgl_bergabung='$tanggal_bergabung' WHERE id_anggota=$id_anggota";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->rowCount();
    }
}