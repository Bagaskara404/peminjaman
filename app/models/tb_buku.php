<?php

class tb_buku {
    private $table = 'tb_buku';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getJumlahBuku(){
        $this->db->query("SELECT COUNT(*) total FROM ".$this->table);
        $user = $this->db->single();
        return $user;
    }

    public function getDataBuku(){
        $this->db->query("SELECT * FROM tb_buku, tb_kategori WHERE id_kategori=kategori_buku");
        $data = $this->db->resultset();
        return $data;
    }

    public function getSemuaBuku(){
        $this->db->query('SELECT * FROM '.$this->table);
        $data = $this->db->resultset();
        return $data;
    }

    public function hapus_buku($id){
        $this->db->query("DELETE FROM ".$this->table." WHERE id_buku = ".$id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function insert_buku($judul, $pengarang, $penerbit, $tahun, $isbn, $jumbuku, $jumsalin, $kategori, $deskripsi, $gambar){
        $sql = "INSERT INTO ".$this->table." (judul_buku, pengarang, penerbit, tahun_terbit, isbn, jumlah_buku, jumlah_salinan, kategori_buku, deskripsi_buku, gambar_sampul) VALUES ('$judul', '$pengarang', '$penerbit', '$tahun', '$isbn', '$jumbuku', '$jumsalin', '$kategori', '$deskripsi', '$gambar')";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function update_buku_gambar($judul, $pengarang, $penerbit, $tahun, $isbn, $jumbuku, $jumsalin, $kategori, $deskripsi, $gambar, $id_buku){
        $sql = "UPDATE ".$this->table." SET judul_buku='$judul', pengarang='$pengarang', penerbit='$penerbit', tahun_terbit='$tahun', isbn='$isbn', jumlah_buku='$jumbuku', jumlah_salinan='$jumsalin', kategori_buku='$kategori', deskripsi_buku='$deskripsi', gambar_sampul='$gambar' WHERE id_buku=$id_buku";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function update_buku($judul, $pengarang, $penerbit, $tahun, $isbn, $jumbuku, $jumsalin, $kategori, $deskripsi, $id_buku){
        $sql = "UPDATE ".$this->table." SET judul_buku='$judul', pengarang='$pengarang', penerbit='$penerbit', tahun_terbit='$tahun', isbn='$isbn', jumlah_buku='$jumbuku', jumlah_salinan='$jumsalin', kategori_buku='$kategori', deskripsi_buku='$deskripsi' WHERE id_buku=$id_buku";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function update_jumlah_buku($jumlah_pinjam, $buku_id){
        $sql = "UPDATE tb_buku SET jumlah_buku = jumlah_buku - $jumlah_pinjam WHERE id_buku = $buku_id";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function proses_jumlah_kembali($jumlah_pinjam, $id_buku){
        $sql = "UPDATE ".$this->table." SET jumlah_buku = jumlah_buku + $jumlah_pinjam WHERE id_buku = $id_buku";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function proses_jumlah_tambah($jumlah_pinjam, $id_buku){
        $sql = "UPDATE ".$this->table." SET jumlah_buku = jumlah_buku - $jumlah_pinjam WHERE id_buku = $id_buku";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function update_jumlah_buku_kembali($jumlah, $idb){
        $sql = "UPDATE ".$this->table." SET jumlah_buku = jumlah_buku + $jumlah WHERE id_buku = $idb";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->rowCount();
    }
}