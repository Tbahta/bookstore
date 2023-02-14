<?php
/**
 * Undocumented class
 */
class Author{
    
   
    public function create($data){

       $_SESSION['error']= "";
       $conn             = Database::db_connect();
       $authordata       = [];
       $authordata['name']   = $data->name;
       $authordata['email']  = $data->email;

       if(!preg_match("/^[a-zA-Z ]+$/",trim($authordata['name']))){
           $_SESSION['error'] = "Please enter valid author name0";

       }
       if(!preg_match("/^[a-zA-Z0-9_-]+.+@[a-zA-Z]+.[a-zA-Z]+$/",$authordata['email'])){
        $_SESSION['error'] = "Please enter valid email";

        }

       if (!isset($_SESSION['error']) || $_SESSION['error']=="") {

            //check if the author already exists
           $sql = "SELECT email FROM author where email = :email";
           $arr['email'] = $authordata['email'];
           $check1 = $conn->read($sql,$arr);
    
           if (is_array($check1) && count($check1) >=1) {
               $_SESSION['error']="ERROR: Duplicate Record";
               return false;
           } 

            //if it gets in here, no duplicate record found
            $query = "INSERT INTO author (name,email) VALUES (:name,:email)";
            $check = $conn->write($query,$authordata);
            if ($check) {
                return true;
            }
            $_SESSION['error'] = "Problem writing data to database";
          
       }


    }

    public function editAuthor($data){
        
      $conn                =  Database::newInstance();
      $arr                 = [];
      $id                  = (int)$data->id;
      $arr['name']        = $data->name;
      $arr['email']        = $data->email;
      $arr['id']           = $id;
    
      $query = "UPDATE author SET name = :name,email =:email WHERE id = :id limit 1 ";
      $conn->write($query,$arr); 

        
    }

    // Function to delete author
    
    public function deleteAuthor($id){
      $conn =  Database::newInstance();
      $id = (int)$id;
      $query = "DELETE FROM author WHERE id ='$id' limit 1 ";
      $conn->write($query); 
        
    }

    public function getAuthors(){
        $conn =  Database::newInstance();
       
        return $conn->read("SELECT *FROM author order by name asc");        
    }

    
    function make_table($authors){
      print_r($authors);
        $result="";

        if(is_array($authors)){
          foreach ($authors as $author) {
            $args = $author["id"];
            $author = (object) $author;
            // $args = $author->name. ",'". $author->email."'";
            // $args = $author->id. ",'".$author->name. ",'". $author->email."'";
            $info = array();
            $info['id'] = $author->id;
            $info['name'] = $author->name;
            $info['email'] = $author->email;

             //conver json to string
             $info = json_encode($info);
             $info =  str_replace('"',"'",json_encode($info));

            $result .= "<tr>";
         
              $result.='                    
                   <td  class="text-dark">'.$author->id.'</td>
                   <td class="text-dark">'.$author->name .'</td>
                   <td  class="text-dark">'.$author->email .'</td>
                  
                   <td>
                       <button info = "'.$info.'" class="btn btn-primary btn-xs"  data-toggle="modal" data-target="#editAuthorModal" onclick="edit_record('.$args.', event)"><i class="fa fa-pencil"></i></button>
                       <button class="btn btn-danger btn-xs"  onclick="delete_record(event,'.$author->id.')"><i class="fa fa-trash-o "></i></button>
                   </td>';
         
            $result.= "</tr>";
  
          }
    
  
        }
        return $result;
  
      }

      // <td><span onclick="disable_record('.$args.')" class ="label label-info label-mini text-secondary p-2 rounded" style="cursor:pointer; background-color:'.$color.'">'.$cat_row->status.'</span></td>

} //end of class

