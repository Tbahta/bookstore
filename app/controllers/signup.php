<?php

class Signup extends Controller {

    public function index () {

        $data["Page_title"] = "Signup";
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $user = $this->loadModel("User");
            $user->signUp($_POST);
            // display($_POST);
        }
        $this->view("store/signup",$data);

    }

}

?>