<?php

function display($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
   

}

//Function to validate user input
function validateInput($name, $email, $password,$password2,$phone,$address){
    $error = "";
    //email
    if(empty($email) || !preg_match("/^[a-zA-Z0-9_-]+@[a-zA-Z]+.[a-zA-Z]+$/",$email)){
            $error.= 'The email is not formatted properly';

        }
    //name
    if(empty($name) || !preg_match("/^[a-zA-Z\s]+$/",$name)){
            $error.= 'Name should only contain alphabets';
            
    }
    //Password 
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    // $specialChars = preg_match('@[^\w]@', $password);
    
    // if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
    if(!$uppercase || !$lowercase || !$number || strlen($password) < 6) {
        $error.= "Password doesn't meet the minimum requirements. ";
        }
    if($password !==$password2){
    $error.= 'Password mismatch ';
    }
    //phone [0-9]{3}-[0-9]{3}-[0-9]{4}
    // $valid = preg_match("/^[0-9]{10}+$/", $phone);
    // $valid = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
    if(!empty($phone) && !preg_match("/^[0-9]{10}+$/", $phone)){
    // if(!empty($phone) || !$valid){
        $error.= 'phone number should only contain numbers ';
        
    }
    // if(!empty($phone) && !preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phone)){
    //     $error.= 'phone number should only contain numbers ';
        
    // }
    $uppercase = preg_match('@[A-Z]@', $address);
    $lowercase = preg_match('@[a-z]@', $address);
    $number    = preg_match('@[0-9]@', $address);
    //address
    if(!empty($address) && !$uppercase && !$lowercase && !$number){
        $error.= 'Errors related the address field ';
    }


    return $error;
}

//check for a error in the $_SESSION array
function checkErrorMessage(){
    if(isset($_SESSION['error']) && $_SESSION['error'] !=""){
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
    if(isset($_SESSION['duplicateemail']) && $_SESSION['duplicateemail'] !=""){
        echo $_SESSION['duplicateemail'];
        unset($_SESSION['duplicateemail']);
    }
    if(isset($_SESSION['signin_error']) && $_SESSION['signin_error'] !=""){
        echo $_SESSION['signin_error'];
        unset($_SESSION['signin_error']);
    }
    
}

/**
 * function that upload product images 
 * @return array
 */
function uploadImages(){

    $size = 10;
    $size =($size *1024 *1024);
    $allowed[] = "image/jpeg";
    $allowed[] = "image/png";
    $arr = array();

    $dir = "uploads/";

    //if folder doesn't exist create it
    if(!file_exists($dir)){
      mkdir($dir,0777,true);
    }

  
  foreach($_FILES as $key => $img_row){
    if($img_row['error']=="" && in_array($img_row['type'], $allowed) ){
      if($img_row['size'] < $size){
        //upload image to folder
        $destination = $dir.$img_row['name'];
        move_uploaded_file($img_row['tmp_name'], $destination);
        $arr[$key] = $destination;
        // resize_image($destination,$destination,500,575);

      }else{
        $_SESSION['error'] .= $key ."is larger than max upload size (5 megabyte max)>";
      }

    }

   }
   return $arr;
}