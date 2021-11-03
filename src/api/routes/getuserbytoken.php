<?php

use Article\Article;
use UserManager\Author;

include_once("../../core/initialize.php");
  
 header($ALLOW_ORIGIN);
 header($CONTENT_TYPE_JSON);
 
 if($method=$_SERVER["REQUEST_METHOD"]!="GET")   die(json_encode([["message"=>"Method $method not allowed","error"=>true]]));
  
if(!isset($_GET["token"]))                           die(json_encode([["message"=>"Token access  required","error"=>true]]));

$token                                                                                                     =$_GET["token"];
if(strlen($token)<150)                                               die([["message"=>"Invalid token access","error"=>true]]);

$user                                                                                             =new Author($connection);
$user->token                                                                                                       =$token;
$user_data                                                                                          =$user->validateUser();

if(!$user_data)                                                 die(json_encode([["message"=>"Acces denied","error"=>true]]));

echo(json_encode([["data"=> $user_data,"error"=>false]]));
