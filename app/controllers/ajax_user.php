<?php

class Ajax_user extends Controller{

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
          $user = $this->loadModel('User');
  
          if($data->data_type == "add_new"){
             $user->create($data);
      
            if(isset($_SESSION['error']) && $_SESSION['error']!=""){
              
              $arr['message'] = $_SESSION['error'];
              $_SESSION['error']=""; //unset session error
              $arr['message_type'] = 'error';
              $arr['data'] = "";
              $arr['data_type'] = "add_new";

              echo json_encode($arr);
    
            }else{
              
              $arr['message'] = "user added successfully";
              $arr['message_type'] = 'info';
              $users = $user->getUsers();
              $arr['data'] = $user->make_table($users);
              $arr['data_type'] = "add_new";
      
              echo json_encode($arr);
            }
  
          }elseif($data->data_type == "delete_row"){
  
            $user->deleteUser($data->id);
            $arr['message'] = "Record deleted successfully!";
            $_SESSION['error']=""; //unset session error
            $arr['message_type'] = 'info';
            $arr['data_type'] = "delete_row";
            $users = $user->getUsers();
            $arr['data'] = $user->make_table($users);
            
   
             echo json_encode($arr);
  
         }elseif($data->data_type == "edit_row"){
  
            $user->editUser($data);
            $arr['message'] = "Record updated successfully!";
            $_SESSION['error']=""; //unset session error
            $arr['message_type'] = 'info';
            $arr['data_type'] = "edit_row";
            $users = $user->getUsers();
            $arr['data'] = $user->make_table($users);
            
    
            echo json_encode($arr);
  
       }
    
      }
    
    }

}

?>