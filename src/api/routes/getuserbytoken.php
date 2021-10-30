<?php

use Article\Article;
use UserManager\Author;

include_once("../../core/initialize.php");
  
 header($ALLOW_ORIGIN);
 header($CONTENT_TYPE_JSON);

  if($_SERVER["REQUEST_METHOD"]=="GET") 
  {
    if(!isset($_GET["token"])){echo json_encode(["res"=>["data"=>[],"error"=>1]]);return;};
    $token=$_GET["token"];
    if(!$token){echo json_encode(["res"=>["data"=>[],"error"=>2]]);return;};
    $user=new Author($connection);
    $user->token=$token;
    $user_data=$user->validateUser();

    if(!$user_data){echo json_encode(["res"=>["data"=>[],"error"=>3]]); return;}
    echo json_encode(["res"=>["data"=> $user_data,"error"=>0]]);
  }
  else
  {
    echo json_encode(["res"=>["data"=>[],"error"=>4]]);
    return;
  }











?>