<?php

class tb_lockscreen {
    private $table = 'lockscreen';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getPassword($password){
        $sql = "SELECT * FROM ".$this->table." WHERE password = '$password'";
        $this->db->query($sql);
        $data = $this->db->single();
        return $data;
    }
}