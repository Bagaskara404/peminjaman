<?php

class tb_admin {
    private $table = 'tb_admin';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function login($username, $password) 
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE username ='".$username."'");
        $user = $this->db->single();
        if ($user && ($password == $user['password'])) {
            return $user;
        }
        return false;
    }
    
    public function getDataAdmin($id){
        $this->db->query("SELECT * FROM ".$this->table." WHERE id_admin=".$id."");
        $user = $this->db->single();
        return $user;
    }

    public function getJumlahAdmin(){
        $this->db->query("SELECT COUNT(*) total FROM ".$this->table);
        $user = $this->db->single();
        return $user;
    }

    public function getDataSemuaAdmin(){
        $this->db->query("SELECT * FROM ".$this->table);
        $data = $this->db->resultset();
        return $data;
    }

    public function hapus_admin($id_admin){
        $sql = "DELETE FROM ".$this->table." WHERE id_admin = $id_admin";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function insert_data_admin($username, $password, $nama_lengkap, $alamat, $nomor_hp, $hak_akses, $gambar_destination){
        $sql = "INSERT INTO ".$this->table." (username, password, nama_lengkap, alamat, nomor_hp, hak_akses, foto) VALUES ('$username', '$password', '$nama_lengkap', '$alamat', '$nomor_hp', '$hak_akses', '$gambar_destination')";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function update_password($username, $password, $nama_lengkap, $alamat, $nomor_hp, $hak_akses, $gambar_destination, $id_admin){
        $sql = "UPDATE ".$this->table." SET username='$username', password='$password', nama_lengkap='$nama_lengkap', alamat='$alamat', nomor_hp='$nomor_hp', hak_akses='$hak_akses', foto='$gambar_destination' WHERE id_admin=$id_admin";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function update_admin_gambar($username, $nama_lengkap, $alamat, $nomor_hp, $hak_akses, $gambar_destination, $id_admin){
        $sql = "UPDATE ".$this->table." SET username='$username', nama_lengkap='$nama_lengkap', alamat='$alamat', nomor_hp='$nomor_hp', hak_akses='$hak_akses', foto='$gambar_destination' WHERE id_admin=$id_admin";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function update_admin($username, $nama_lengkap, $alamat, $nomor_hp, $hak_akses, $id_admin){
        $sql = "UPDATE ".$this->table." SET username='$username', nama_lengkap='$nama_lengkap', alamat='$alamat', nomor_hp='$nomor_hp', hak_akses='$hak_akses' WHERE id_admin=$id_admin";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function cek_admin($username){
        $this->db->query("SELECT * FROM ".$this->table." WHERE username = '$username'");
        $data = $this->db->single();
        return $data;
    }

    public function reset_password($password, $username){
        $sql = "UPDATE ".$this->table." SET password = '$password' WHERE username = '$username'";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->rowCount();
    }
}