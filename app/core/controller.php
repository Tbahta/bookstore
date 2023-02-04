<?php

// Path: app\core\controller.php
// This is the base controller class
class Controller {

 //This method is used to load a view and pass data to it
  protected function view($view, $data = []) {
      
      extract($data); //using this, we can access each element inside $data  can be echoed as a ssingle variable
      if(file_exists("../app/views/".$view.".php") ){
          include "../app/views/".$view.".php";
  
      } else {
          include "../app/views/404.php";
        }
  }

  // This method is used to load a model
  protected function loadModel($model) {
    if(file_exists("../app/models/". strtolower($model) . ".class.php")) {
        include "../app/models/".strtolower($model).".class.php";
              
        return $model = new $model();

    } else {
        return false;
      }
      

  }


}