<?php

use UserManager\Author;

include_once("../../core/initialize.php");
include_once("../middleware/policies_articles.php");
include_once("../utils/savefile.php");

header($ALLOW_ORIGIN);//access conroll
header($ALLOW_POST);//access conroll
header($ALLOWS_HEADERS);//access conroll







if($_SERVER["REQUEST_METHOD"]=="POST"){
if(validateFormLogin()){
    $body=$_POST;
    $user=new Author($connection);
    $user->mail=$body["mail"];
    $user->password=$body["password"];
    $res=$user->login();
    if($res){
        echo(json_encode(["res"=>["token"=>$res,"error"=>0]]));
        exit();
    }else{
        echo(json_encode(["res"=>["token"=>$res,"error"=>1]]));
       // showEror();
        return;
    }


    }else{
       echo(json_encode(["res"=>["token"=>"","error"=>2]]));
       // showEror();
        return;
    }



}else{
    echo(json_encode(["res"=>["token"=>"","error"=>3]]));
  //  showEror();
    return;
}





























?>