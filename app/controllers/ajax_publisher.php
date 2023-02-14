<?php

class Ajax_publisher extends Controller{

     /**
     *  defualt method - gets the categories from the input fields and passes them to a proper model
     * to execute the required operation (create, delete, edit )
     */

    public function index () {
       
        $data = file_get_contents("php://input");
        $data = json_decode($data); 
        // print_r($data);

        if(is_object($data) && isset($data->data_type)){
  
          //create instance of Category Model to access methods like create, editCategory, deleteCategory etc ..
          $publisher = $this->loadModel('Publisher');
  
          if($data->data_type == "add_new"){
             $publisher->create($data);
      
            if(isset($_SESSION['error']) && $_SESSION['error']!=""){
              
              $arr['message'] = $_SESSION['error'];
              $_SESSION['error']=""; //unset session error
              $arr['message_type'] = 'error';
              $arr['data'] = "";
              $arr['data_type'] = "add_new";

              echo json_encode($arr);
    
            }else{
              
              $arr['message'] = "Publisher added successfully";
              $arr['message_type'] = 'info';
              $publishers = $publisher->getPublishers();
              $arr['data'] = $publisher->make_table($publishers);
              $arr['data_type'] = "add_new";
      
              echo json_encode($arr);
            }
  
          }elseif($data->data_type == "delete_row"){
  
            $publisher->deletePublisher($data->id);
            $arr['message'] = "Record deleted successfully!";
            $_SESSION['error']=""; //unset session error
            $arr['message_type'] = 'info';
            $arr['data_type'] = "delete_row";
            $publishers = $publisher->getPublishers();
            $arr['data'] = $publisher->make_table($publishers);
            
   
             echo json_encode($arr);
  
         }elseif($data->data_type == "edit_row"){
  
            $publisher->editPublisher($data);
            $arr['message'] = "Record updated successfully!";
            $_SESSION['error']=""; //unset session error
            $arr['message_type'] = 'info';
            $arr['data_type'] = "edit_row";
            $publishers = $publisher->getPublishers();
            $arr['data'] = $publisher->make_table($publishers);
            
    
            echo json_encode($arr);
  
       }
    
      }
    
    }

}

?>