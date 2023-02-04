<?php
class Admin extends Controller
{
    //defualt method - the feeds the home page
    public function index()
    {
        // check if user is logged in
        $user = $this->loadModel('user');
        $user_info = $user->checkLogin();
        if (is_array($user_info)) {
            $data['user_email']  = $user_info['email'];
            $data['name']        = $user_info['name'];
            $data['role']        = $user_info['role'];
            $data['userid']      = $user_info['userid'];
            $data['phone']       = $user_info['phone'];
            $data['address']     = $user_info['address'];
        }

         //check if a session for login is set and if it is set, and user is admin, get them to the dashboard
        //otherwise, get them to signin 
        
        if(isset($_SESSION['logged'])){

            if($_SESSION['logged']['role']=="admin"){
                $data["Page_title"] = "Admin";
                $this->view("admin/index",$data); 
                // $this->view("admin/admin",$data); 
            } else if($_SESSION['logged']['role']=="customer"){
                $data["Page_title"] = "Profile";
                $this->view("store/profile",$data); //will take non admin to 404 page
            }
            
        }else{
            //intentionally lead them to 404
            $data=[];
            $data["Page_title"] = "Page not found";
            $this->view("store/404",$data);
        }
    }
}