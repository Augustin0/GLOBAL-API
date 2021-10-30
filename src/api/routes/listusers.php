<?php

use UserManager\Author;

include_once("../../core/initialize.php");
  
 header($ALLOW_ORIGIN);
 header($CONTENT_TYPE_JSON);

  if($_SERVER["REQUEST_METHOD"]=="GET"){
    $author=new Author($connection);
    $data=$author->list_users();
    if($data){
        echo(json_encode(["res"=>["data"=>$data,"error"=>1]]));
    }else  echo(json_encode(["res"=>["message"=>"No data","error"=>0]]));
    
  }else{
      echo(json_encode(["res"=>["message"=>"","error"=>0]]));
  }









?>