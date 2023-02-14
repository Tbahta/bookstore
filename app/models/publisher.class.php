<?php
/**
 * Undocumented class
 */
class Publisher{
    
   
    public function create($data){

       $_SESSION['error']= "";
       $conn             = Database::db_connect();
       $pubdata       = [];
       $pubdata['publisherName']   = $data->publisherName;

       if(!preg_match("/^[a-zA-Z ]+$/",trim($pubdata['publisherName']))){
           $_SESSION['error'] = "Please enter valid publisher name";

       }

       if (!isset($_SESSION['error']) || $_SESSION['error']=="") {

            //check if the Publisher already exists
           $sql = "SELECT publisherName FROM publisher where publisherName = :publisherName";
           $arr['publisherName'] = $pubdata['publisherName'];
           $check1 = $conn->read($sql,$arr);
           if (is_array($check1) && count($check1) >=1) {
               $_SESSION['error']="ERROR: Duplicate Record";
               return false;
           } 

            //if it gets in here, no duplicate record found
            $query = "INSERT INTO publisher (publisherName) VALUES (:publisherName)";
            $check = $conn->write($query,$pubdata);
            if ($check) {
                return true;
            }
            $_SESSION['error'] = "Problem writing data to database";
          
       }


    }
 // Function to update Publisher
    public function editPublisher($data){
        
      $conn                =  Database::newInstance();
      $arr                 = [];
      $id                  = (int)$data->id;
      $arr['id']           = $id;
      $arr['publisherName']= $data->publisherName;
         
      $query = "UPDATE publisher SET publisherName = :publisherName WHERE id = :id limit 1 ";
      $conn->write($query,$arr); 
        
    }

    // Function to delete Publisher
    
    public function deletePublisher($id){
      $conn =  Database::newInstance();
      $id = (int)$id;
      $query = "DELETE FROM publisher WHERE id ='$id' limit 1 ";
      $conn->write($query); 
        
    }

    public function getPublishers(){
        $conn =  Database::newInstance();
       
        return $conn->read("SELECT *FROM publisher order by publisherName asc");        
    }

    
    function make_table($publishers){
        $result="";

        if(is_array($publishers)){
          foreach ($publishers as $publisher) {
            $args = $publisher["id"];
            $publisher = (object) $publisher;
    
            // $args = $publisher->id. ",'".$publisher->publisherName. "'";
            $info = array();
            $info['id'] = $publisher->id;
            $info['publisherName'] = $publisher->publisherName;

             //conver json to string
             $info = json_encode($info);
             $info =  str_replace('"',"'",json_encode($info));

            $result .= "<tr>";
         
              $result.='                    
                   <td  class="text-dark">'.$publisher->id.'</td>
                   <td class="text-dark">'.$publisher->publisherName .'</td>
                  
                   <td>
                       <button info = "'.$info.'" class="btn btn-primary btn-xs"  data-toggle="modal" data-target="#editPublisherModal" onclick="edit_record('.$args.', event)"><i class="fa fa-pencil"></i></button>
                       <button class="btn btn-danger btn-xs"  onclick="delete_record(event,'.$publisher->id.')"><i class="fa fa-trash-o "></i></button>
                   </td>';
         
            $result.= "</tr>";
  
          }
    
  
        }
        return $result;
  
      }

      // <td><span onclick="disable_record('.$args.')" class ="label label-info label-mini text-secondary p-2 rounded" style="cursor:pointer; background-color:'.$color.'">'.$cat_row->status.'</span></td>

} //end of class

