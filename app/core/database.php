<?php

class Database{
    

    public static $conn;
    
    public function __construct()
    {
        try{
            $dsn = DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME;
            self::$conn = new PDO($dsn,DB_USER,DB_PASS);
        }catch(PDOException $th){
            die($th->getMessage());
        }
  
    }

    public static function db_connect(){
        if(self::$conn){
           return self::$conn;
        }
        // $instance = new self();
        return $instance = new self();
    }

    //to avoid calling the same instance 
    public static function newInstance(){
      
       // $instance = new self();
        return $instance = new self();
    }

    // function that reads data from database
     public function read($query, $data = []){
        
        $stmt = self::$conn->prepare($query);
        $result = $stmt->execute($data);
     
        if($result){
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(is_array($data) && count($data) > 0){
             
                return $data;
            }
        }
        return false;

    } 


    // function to write data into the database
     public function write($query, $data = []){
       
        $stmt = self::$conn->prepare($query);
        $result = $stmt->execute($data);
       
        if($result){
        
          return true;
            
        }
        return false;
    
    } 
  
}



