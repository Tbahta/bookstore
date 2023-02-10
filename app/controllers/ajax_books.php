<?php

/**
 * This controller gets product  input data through ajax and enables the index method
 * to call all crud functions of the user model
 */
 
class Ajax_books extends  Controller{

    //defualt method
    function index(){

      // $data = file_get_contents("php://input");
      // $data = json_decode($data);  // this brings object
      // show($_POST);  //this is array
      // show($_FILES);
      // die;
      if(count($_POST) > 0){
        $data = (object)$_POST;
      }else{
        $data = file_get_contents("php://input");
      }

      //convert POST data to an object
      // $data = (object)$_POST;
    
      
      if(is_object($data) && isset($data->data_type)){
        

        //create instance of book Model to access methods like create, editProduct, deleteproduct etc ..
        $book = $this->loadModel('Book');
       

        if($data->data_type == "add_book"){
         
              
              //add new product  - $_FILES is always present by default
              // $check = $product->create($data, $_FILES);
              $book->create($data, $_FILES);
              
        
              if(isset($_SESSION['error']) && $_SESSION['error']!=""){
                
                $arr['message']       = $_SESSION['error'];
                $_SESSION['error']    = ""; //unset session error
                $arr['message_type']  = 'error';
                $arr['data']          = "";
                $arr['data_type']     = "add_book";
      
                echo json_encode($arr);
      
              }else{
                
                $arr['message']      = "Book added successfully";
                $arr['message_type'] = 'info';
                $arr['data_type']    = "add_book";
                
                $books               = $book->getBooks();
                $arr['data']         = $book->make_table($books);
                
                echo json_encode($arr);
              }

        }elseif($data->data_type == "delete_book"){
              
              $book->deleteBook($data->id);
              $arr['message']       =  "Record deleted successfully!";
              $_SESSION['error']    =  ""; 
              $arr['message_type']  =  'info';
              $arr['data_type']     =  "delete_book";
              
              $books                =  $book->getBooks();
              $arr['data']          =  $book->make_table($books);
            
              echo json_encode($arr);

       }elseif($data->data_type == "edit_book"){
        
            $book->editBook($data,$_FILES);
            $arr['message']       = "Record updated successfully!";
            $_SESSION['error']    = ""; //unset session error
            $arr['message_type']  = 'info';
            $arr['data_type']     = "edit_book";
           
            $books                = $book->getBooks();
            $arr['data']          = $book->make_table($books);

            echo json_encode($arr);

     }
  
    }

   


  } //Method index ends here


   
}