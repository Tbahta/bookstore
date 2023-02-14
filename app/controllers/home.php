<?php

//this controller class calls the view method of the main "Controller" class to see if corresponding view exists 
class Home extends  Controller{

    //defualt method
    function index(){

         //check if search was made 
         $search = false;
         $find = '';
         if(isset($_GET['find'])){
             $find = addslashes($_GET['find']);
             $search = true;
         }
    
        $user = $this->loadModel('user');
        $user_info = $user->checkLogin();
        if(is_array($user_info)){
            $data['user_email'] =   $user_info['email'];
            $data['name']       =   $user_info['name'];
            $data['role']       =   $user_info['role'];
            $data['userid']     =   $user_info['userid'];
            
        //    display($data['user_email']);
        //    display($user_info['role']);
           
        }

        $conn =  Database::newInstance();
        $sql= "SELECT *FROM category order by id ";
        $categories = $conn->read($sql,[]);
        if(count($categories) !== 0){
            $data['categories'] = $categories;
            //display($data['categories']);
        }

        //read books to display in home

        $conn = Database::newInstance();
        if($search){
         
            $arr['slug'] = "%".$find."%"; 
            $query = "SELECT *FROM book WHERE slug like :slug";
            $BOOKS = $conn->read($query,$arr);
            $data['item_searched'] = true;
        }else{
            $BOOKS = $conn->read("SELECT *FROM book"); //limit stuff
        }

        $data['BOOKS'] = $BOOKS;   


       $data["Page_title"] = "Home";
       $data['search'] = true; //search box will show
       //load the home view - > index.php
        $this->view("store/index",$data);


      
    }

   
}