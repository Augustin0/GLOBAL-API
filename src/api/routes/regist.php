<?php

use UserManager\Author;

include_once("../../core/initialize.php");
include_once("../middleware/policies_articles.php");
include_once("../utils/savefile.php");

header($ALLOW_ORIGIN);//access conroll
header($ALLOW_POST);//access conroll
header($ALLOWS_HEADERS);//access conroll




if($_SERVER["REQUEST_METHOD"]=="POST"){
  if(!validateFormRegist())
  {
    echo(json_encode(["res"=>["message"=>"Invalida form","error"=>0]]));
   
  }else {
     $fileData=save_file("user_image","users/");
     if($fileData)
     {
       $body=$_POST;
       $user=new Author($connection);

       $user->ctr              =$body["ctr"];
       $user->name            =$body["name"];
       $user->lang            =$body["lang"];
       $user->prov            =$body["prov"];
       $user->mail            =$body["mail"];
       $user->lastname    =$body["lastname"];
       $user->password    =$body["password"];
       $user->user_image   =$fileData["url"];
       $res=$user->regist();
       if($res>0){
           print($res);
           echo(json_encode(["res"=>["message"=>"Success","error"=>1]]));

       }else{
        unlink($fileData["origin"]);
        echo(json_encode(["res"=>["message"=>"profile required","error"=>2]]));
       }


     }else
     {
      echo(json_encode(["res"=>["message"=>"profile required","error"=>3]])); 
     }

  }
 
   

}else{
  echo(json_encode(["res"=>["message"=>"profile required","error"=>4]])); 
   
    return;

}









?>