<?php

// Path: app\core\config.php
define("WEBSITE","Bookstre");

//Database constants
define("DB_TYPE",'mysql');
define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASS","root");
define("DB_NAME","bookstore");


define("PROTOCOL","http");

//This is for the root path
$path = str_replace("\\","/",PROTOCOL ."://". $_SERVER['SERVER_NAME']. __DIR__ ."/");
$path = str_replace($_SERVER['DOCUMENT_ROOT'],"",$path);
define('ROOT',str_replace("app/core","public", $path));//http://localhost/bookstore/public/
define("ASSETS", str_replace("app/core","public/assets",$path)); //http://localhost/bookstore/public/assets/

//debug for dev purposes
// echo "Path : ".$path ."<br/>";
// echo "ROOT : ".ROOT ."<br/>";
// echo "ASSESTS : ".ASSETS ."<br/>";
define('DEBUG',true);
if(DEBUG){
    ini_set("display_errors",1);
}else{
    ini_set("display_errors",0);
}






