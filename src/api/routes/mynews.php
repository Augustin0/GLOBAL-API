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
    //print_r($user_data);
    if(!$user_data){echo json_encode(["res"=>["data"=>[],"error"=>3]]); return;};
    $article=new Article($connection,$API_KEY);
    $article->author=$user_data["id"];
    $my_news=$article->getMynews();
    echo json_encode(["res"=>["data"=>$my_news,"error"=>0]]);
  }
  else
  {
    echo json_encode(["res"=>["data"=>[],"error"=>4]]);
    return;
  }











?>