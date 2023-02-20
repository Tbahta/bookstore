<?php


class BookDetails extends Controller{

    function index($slug){
           // check if user is logged in
          
           
           $user = $this->loadModel('user');
           $user_info = $user->checkLogin();
           if(is_array($user_info)){
                $data['email'] = $user_info['email'];
                $data['name']=$user_info['name'];
                $data['role']=$user_info['role'];
                $data['userid']=$user_info['userid'];
                
            // show($data['user_email']);
            //show($user_info['role']);
              
           }
           
           $conn = Database::newInstance();
           $arr['slug']= $slug;
           $singlerow = $conn->read("SELECT *FROM book where slug =:slug",$arr);

           $catid = $singlerow[0]['category'];
           $cat['id'] = $catid;
                
           //get category name from id 
           $categoryname = $conn->read("SELECT categoryName FROM category where id = :id",$cat);

           $conn = Database::newInstance();
           $books = $conn->read("SELECT *FROM book limit 10");
          
          
          //passing data to views
          $data['book']    = $singlerow[0];
          $data['categoryName'] = $categoryname;    
          $data['BOOKS']     = $books;    

          $data["Page_title"] = "Book Details";
          $this->view("store/bookdetails",$data);
        
    }

   
}