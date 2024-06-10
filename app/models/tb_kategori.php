<?php

class tb_kategori {
    private $table = 'tb_kategori';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getDataKategori(){
        $this->db->query("SELECT * FROM ".$this->table);
        $data = $this->db->resultset();
        return $data;
    }

    public function hapus_kategori($id){
        $sql = "DELETE FROM ".$this->table." WHERE id_kategori = $id";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function tambah_kategori($nama, $deskripsi){
        $sql = "INSERT INTO ".$this->table." (nama_kategori, deskripsi_kategori) VALUES ('$nama', '$deskripsi')";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function update_kategori($nama, $deskripsi, $id_kategori){
        $sql = "UPDATE ".$this->table." SET nama_kategori='$nama', deskripsi_kategori='$deskripsi' WHERE id_kategori=$id_kategori";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->rowCount();
    }
}