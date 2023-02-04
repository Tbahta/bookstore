<?php


class Profile extends Controller{

     function index(){
           // check if user is logged in
           $user = $this->loadModel('user');
           $user_info = $user->checkLogin(true);
           if(is_array($user_info)){
                //collect user data to pass to profile view
                $data['user_email']  = $user_info['email'];
                $data['name']        = $user_info['name'];
                $data['role']        = $user_info['role'];
                $data['userid']      = $user_info['userid'];
                $data['phone']       = $user_info['phone'];
                $data['address']     = $user_info['address'];
                
           }

        //you can do this if passing data to view
      
        // $this->view("store/profile",$data);


        if(isset($_SESSION['logged'])){
            $data["Page_title"] = "Profile";
            if($_SESSION['logged']['role']=="customer"){
                $this->view("store/profile",$data);
            } else if($_SESSION['logged']['role']=="admin"){
                $this->view("admin/index",$data);
            }
            
        }else{
            $data=[];
            $data["Page_title"] = "Home Page";
            $this->view("store/index",$data);
            // die;
        }
        
    }

    function deleteAccount(){

        $user = $this->loadModel('user');
        $user_info = $user->checkLogin();
        if(is_array($user_info)){
                //collect user data to pass to profile view
             $data['user_email']  = $user_info['email'];
             $data['name']        = $user_info['name'];
             $data['role']        = $user_info['role'];
             $data['userid']      = $user_info['userid'];
             $data['phone']       = $user_info['phone'];
             $data['address']     = $user_info['address'];
              
        }

        $data["Page_title"] = "Profile";
        // $this->view("store/profile",$data);


        if(isset($_SESSION['logged'])){

            if($_SESSION['logged']['role']=="customer"){

               $user->deleteProfile($data['user_email']);
                    
            }
            
        }

    }




}