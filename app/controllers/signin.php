<?php



class Signin extends Controller{

    function index(){

        //you can do this if passing data to view
       $data["Page_title"] = "Signin";

        if($_SERVER['REQUEST_METHOD'] == "POST"){
           
            $user = $this->loadModel("User");
            // display($_POST);
            // die;
            $user->signin($_POST);
            
        }
   
        $this->view("store/signin",$data);
        
    }


}