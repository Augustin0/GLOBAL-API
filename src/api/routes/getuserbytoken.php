<?php

use Article\Article;
use UserManager\Author;

include_once("../../core/initialize.php");
  
 header($ALLOW_ORIGIN);
 header($CONTENT_TYPE_JSON);
 
 if($method=$_SERVER["REQUEST_METHOD"]!="GET")   die("Method $method not allowed");
  
if(!isset($_GET["token"]))      die(json_encode(["res"=>["data"=>[],"error"=>1]]));

$token                                                            =$_GET["token"];
if(strlen($token)<150)                                die("Invalid token access");

$user                                                    =new Author($connection);
$user->token                                                              =$token;
$user_data                                                 =$user->validateUser();

if(!$user_data)                                               die("Acces denied");

echo(json_encode(["res"=>["data"=> $user_data,"error"=>0]]));
