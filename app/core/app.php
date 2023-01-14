<?php

// Path: app\core\app.php
class App
{

    private $controller = "home";
    private $method = "index";
    private $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();
        display($url);
        if(file_exists("../app/controllers/". strtolower($url[0]). ".php")) {
            $this->controller = $url[0];
           // unset($url[0]);
        }
        require "../app/controllers/" . $this->controller . ".php";
        $this->controller = new $this->controller;

        if(isset($url[1])) {
            echo "i am here \n";
            if(method_exists($this->controller, strtolower($url[1]))){
                echo "here ehrere am here \n";
                $this->method = $url[1];
                unset($url[1]);
            }
        }
       // display($url);
    }

    private function parseUrl(){
        // $url = isset($_GET['url']) ? $_GET['url'] : "home" ;
        if(isset($_GET['url'])) {
            $url = $_GET['url'];
        } else {
            $url = 'home';
        }

        return explode("/", filter_var(trim($url,"/"),FILTER_SANITIZE_URL));
    }

}