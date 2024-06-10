<?php
session_start();
class Register extends Controller{

    public function index (){
        $this->view('user_register/index');
    }
}