<?php
/**
 * Undocumented class
 */
class User{

    public function signup($POST){

        //create instance to establish connection to the databse
       $instance = Database::db_connect();
   

       //Get POST data from user
       $name        = trim($POST['name']);
       $email       = trim($POST['email']);
       $password    = trim($POST['password']);
       $password2   = trim($POST['confirm-password']);
       $phone       = trim($POST['phone']);
       $address     = trim($POST['address']);
       //$checkagree  = $POST['termscheck'];

        
       //call validation function - from /core/functions.php
    //    $error = validateInput($name, $email, $password,$password2,$phone,$address);
    //    if($error==""){
    //        //if there is no validation error, prepare data to push it to the database;
    //        $hashedPass = hash('sha1',$password);
    //        $data['name']     = $name; 
    //        $data['email']    = $email; 
    //        $data['password'] = $hashedPass;
    //        $data['userid']   = $this->generate_random_userid(60);
    //        $data['phone']    = $phone;
    //        $data['address']  = $address;
           
    //        //fixed entries
    //        $data['date'] = date("Y-m-d H:i:s");
    //        $data['role'] = "customer";

    //         //Before pushing data to database, check if there is a user with the same email already in the database
    //         $query        = "SELECT email FROM user WHERE email = :email limit 1";
    //         $arr['email'] = $data['email'];
    //         $check        = $instance->read($query,$arr);
    //         if(is_array($check) && count($check)>0){
    //             $message ='<a href="'.ROOT.'signin">Login</a> instead';
    //             $_SESSION['duplicateemail'] = "User already exists, ".$message;
               
    //         }
            
    //         //One last check for userid before pushing data to database
    //         $arr           = []; //unset the array from previous value
    //         $sql           = "SELECT userid FROM user WHERE userid = :userid limit 1";
    //         $arr['userid'] = $data['userid'];
    //         $check         = $instance->read($sql,$arr);
    //         if(is_array($check)){
    //             //generate another random userid
    //             $data['userid']   = $this->generate_random_userid(60);
               
    //         }

    //         //Push data to database
    //        $query = "INSERT INTO user (userid,name,email,phone,password,role,address,date) VALUES( :userid, :name, :email, :phone, :password, :role, :address, :date)";
    //        $success = $instance->write($query,$data);
    //        if($success){
    //           //redirect and exit from here;
    //            header('location:'.ROOT.'signin?signup=success');
    //            die;
    //        }
 
    //    }else{
    //        $_SESSION['error']  = $error;
           
    //    }
     



    }

}