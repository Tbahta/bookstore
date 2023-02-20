<?php

class Ajax_author extends Controller{


    public function index () {
       
        $data = file_get_contents("php://input");
        $data = json_decode($data); 
    

        if(is_object($data) && isset($data->data_type)){
  
          //create instance of Category Model to access methods like create, editCategory, deleteCategory etc ..
          $author = $this->loadModel('Author');
  
          if($data->data_type == "add_new"){
             $author->create($data);
      
            if(isset($_SESSION['error']) && $_SESSION['error']!=""){
              
              $arr['message'] = $_SESSION['error'];
              $_SESSION['error']=""; //unset session error
              $arr['message_type'] = 'error';
              $arr['data'] = "";
              $arr['data_type'] = "add_new";

              echo json_encode($arr);
    
            }else{
              
              $arr['message'] = "Author added successfully";
              $arr['message_type'] = 'info';
              $authors = $author->getAuthors();
              $arr['data'] = $author->make_table($authors);
              $arr['data_type'] = "add_new";
      
              echo json_encode($arr);
            }
  
          }elseif($data->data_type == "delete_row"){
  
            $author->deleteAuthor($data->id);
            $arr['message'] = "Record deleted successfully!";
            $_SESSION['error']=""; //unset session error
            $arr['message_type'] = 'info';
            $arr['data_type'] = "delete_row";
            $authors = $author->getAuthors();
            $arr['data'] = $author->make_table($authors);
            
   
             echo json_encode($arr);
  
         }elseif($data->data_type == "edit_row"){
  
            $author->editAuthor($data);
            $arr['message'] = "Record updated successfully!";
            $_SESSION['error']=""; //unset session error
            $arr['message_type'] = 'info';
            $arr['data_type'] = "edit_row";
            $authors = $author->getAuthors();
            $arr['data'] = $author->make_table($authors);
            
    
            echo json_encode($arr);
  
       }
    
      }
    
    }

}

?>