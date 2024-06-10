<?php

session_start();

class Lockscreen extends Controller{
    public function index(){
        $id = $_SESSION['id_admin'];
        $data ['admin'] = $this->model('tb_admin')->getDataAdmin($id);
        $this->view('lockscreen/index', $data);
    }

    public function proses_lockscreen(){
        if (!isset($_POST['password'])) {
            // Password not provided, redirect back to lockscreen.php
            header("Location: ".BASEURL."lockscreen/index");
            exit(); // Stop further execution of the script
        }
        
        // Ambil kata sandi yang dimasukkan dari form
        $password = $_POST['password'];
        
        // Query database untuk memeriksa kata sandi
        $query = $this->model('tb_lockscreen')->getPassword($password);
        
        // Periksa apakah kata sandi cocok
        if (!empty ($query)) {
            $_SESSION['login_type'] = true; // Pengguna sudah login
            // Kata sandi benar, arahkan pengguna ke halaman "index.php"
            header("Location: ".BASEURL."/home/index");
        } else {
            // Kata sandi salah, arahkan pengguna kembali ke halaman lock screen
            header("Location: ".BASEURL."/lockscreen/index");
        }
    }
}