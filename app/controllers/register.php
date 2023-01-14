<?php

class Register extends Controller {

    public function index () {
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            // $user = $this->loadModel("User");
            // $user->signUp($_POST);
            display($_POST);
        }
        $this->view("store/register");

    }

}

?>