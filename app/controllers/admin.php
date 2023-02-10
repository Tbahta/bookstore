<?php
class Admin extends Controller
{
    //defualt method - the feeds the home page
    public function index()
    {
        // check if user is logged in
        $user = $this->loadModel('user');
        $user_info = $user->checkLogin(true);
        if (is_array($user_info)) {
            $data['email']  = $user_info['email'];
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
                // $this->view("admin/index",$data); 
                $this->view("admin/admin",$data); 
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

     /**
      * categories is admin facing method, checks if user is logged in and loads the categories
      * if user has the required level of access
      */
      function categories(){
      
        $user = $this->loadModel('user');
        $user_info = $user->checkLogin();
        if(is_array($user_info)){
            $data['email']    = $user_info['email'];
            $data['name']     = $user_info['name'];
            $data['role']     = $user_info['role'];
            $data['userid']   = $user_info['userid'];
            $data['phone']    = $user_info['phone'];
            $data['address']  = $user_info['address'];
    
        }
      
      
        //get table displayed in the categories area
        $conn =  Database::newInstance();
        $sql= "SELECT *FROM category order by id ";
        $categories = $conn->read($sql,[]); 
        
        $category = $this->loadModel('Category');
        $tbl_rows = $category->make_table($categories);
        $data["tbl_rows"] = $tbl_rows;
        // print_r($tbl_rows);
        $data["categories"] = $categories;
        if(is_array($categories)){
             $data["tbl_rows"] = $tbl_rows;
             $data["categories"] = $categories;
            
        }


        $data["Page_title"] = "Categories";
        //check loggin and credential status
        if(isset($_SESSION['logged'])){

            if($_SESSION['logged']['role']=="admin"){
                $this->view("admin/categories",$data);
            } else if($_SESSION['logged']['role']=="customer"){
                $this->view("store/index",$data); //will take non admin to 404 page
            }
            
        }else{
            //intentionally lead them to 404
            $this->view("store/404",$data);
        }
       
  
    }


     /**
      * books is admin facing method, checks if user is logged in and loads the books
      * if user has the required level of access
      */
      function books(){
      
        // check if user is logged in
        $user = $this->loadModel('User');
        $user_info = $user->checkLogin();
        if(is_array($user_info)){
            $data['email']    = $user_info['email'];
            $data['name']     = $user_info['name'];
            $data['role']     = $user_info['role'];
            $data['userid']   = $user_info['userid'];
            $data['phone']    = $user_info['phone'];
            $data['address']  = $user_info['address'];

        }
   
       
        $conn =  Database::newInstance();
        $sql= "SELECT *FROM book order by title";
        $books = $conn->read($sql,[]); 
      
        // get categories to feed the combobox in book modal
        $query= "SELECT *FROM category order by categoryName";
        $categories = $conn->read($query,[]); 
        $data["categories"] = $categories;


        //get authors to feed the combobox in book modal
        $query= "SELECT *FROM author order by authorName";
        $authors = $conn->read($query,[]); 
        $data["authors"] = $authors;



       //get publishers to feed the combobox in book modal
        $query= "SELECT *FROM publisher order by publisherName";
        $publishers = $conn->read($query,[]); 
        $data["publishers"] = $publishers;
             



        $book = $this->loadModel('Book');
        $tbl_rows = $book->make_table($books);
        $data["tbl_rows"] = $tbl_rows;
        $data["books"] = $books;
        // print_r($tbl_rows);
        if(is_array($books)){
            $data["tbl_rows"] = $tbl_rows;
            $data["books"] = $books;
           
       }


        $data["Page_title"] = "Books";
        if(isset($_SESSION['logged'])){

            if($_SESSION['logged']['role']=="admin"){
                $this->view("admin/books",$data);
            } 
            // else if($_SESSION['logged']['role']=="customer"){
            //     $this->view("admin/home",$data); //will take non admin to 404 page
            // }
            
        }else{
            //intentionally lead them to 404
            $this->view("store/404",$data);
        }
       
  
    }




    function authors(){
      
        $user = $this->loadModel('user');
        $user_info = $user->checkLogin();
        if(is_array($user_info)){
            $data['email']    = $user_info['email'];
            $data['name']     = $user_info['name'];
            $data['role']     = $user_info['role'];
            $data['userid']   = $user_info['userid'];
            $data['phone']    = $user_info['phone'];
            $data['address']  = $user_info['address'];
    
        }
      
      
        //get table displayed in the authors area
        $conn =  Database::newInstance();
        $sql= "SELECT *FROM author order by id ";
        $authors = $conn->read($sql,[]); 
        
        $author = $this->loadModel('Author');
        $tbl_rows = $author->make_table($authors);
        $data["tbl_rows"] = $tbl_rows;
        // print_r($tbl_rows);
        $data["authors"] = $authors;
        if(is_array($authors)){
             $data["tbl_rows"] = $tbl_rows;
             $data["authors"] = $authors;
            
        }


        $data["Page_title"] = "Authors";
        //check loggin and credential status
        if(isset($_SESSION['logged'])){

            if($_SESSION['logged']['role']=="admin"){
                $this->view("admin/authors",$data);
            } else if($_SESSION['logged']['role']=="customer"){
                $this->view("store/index",$data); //will take non admin to 404 page
            }
            
        }else{
            //intentionally lead them to 404
            $this->view("store/404",$data);
        }
       
  
    }
    
}